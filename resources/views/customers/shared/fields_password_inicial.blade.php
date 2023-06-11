<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('password_inicial') is-invalid @enderror" name="password_inicial"
        id="inputNIF" value="{{ old('password_inicial', '123') }}">
    <label for="inputNIF" class="form-label">Password Inicial</label>
    @error('password_inicial')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
