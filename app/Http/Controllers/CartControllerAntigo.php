<?php

namespace App\Http\Controllers;

//TODO APAGAR ESTE FICHIERO

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\TshirtImage;

class CartController extends Controller
{
    // Mostrar carrinho
    public function show(): View
    {
        $cart = session('cart', []);
        return view('cart.show', compact('cart'));
    }

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
            $totalItems = TshirtImage::where('order_id', $tshirtImage)
                ->where('order_id', $customersId)
                ->count();
                if ($totalItems >= 1) {
                $alertType = 'warning';
                $url = route('tshirtImages.show', ['tshirtImage' => $tshirtImage]);
                $htmlMessage = "Não é possível adicionar o item <a href='$url'>#{$tshirtImage->id}</a>
                    <strong>\"{$tshirtImage->name}\"</strong> ao carrinho, porque já existe no mesmo";
            } else {
                // We can access session with a "global" function
                $cart = session('cart', []);
                if (array_key_exists($tshirtImage->id, $cart)) {
                    $alertType = 'warning';
                    $url = route('tshirtImages.show', ['tshirtImage' => $tshirtImage]);
                    $htmlMessage = "Item <a href='$url'>#{$tshirtImage->id}</a>
                    <strong>\"{$tshirtImage->name}\"</strong> não foi adicionado ao carrinho porque já está presente no mesmo!";
                } else {
                    $cart[$tshirtImage->id] = $tshirtImage;
                    // We can access session with a request function
                    $request->session()->put('cart', $cart);
                    $alertType = 'success';
                    $url = route('tshirtImages.show', ['tshirtImage' => $tshirtImage]);
                    $htmlMessage = "Item <a href='$url'>#{$tshirtImage->id}</a>
                    <strong>\"{$tshirtImage->name}\"</strong> foi adicionado ao carrinho!";
                }
            }
        } catch (\Exception $error) {
            $url = route('tshirtImages.show', ['tshirtImage' => $tshirtImage]);
            $htmlMessage = "Não é possível adicionar o item <a href='$url'>#{$tshirtImage->id}</a>
                        <strong>\"{$tshirtImage->name}\"</strong> ao carrinho, porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }

        // Remover tshirt do carrinho
    public function removeFromCart(Request $request, TshirtImage $tshirtImage): RedirectResponse
    {
        $cart = session('cart', []);
        if (array_key_exists($tshirtImage->id, $cart)) {
            unset($cart[$tshirtImage->id]);
        }
        $request->session()->put('cart', $cart);
        $url = route('tshirtImages.show', ['tshirtImage' => $tshirtImage]);
        $htmlMessage = "Item <a href='$url'>#{$tshirtImage->id}</a>
                        <strong>\"{$tshirtImage->name}\"</strong> foi removido do carrinho!";
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
                    foreach ($cart as $tshirtImage) {
                        // $tshirtImage->tshirtImages()->attach($tshirtImage->id, []);
                        // $order = new tshirtImage();
                        // $order->order_id = $totalOrders;
                        // $order->tshirt_image_id = $tshirtImage->id;
                        // $order->color_code = 'a1a2a3'; // valor forçado
                        // $order->size = 'L'; // valor forçado
                        // $order->qty = '1'; // valor forçado
                        // $order->unit_price = '0,0'; // valor forçado
                        // $order->sub_total = '0,0'; // valor forçado
                        // dd($tshirtImage);

                        // $order = new tshirtImage();
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

                        // $customer->tshirtImages()->attach(['status' => 'Pending', 'customer_id' => $customer, 'date' => date('Y-m-d H:i:s'), 'total_price' => '', 'notes' => 'Sem notas',
                        // 'nif' => $customer->nif, 'address' => $customer->address, 'payment_type' => $customer->default_payment_type, 'payment_ref' => $customer->default_payment_ref, 'receipt_url' => 'Vazio.pdf']);

                        $customer->tshirtImages()->attach($tshirtImage->id, ['status' => 'Pending']);

                        dd('AQUI');
                        // $order->save();

                    }
                });
                $htmlMessage = "A encomenda foi confirmada com $total itens #{$customer->id} <strong>\"{$request->user()->name}\"</strong>";
                $request->session()->forget('cart');
                return redirect()->route('tshirtImages.show')
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
