@extends('template.layout')

@section('titulo', 'Novo User')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Users</a></li>
        <li class="breadcrumb-item active">Criar Novo</li>
    </ol>
@endsection

@section('main')
    <form id="form_user" method="POST" action="{{ route('users.store') }}">
        @csrf
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('users.shared.fields', ['user' => $user, 'readonlyData' => false, 'isCliente' => false])
                @include('users.shared.fields_password_inicial')
                <div class="my-1 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="ok" form="form_user">Guardar novo
                        user</button>
                    <a href="{{ route('users.create', ['user' => $user]) }}"
                        class="btn btn-secondary ms-3">Cancelar</a>
                </div>
            </div>
            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                @include('users.shared.fields_foto', [
                    'user' => $user,
                    'allowUpload' => true,
                    //'allowDelete' => false, //TODO descomentar
                ])
            </div>
        </div>
    </form>
@endsection










{{--
@extends('template.layout')

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
        {{-- @include ('users.shared.fields')

        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Criar conta</button>
            <a href="{{ route('users.create') }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
@endsection --}}
