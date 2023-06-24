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
        $order = new Order();
        $tshirtImage = TshirtImage::all();
        return view('cart.show', compact('cart', 'price', 'order', 'tshirtImage'));
    }

public function addToCart(CartRequest $request, TshirtImage $tshirtImage): RedirectResponse
    {
        try {
            $formData = $request->validated();

            $cart = session('cart', []);
            $orderItem = new OrderItem();
            $orderItem->id = null; //precisa de id para ser parametro de rota
            $orderItem->color_code = $formData['color'];
            $orderItem->size = $formData['size'];
            $orderItem->qty = $formData['qty'];
            $orderItem->tshirtImage = $tshirtImage;
            $orderItem->tshirt_image_id = $tshirtImage->id;
            //dd($orderItem);
            //dd($tshirtImage);

            $index = $orderItem->index;//Index é definido no model OrderItem

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
                ->with('alert-msg', "É necessário fazer login para concluir a encomenda!")
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
                    $newOrder = new Order();
                    $newOrder->status = 'pending';
                    $newOrder->customer_id = $user->id;
                    $newOrder->date = date('y-m-d');
                    $newOrder->notes = $formData['notes'];
                    $newOrder->nif = $formData['nif'] ?? '';
                    $newOrder->address = $formData['address'];
                    $newOrder->payment_type = $formData['payment_type'];
                    $newOrder->payment_ref = $formData['payment_ref'];
                    $newOrder->receipt_url = null;//TODO ver enunciado

                    $total = 0;
                    foreach($cart as $orderItem){
                        if( $orderItem->tshirtImage->customer_id == null){
                            $orderItem->unit_price = $prices->unit_price_catalog;
                        }
                        else{
                            $orderItem->unit_price = $prices->unit_price_own;
                        }
                        $orderItem->sub_total = $orderItem->unit_price * $orderItem->qty;
                        $total += $orderItem->sub_total;
                    }

                    $newOrder->total_price = $total;
                    $newOrder->save();

                    foreach($cart as $orderItem){

                        $orderItem->order_id = $newOrder->id;
                        //remover a referência da tshirtImage para nao interferir com a vista
                        $orderCopia = clone $orderItem;
                        unset($orderCopia->tshirtImage);
                        $orderCopia->save();
                    }

                    return $newOrder;
                });

                $htmlMessage = "A encomenda com $total itens foi criada com sucesso!";
                $request->session()->forget('cart');
                return redirect()->route('cart.show', ['order' => $order])
                    ->with('alert-msg', $htmlMessage)
                    ->with('alert-type', 'success');
            }

        } catch (\Exception $error) {

            $htmlMessage = "Não foi possível criar encomenda, porque ocorreu um erro!";
            //$htmlMessage = "$error Não foi possível criar encomenda, porque ocorreu um erro!";
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


