
@extends('template.layout')

@section('titulo', 'Cor')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('colors.index') }}">Cor</a></li>
        <li class="breadcrumb-item"><strong>{{ $color->name }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
@endsection

@section('main')
    <div>
        @include('colors.shared.fields', ['readonlyData' => true])
    </div>
    <div class="my-4 d-flex justify-content-end">
        <a href="{{ route('colors.edit', ['color' => $color]) }}" class="btn btn-secondary ms-3">Alterar Preço</a>
    </div>
@endsection

