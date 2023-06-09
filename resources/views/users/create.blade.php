{{-- <!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0,
    maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User</title>
</head>

<body>
    <h2>Nova Conta</h2>
    <form method="POST" action="/users"> --}}

{{-- @extends('template.layout') --}}
@extends('template.layout')

{{-- @section('header-title', 'Criar Novo User') --}}
@section('titulo', 'Criar Novo User')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
        <li class="breadcrumb-item active">Criar Novo</li>
    </ol>
@endsection



@section('main')

    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        {{-- <div>
            TODO: adicionar id automaticamente
        </div> --}}

        {{-- Subview: --}}
        @include ('users.shared.fields')

        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Criar conta</button>
            <a href="{{ route('users.create') }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
@endsection
