    <!--Tabela:-->
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th></th>
                {{-- <th>ID</th> --}}
                @if (!$showCart ?? true)
                    <th>ID Cliente</th>
                    <th>Categoria</th>
                @endif
                <th>Nome</th>
                <th>Descrição</th>
                @if (!$showCart ?? true)
                    <th>URL Imagem</th>
                    <th>Info Extra</th>
                    <th class="button-icon-col"></th>
                    <th class="button-icon-col"></th>
                    <th class="button-icon-col"></th>
                    <th class="button-icon-col"></th>
                @endif
            </tr>
        </thead>
        <tbody>




            @foreach ($tshirtImages as $tshirtImage)
                <tr>

                    @if ($showFoto)
                        <td width="45">
                            @if ($tshirtImage->image_url)
                                <img src="{{ $tshirtImage->fullImageUrl }}" alt="Avatar" class="bg-dark rounded-circle"
                                    width="45" height="45">
                            @endif
                        </td>
                    @endif

                    {{-- <td>{{ $tshirtImage->id }}</td> --}}
                    @if (!$showCart ?? true)
                        <td>{{ $tshirtImage->customer_id }}</td>
                        <td>{{ $tshirtImage->category->name }}</td>
                        {{-- <td>{{ $tshirtImage->category_id }}</td> --}}
                    @endif
                    <td>{{ $tshirtImage->name }}</td>
                    <td>{{ $tshirtImage->description }}</td>
                    @if (!$showCart ?? true)
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
                            @can('update', $tshirtImage)
                                <!--Auth-->
                                <a class="btn btn-dark"
                                    href="{{ route('tshirtImages.edit', ['tshirtImage' => $tshirtImage]) }}">
                                    <i class="fas fa-edit"></i></a>
                            @endcan
                        </td>
                        <td class="button-icon-col">
                            @can('delete', $tshirtImage)
                                <!--Auth-->
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
                        <td class="button-icon-col">
                            <a class="btn btn-success"
                                href="{{ route('tshirtImages.createOrderItem', ['tshirtImage' => $tshirtImage]) }}">
                                <i class="fas fa-plus"></i></a>
                        </td>
                    @endif



                </tr>
            @endforeach
        </tbody>
    </table>
