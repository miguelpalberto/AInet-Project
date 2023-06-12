{{-- <!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0,
maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User</title>
</head> --}}


@extends('template.layout')

@section('titulo', 'User')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
        <li class="breadcrumb-item"><strong>{{ $user->name }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
@endsection

@section('main')

    <body>
        <div>
            @include('users.shared.fields', ['readonlyData' => true])
        </div>
        <div class="my-4 d-flex justify-content-end">
            <a href="{{ route('users.edit', ['user' => $user]) }}" class="btn btn-secondary ms-3">Alterar User</a>
        </div>
    @endsection
