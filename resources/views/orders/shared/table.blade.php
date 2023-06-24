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
