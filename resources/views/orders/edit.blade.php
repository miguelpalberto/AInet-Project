@extends('template.layout')

@section('titulo', 'Alterar Order')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}"> Order</a></li>
        <li class="breadcrumb-item"><strong>{{ $order->name }}</strong></li>
        <li class="breadcrumb-item active">Alterar</li>
    </ol>
@endsection

@section('main')
    <form method="POST" action="{{ route('orders.update', ['order' => $order]) }}">
        @csrf
        @method('PUT')
        @include('orders.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Guardar Alterações</button>
            <a href="{{ route('orders.index', ['order' => $order]) }}"
                class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
@endsection

