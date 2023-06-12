
@extends('template.layout')

@section('titulo', 'Preço')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('prices.index') }}">Imagens Tshirts</a></li>
        <li class="breadcrumb-item"><strong>{{ $price->name }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
@endsection

@section('main')
    <div>
        @include('prices.shared.fields', ['readonlyData' => true])
    </div>
    <div class="my-4 d-flex justify-content-end">
        <a href="{{ route('prices.edit', ['price' => $price]) }}" class="btn btn-secondary ms-3">Alterar Preço</a>
    </div>
@endsection

