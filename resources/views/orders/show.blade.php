
@extends('template.layout')

@section('titulo', 'Order')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Order</a></li>
        <li class="breadcrumb-item"><strong>{{ $order->name }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
@endsection

@section('main')
    <div>
        @include('orders.shared.fields', ['readonlyData' => true])
    </div>
    <div class="my-4 d-flex justify-content-end">
        <a href="{{ route('orders.edit', ['order' => $order]) }}" class="btn btn-secondary ms-3">Alterar Order</a>
    </div>
@endsection

