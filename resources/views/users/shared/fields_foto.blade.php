<img src="{{ $user->fullPhotoUrl }}" alt="Avatar" class="rounded-circle img-thumbnail">
@if ($allowUpload)
    <div class="mb-3 pt-3">
        <input type="file" class="form-control @error('file_foto') is-invalid @enderror" name="file_foto"
            id="inputFileFoto">
        @error('file_foto')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
@endif
@if (($allowDelete ?? false) && $user->url_foto)
    @if ($user->customer)
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationModal"
            data-action="{{ route('customers.foto.destroy', ['customer' => $user->customer]) }}"
            data-msgLine2="Quer mesmo apagar a fotografia do cliente <strong>{{ $user->name }}</strong>?">
            Apagar Foto
        </button>
    @endif
@endif
