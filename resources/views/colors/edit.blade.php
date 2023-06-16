@extends('template.layout')

@section('titulo', 'Alterar Cor')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('colors.index') }}"> Cor</a></li>
        <li class="breadcrumb-item"><strong>{{ $color->name }}</strong></li>
        <li class="breadcrumb-item active">Alterar</li>
    </ol>
@endsection

@section('main')
    <form method="POST" action="{{ route('colors.update', ['color' => $color]) }}">
        @csrf
        @method('PUT')

        @include('colors.shared.fieldsedit', ['readonlyData' => true])

        <div class="mb-3 form-floating">
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="inputName"
                value="{{ old('name', $color->name) }}">
            <label for="inputName" class="form-label">Nome</label>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>


        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Guardar Alterações</button>
            <a href="{{ route('colors.index', ['color' => $color]) }}"
                class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
@endsection

