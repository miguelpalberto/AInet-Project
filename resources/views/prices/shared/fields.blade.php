@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp
{{-- TODO: colocar apenas para ser visto (e pelo admin) --}}
{{-- <div class="mb-3 form-floating">
    <input type="text" class="form-control @error('id') is-invalid @enderror" name="id" id="inputID"
        {{ $disabledStr }} value="{{ old('id', $price->price) }}">
    <label for="inputAbr" class="form-label">ID</label>
    @error('id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div> --}}
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('customer_id') is-invalid @enderror" name="customer_id" id="inputCustomerID"
        {{ $disabledStr }} value="{{ old('customer_id', $tshirtImage->customer_id) }}">
    <label for="inputCustomerID" class="form-label">ID Customer</label>
    @error('customer_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
{{-- //TODO: fazer selecao de categoria, nao escrever, e fazer ex 17 Ficha 7 --}}
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="inputCategoryID"
        {{ $disabledStr }} value="{{ old('category_id', $tshirtImage->category_id) }}">
    <label for="inputCategoryID" class="form-label">ID Category</label>
    @error('category_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
        id="inputName" {{ $disabledStr }} value="{{ old('name', $tshirtImage->name) }}">
    <label for="inputName" class="form-label">Nome</label>
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="inputDescription"
        {{ $disabledStr }} value="{{ old('description', $tshirtImage->description) }}">
    <label for="inputDescription" class="form-label">Descrição</label>
    @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('image_url') is-invalid @enderror" name="image_url" id="inputImageURL"
        {{ $disabledStr }} value="{{ old('image_url', $tshirtImage->image_url) }}">
    <label for="inputImageURL" class="form-label">URL Imagem</label>
    @error('image_url')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('extra_info') is-invalid @enderror" name="extra_info" id="inputExtraInfo"
        {{ $disabledStr }} value="{{ old('extra_info', $tshirtImage->extra_info) }}">
    <label for="inputExtraInfo" class="form-label">Info Extra</label>
    @error('extra_info')
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
