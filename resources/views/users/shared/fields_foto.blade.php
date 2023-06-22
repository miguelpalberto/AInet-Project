<img src="{{ $user->fullPhotoUrl }}" alt="Avatar" class="rounded-circle img-thumbnail">

@if ($allowUpload)
<div class="mb-3 pt-3">
    <input type="file" class="form-control" id="inputFileFoto" @error('file_foto') is-invalid @enderror" name="file_foto">

    @error('file_foto')

    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
@endif

@if (($allowDelete ?? false) && $user->url_foto)
@if ($user)
<button type="submit" class="btn btn-danger" name="deletefoto" form="{{ $formToDelete }}">
    Apagar Foto
</button>
@endif
@endif