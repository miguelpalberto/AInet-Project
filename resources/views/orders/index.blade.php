@extends('template.layout')

@section('titulo', 'Order')

@section('subtitulo')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Gestão</li>
    <li class="breadcrumb-item active">Encomendas</li>
</ol>
@endsection

@section('main')
<p><a class="btn btn-success" href="{{ route('orders.create') }}"><i class="fas fa-plus"></i> &nbsp;Criar Nova Encomenda</a></p>

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


<!--Tabela:-->
<table class="table">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Estado</th>
            <th>ID Cliente</th>
            <th>Data</th>
            <th>Preço Total</th>
            <th>Notas</th>
            <th>NIF</th>
            <th>Morada Envio</th>
            <th>Tipo Pagamento</th>
            <th>Referência Pagamento</th>
            <th>Recibo</th>
            <th class="button-icon-col"></th>
            <th class="button-icon-col"></th>
            <th class="button-icon-col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->customer_id }}</td>
            {{-- <td>{{ $tshirtImage->categoryStr }}</td> --}}
            <td>{{ $order->date }}</td>
            <td>{{ $order->total_price }}</td>
            <td>{{ $order->notes }}</td>
            <td>{{ $order->nif }}</td>
            <td>{{ $order->address }}</td>
            <td>{{ $order->payment_type }}</td>
            <td>{{ $order->payment_ref }}</td>
            <td>{{ $order->receipt_url }}</td>


            <td class="button-icon-col"><a class="btn btn-secondary" href="{{ route('orders.show', ['order' => $order]) }}">
                    <i class="fas fa-eye"></i></a></td>
            <td class="button-icon-col"><a class="btn btn-dark" href="{{ route('orders.edit', ['order' => $order]) }}">
                    <i class="fas fa-edit"></i></a></td>
            <td class="button-icon-col">
                <form method="POST" action="{{ route('orders.destroy', ['order' => $order]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" name="delete" class="btn btn-danger">
                        <i class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div>
    {{ $orders->withQueryString()->links() }}
</div>
@endsection
