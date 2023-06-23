
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Color</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $orderItem)
                <tr>
                    <td>
                        <img src="{{ $orderItem->tshirtImage->fullImageUrl }}" alt="{{ $orderItem->tshirtImage->name }}" width="50">
                    </td>
                    <td>{{ $orderItem->tshirtImage->name }}</td>
                    <td>{{ $orderItem->color_code }}</td>
                    <td>{{ $orderItem->size }}</td>
                    <td>{{ $orderItem->qty }}</td>
                    {{-- TODO --}}
                    {{-- <td>{{ $orderItem->getUnitPrice($prices) }}</td>

                    <td>{{ $orderItem->calculateSubTotal($prices) }}</td> --}}
                    @php

                    $prices

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
        </tbody>
    </table>

    <div class="text-right">
        {{-- <p>Total Price: {{ $totalPrice }}</p> --}}
    </div>


