@extends('template.layout')

@section('titulo', 'Imagens de Tshirts')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('tshirtImages.index') }}">Imagens Tshirts</a></li>
        <li class="breadcrumb-item"><strong>{{ $tshirtImage->name }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
@endsection

@section('main')
    <div>
        @include('tshirtImages.shared.fields', ['readonlyData' => true])
    </div>
    <div class="my-4 d-flex justify-content-end">
        <form method="POST" action="{{ route('tshirtImages.destroy', ['tshirtImage' => $tshirtImage]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" name="delete" class="btn btn-danger">
                Apagar Imagem de Tshirt
            </button>
        </form>
        <a href="{{ route('tshirtImages.edit', ['tshirtImage' => $tshirtImage]) }}" class="btn btn-secondary ms-3">Alterar
            Imagem de Tshirt</a>
    </div>

    <div class="my-3">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link {{ $showDetail == 'orders' ? 'active' : '' }}"
                    href="{{ route('tshirtImages.show', ['tshirtImage' => $tshirtImage]) }}">Encomendas</a>
            </li>
        </ul>
    </div>

    <div>
        @if ($showDetail == 'orders')
            <h3 class="my-3">Encomendas com esta Imagem de Tshirt</h3>
            @include('orders.shared.table', [
                'orders' => $tshirtImage->orders,
                // 'showFoto' => true,
                // 'showDepartamento' => true,
                // 'showContatos' => true,
                // 'showDetail' => true,
                // 'showEdit' => false,
                // 'showDelete' => false,
            ])
        @endif
    </div>

@endsection
