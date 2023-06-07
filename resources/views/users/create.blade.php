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
    <h2>Nova Conta</h2>
    {{-- <form method="POST" action="/users"> --}}
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div>
            {{-- TODO: adicionar id automaticamente --}}
        </div>

        {{-- Subview: --}}
        @include ('users.shared.fields')

        <div>
            <label for="inputEmail">Email</label>
            <input type="text" name="email" id="inputEmail">
        </div>
        <div>
            <label for="inputPassword">Password</label>
            <input type="text" name="password" id="inputPassword">
        </div>

        <div>
            <button type="submit" name="ok">Criar Conta</button>
        </div>
    </form>
</body>

</html>
