@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp
<div>
    <label for="inputName">Nome</label>
    <input type="text" name="name" id="inputName" {{ $disabledStr }} value="{{ $user->id }}">
</div>
        {{-- isto será no edit customer ? - para ser proprio user a mudar suas infos
        <div>
            <label for="inputEmail">Email</label>
            <input type="text" name="email" id="inputEmail" {{ $disabledStr }} value="{{ $user->email }}">
        </div>
        <div>
            <label for="inputPassword">Password</label>
            <input type="text" name="password" id="inputPassword" {{ $disabledStr }} value="{{ $user->password }}">
        </div> --}}

    {{-- TODO: fazer isto so apenas se user logged in for admin --}}
    <label for="inputTipo">Tipo de User</label>
    <select name="tipo" id="inputTipo" {{ $disabledStr }}>
        <option {{ $user->tipo == 'Cliente' ? 'selected' : '' }}>Cliente</option>
        <option {{ $user->tipo == 'Funcionário' ? 'selected' : '' }}>Funcionário</option>
        <option {{ $user->tipo == 'Administrador' ? 'selected' : '' }}>Administrador</option>
    </select>
</div>
<div>
