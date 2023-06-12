@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp
{{-- TODO: colocar apenas para ser visto (e pelo admin) --}}
{{-- <div class="mb-3 form-floating">
    <input type="text" class="form-control @error('id') is-invalid @enderror" name="id" id="inputID"
        {{ $disabledStr }} value="{{ old('id', $price->id) }}">
    <label for="inputID" class="form-label">ID</label>
    @error('inputID')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div> --}}

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('unit_price_catalog') is-invalid @enderror" name="unit_price_catalog" id="inputPriceCatalog"
        {{ $disabledStr }} value="{{ old('unit_price_catalog', $price->unit_price_catalog) }}">
    <label for="inputPriceCatalog" class="form-label">Preço Catalogo</label>
    @error('unit_price_catalog')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

{{-- //TODO: fazer selecao de categoria, nao escrever, e fazer ex 17 Ficha 7 --}}
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('unit_price_own') is-invalid @enderror" name="unit_price_own" id="inputPriceOwn"
        {{ $disabledStr }} value="{{ old('unit_price_own', $price->unit_price_own) }}">
    <label for="inputPriceOwn" class="form-label">Preço Own</label>
    @error('unit_price_own')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('unit_price_catalog_discount') is-invalid @enderror" name="unit_price_catalog_discount"
        id="inputPriceCatalogDiscount" {{ $disabledStr }} value="{{ old('unit_price_catalog_discount', $price->unit_price_catalog_discount) }}">
    <label for="inputPriceCatalogDiscount" class="form-label">Preço Catalogo Disc</label>
    @error('unit_price_catalog_discount')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('unit_price_own_discount') is-invalid @enderror" name="unit_price_own_discount" id="inputPriceOwnDiscount"
        {{ $disabledStr }} value="{{ old('unit_price_own_discount', $price->unit_price_own_discount) }}">
    <label for="inputDescription" class="form-label">Preço Own Disc</label>
    @error('unit_price_own_discount')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('qty_discount') is-invalid @enderror" name="qty_discount" id="inputQtyDiscount"
        {{ $disabledStr }} value="{{ old('qty_discount', $price->qty_discount) }}">
    <label for="inputQtyDiscount" class="form-label">Quantidade Disc</label>
    @error('qty_discount')
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
