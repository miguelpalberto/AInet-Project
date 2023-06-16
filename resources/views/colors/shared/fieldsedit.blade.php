@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp


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



