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
            @foreach ($tshirtImages as $tshirtImage)
                <tr>
                    <td>{{ $tshirtImage->id }}</td>
                    <td>{{ $tshirtImage->name }}</td>
                    <td>{{ $tshirtImage->description }}</td>
                    <td>{{ $tshirtImage->image_url }}</td>
                    <td>{{ $tshirtImage->extra_info }}</td>

                    <!-- Botão adicionar ao carrinho -->
                    @if ($showAddCart ?? false)
                        <td class="button-icon-col">
                            <form method="POST" action="{{ route('cart.add', ['tshirtImage' => $tshirtImage]) }}">
                                @csrf
                                <button type="submit" name="addToCart" class="btn btn-success">
                                    <i class="fas fa-plus"></i></button>
                            </form>
                        </td>
                    @endif

                    <!-- Botão remover do carrinho -->
                    @if ($showRemoveCart ?? false)
                        <td class="button-icon-col">
                            <form method="POST" action="{{ route('cart.remove', ['tshirtImage' => $tshirtImage]) }}">
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
