@extends('template.layout')

@section('titulo', 'Clientes')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item active">Clientes</li>
    </ol>
@endsection

@section('main')
    <p><a class="btn btn-success" href="{{ route('customers.create') }}"><i class="fas fa-plus"></i> &nbsp;Criar novo
            cliente</a></p>
    <hr>

    <!--Filtro-->
    <form method="GET" action="{{ route('customers.index') }}">
        <div class="d-flex justify-content-between">


            <div class="flex-grow-1 pe-2">
                <div class="d-flex justify-content-between">
                    <div class="mb-3 me-2 flex-grow-1 form-floating">
                        <input type="text" class="form-control" name="name" id="inputName"
                            value="{{ old('name', $filterByName) }}">
                        <label for="inputName" class="form-label">Nome</label>
                    </div>
                </div>



                <div class="d-flex justify-content-between">
                    <div class="mb-3 me-2 flex-grow-1 form-floating">
                        <input type="text" class="form-control" name="email" id="inputEmail"
                            value="{{ old('email', $filterByEmail) }}">
                        <label for="inputEmail" class="form-label">Email</label>
                    </div>
                </div>
            </div>





            <div class="flex-shrink-1 d-flex flex-column justify-content-between">
                <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1" name="filtrar">Filtrar</button>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>
            </div>


        </div>
    </form>
    @include('customers.shared.table', [
        'customers' => $customers,
        'showFoto' => true,
        'showDates' => false,
        'showDetail' => true,
        'showEdit' => true,
        'showDelete' => true,
    ])
    <div>
        {{ $customers->withQueryString()->links() }}
    </div>
@endsection
