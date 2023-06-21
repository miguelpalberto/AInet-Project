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
            </tr>
        </thead>
        <tbody>
            @foreach ($tshirtImages as $tshirtImage)
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
                </tr>
            @endforeach
        </tbody>
    </table>
