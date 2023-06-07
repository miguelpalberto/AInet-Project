<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0,
maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <h1>Lista de Users</h1>
    <p><a href="{{ route('users.create') }}">Criar nova conta</a></p>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Tipo de User</th>
                <th>Bloqueado</th>
                <th>Foto</th>
                <th>Data Criação</th>
                <th>Data Edição</th>
                <th>Data Remoção</th>
                <th></th>
                <th></th>
                <th></th>
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
                    <td>
                        {{-- <a href="/users/{{$user->id}}/edit">Modificar</a> --}}
                        <a href="{{ route('users.edit', ['user' => $user]) }}">Modificar</a>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('users.destroy', ['user' => $user]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="delete">Apagar</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('users.show', ['user' => $user]) }}">Consultar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
