
@extends('template.layout')

@section('titulo', 'Preços')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item active">Preços</li>
    </ol>
@endsection

@section('main')
    <p><a class="btn btn-success" href="{{ route('prices.create') }}"><i class="fas fa-plus"></i> &nbsp;Criar Novo Preço</a></p>

    <!-- Filtro: -->
    {{-- Descomentar e corrigir DEPOIS de criar classe category --}}
    {{-- <hr>
    <form method="GET" action="{{ route('prices.index') }}">
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
                <a href="{{ route('prices.index') }}"
                    class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>
            </div>
        </div>
    </form> --}}

    <!--Tabela:-->
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Preço Imagem da Loja</th>
                <th>Preço Imagem do Cliente</th>
                <th>Preço Imagem da Loja c/ Desconto</th>
                <th>Preço Imagem do Cliente c/ Desconto</th>
                <th>Quantidade Mínima p/ Desconto</th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prices as $price)
                <tr>
                    <td>{{ $price->id }}</td>
                    <td>{{ $price->unit_price_catalog }}</td>
                    <td>{{ $price->unit_price_own }}</td>
                    {{-- <td>{{ $tshirtImage->categoryStr }}</td> --}}
                    <td>{{ $price->unit_price_catalog_discount }}</td>
                    <td>{{ $price->unit_price_own_discount }}</td>
                    <td>{{ $price->qty_discount }}</td>
                    <td class="button-icon-col"><a class="btn btn-secondary"
                            href="{{ route('prices.show', ['price' => $price]) }}">
                            <i class="fas fa-eye"></i></a></td>
                    <td class="button-icon-col"><a class="btn btn-dark"
                            href="{{ route('prices.edit', ['price' => $price]) }}">
                            <i class="fas fa-edit"></i></a></td>
                    <td class="button-icon-col">
                        <form method="POST" action="{{ route('prices.destroy', ['price' => $price]) }}">
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
        {{ $prices->withQueryString()->links() }}
    </div>
@endsection
