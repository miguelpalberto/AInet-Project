@extends('template.layout')

@section('titulo', 'Alterar Categoria')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}"> Categorias</a></li>
        <li class="breadcrumb-item"><strong>{{ $category->name }}</strong></li>
        <li class="breadcrumb-item active">Alterar Categoria</li>
    </ol>
@endsection

@section('main')
    <form method="POST" action="{{ route('categories.update', ['category' => $category]) }}">
        @csrf
        @method('PUT')
        @include('categories.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Guardar Alterações</button>
            <a href="{{ route('categories.index', ['category' => $category]) }}"
                class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
@endsection

