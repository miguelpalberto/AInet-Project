
@extends('template.layout')

@section('titulo', 'Cores')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item active">Cores</li>
    </ol>
@endsection

@section('main')
    <p><a class="btn btn-success" href="{{ route('colors.create') }}"><i class="fas fa-plus"></i> &nbsp;Criar nova Cor</a></p>

    <!-- Filtro: -->
    <form method="GET" action="{{ route('colors.index') }}">
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
                <a href="{{ route('colors.index') }}"
                    class="btn btn-secondary mb-3 py-1 px-4 flex-shrink-1">Limpar</a>
            </div>
        </div>
    </form>

    <!--Tabela:-->
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Código</th>
                <th>Nome</th>
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
                            href="{{ route('colors.show', ['color' => $color->code ]) }}">
                            <i class="fas fa-eye"></i></a></td>
                    <td class="button-icon-col"><a class="btn btn-dark"
                            href="{{ route('colors.edit', ['color' => $color->code]) }}">
                            <i class="fas fa-edit"></i></a></td>
                    <td class="button-icon-col">
                        <form method="POST" action="{{ route('colors.destroy', ['color' => $color->code]) }}">
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
