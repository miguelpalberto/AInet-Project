<img src="{{ $user->fullPhotoUrl }}" alt="Avatar" class="rounded-circle img-thumbnail">

@if ($allowUpload)
<div class="mb-3 pt-3">
    <input type="file" class="form-control" id="inputFileFoto" @error('photo_url') is-invalid @enderror" name="photo_url">

    @error('photo_url')

    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
@endif

@if (($allowDelete ?? false) && $user->photo_url)
@if ($user)
<button type="submit" class="btn btn-danger" name="deletefoto" form="{{ $formToDelete }}">
    Apagar Foto
</button>
@endif
@endif