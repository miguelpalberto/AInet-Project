<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
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

    public function addToCart(Request $request, TshirtImage $tshirtImage): RedirectResponse
    {
        try {
            $userType = $request->user()->user_type ?? 'O';
            if ($userType != 'C') {
                $customersId = 9999;
            } else {
                $customersId = $request->user()->id;
            }

            $totalTshirt = OrderItem::where('order_id', $tshirtImage)
                ->where('order_id', $customersId)
                ->count();

                if ($totalTshirt >= 1) {
                $alertType = 'warning';
                $url = route('tshirtImages.show', ['tshirtImage' => $tshirtImage]);
                $htmlMessage = "Não é possível adicionar a tshirt <a href='$url'>#{$tshirtImage->id}</a>
                    <strong>\"{$tshirtImage->name}\"</strong> ao carrinho, porque já existeno mesmo";
            } else {
                // We can access session with a "global" function
                $cart = session('cart', []);
                if (array_key_exists($tshirtImage->id, $cart)) {
                    $alertType = 'warning';
                    $url = route('tshirtImages.show', ['tshirtImage' => $tshirtImage]);
                    $htmlMessage = "Tshirt <a href='$url'>#{$tshirtImage->id}</a>
                    <strong>\"{$tshirtImage->name}\"</strong> não foi adicionada ao carrinho porque já está presente no mesmo!";
                } else {
                    $cart[$tshirtImage->id] = $tshirtImage;
                    // We can access session with a request function
                    $request->session()->put('cart', $cart);
                    $alertType = 'success';
                    $url = route('tshirtImages.show', ['tshirtImage' => $tshirtImage]);
                    $htmlMessage = "Tshirt <a href='$url'>#{$tshirtImage->id}</a>
                    <strong>\"{$tshirtImage->name}\"</strong> foi adicionada ao carrinho!";
                }
            }
        } catch (\Exception $error) {
            $url = route('tshirtImages.show', ['tshirtImage' => $tshirtImage]);
            $htmlMessage = "Não é possível adicionar a tshirt <a href='$url'>#{$tshirtImage->id}</a>
                        <strong>\"{$tshirtImage->name}\"</strong> ao carrinho, porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }

    public function removeFromCart(Request $request, tshirtImage $tshirtImage): RedirectResponse
    {
        $cart = session('cart', []);
        if (array_key_exists($tshirtImage->id, $cart)) {
            unset($cart[$tshirtImage->id]);
        }
        $request->session()->put('cart', $cart);
        $url = route('tshirtImages.show', ['tshirtImage' => $tshirtImage]);
        $htmlMessage = "Tshirt <a href='$url'>#{$tshirtImage->id}</a>
                        <strong>\"{$tshirtImage->name}\"</strong> foi removida do carrinho!";
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    // Gravar encomenda
    public function store(Request $request): RedirectResponse
    {
        try {
            $userType = $request->user()->tipo ?? 'O';
            if ($userType != 'C') {
                $alertType = 'warning';
                $htmlMessage = "É necessário fazer login com uma conta de cliente para adicionar itens ao carrinho.";
            } else {
                $cart = session('cart', []);
                $total = count($cart);
                if ($total < 1) {
                    $alertType = 'warning';
                    $htmlMessage = "Não é possível gravar a encomenda, pois não há tshirts no carrinho.";
                } else {
                    $customer = $request->user()->customers;
                    DB::transaction(function () use ($customer, $cart) {
                        foreach ($cart as $tshirtImage) {
                            $customer->tshirtImage()->attach($tshirtImage->id, []);
                        }
                    });
                    $htmlMessage = "A encomenda foi confirmada com $total tshirts #{$customer->id} <strong>\"{$request->user()->name}\"</strong>";
                    $request->session()->forget('cart');
                    return redirect()->route('tshirtImage.minhas')
                        ->with('alert-msg', $htmlMessage)
                        ->with('alert-type', 'success');
                }
            }
        } catch (\Exception $error) {
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
        $htmlMessage = "Carrinho está limpo!";
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }


}
