@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
    $isCliente = $isCliente ?? true;
@endphp

{{-- isto será no edit customer ? - para ser proprio user a mudar suas infos - atualizar com codigo ativo
        <div>
            <label for="inputEmail">Email</label>
            <input type="text" name="email" id="inputEmail" {{ $disabledStr }} value="{{ $user->email }}">
        </div>
        <div>
            <label for="inputPassword">Password</label>
            <input type="text" name="password" id="inputPassword" {{ $disabledStr }} value="{{ $user->password }}">
        </div> --}}

{{-- TODO: fazer isto so apenas se user logged in for admin --}}


@if ($errors->any())

<div class="alert alert-danger">

<ul>

@foreach ($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif

<div class="mb-3 form-floating ms-2">
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="inputName"
    {{ $disabledStr }} value="{{ old('name', $user->name) }}">
    <label for="inputName" class="form-label">Nome</label>
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

@if (!$isCliente)
<div class="mb-3 form-floating ms-2">
    <select class="form-control @error('user_type') is-invalid @enderror" name="user_type" id="inputUserType" {{ $disabledStr }}>
        {{-- <option value="C" {{ old('user_type', $user->user_type) == 'C' ? 'selected' : '' }}>Cliente</option> --}}
        <option {{ old('user_type', $user->user_type) == 'E' ? 'selected' : '' }} value="E" >Funcionário</option>
        <option {{ old('user_type', $user->user_type) == 'A' ? 'selected' : '' }} value="A">Administrador</option>
    </select>
    <label for="inputUserType" class="form-label">Tipo de User</label>
    @error('user_type')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
@endif

{{-- rever se deixo estes campos aqui --}}
<div class="mb-3 form-floating ms-2">
    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="inputEmail" {{ $disabledStr }} value="{{ old('email', $user->email) }}">
    <label for="inputEmail">Email</label>
    @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
{{-- <div class="mb-3 form-floating ms-2">
        <input type="text" name="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" {{ $disabledStr }} value="{{ $user->password }}">
        <label for="inputPassword">Password</label>
    @error('password')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
        @enderror
    </div> --}}

    {{-- TODO - foto --}}
