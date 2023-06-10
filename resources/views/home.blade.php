{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    {{ __('You are logged in!') }}
</div>
</div>
</div>
</div>
</div>
@endsection --}}
@extends('template.layout')

@section('subtitulo')
<p>Aplicação Gestão Loja</p>
@endsection

@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-light">Homepage</div>
                <div class="card-body">
                    @auth
                    <p>{{ Auth::user()->name }}</p>
                    @else
                    <p>Bem-vindo!</p>
                    <p>Podes fazer o login
                        <a href="{{ route('login') }}">aqui</a>.
                    </p>
                    @endauth
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection