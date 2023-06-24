@extends('template.layout')

@section('titulo', 'Imagens de Tshirts')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('tshirtImages.index') }}">Imagens Tshirts</a></li>
        <li class="breadcrumb-item"><strong>{{ $tshirtImage->name }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
@endsection

@section('main')
    <div>
        @include('tshirtImages.shared.fields', ['readonlyData' => true])
    </div>
    <div class="my-4 d-flex justify-content-end">

        @auth
            {{-- Se estiver autenticado e for Cliente --}}
            @if (auth()->user()->user_type === 'C')
                <td class="button-icon-col">
                    <a class="btn btn-success"
                        href="{{ route('tshirtImages.createOrderItem', ['tshirtImage' => $tshirtImage]) }}">
                        <i class="fas fa-plus"></i> Comprar Tshirt com esta Imagem</a>
                </td>
            @endif
        @else
            {{-- Se não estiver autenticado --}}
            <td class="button-icon-col">
                <a class="btn btn-success" href="{{ route('tshirtImages.createOrderItem', ['tshirtImage' => $tshirtImage]) }}">
                    <i class="fas fa-plus"></i> Comprar Tshirt com esta Imagem</a>
            </td>
        @endauth



        <form method="POST" action="{{ route('tshirtImages.destroy', ['tshirtImage' => $tshirtImage]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" name="delete" class="btn btn-danger ms-3">
                Apagar Imagem de Tshirt
            </button>
        </form>
        <a href="{{ route('tshirtImages.edit', ['tshirtImage' => $tshirtImage]) }}" class="btn btn-secondary ms-3">Alterar
            Imagem de Tshirt</a>
    </div>



@endsection
