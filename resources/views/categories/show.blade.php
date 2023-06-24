@extends('template.layout')

@section('titulo', 'Categoria')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorias</a></li>
        <li class="breadcrumb-item"><strong>{{ $category->name }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
@endsection

@section('main')
    <div>
        @include('categories.shared.fields', ['readonlyData' => true])
    </div>
    <div class="my-4 d-flex justify-content-end">
        <form method="POST" action="{{ route('categories.destroy', ['category' => $category]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" name="delete" class="btn btn-danger">
                Apagar Categoria
            </button>
        </form>
        <a href="{{ route('categories.edit', ['category' => $category]) }}" class="btn btn-secondary ms-3">Alterar
            Categoria</a>
    </div>
    
@endsection
