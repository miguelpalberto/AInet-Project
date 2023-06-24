    <!--Tabela:-->
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th></th>
                {{-- <th>ID</th> --}}

                <th>ID Cliente</th>
                <th>Categoria</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>URL Imagem</th>
                <th>Info Extra</th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
                {{-- @can('update', $tshirtImage) --}}
                <th class="button-icon-col"></th>
                {{-- @endcan --}}
                {{-- @can('delete', $tshirtImage) --}}
                <th class="button-icon-col"></th>
                {{-- @endcan --}}

            </tr>
        </thead>
        <tbody>

            <tr>

            @foreach ($tshirtImages as $tshirtImage)
                @if ($showFoto)
                    <td width="45">
                        @if ($tshirtImage->image_url)
                            <img src="{{ $tshirtImage->fullImageUrl }}" alt="Avatar" class="bg-dark rounded-circle"
                                width="45" height="45">
                        @endif
                    </td>
                @endif


                    {{-- <td>{{ $tshirtImage->id }}</td> --}}
                    <td>{{ $tshirtImage->customer_id }}</td>
                    <td>{{ $tshirtImage->category->name }}</td>
                    {{-- <td>{{ $tshirtImage->category_id }}</td> --}}

                    <td>{{ $tshirtImage->name }}</td>
                    <td>{{ $tshirtImage->description }}</td>

                    <td>{{ $tshirtImage->image_url }}</td>
                    <td>{{ $tshirtImage->extra_info }}</td>

                    <!-- Botão adicionar ao carrinho -->


                    @auth
                    {{-- Se estiver autenticado e for Cliente --}}
                    @if (auth()->user()->user_type === 'C')
                        <td class="button-icon-col">
                            <a class="btn btn-success" href="{{ route('tshirtImages.createOrderItem', ['tshirtImage' => $tshirtImage]) }}">
                                <i class="fas fa-plus"></i>
                            </a>
                        </td>
                    @endif
                @else
                    {{-- Se não estiver autenticado --}}
                    <td class="button-icon-col">
                        <a class="btn btn-success" href="{{ route('tshirtImages.createOrderItem', ['tshirtImage' => $tshirtImage]) }}">
                            <i class="fas fa-plus"></i>
                        </a>
                    </td>
                @endauth

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







                </tr>
            @endforeach
        </tbody>
    </table>
