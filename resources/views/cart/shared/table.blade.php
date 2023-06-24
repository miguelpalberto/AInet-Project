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
                    {{-- TODO --}}
                    {{-- <td>{{ $orderItem->getUnitPrice($price) }}</td>

                    <td>{{ $orderItem->calculateSubTotal($price) }}</td> --}}
                    @php

                        $price;

                        //TODO contas

                    @endphp
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


<div class="text-right">
    {{-- <p>Total Price: {{ $totalPrice }}</p> --}}
</div>
