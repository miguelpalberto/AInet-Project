<?php

namespace App\Http\Controllers;

use App\Models\TshirtImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\TshirtImageRequest;
use Illuminate\Support\Facades\DB;

class TshirtImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tshirtImages = TshirtImage::paginate(10);
        return view('tshirtImages.index', compact('tshirtImages'));
    }
    // Depois de criar classe category - Substituir por funcao acima e corrigir, para ter filtro de categoria, na apresentacao das tshirts- Ex 3 Ficha 7
    // public function index(Request $request): View
    // {
    //     $cursos = Curso::all();
    //     $filterByCurso = $request->curso ?? '';
    //     $filterByAno = $request->ano ?? '';
    //     $filterBySemestre = $request->semestre ?? '';
    //     $disciplinaQuery = Disciplina::query();
    //     if ($filterByCurso !== '') {
    //         $disciplinaQuery->where('curso', $filterByCurso);
    //     }
    //     $disciplinas = $disciplinaQuery->paginate(10);
    //     return view('disciplinas.index', compact(
    //         'disciplinas',
    //         'cursos',
    //         'filterByCurso',
    //         'filterByAno',
    //         'filterBySemestre'
    //     ));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $tshirtImage = new TshirtImage();
        //$user = User::all();
        return view('tshirtImages.create')
            ->withTshirtImage($tshirtImage)
            //->withUsers($users)
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TshirtImageRequest $request): RedirectResponse
    {
        $newTshirtImage = TshirtImage::create($request->validated());
        $url = route('tshirtImages.show', ['tshirtImage' => $newTshirtImage]);
        $htmlMessage = "Imagem de Tshirt <a href='$url'>#{$newTshirtImage->id}</a> <strong>\"{$newTshirtImage->name}\"</strong> foi criada com sucesso!";
        return redirect()->route('tshirtImages.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(TshirtImage $tshirtImage): View
    {
        //$users = User::all();
        return view('tshirtImages.show')
            ->with('tshirtImage', $tshirtImage);
        //->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TshirtImage $tshirtImage): View
    {
        //$users = User::all();
        return view('tshirtImages.edit', [
            'tshirtImage' => $tshirtImage
            //, 'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TshirtImageRequest $request, TshirtImage $tshirtImage): RedirectResponse
    {
        $tshirtImage->update($request->validated());
        $url = route('tshirtImages.show', ['tshirtImage' => $tshirtImage]);
        $htmlMessage = "Imagem de Tshirt <a href='$url'>#{$tshirtImage->id}</a> <strong>\"{$tshirtImage->name}\"</strong> foi alterada com sucesso!";
        return redirect()->route('tshirtImages.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    //TODO - adicionar condicoes e especificacoes
    public function destroy(TshirtImage $tshirtImage): RedirectResponse
    {
        try {
            $tshirtImage->delete();
            $htmlMessage = "Imagem de Tshirt #{$tshirtImage->id} <strong>\"{$tshirtImage->name}\"</strong> foi apagada com sucesso!";
            $alertType = 'success';
        } catch (\Exception $error) {
            $url = route('tshirtImages.show', ['tshirtImage' => $tshirtImage]);
            $htmlMessage = "Não foi possível apagar a Imagem de Tshirt <a href='$url'>#{$tshirtImage->id}</a><strong>\"{$tshirtImage->name}\"</strong> porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return redirect()->route('tshirtImages.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }
}
