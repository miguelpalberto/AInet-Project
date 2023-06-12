<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = Category::paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $category = new Category();
        return view('categories.create')->withCategory($category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $newCategory = Category::create($request->validate());
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
        return view('categories.show') ->with('category', $category);
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
        $newCategory = Category::create($request->validate());
        $url = route('categories.show', ['category' => $newCategory]);
        $htmlMessage = "Categoria <a href='$url'>#{$newCategory->id}</a> foi criada com sucesso!";
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
            $category->delete();
            $htmlMessage = "Categoria #{$category->id}foi apagada com sucesso!";
            $alertType = 'success';
        } catch (\Exception $error) {
            $url = route('categories.show', ['category' => $category]);
            $htmlMessage = "Não foi possível apagar a Categoria <a href='$url'>#{$category->id}</a> porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return redirect()->route('categories.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }
}
