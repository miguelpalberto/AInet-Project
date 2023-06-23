
@extends('template.layout')

@section('titulo', 'Comprar T-Shirt')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('tshirtImages.index') }}">Imagens Tshirts</a></li>
        <li class="breadcrumb-item"><strong>{{ $tshirtImage->name }}</strong></li>
        <li class="breadcrumb-item active">Comprar</li>
    </ol>
@endsection

@section('main')
    <form method="POST" action="{{ route('cart.add', ['tshirtImage' => $tshirtImage]) }}">
        @csrf
        @include('order_items.shared.fields', [
            //'orderItem' => $orderItem,
            'readonlyData' => false,
        ])
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" name="addToCart" class="btn btn-success ms-3">
                <i class="fas fa-plus"></i> Adicionar ao Carrinho
            </button>
            <a href="{{ route('tshirtImages.index') }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>

@endsection
