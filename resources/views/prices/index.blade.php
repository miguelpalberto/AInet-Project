
@extends('template.layout')

@section('titulo', 'Preços')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item active">Preços</li>
    </ol>
@endsection

@section('main')

    {{-- Prices é só uma linha (já criada desde o inicio, nao se pode criar mais) --}}
    {{-- <p><a class="btn btn-success" href="{{ route('prices.create') }}"><i class="fas fa-plus"></i> &nbsp;Criar Novo Preço</a></p> --}}

    <!-- Filtro: -->


    <!--Tabela:-->
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Preço Imagem da Loja</th>
                <th>Preço Imagem do Cliente</th>
                <th>Preço Imagem da Loja c/ Desconto</th>
                <th>Preço Imagem do Cliente c/ Desconto</th>
                <th>Quantidade Mínima p/ Desconto</th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prices as $price)
                <tr>
                    <td>{{ $price->id }}</td>
                    <td>{{ $price->unit_price_catalog }}</td>
                    <td>{{ $price->unit_price_own }}</td>
                    <td>{{ $price->unit_price_catalog_discount }}</td>
                    <td>{{ $price->unit_price_own_discount }}</td>
                    <td>{{ $price->qty_discount }}</td>
                    <td class="button-icon-col"><a class="btn btn-secondary"
                            href="{{ route('prices.show', ['price' => $price]) }}">
                            <i class="fas fa-eye"></i></a></td>
                    <td class="button-icon-col"><a class="btn btn-dark"
                            href="{{ route('prices.edit', ['price' => $price]) }}">
                            <i class="fas fa-edit"></i></a></td>

                    {{-- Prices é so uma unica linha (nao pode ser removivel) --}}
                    {{-- <td class="button-icon-col">
                        <form method="POST" action="{{ route('prices.destroy', ['price' => $price]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="delete" class="btn btn-danger">
                                <i class="fas fa-trash"></i></button>
                        </form>
                    </td> --}}

                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $prices->withQueryString()->links() }}
    </div>
@endsection
