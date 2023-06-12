
@extends('template.layout')

@section('titulo', 'Preço')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item active">Cor</li>
    </ol>
@endsection

@section('main')
    <p><a class="btn btn-success" href="{{ route('colors.create') }}"><i class="fas fa-plus"></i> &nbsp;Colocar nova Cor</a></p>

    <!-- Filtro: -->
    {{-- Descomentar e corrigir DEPOIS de criar classe category --}}
    {{-- <hr>
    <form method="GET" action="{{ route('colors.index') }}">
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
                <a href="{{ route('colors.index') }}"
                    class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>
            </div>
        </div>
    </form> --}}

    <!--Tabela:-->
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>code</th>
                <th>nome</th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($colors as $color)
                <tr>
                    <td>{{ $color->code }}</td>
                    <td>{{ $color->name }}</td>
                    
                    
                    
                    <td class="button-icon-col"><a class="btn btn-secondary"
                            href="{{ route('colors.show', ['color' => $color]) }}">
                            <i class="fas fa-eye"></i></a></td>
                    <td class="button-icon-col"><a class="btn btn-dark"
                            href="{{ route('colors.edit', ['color' => $color]) }}">
                            <i class="fas fa-edit"></i></a></td>
                    <td class="button-icon-col">
                        <form method="POST" action="{{ route('colors.destroy', ['color' => $color]) }}">
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
        {{ $colors->withQueryString()->links() }}
    </div>
@endsection
