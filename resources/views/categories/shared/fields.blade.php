@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp
{{-- TODO: colocar apenas para ser visto (e pelo admin) --}}
{{-- <div class="mb-3 form-floating">
    <input type="text" class="form-control @error('id') is-invalid @enderror" name="id" id="inputID"
        {{ $disabledStr }} value="{{ old('id', $category->id) }}">
    <label for="inputID" class="form-label">ID</label>
    @error('inputID')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div> --}}

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="inputName"
        {{ $disabledStr }} value="{{ old('name', $category->name) }}">
    <label for="inputName" class="form-label">Nome</label>
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

