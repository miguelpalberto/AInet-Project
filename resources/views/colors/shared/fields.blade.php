@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp
{{-- TODO: colocar apenas para ser visto (e pelo admin) --}}
{{-- <div class="mb-3 form-floating">
    <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" id="inputCode"
        {{ $disabledStr }} value="{{ old('code', $color->code) }}">
    <label for="inputCode" class="form-label">ID</label>
    @error('code')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div> --}}

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="inputName"
        {{ $disabledStr }} value="{{ old('name', $color->name) }}">
    <label for="inputName" class="form-label">Nome</label>
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>




<!-- {{-- @php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp
<div>
    <label for="inputAbr">Abreviatura</label>
    <input type="text" name="abreviatura" id="inputAbr" {{ $disabledStr }} value="{{ $disciplina->abreviatura }}">
</div>
<div>
    <label for="inputNome">Nome</label>
    <input type="text" name="nome" id="inputNome" {{ $disabledStr }} value="{{ $disciplina->nome }}">
</div>
<div>
    <label for="inputCurso">Curso</label>
    <select name="curso" id="inputCurso" {{ $disabledStr }}>
        @foreach ($cursos as $curso)
            <option {{ $curso->abreviatura == $disciplina->curso ? 'selected' : '' }}
                    value="{{$curso->abreviatura}}">{{$curso->nome}}</option>
        @endforeach
    </select>
</div>
<div>
    <label for="inputAno">Ano</label>
    <input type="text" name="ano" id="inputAno" {{ $disabledStr }} value="{{ $disciplina->ano }}">
</div>
<div>
    <label for="inputSemestre">Semestre</label>
    <input type="text" name="semestre" id="inputSemestre" {{ $disabledStr }} value="{{ $disciplina->semestre }}">
</div>
<div>
    <label for="inputECTS">ECTS</label>
    <input type="text" name="ECTS" id="inputECTS" {{ $disabledStr }} value="{{ $disciplina->ECTS }}">
</div>
<div>
    <label for="inputHoras">Horas</label>
    <input type="text" name="horas" id="inputHoras" {{ $disabledStr }} value="{{ $disciplina->horas }}">
</div>
<div>
    <label for="inputOpcional">Opcional</label>
    <input type="text" name="opcional" id="inputOpcional" {{ $disabledStr }} value="{{ $disciplina->opcional }}">
</div> --}} -->
