@extends('template.layout')

@section('titulo', 'Categoria')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item active">Categoria</li>
    </ol>
@endsection

@section('main')

        <p>
            <a class="btn btn-success" href="{{ route('categories.create') }}">
                <i class="fas fa-plus"></i> &nbsp;Criar Nova Categoria</a>
        </p>

    <!-- Filtro: -->
    <form method="GET" action="{{ route('categories.index') }}">
        <div class="d-flex justify-content-between">
            <div class="flex-grow-1 pe-2">
                <div class="d-flex justify-content-between">
                    <div class="mb-3 me-2 flex-grow-1 form-floating">
                        <input type="text" class="form-control" name="name" id="inputName"
                            value="{{ old('name', $filterByName) }}">
                        <label for="inputName" class="form-label">Nome</label>
                    </div>
                </div>
            </div>
            <div class="flex-shrink-1 d-flex flex-column justify-content-between">
                <button type="submit" class="btn btn-primary mb-3 py-1 px-4 flex-grow-1" name="filtrar">Filtrar</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary mb-3 py-1 px-4 flex-shrink-1">Limpar</a>
            </div>
        </div>
    </form>

    @include('categories.shared.table', [
        'categories' => $categories,
        //'showDetail' => true,
    ])


    <div>
        {{ $categories->withQueryString()->links() }}
    </div>
@endsection
