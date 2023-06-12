
@extends('template.layout')

@section('titulo', 'Order')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item active">Orders</li>
    </ol>
@endsection

@section('main')
    <p><a class="btn btn-success" href="{{ route('orders.create') }}"><i class="fas fa-plus"></i> &nbsp;Colocar nova Order</a></p>

    <!-- Filtro: -->
    {{-- Descomentar e corrigir DEPOIS de criar classe category --}}
    {{-- <hr>
    <form method="GET" action="{{ route('orders.index') }}">
        <div class="d-flex justify-content-between">
            <div class="flex-grow-1 pe-2">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 mb-3 form-floating">
                        <select class="form-select" name="category" id="inputCategory">
                            <option {{ old('category', $filterByCategory) === '' ? 'selected' : '' }} value="">Todas Categorias </option>
                            @foreach ($categorys as $category)
                                <option {{ old('category_id', $filterByCategory) == $category->id ? 'selected' : '' }}
                                    value="{{ $category->id }}">
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label for="inputCategory" class="form-label">Categoria</label>
                    </div>
                </div>
            </div>
            <div class="flex-shrink-1 d-flex flex-column justify-content-between">
                <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1" name="filtrar">Filtrar</button>
                <a href="{{ route('orders.index') }}"
                    class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>
            </div>
        </div>
    </form> --}}

    <!--Tabela:-->
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>status</th>
                <th>customer_id</th>
                <th>date</th>
                <th>total_price</th>
                <th>notes</th>
                <th>nif</th>
                <th>address</th>
                <th>payment_type</th>
                <th>payment_ref</th>
                <th>receipt_url</th>
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


                    <td class="button-icon-col"><a class="btn btn-secondary"
                            href="{{ route('orders.show', ['order' => $order]) }}">
                            <i class="fas fa-eye"></i></a></td>
                    <td class="button-icon-col"><a class="btn btn-dark"
                            href="{{ route('orders.edit', ['order' => $order]) }}">
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
