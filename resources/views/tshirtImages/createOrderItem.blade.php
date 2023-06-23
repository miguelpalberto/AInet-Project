

@section('titulo', 'Comprar T-Shirt')

@section('subtitulo')
    <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item">Gestão</li> --}}
        <li class="breadcrumb-item"><a href="{{ route('tshirtImages.index') }}">Imagens Tshirts</a></li>
        <li class="breadcrumb-item active">Comprar</li>
    </ol>
@endsection

@section('main')
    {{-- <form id="form_docente" method="POST" action="{{ route('docentes.store') }}" enctype="multipart/form-data"> --}}
    @csrf
    <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
        <div class="flex-grow-1 pe-2">
            @include('order_items.shared.fields', [
                //'orderItem' => $orderItem,
                'readonlyData' => false,
            ])

            <!-- Botão adicionar ao carrinho -->
            {{-- TODO order item em vez de tshirt e ver se botao esta bom --}}
            <td class="button-icon-col">
                <form method="POST" action="{{ route('cart.add', ['orderItem' => $orderItem]) }}">
                    @csrf
                    <button type="submit" name="addToCart" class="btn btn-success ms-3">
                        <i class="fas fa-plus"></i> Adicionar ao Carrinho
                    </button>


                </form>
            </td>
            <a href="{{ route('tshirtImages.index') }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </div>

    {{-- <form method="POST" action="{{ route('order_items.store') }}">
        @csrf
        @include('order_items.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Comprar Tshirt com esta Imagem</button>
            <a href="{{ route('tshirtImages.index') }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form> --}}
@endsection
