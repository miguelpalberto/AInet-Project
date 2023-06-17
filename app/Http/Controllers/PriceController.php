<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\PriceRequest;
use Illuminate\Support\Facades\DB;


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


    // Prices é só uma linha (já criada desde o inicio)
    // public function create(): View
    // {
    //     $price = new Price();
    //     return view('prices.create')->withPrice($price);
    // }

    // Prices é só uma linha (já criada desde o inicio)
    // public function store(PriceRequest $request): RedirectResponse
    // {
    //     $newPrice = Price::create($request->validated());
    //     $url = route('prices.show', ['price' => $newPrice]);
    //     $htmlMessage = "Preço <a href='$url'>#{$newPrice->id}</a> foi criado com sucesso!";
    //     return redirect()->route('prices.index')
    //         ->with('alert-msg', $htmlMessage)
    //         ->with('alert-type', 'success');
    // }

    /**
     * Display the specified resource.
     */
    public function show(Price $price): View
    {
         //$users = User::all();
         return view('prices.show') ->with('price', $price);
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
        $htmlMessage = "Preço <a href='$url'>#{$price->id}</a> foi alterado com sucesso!";
        return redirect()->route('prices.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    // Prices é só uma linha (nao removivel)
    // public function destroy(Price $price): RedirectResponse
    // {
    //     try {
    //         $price->delete();
    //         $htmlMessage = "Preço #{$price->id}foi apagado com sucesso!";
    //         $alertType = 'success';
    //     } catch (\Exception $error) {
    //         $url = route('prices.show', ['price' => $price]);
    //         $htmlMessage = "Não foi possível apagar o Preço <a href='$url'>#{$price->id}</a> porque ocorreu um erro!";
    //         $alertType = 'danger';
    //     }
    //     return redirect()->route('prices.index')
    //         ->with('alert-msg', $htmlMessage)
    //         ->with('alert-type', $alertType);
    // }
}

