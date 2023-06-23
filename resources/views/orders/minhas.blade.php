@extends('template.layout')

@section('titulo', 'Minhas Orders')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Espaço Privado</li>
        <li class="breadcrumb-item active">Minhas Orders</li>
    </ol>
@endsection

@section('main')
   
{{--  <!-- @if ($orders) -->--}} 
        @include('orders.shared.table', [
            'orders' => $orders,
            'showOrder' => true,
            'showDetail' => true,
            'showEdit' => false,
            'showDelete' => false,
        ])
{{--  <!-- @endif  -->--}}    
@endsection
