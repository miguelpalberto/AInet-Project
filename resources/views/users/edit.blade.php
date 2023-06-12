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
    <h2>Modificar utilizador {{ $user->name }}</h2>
    <form method="POST" action="/users/{{ $user->id }}"> --}}

@extends('template.layout')

@section('titulo', "Modificar User")

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
        <li class="breadcrumb-item"><strong>{{ $user->name }}</strong></li>
        <li class="breadcrumb-item active">Modificar</li>
    </ol>
@endsection


@section('main')

    <form method="POST" action="{{ route('users.update', ['user' => $user]) }}">
        @csrf
        @method('PUT')

        @include('users.shared.fields')

        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Guardar Alterações</button>
            <a href="{{ route('users.edit', ['user' => $user]) }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>

@endsection
