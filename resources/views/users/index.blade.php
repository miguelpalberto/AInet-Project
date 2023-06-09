@extends('template.layout')

@section('titulo', 'Users')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        {{-- <li class="breadcrumb-item">Curricular</li> --}}
        <li class="breadcrumb-item active">Users</li>
    </ol>
@endsection

@section('main')
    <p>
        <a class="btn btn-success" href="{{ route('users.create') }}"><i class="fas fa-plus"></i> &nbsp;Criar nova conta</a>
    </p>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Tipo de User</th>
                <th>Bloqueado</th>
                <th>Foto</th>
                <th>Data Criação</th>
                <th>Data Edição</th>
                <th>Data Remoção</th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    {{-- usar campos iguais à db: --}}
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->user_type }}</td>
                    <td>{{ $user->blocked }}</td>
                    <td>{{ $user->photo_url }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>{{ $user->deleted_at }}</td>
                    <td class="button-icon-col"><a href="{{ route('users.show', ['user' => $user]) }}"
                            class="btn btn-secondary"><i class="fas fa-eye"></i></a></td>
                    <td class="button-icon-col"><a href="{{ route('users.edit', ['user' => $user]) }}"
                            class="btn btn-dark"><i class="fas fa-edit"></i></a></td>
                    <td class="button-icon-col">
                        <form method="POST" action="{{ route('users.destroy', ['user' => $user]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="delete" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $users->links() }}
    </div>
@endsection
