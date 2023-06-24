@extends('template.layout')

@section('titulo', 'Order')

@section('subtitulo')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Gestão</li>
    <li class="breadcrumb-item active">Encomendas</li>
</ol>
@endsection

@section('main')
{{-- <p><a class="btn btn-success" href="{{ route('orders.create') }}"><i class="fas fa-plus"></i> &nbsp;Criar Nova Encomenda</a></p> --}}

<!--Filtro:-->

<form method="GET" action="{{ route('orders.index') }}">
    <div class="d-flex justify-content-between">


        <div class="flex-grow-1 pe-2">
            <div class="d-flex justify-content-between">
                <div class="mb-3 me-2 flex-grow-1 form-floating">
                    <input type="text" class="form-control" name="customer_id" id="inputCustomerID" value="{{ old('customer_id', $filterByCustomerID) }}">
                    <label for="inputCustomerID" class="form-label">ID Cliente</label>
                </div>
            </div>
        </div>

        <div class="flex-grow-1 pe-2">
            <div class="d-flex justify-content-between">
                <div class="mb-3 me-2 flex-grow-1 form-floating">
                    <input type="text" class="form-control" name="nif" id="inputNif" value="{{ old('nif', $filterByNif) }}">
                    <label for="inputNif" class="form-label">NIF</label>
                </div>
            </div>
        </div>




        <div class="flex-shrink-1 d-flex flex-column justify-content-between">
            <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1" name="filtrar">Filtrar</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>
        </div>


    </div>
</form>

@include('orders.shared.table', [
        'orders' => $orders,
        'showOrder' => true,
        'showDetail' => true,
        'showEdit' => true,
        'showDelete' => true,
    ])


<div>
    {{ $orders->withQueryString()->links() }}
</div>
@endsection
