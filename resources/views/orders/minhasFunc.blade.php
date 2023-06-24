@extends('template.layout')

@section('titulo', 'Order')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestao</li>
        <li class="breadcrumb-item active">Encomendas</li>
    </ol>
@endsection

@section('main')
   
 @if ($orders) 
        @include('orders.shared.table', [
            'orders' => $orders,
            'showOrder' => true,
            'showDetail' => true,
            'showEdit' => false,
            'showDelete' => false,
        ])
@endif     
@endsection
