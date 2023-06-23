<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TshirtImage;

class CartController extends Controller
{
    // Mostrar carrinho
    public function show(): View
    {
        $cart = session('cart', []);
        return view('cart.show', compact('cart'));
    }

    //TODO cartRequest
    // Adicionar item ao carrinho
    public function addToCart(Request $request, TshirtImage $tshirtImage): RedirectResponse
    {
        try {
            $userType = $request->user()->user_type ?? 'O';
            if ($userType != 'C') {
                $customersId = 9999;
            } else {
                $customersId = $request->user()->id;
            }
            $totalItems = OrderItem::where('order_id', $orderItem)
                ->where('order_id', $customersId)
                ->count();
                if ($totalItems >= 1) {
                $alertType = 'warning';
                $url = route('orderItems.show', ['orderItem' => $orderItem]);
                $htmlMessage = "Não é possível adicionar o item <a href='$url'>#{$orderItem->id}</a>
                    <strong>\"{$orderItem->name}\"</strong> ao carrinho, porque já existe no mesmo";
            } else {
                // We can access session with a "global" function
                $cart = session('cart', []);
                if (array_key_exists($orderItem->id, $cart)) {
                    $alertType = 'warning';
                    $url = route('orderItems.show', ['orderItem' => $orderItem]);
                    $htmlMessage = "Item <a href='$url'>#{$orderItem->id}</a>
                    <strong>\"{$orderItem->name}\"</strong> não foi adicionado ao carrinho porque já está presente no mesmo!";
                } else {
                    $cart[$orderItem->id] = $orderItem;
                    // We can access session with a request function
                    $request->session()->put('cart', $cart);
                    $alertType = 'success';
                    $url = route('orderItems.show', ['orderItem' => $orderItem]);
                    $htmlMessage = "Item <a href='$url'>#{$orderItem->id}</a>
                    <strong>\"{$orderItem->name}\"</strong> foi adicionado ao carrinho!";
                }
            }
        } catch (\Exception $error) {
            $url = route('orderItems.show', ['orderItem' => $orderItem]);
            $htmlMessage = "Não é possível adicionar o item <a href='$url'>#{$orderItem->id}</a>
                        <strong>\"{$orderItem->name}\"</strong> ao carrinho, porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }

        // Remover tshirt do carrinho
    public function removeFromCart(Request $request, OrderItem $orderItem): RedirectResponse
    {
        $cart = session('cart', []);
        if (array_key_exists($orderItem->id, $cart)) {
            unset($cart[$orderItem->id]);
        }
        $request->session()->put('cart', $cart);
        $url = route('orderItems.show', ['orderItem' => $orderItem]);
        $htmlMessage = "Item <a href='$url'>#{$orderItem->id}</a>
                        <strong>\"{$orderItem->name}\"</strong> foi removido do carrinho!";
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    // Gravar encomenda
    public function store(Request $request): RedirectResponse
    {
        try {
            $userType = $request->user()->user_type ?? 'O';
            if ($userType != 'C') {
                $alertType = 'warning';
                $htmlMessage = "É necessário fazer login com uma conta de cliente para concluir a encomenda.";
            } else {
                $cart = session('cart', []);
                $total = count($cart);
                $customer = $request->user()->customer;
                // dd($customer);
                $totalOrdersItems = (DB::select('select count(*) as total from order_items'))[0]->total + 1;
                $totalOrders = (DB::select('select count(*) as total from orders'))[0]->total + 1;
                // dd($totalOrdersItems, $totalOrders);
                DB::transaction(function () use ($customer, $cart, $totalOrders) {
                    foreach ($cart as $orderItem) {
                        // $orderItem->orderItems()->attach($orderItem->id, []);
                        // $order = new OrderItem();
                        // $order->order_id = $totalOrders;
                        // $order->tshirt_image_id = $orderItem->id;
                        // $order->color_code = 'a1a2a3'; // valor forçado
                        // $order->size = 'L'; // valor forçado
                        // $order->qty = '1'; // valor forçado
                        // $order->unit_price = '0,0'; // valor forçado
                        // $order->sub_total = '0,0'; // valor forçado
                        // dd($orderItem);

                        // $order = new OrderItem();
                        // $order->status = 'Pending';
                        // $order->customer_id = $customer;
                        // $order->date = date('Y-m-d H:i:s');
                        // $order->total_price = '';
                        // $order->notes = 'Sem notas extra';
                        // $order->nif = $customer->nif;
                        // $order->address = $customer->address;
                        // $order->payment_type = $customer->default_payment_type;
                        // $order->payment_ref = $customer->default_payment_ref;
                        // $order->receipt_url = 'Vazio.pdf';
                        // dd($order);

                        // $customer->orderItems()->attach(['status' => 'Pending', 'customer_id' => $customer, 'date' => date('Y-m-d H:i:s'), 'total_price' => '', 'notes' => 'Sem notas',
                        // 'nif' => $customer->nif, 'address' => $customer->address, 'payment_type' => $customer->default_payment_type, 'payment_ref' => $customer->default_payment_ref, 'receipt_url' => 'Vazio.pdf']);

                        $customer->orderItems()->attach($orderItem->id, ['status' => 'Pending']);

                        dd('AQUI');
                        // $order->save();

                    }
                });
                $htmlMessage = "A encomenda foi confirmada com $total itens #{$customer->id} <strong>\"{$request->user()->name}\"</strong>";
                $request->session()->forget('cart');
                return redirect()->route('orderItems.show')
                    ->with('alert-msg', $htmlMessage)
                    ->with('alert-type', 'success');
            }
        } catch (\Exception $error) {
            dd($error->getMessage());
            $htmlMessage = "Não foi possível confirmar a encomenda devido a um erro.";
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
