@extends('template.layout')
@section('titulo', 'Carrinho')
@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Área pessoal</li>
        <li class="breadcrumb-item active">Carrinho</li>
    </ol>
@endsection
@section('main')
    <div>
        <h3>Item(s) no carrinho</h3>
    </div>

    @if ($cart && count($cart) > 0)
        @include('cart.shared.table', [
            'cart' => $cart,
            'price' => $price,
            'order' => $order,
            'showCart' => true,
            'showFoto' => true,
        ])


        <form method="POST" action="{{ route('cart.store') }}">
            @csrf
            @include('cart.shared.fields', [
                'cart' => $cart,
                'price' => $price,
                'order' => $order,
            ])


            <div class="my-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-success" name="ok">
                    <i class="fas fa-credit-card"></i> Concluir Encomenda</button>

        </form>


            <button type="submit" class="btn btn-danger ms-3" name="clear" form="formClear"> Limpar Carrinho</button>
        </div>
        <form id="formStore" method="POST" action="{{ route('cart.store') }}" class="d-none">
            @csrf
        </form>
        <form id="formClear" method="POST" action="{{ route('cart.destroy') }}" class="d-none">
            @csrf
            @method('DELETE')
        </form>
    @else
        <div>
            <p><strong>O carrinho está vazio.</strong></p>
        </div>
    @endif
    {{-- @dump($cart) --}}
@endsection
