
@extends('template.layout')

@section('titulo', 'Categoria')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item active">Categoria</li>
    </ol>
@endsection

@section('main')
    <p><a class="btn btn-success" href="{{ route('categories.create') }}"><i class="fas fa-plus"></i> &nbsp;Criar Nova Categoria</a></p>

    <!-- Filtro: -->
    {{-- Descomentar e corrigir DEPOIS de criar classe category --}}
    {{-- <hr>
    <form method="GET" action="{{ route('categories.index') }}">
        <div class="d-flex justify-content-between">
            <div class="flex-grow-1 pe-2">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 mb-3 form-floating">
                        <select class="form-select" name="category" id="inputCategory">
                            <option {{ old('category', $filterByCategory) === '' ? 'selected' : '' }} value="">Todas Categorias </option>
                            @foreach ($categorys as $category)
                                <option {{ old('category_id', $filterByCategory) == $category->id ? 'selected' : '' }}
                                    value="{{ $category->id }}">
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label for="inputCategory" class="form-label">Categoria</label>
                    </div>
                </div>
            </div>
            <div class="flex-shrink-1 d-flex flex-column justify-content-between">
                <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1" name="filtrar">Filtrar</button>
                <a href="{{ route('categories.index') }}"
                    class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>
            </div>
        </div>
    </form> --}}

    @include('categories.shared.table', [
        'categories' => $categories,
        //'showDetail' => true, //para depois ver tshirts com x categoria
    ])


    <div>
        {{ $categories->withQueryString()->links() }}
    </div>
@endsection
