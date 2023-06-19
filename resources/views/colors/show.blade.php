@extends('template.layout')

@section('titulo', 'Cor')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('colors.index') }}">Cores</a></li>
        <li class="breadcrumb-item"><strong>{{ $color->name }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
@endsection


@section('main')
    <div>
        @include('colors.shared.fields', ['readonlyData' => true])
    </div>
    <div class="my-4 d-flex justify-content-end">
        <form method="POST" action="{{ route('colors.destroy', ['color' => $color]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" name="delete" class="btn btn-danger">
                Apagar Cor
            </button>
        </form>
        <a href="{{ route('colors.edit', ['color' => $color]) }}" class="btn btn-secondary ms-3">Alterar
            Cor</a>
    </div>

    {{-- TODO: detalhes a mostrar order_items de x cor --}}
    {{-- <div class="my-3">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link {{ $showDetail == 'docentes' ? 'active' : '' }}"
                href="{{ route('disciplinas.show', ['disciplina' => $disciplina]) }}">Docentes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  {{ $showDetail == 'alunos' ? 'active' : '' }}"
                href="{{ route('disciplinas.show', ['disciplina' => $disciplina, 'show-detail' => 'alunos']) }}">Alunos</a>
        </li>
    </ul>
</div>

<div>
    @if ($showDetail == 'docentes')
        <h3 class="my-3">Docentes que lecionam a disciplina</h3>
        @include('docentes.shared.table', [
            'docentes' => $disciplina->docentes,
            'showFoto' => true,
            'showDepartamento' => true,
            'showContatos' => true,
            'showDetail' => true,
            'showEdit' => false,
            'showDelete' => false,
        ])
    @elseif ($showDetail == 'alunos')
        <h3 class="my-3">Alunos inscritos à disciplina</h3>
        @include('alunos.shared.table', [
            'alunos' => $disciplina->alunos,
            'showFoto' => true,
            'showDepartamento' => false,
            'showContatos' => true,
            'showDetail' => true,
            'showEdit' => false,
            'showDelete' => false,
        ])
    @endif
</div> --}}
@endsection
