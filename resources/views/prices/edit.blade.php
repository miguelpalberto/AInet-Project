@extends('template.layout')

@section('titulo', 'Alterar Preço')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('price.index') }}"> Preço</a></li>
        <li class="breadcrumb-item"><strong>{{ $price->name }}</strong></li>
        <li class="breadcrumb-item active">Alterar</li>
    </ol>
@endsection

@section('main')
    <form method="POST" action="{{ route('prices.update', ['price' => $price]) }}">
        @csrf
        @method('PUT')
        @include('prices.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Guardar Alterações</button>
            <a href="{{ route('prices.edit', ['price' => $price]) }}"
                class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
@endsection

