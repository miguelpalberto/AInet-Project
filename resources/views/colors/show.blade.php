@extends('template.layout')

@section('titulo', 'Cor')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('colors.index') }}">Cores</a></li>
        <li class="breadcrumb-item"><strong>{{ $color->name }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
@endsection


@section('main')
    <div>
        @include('colors.shared.fields', ['readonlyData' => true])
    </div>
    <div class="my-4 d-flex justify-content-end">
        <form method="POST" action="{{ route('colors.destroy', ['color' => $color]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" name="delete" class="btn btn-danger">
                Apagar Cor
            </button>
        </form>
        <a href="{{ route('colors.edit', ['color' => $color]) }}" class="btn btn-secondary ms-3">Alterar
            Cor</a>
    </div>

@endsection
