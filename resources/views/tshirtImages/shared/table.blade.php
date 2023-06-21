    <!--Tabela:-->
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>ID Cliente</th>
                <th>ID Categoria</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>URL Imagem</th>
                <th>Info Extra</th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col">Carrinho</th>
            </tr>
        </thead>
        <tbody>
            
        
        
        @foreach ($tshirtImages as $tshirtImage)
                


            @if ($showFoto)
            <td width="45">
                @if ($tshirtImage->image_url)
                <img src="{{ $tshirtImage->fullImageUrl }}" alt="Avatar" class="bg-dark rounded-circle" width="45" height="45">
                @endif
            @endif    
            </td>
            
                <tr>
                    <td>{{ $tshirtImage->id }}</td>
                    <td>{{ $tshirtImage->customer_id }}</td>
                    <td>{{ $tshirtImage->category_id }}</td>
                    {{-- <td>{{ $tshirtImage->categoryStr }}</td> --}}
                    <td>{{ $tshirtImage->name }}</td>
                    <td>{{ $tshirtImage->description }}</td>
                    <td>{{ $tshirtImage->image_url }}</td>
                    <td>{{ $tshirtImage->extra_info }}</td>
                    <td class="button-icon-col">
                        {{-- @can('view', $tshirtImage)<!--Auth--> --}}
                            <a class="btn btn-secondary"
                                href="{{ route('tshirtImages.show', ['tshirtImage' => $tshirtImage]) }}">
                                <i class="fas fa-eye"></i></a>
                        {{-- @endcan --}}
                    </td>
                    <td class="button-icon-col">
                        @can('update', $tshirtImage)<!--Auth-->
                            <a class="btn btn-dark"
                                href="{{ route('tshirtImages.edit', ['tshirtImage' => $tshirtImage]) }}">
                                <i class="fas fa-edit"></i></a>
                        @endcan
                    </td>
                    <td class="button-icon-col">
                        @can('delete', $tshirtImage)<!--Auth-->
                            <form method="POST"
                                action="{{ route('tshirtImages.destroy', ['tshirtImage' => $tshirtImage]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="delete" class="btn btn-danger">
                                    <i class="fas fa-trash"></i></button>
                            </form>
                        @endcan
                    </td>

                    {{-- TODO: Este botao remte para order_items.create inves --}}
                    <!-- Botão adicionar ao carrinho -->
                        {{-- <td class="button-icon-col">
                            <form method="POST" action="{{ route('cart.add', ['tshirtImage' => $tshirtImage]) }}">
                                @csrf
                                <button type="submit" name="addToCart" class="btn btn-success">
                                    <i class="fas fa-plus"></i></button>
                            </form>
                        </td> --}}
        {{-- <td class="button-icon-col">
            <form method="POST" action="{{ route('order_item.create', ['order_item' => $orderItem]) }}">
                @csrf
                <button type="submit" name="order_item" class="btn btn-success">
                    <i class="fas fa-plus"></i></button>
            </form>
        </td> --}}



                </tr>
            @endforeach
        </tbody>
    </table>
