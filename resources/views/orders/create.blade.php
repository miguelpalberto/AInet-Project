{{-- @extends('template.layout')

@section('titulo', 'Order')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Encomendas</a></li>
        <li class="breadcrumb-item active">Criar Nova Order</li>
    </ol>
@endsection

@section('main')
    <form method="POST" action="{{ route('orders.store') }}">
        @csrf
        @include('orders.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Criar Nova Order</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
@endsection --}}

