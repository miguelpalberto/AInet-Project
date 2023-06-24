@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp

<div class="row">
    <div class="col-md-6">

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" id="inputCode"
        {{ $disabledStr }} value="{{ old('code', $color->code) }}">
    <label for="inputCode" class="form-label">Código Cor</label>
    @error('code')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
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


</div>
    <div class="col-md-6">
        <div class="mb-3">
            <h3>Preview da T-Shirt</h3>
            <img src="{{ asset('storage/tshirt_base/'.$color->code .'.jpg') }}" alt="Cor da T-Shirt" style="max-width: 40%">

        </div>
    </div>
