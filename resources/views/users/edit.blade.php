<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0,
        maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User</title>
</head>

<body>
    <h2>Modificar utilizador {{ $user->name }}</h2>
    {{-- <form method="POST" action="/users/{{ $user->id }}"> --}}
    <form method="POST" action="{{ route('users.update', ['user' => $user]) }}">
        @csrf
        @method('PUT')

        {{-- Subview: --}}
        @include ('users.shared.fields')

        <div>
            <button type="submit" name="ok">Guardar alterações</button>
        </div>
    </form>
</body>

</html>
