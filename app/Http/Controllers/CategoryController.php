<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\TshirtImage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $filterByName = $request->name ?? '';
        $userQuery = Category::query();
        if ($filterByName !== '') {
            $categoryIds = Category::where('name', 'like', "%$filterByName%")->pluck('id');
            $userQuery->whereIntegerInRaw('id', $categoryIds);
        }
        $categories = Category::paginate(10);
        return view('categories.index', compact('categories', 'filterByName'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $category = new Category();
        return view('categories.create')
            ->withCategory($category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $newCategory = Category::create($request->validated());
        $url = route('categories.show', ['category' => $newCategory]);
        $htmlMessage = "Categoria <a href='$url'>#{$newCategory->id}</a> foi criada com sucesso!";
        return redirect()->route('categories.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        //TODO: ter detalhes com tshirtimagens (mudar view show e um @include do index (para enviar o showDetails))
        // $tshirtImages = TshirtImage::all();
        // $showDetail = 'tshirtImages';
        // $category->load('tshirtImages', 'tshirtImages.category');

        return view('categories.show')
            ->withCategory($category);
            //->with('tshirtImages', $tshirtImage)
            //->with('showDetail', $showDetail);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', [
            'category' => $category
            //, 'users' => $users

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
            $category->update($request->validated());
            $url = route('categories.show', ['category' => $category]);
            $htmlMessage = "Categoria <a href='$url'>#{$category->id}</a>
                            <strong>\"{$category->nome}\"</strong> foi alterada com sucesso!";
            return redirect()->route('categories.index')
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        try {
            $totalTshirtImages = DB::scalar('select count(*) from tshirt_images where category_id = ?', [$category->id]);
            if ($totalTshirtImages == 0) {
                $category->delete();
                $htmlMessage = "Categoria #{$category->id}
                        <strong>\"{$category->name}\"</strong> foi apagada com sucesso!";
                return redirect()->route('categories.index')
                    ->with('alert-msg', $htmlMessage)
                    ->with('alert-type', 'success');
            } else {
                $url = route('categories.show', ['category' => $category]);
                $alertType = 'warning';
                $tshirtImageStr = $totalTshirtImages > 0 ?
                    ($totalTshirtImages == 1 ?
                        "1 Imagem de Tshirt com esta categoria" :
                        "$totalTshirtImages Imagens de Tshirt com esta categoria") :
                    "";
                    $htmlMessage = "Categoria <a href='$url'>#{$category->id}</a>
                        <strong>\"{$category->name}\"</strong>
                        não pode ser apagada porque há $tshirtImageStr!
                        ";
            }
        } catch (\Exception $error) {
            $url = route('categories.show', ['category' => $category]);
            $htmlMessage = "Não foi possível apagar a categoria <a href='$url'>#{$category->id}</a>
                        <strong>\"{$category->name}\"</strong> porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }
}
