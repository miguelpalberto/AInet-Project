@extends('template.layout')

@section('titulo', 'Clientes')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Clientes</a></li>
        <li class="breadcrumb-item"><strong>{{ $customer->user->name }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
@endsection

@section('main')
    <div>
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('users.shared.fields', ['user' => $customer->user, 'readonlyData' => true, 'isCliente' => true])
                @include('customers.shared.fields', ['customer' => $customer, 'readonlyData' => true])
                <div class="my-1 d-flex justify-content-end">
                    {{-- TODO @can ver alteracoes docente --}}
                    <form method="POST" action="{{ route('customers.destroy', ['customer' => $customer]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="delete" class="btn btn-danger">
                            Apagar Cliente
                        </button>
                    </form>
                    <a href="{{ route('customers.edit', ['customer' => $customer]) }}" class="btn btn-secondary ms-3">
                        Alterar Cliente
                    </a>
                </div>
            </div>
            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                @include('users.shared.fields_foto', [
                    'user' => $customer->user,
                    'allowUpload' => false,
                    //TODO delete foto - ver alteracoes docente
                ])
            </div>
        </div>
    </div>
    {{-- TODO descomentar e rever depois de ter orders--}}
    {{-- <div>
        <h3>Orders do Cliente</h3>
        @include('orders.shared.table', [
            'orders' => $customer->orders,
            'showDates' => false,
            'showDetail' => true,
            'showEdit' => false,
            'showDelete' => false,
        ])
    </div> --}}
@endsection
