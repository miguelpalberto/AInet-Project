<table class="table">
    <thead>
        <tr>
            <th>Tshirt</th>
            <th>Imagem</th>
            <th>Nome Imagem</th>
            <th>Cor</th>
            <th>Tamanho</th>
            <th>Quantidade</th>
            <th>Preço Unidade

            </th>
            <th>Subtotal</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <div>
            @foreach ($cart as $orderItem)
                <tr>
                    <td>
                        <img src="{{ $orderItem->fullImageUrl }}" alt="Tshirt Color" width="50">
                    </td>
                    <td>
                        <img src="{{ $orderItem->tshirtImage->fullImageUrl }}" alt="{{ $orderItem->tshirtImage->name }}"
                            width="50">
                    </td>
                    <td>{{ $orderItem->tshirtImage->name }}</td>
                    <td>{{ $orderItem->color_code }}</td>
                    <td>{{ $orderItem->size }}</td>
                    <td>{{ $orderItem->qty }}</td>
                    @php
                        $total = 0;

                        if ($orderItem->tshirtImage->customer_id == null) {
                            $orderItem->unit_price = $price->unit_price_catalog;
                        } else {
                            $orderItem->unit_price = $price->unit_price_own;
                        }
                        $orderItem->sub_total = $orderItem->unit_price * $orderItem->qty;
                        $total += $orderItem->sub_total;
                    @endphp
                    <td>{{ $orderItem->unit_price }} €</td>
                    <td>{{ $orderItem->sub_total }} €</td>

                    <td>
                        <form action="{{ route('cart.remove', ['index' => $orderItem->index]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </div>

    </tbody>
</table>
<div style="text-align: right;">
    <table>
        <tr>
            @php
                $totalPrice = 0;
                foreach ($cart as $orderItem) {
                    $totalPrice += $orderItem->sub_total;
                }
            @endphp
            <strong style="text-align: right; font-size: 24px;"> Total: {{ $totalPrice }} €</strong>
        </tr>
    </table>
</div>
