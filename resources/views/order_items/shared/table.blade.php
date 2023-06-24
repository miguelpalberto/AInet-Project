    <!--Tabela:-->
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>URL Imagem</th>
                <th>Info Extra</th>
                @if ($showAddCart ?? false)
                    <th class="button-icon-col">Carrinho</th>
                @endif
                @if ($showRemoveCart ?? false)
                    <th class="button-icon-col"></th>
                @endif

            </tr>
        </thead>
        <tbody>
            @foreach ($orderItems as $orderItem)
                <tr>
                    <td>{{ $orderItem->id }}</td>
                    <td>{{ $orderItem->name }}</td>
                    <td>{{ $orderItem->description }}</td>
                    <td>{{ $orderItem->image_url }}</td>
                    <td>{{ $orderItem->extra_info }}</td>

                    <!-- Botão adicionar ao carrinho -->
                    @if ($showAddCart ?? false)
                        <td class="button-icon-col">
                            <form method="POST" action="{{ route('cart.add', ['orderItem' => $orderItem]) }}">
                                @csrf
                                <button type="submit" name="addToCart" class="btn btn-success">
                                    <i class="fas fa-plus"></i></button>
                            </form>
                        </td>
                    @endif

                    <!-- Botão remover do carrinho -->
                    @if ($showRemoveCart ?? false)
                        <td class="button-icon-col">
                            <form method="POST" action="{{ route('cart.remove', ['index' => $orderItem->index]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="removeFromCart" class="btn btn-danger">
                                    <i class="fas fa-remove"></i></button>
                            </form>
                        </td>
                    @endif



                </tr>
            @endforeach
        </tbody>
    </table>
