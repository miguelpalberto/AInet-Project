@extends('template.layout')

@section('titulo', 'Criar Categoria')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorias</a></li>
        <li class="breadcrumb-item active">Criar Nova Categoria</li>
    </ol>
@endsection

@section('main')
    <form method="POST" action="{{ route('categories.store') }}">
        @csrf
        @include('categories.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Criar Nova Categoria</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
@endsection

