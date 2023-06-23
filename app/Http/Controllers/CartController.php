<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Order;
use App\Models\Price;
use App\Models\OrderItem;
use App\Models\TshirtImage;
use Illuminate\Http\Request;
use App\Http\Requests\CartRequest;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Mostrar carrinho
    public function show(): View
    {
        $cart = session('cart', []);
        $price = Price::first();
        return view('cart.show', compact('cart', 'price'));
    }

public function addToCart(CartRequest $request, TshirtImage $tshirtImage): RedirectResponse
    {
        try {
            $formData = $request->validated();

            $cart = session('cart', []);
            $orderItem = new OrderItem();
            $orderItem->id = null; //precisa de ter um id para ser considerado como parametro de uma rota
            $orderItem->color_code = $formData['color'];
            $orderItem->size = $formData['size'];
            $orderItem->qty = $formData['qty'];
            $orderItem->tshirtImage = $tshirtImage;
            $orderItem->tshirt_image_id = $tshirtImage->id;
            //dd($orderItem);
            //dd($tshirtImage);

            //$index = $tshirtImage->id . '#' . $orderItem->color_code . '#' . $orderItem->size;
            $index = $orderItem->index;

            if (array_key_exists($index, $cart)) {
                $cart[$index]->qty += $orderItem->qty;
            } else {
                $cart[$index] = $orderItem;
            }

            $request->session()->put('cart', $cart);

            if ($orderItem->qty == 1) {
                $htmlMessage = "1 Tshirt \"{$tshirtImage->name}\" foi adicionada ao carrinho!";

            } else {
                $htmlMessage = "{$orderItem->qty} Tshirts foram adicionadas ao carrinho!";
            }

            $alertType = 'success';
        } catch (\Exception $error) {
            $htmlMessage = "Não foi possível adicionar a Tshirt <strong>\"{$tshirtImage->name}\"</strong> ao carrinho, porque ocorreu um erro!";
            $alertType = 'danger';
        }

        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }



    public function removeFromCart(Request $request, $index): RedirectResponse
    {
        $cart = session('cart', []);
        if (array_key_exists($index, $cart)) {
            unset($cart[$index]);
        }
        else{
            throw new \Exception($index);
        }

        $tshirt_image_id = explode("_", $index)[0];//0-imageID, 1-color, 2-size
        $tshirtImage = TshirtImage::find($tshirt_image_id);

        $request->session()->put('cart', $cart);
        $htmlMessage = "Item com tshirt <strong>\"{$tshirtImage->name}\"</strong> foi removido do carrinho!";
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }


    public function store(OrderRequest $request): RedirectResponse
    {
        $cart = session('cart', []);

        if (!Auth::check()) {//Auth
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

        // Limpar carrinho
        public function destroy(Request $request): RedirectResponse
        {
            $request->session()->forget('cart');
            $htmlMessage = "O carrinho foi limpo!";
            return back()
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'success');
        }

}


