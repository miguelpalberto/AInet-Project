
@extends('template.layout')

@section('titulo', 'Imagens de Tshirts')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item active">Imagens Tshirts</li>
    </ol>
@endsection

@section('main')
    <p><a class="btn btn-success" href="{{ route('tshirtImages.create') }}"><i class="fas fa-plus"></i> &nbsp;Criar nova imagem de tshirt</a></p>

    <!-- Filtro: -->
    {{-- Descomentar e corrigir DEPOIS de criar classe category --}}
    {{-- <hr>
    <form method="GET" action="{{ route('tshirtImages.index') }}">
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
                <a href="{{ route('disciplinas.index') }}"
                    class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>
            </div>
        </div>
    </form> --}}

    <!--Tabela:-->
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>ID Cliente</th>
                <th>ID Categoria</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>URL Imagem</th>
                <th>Info Extra</th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tshirtImages as $tshirtImage)
                <tr>
                    <td>{{ $tshirtImage->id }}</td>
                    <td>{{ $tshirtImage->customer_id }}</td>
                    <td>{{ $tshirtImage->category_id }}</td>
                    {{-- <td>{{ $tshirtImage->categoryStr }}</td> --}}
                    <td>{{ $tshirtImage->name }}</td>
                    <td>{{ $tshirtImage->description }}</td>
                    <td>{{ $tshirtImage->image_url }}</td>
                    <td>{{ $tshirtImage->extra_info }}</td>
                    <td class="button-icon-col"><a class="btn btn-secondary"
                            href="{{ route('tshirtImages.show', ['tshirtImage' => $tshirtImage]) }}">
                            <i class="fas fa-eye"></i></a></td>
                    <td class="button-icon-col"><a class="btn btn-dark"
                            href="{{ route('tshirtImages.edit', ['tshirtImage' => $tshirtImage]) }}">
                            <i class="fas fa-edit"></i></a></td>
                    <td class="button-icon-col">
                        <form method="POST" action="{{ route('tshirtImages.destroy', ['tshirtImage' => $tshirtImage]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="delete" class="btn btn-danger">
                                <i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $tshirtImages->withQueryString()->links() }}
    </div>
@endsection
