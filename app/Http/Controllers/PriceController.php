<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\PriceRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        $prices = Price::paginate(10);
        return view('prices.index', compact('prices'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $price = new Price();

        return view('prices.create')
        ->withPrice($price);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PriceRequest $request): RedirectResponse
    {
        $newPrice = Price::create($request->validate());
        $url = route('prices.show', ['price' => $newPrice]);
        $htmlMessage = "Imagem de Price <a href='$url'>#{$newPrice->id}</a> <strong>\"{$newPrice->nome}\"</strong> foi criada com sucesso!";
        return redirect()->route('prices.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Price $price): View
    {
         //$users = User::all();
         return view('prices.show')
         ->with('price', $price);
        //->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Price $price): View
    {
         //$users = User::all();
         return view('prices.edit', [
            'price' => $price
            //, 'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PriceRequest $request, Price $price): RedirectResponse
    {
        $price->update($request->validated());
        $url = route('prices.show', ['price' => $price]);
        $htmlMessage = "Imagem de Preço <a href='$url'>#{$price->id}</a> <strong>\"{$price->name}\"</strong> foi alterada com sucesso!";
        return redirect()->route('prices.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Price $price): RedirectResponse
    {
        try {
            $price->delete();
            $htmlMessage = "Imagem de Preço #{$price->id} <strong>\"{$price->name}\"</strong> foi apagada com sucesso!";
            $alertType = 'success';
        } catch (\Exception $error) {
            $url = route('prices.show', ['price' => $price]);
            $htmlMessage = "Não foi possível apagar a Imagem de Preço <a href='$url'>#{$price->id}</a><strong>\"{$price->name}\"</strong> porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return redirect()->route('prices.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }
}

