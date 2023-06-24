@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp



<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('nif') is-invalid @enderror" name="nif" id="inputNif"
        {{ $disabledStr }} value="{{ old('nif', $order->nif) }}">
    <label for="inputNif" class="form-label">NIF</label>
    @error('nif')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="inputAddress"
        {{ $disabledStr }} value="{{ old('address', $order->address) }}">
    <label for="inputAddress" class="form-label">Morada</label>
    @error('address')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">{{-- flex-grow-1 ms-2 --}}
    <select class="form-select @error('payment_type') is-invalid @enderror" name="payment_type"
        id="inputDefaultPaymentType" {{ $disabledStr }}>
        <option {{ old('payment_type', $order->payment_type) === null ? 'selected' : '' }} value="">-Nenhum-
        </option>
        <option {{ old('payment_type', $order->payment_type) == 'VISA' ? 'selected' : '' }} value="VISA">Visa
        </option>
        <option {{ old('payment_type', $order->payment_type) == 'MC' ? 'selected' : '' }} value="MC">MasterCard
        </option>
        <option {{ old('payment_type', $order->payment_type) == 'PAYPAL' ? 'selected' : '' }} value="PAYPAL">Paypal
        </option>
    </select>
    <label for="inputDefaultPaymentType" class="form-label">Tipo de Pagamento</label>
    @error('payment_type')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('payment_ref') is-invalid @enderror" name="payment_ref"
        id="inputPaymentRef" {{ $disabledStr }} value="{{ old('payment_ref', $order->payment_ref) }}">
    <label for="inputPaymentRef" class="form-label">Referência de Pagamento</label>
    @error('payment_ref')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('notes') is-invalid @enderror" name="notes" id="inputNotes"
        {{ $disabledStr }} value="{{ old('notes', $order->notes) }}">
    <label for="inputNotes" class="form-label">Notas</label>
    @error('notes')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


