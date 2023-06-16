@extends('template.layout')

@section('titulo', 'Nova Imagem de T-Shirt')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('tshirtImages.index') }}">Imagens Tshirts</a></li>
        <li class="breadcrumb-item active">Criar Nova</li>
    </ol>
@endsection

@section('main')
    <form method="POST" action="{{ route('tshirtImages.store') }}">
        @csrf
        @include('tshirtImages.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Guardar nova imagem de t-shirt</button>
            <a href="{{ route('tshirtImages.index') }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
@endsection

