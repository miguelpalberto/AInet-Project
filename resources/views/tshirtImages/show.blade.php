
@extends('template.layout')

@section('titulo', 'Imagens de Tshirts')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('tshirtImages.index') }}">Imagens Tshirts</a></li>
        <li class="breadcrumb-item"><strong>{{ $tshirtImage->name }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
@endsection

@section('main')
    <div>
        @include('tshirtImages.shared.fields', ['readonlyData' => true])
    </div>
    <div class="my-4 d-flex justify-content-end">
        <a href="{{ route('tshirtImages.edit', ['tshirtImage' => $tshirtImage]) }}" class="btn btn-secondary ms-3">Alterar Imagem Tshirt</a>
    </div>
@endsection

