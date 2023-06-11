@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp

<div class="mb-3 form-floating flex-grow-1 ms-2">
    <input type="text" class="form-control @error('nif') is-invalid @enderror" name="nif"
        id="inputNIF" {{ $disabledStr }} value="{{ old('nif', $customer->nif) }}">
    <label for="inputNIF" class="form-label">NIF</label>
    @error('nif')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="d-flex justify-content-between">
    <div class="mb-3 form-floating flex-grow-1">
        <input type="address" class="form-control @error('address') is-invalid @enderror" name="address"
            id="inputAddress" {{ $disabledStr }} value="{{ old('address', $customer->address) }}">
        <label for="inputAddress" class="form-label">Morada</label>
        @error('address')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>


    <div class="mb-3 form-floating">
        <select class="form-select @error('default_payment_type') is-invalid @enderror" name="default_payment_type" id="inputDefaultPaymentType"
            {{ $disabledStr }}>
            <option {{ old('default_payment_type', $customer->default_payment_type) == null ? 'selected' : '' }} value="nullable">-Nenhum-
            </option>
            <option {{ old('default_payment_type', $customer->default_payment_type) == 'VISA' ? 'selected' : '' }} value="VISA">Visa
            </option>
            <option {{ old('default_payment_type', $customer->default_payment_type) == 'MC' ? 'selected' : '' }} value="MC">MasterCard
            </option>
            <option {{ old('default_payment_type', $customer->default_payment_type) == 'PAYPAL' ? 'selected' : '' }} value="PAYPAL">Paypal
            </option>
        </select>
        <label for="inputDefaultPaymentType" class="form-label">Tipo Pagamento Predefenido</label>
        @error('default_payment_type')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3 form-floating flex-grow-1 ms-2">
        <input type="text" class="form-control @error('default_payment_ref') is-invalid @enderror" name="default_payment_ref" id="inputDefaultPaymentRef"
            {{ $disabledStr }} value="{{ old('default_payment_ref', $customer->default_payment_ref) }}">
        <label for="inputDefaultPaymentRef" class="form-label">Referência Pagamento Predefinida</label>
        @error('default_payment_ref')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
