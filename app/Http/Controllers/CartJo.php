<?php

namespace App\Http\Controllers;

//TODO APAGAR ESTE FICHIERO

use App\Models\Order;
use App\Models\Price;
use App\Models\OrderItem;
use Illuminate\View\View;
use App\Models\TshirtImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    // Mostrar carrinho
    public function show(): View
    {
        $cart = session('cart', []);
        return view('cart.show', compact('cart'));
    }

public function addToCart(CartRequest $request, TshirtImage $tshirtImage): RedirectResponse
    {
        try {
            $formData = $request->validated();

            $cart = session('cart', []);
            $orderItem = new OrderItem();
            $orderItem->id = null; //precisa de ter um id para set considerado como parametro de uma rota
            $orderItem->tshirt_image_id = $tshirtImage->id;
            $orderItem->color_code = $formData['color'];
            $orderItem->size = $formData['size'];
            $orderItem->qty = $formData['quantity'];
            $orderItem->tshirtImage = $tshirtImage;
            $orderItem->tshirt_image_id = $tshirtImage->id;
            $hashValue = $orderItem->hashValue;

            if (array_key_exists($hashValue, $cart)) {
                $cart[$hashValue]->qty += $orderItem->qty;
            } else {
                $cart[$hashValue] = $orderItem;
            }

            $request->session()->put('cart', $cart);

            if ($orderItem->qty == 1) {
                $htmlMessage = "1 tshirt \"{$tshirtImage->name}\" foi adicionada ao carrinho!";

            } else {
                $htmlMessage = "{$orderItem->qty} tshirts foram adicionadas ao carrinho!";
            }

            $alertType = 'success';
        } catch (\Exception $error) {
            $htmlMessage = "Não é possível adicionar a tshirt <strong>\"{$tshirtImage->name}\"</strong>ao carrinho, porque ocorreu um erro!";
            $alertType = 'danger';
        }

        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }



    public function removeFromCart(Request $request, $orderItemHashValue): RedirectResponse
    {
        $cart = session('cart', []);
        if (array_key_exists($orderItemHashValue, $cart)) {
            unset($cart[$orderItemHashValue]);
        }

        $request->session()->put('cart', $cart);
        $htmlMessage = "Item removido do carrinho!";
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    public function store(OrderRequest $request): RedirectResponse
    {
        $cart = session('cart', []);

        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('cart', $cart)
                ->with('alert-msg', "Precisa de fazer login para finalizar a compra!")
                ->with('alert-type', 'danger');
        }

        try {
            $total = count($cart);

            if ($total < 1) {
                return back()
                ->with('alert-msg', 'Não existem items no carrinho.')
                ->with('alert-type', 'danger');
            } else {

                $formData = $request->validated();
                $prices = Price::first();
                $user = Auth::user();

                $order = DB::transaction(function () use ($user, $formData, $prices, $cart) {
                    $total = 0;
                    $newOrder = new Order();
                    $newOrder->status = 'pending';
                    $newOrder->customer_id = $user->id;
                    $newOrder->date = date('y-m-d');
                    $newOrder->nif = $formData['nif'];
                    $newOrder->address = $formData['address'];
                    $newOrder->payment_type = $formData['payment_type'];
                    $newOrder->payment_ref = $formData['payment_ref'];

                    foreach($cart as $orderItem){
                        $orderItem->unit_price = $orderItem->getUnitPrice($prices);
                        $orderItem->sub_total = $orderItem->calculateSubTotal($prices);
                        $total += $orderItem->sub_total;
                    }

                    $newOrder->total_price = $total;
                    $newOrder->save();

                    foreach($cart as $orderItem){

                        $orderItem->order_id = $newOrder->id;
                        //não encontramos outra solução para remover a referência da tshirtImage sem
                        //  interferir com a vista

                        $orderItemClone = clone $orderItem;
                        unset($orderItemClone->tshirtImage);
                        $orderItemClone->save();
                    }

                    return $newOrder;
                });

                $htmlMessage = "Encomenda efetuada com sucesso";
                $request->session()->forget('cart');

                return redirect()->route('orders.payment.confirm', ['order' => $order])
                    ->with('alert-msg', $htmlMessage)
                    ->with('alert-type', 'success');
            }

        } catch (\Exception $error) {

            $htmlMessage = "$error Não foi possível confirmar o carrinho, porque ocorreu um erro!";
            $alertType = 'danger';
        }

        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }

}


