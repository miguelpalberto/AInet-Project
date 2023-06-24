@extends('template.layout')

@section('titulo', 'Imagens de Tshirts')

@section('subtitulo')
    <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item">Gestão</li> --}}
        <li class="breadcrumb-item active">Imagens Tshirts</li>
    </ol>
@endsection

@section('main')
    @can('create', \App\Models\TshirtImage::class)
        <!--Auth-->
        <p>
            <a class="btn btn-success" href="{{ route('tshirtImages.create') }}"><i class="fas fa-plus">
                </i> &nbsp;Criar nova Imagem de Tshirt</a>
        </p>
    @endcan
    <!--Filtro:-->

    <hr>
    <form method="GET" action="{{ route('tshirtImages.index') }}">
        <div class="d-flex justify-content-between">
            <div class="flex-grow-1 pe-2">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 mb-3 form-floating">
                        <select class="form-select" name="category" id="inputCategory">
                            <option {{ old('category', $filterByCategory) === '' ? 'selected' : '' }} value="">Todas
                                Categorias </option>
                            @foreach ($categories as $category)
                                <option {{ old('category_id', $filterByCategory) == $category->id ? 'selected' : '' }}
                                    value="{{ $category->id }}">
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label for="inputCategory" class="form-label">Categoria</label>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="mb-3 me-2 flex-grow-1 form-floating">
                        <input type="text" class="form-control" name="name" id="inputName"
                            value="{{ old('name', $filterByName) }}">
                        <label for="inputName" class="form-label">Nome</label>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="mb-3 me-2 flex-grow-1 form-floating">
                        <input type="text" class="form-control" name="description" id="inputDescription"
                            value="{{ old('description', $filterByDescription) }}">
                        <label for="inputDescription" class="form-label">Descrição</label>
                    </div>
                </div>
            </div>
            <div class="flex-shrink-1 d-flex flex-column justify-content-between">
                <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1" name="filtrar">Filtrar</button>
                <a href="{{ route('tshirtImages.index') }}"
                    class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>
            </div>
        </div>
    </form>

    @include('tshirtImages.shared.table', [
        //'tshirtImages' => $tshirtImages,
        'showFoto' => true,
        // 'showContatos' => true,
        // 'showDetail' => true,
        // 'showEdit' => true,
        // 'showDelete' => true,
        //'showCart' => false,
    ])


    <div>
        {{ $tshirtImages->withQueryString()->links() }}
    </div>
@endsection
