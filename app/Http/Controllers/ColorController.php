<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColorRequest;
use App\Models\Color;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $filterByName = $request->name ?? '';
        $userQuery = Color::query();
        if ($filterByName !== '') {
            $colorIds = Color::where('name', 'like', "%$filterByName%")->pluck('code');
            $userQuery->whereIntegerInRaw('code', $colorIds);
        }
        $colors = Color::paginate(10);
        return view('colors.index', compact('colors', 'filterByName'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $color = new Color();
        return view('colors.create')->withColor($color);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColorRequest $request): RedirectResponse
    {
        $newColor = Color::create($request->validate());
        $url = route('colors.show', ['color' => $newColor]);
        $htmlMessage = "Cor <a href='$url'>#{$newColor->code}</a> foi criada com sucesso!";
        return redirect()->route('colors.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color): View
    {
        return view('colors.show') ->with('color', $color);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color): View
    {
        return view('colors.edit', [
            'color' => $color
            //, 'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ColorRequest $request, Color $color): RedirectResponse
    {
        $color->update($request->validated());
        $url = route('colors.show', ['color' => $color]);
        $htmlMessage = "Cor <a href='$url'>#{$color->code}</a> foi alterada com sucesso!";
        return redirect()->route('colors.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color): RedirectResponse
    {
        try {
            $color->delete();
            $htmlMessage = "Cor #{$color->code}foi apagada com sucesso!";
            $alertType = 'success';
        } catch (\Exception $error) {
            $url = route('colors.show', ['color' => $color]);
            $htmlMessage = "Não foi possível apagar a Cor <a href='$url'>#{$color->code}</a> porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return redirect()->route('colors.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }

}

