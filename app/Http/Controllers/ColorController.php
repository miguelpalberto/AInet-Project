<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColorRequest;
use App\Models\Color;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ColorEditRequest;

class ColorController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Color::class, 'color');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $filterByName = $request->name ?? '';
        $colorQuery = Color::query();
        if ($filterByName !== '') {
            $colorIds = Color::where('name', 'like', "%$filterByName%")->pluck('code');
            $colorQuery->whereIn('code', $colorIds);
        }
        $colors = $colorQuery->paginate(10);
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
        $formData = $request->validated();
        $color = DB::transaction(function () use ($formData, $request) {
            $newColor = new Color();
            $newColor->code = $formData['code'];
            $newColor->name = $formData['name'];
            $newColor->save();
            return $newColor;
        });
        $url = route('colors.show', ['color' => $color]);
        $htmlMessage = "Cor <a href='$url'>#{$color->code}</a>
                        <strong>\"{$color->name}\"</strong> foi criada com sucesso!";

        return redirect()->back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color): View
    {
        return view('colors.show')
            ->withColor($color);
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

    public function update(ColorEditRequest $request, Color $color): RedirectResponse
    {
        $color->name = $request->input('name');
        $color->save();

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
            $totalColors = DB::scalar('select count(*) from order_items where color_code = ?', [$color->code]);
            if ($totalColors == 0) {
                $color->delete();
                $htmlMessage = "Cor #{$color->code}
                                <strong>\"{$color->name}\"</strong> foi apagada com sucesso!";
                return redirect()->route('colors.index')
                    ->with('alert-msg', $htmlMessage)
                    ->with('alert-type', 'success');
            } else {
                $url = route('colors.show', ['color' => $color]);
                $alertType = 'warning';
                $colorsStr = $totalColors > 0 ?
                    ($totalColors == 1 ?
                        "1 Order Item com esta cor" :
                        "$totalColors Order Items com esta cor") :
                    "";
                $htmlMessage = "Cor <a href='$url'>#{$color->code}</a>
                                <strong>\"{$color->name}\"</strong>
                                não pode ser apagada porque há $colorsStr!
                                ";
            }
        } catch (\Exception $error) {
            $url = route('colors.show', ['color' => $color]);
            $htmlMessage = "Não foi possível apagar a cor <a href='$url'>#{$color->code}</a>
                                <strong>\"{$color->name}\"</strong> porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }
}
