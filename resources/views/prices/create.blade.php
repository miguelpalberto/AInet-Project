@extends('template.layout')

@section('titulo', 'Preço')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('prices.index') }}">Imagens Preço</a></li>
        <li class="breadcrumb-item active">Criar Nova</li>
    </ol>
@endsection

@section('main')
    <form method="POST" action="{{ route('prices.store') }}">
        @csrf
        @include('prices.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Guardar Preço</button>
            <a href="{{ route('prices.create') }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
@endsection

