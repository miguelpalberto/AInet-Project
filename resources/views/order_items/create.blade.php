@extends('template.layout')

@section('titulo', 'Comprar T-Shirt')

@section('subtitulo')
    <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item">Gestão</li> --}}
        <li class="breadcrumb-item"><a href="{{ route('tshirtImages.index') }}">Imagens Tshirts</a></li>
        <li class="breadcrumb-item active">Comprar</li>
    </ol>
@endsection

@section('main')
    <!-- Botão adicionar ao carrinho -->
    {{-- TODO order item em vez de tshirt e ver se botao esta bom --}}
    <td class="button-icon-col">
        <form method="POST" action="{{ route('cart.add', ['tshirtImage' => $tshirtImage]) }}">
            @csrf
            <button type="submit" name="addToCart" class="btn btn-success ms-3">
                <i class="fas fa-plus"></i> Adicionar ao Carrinho</button>
        </form>
    </td>

    {{-- <form method="POST" action="{{ route('order_items.store') }}">
        @csrf
        @include('order_items.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Comprar Tshirt com esta Imagem</button>
            <a href="{{ route('tshirtImages.index') }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form> --}}
@endsection


