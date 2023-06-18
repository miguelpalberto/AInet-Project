@extends('template.layout')

@section('titulo', 'Criar Cor')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('colors.index') }}">Cores</a></li>
        <li class="breadcrumb-item active">Criar Nova Cor</li>
    </ol>
@endsection

@section('main')
    <form method="POST" action="{{ route('colors.store') }}">
        @csrf
        @include('colors.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Criar Nova Cor</button>
            <a href="{{ route('colors.index') }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
@endsection

