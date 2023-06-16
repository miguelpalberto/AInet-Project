@extends('template.layout')

@section('titulo', 'Alterar Imagem de T-shirt')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('tshirtImage.index') }}">Imagens Tshirts</a></li>
        <li class="breadcrumb-item"><strong>{{ $tshirtImage->name }}</strong></li>
        <li class="breadcrumb-item active">Alterar</li>
    </ol>
@endsection

@section('main')
    <form method="POST" action="{{ route('tshirtImages.update', ['tshirtImage' => $tshirtImage]) }}">
        @csrf
        @method('PUT')
        @include('tshirtImages.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Guardar Alterações</button>
            <a href="{{ route('tshirtImages.index', ['tshirtImage' => $tshirtImage]) }}"
                class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
@endsection

