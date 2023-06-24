@extends('template.layout')

@section('titulo', 'Users')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item active">Users</li>
    </ol>
@endsection

@section('main')
    <p>
        <a class="btn btn-success" href="{{ route('users.create') }}"><i class="fas fa-plus"></i> &nbsp;Criar nova conta</a>
    </p>
    <hr>
    {{-- Filtro --}}
    <form method="GET" action="{{ route('users.index') }}?filter=1">
        <div class="d-flex justify-content-between">


            <div class="flex-grow-1 pe-2">
                <div class="d-flex justify-content-between">
                    <div class="mb-3 me-2 flex-grow-1 form-floating">
                        <input type="text" class="form-control" name="name" id="inputName"
                            value="{{ old('name', $filterByName) }}">
                        <label for="inputName" class="form-label">Nome</label>
                    </div>
                </div>

                {{-- <div class="d-flex justify-content-between">
                        <div class="mb-3 me-2 flex-grow-1 form-floating">
                            <input type="text" class="form-control" name="email" id="inputEmail"
                                value="{{ old('email', $filterByEmail) }}">
                            <label for="inputEmail" class="form-label">Email</label>
                        </div>
                    </div>
                </div> --}}
                <div class="d-flex justify-content-between">
                    <div class="mb-3 me-2 flex-grow-1 form-floating">
                        <select class="form-select" name="user_type" id="inputUserType">
                            <option value="">Todos</option>
                            <option value="C"{{ old('user_type', $filterByUserType) === 'C' ? ' selected' : '' }}>Cliente
                            </option>
                            <option value="E"{{ old('user_type', $filterByUserType) === 'E' ? ' selected' : '' }}>Funcionário
                            </option>
                            <option value="A"{{ old('user_type', $filterByUserType) === 'A' ? ' selected' : '' }}>Administrador
                            </option>
                        </select>
                        <label for="inputUserType" class="form-label">Tipo de User</label>
                    </div>
                </div>
            </div>





            <div class="flex-shrink-1 d-flex flex-column justify-content-between">
                <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1" name="filtrar">Filtrar</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>
            </div>


        </div>


    </form>
    @include('users.shared.table', [
        'users' => $users,
        'showFoto' => true,
        'showDates' => false,
        'showDetail' => true,
        'showEdit' => true,
        'showDelete' => true,
       
    ])
    <div>
        {{ $users->withQueryString()->links() }}
    </div>
@endsection
