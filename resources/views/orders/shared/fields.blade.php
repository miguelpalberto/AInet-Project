@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp


<div class="mb-3 form-floating">
    <select class="form-select @error('status') is-invalid @enderror" name="status" id="inputDefaultPaymentType"
        {{ $disabledStr }}>
        <option {{ old('status', $order->status) === 'pending' ? 'selected' : '' }} value="pending">-Em espera-</option>
        <option {{ old('status', $order->status) == 'paid' ? 'selected' : '' }} value="paid">Pago
        </option>
        <option {{ old('status', $order->status) == 'closed' ? 'selected' : '' }} value="closed">Fechado
        </option>
        <option {{ old('status', $order->status) == 'canceled' ? 'selected' : '' }} value="canceled">Cancelado
        </option>
    </select>
    <label for="inputDefaultPaymentType" class="form-label">Tipo de Status</label>
    @error('status')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

@php
    $disabledStr = 'disabled';//So se pode editar o Status
@endphp

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('customer_id') is-invalid @enderror" name="customer_id"
        id="inpuCustomerID" value="{{ old('unit_order_own', $order->customer_id) }}" {{ $disabledStr }}>
    <label for="inpuCustomerID" class="form-label">Customer_ID</label>
    @error('customer_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('date') is-invalid @enderror" name="date" id="inputDate"
        {{ $disabledStr }} value="{{ old('date', $order->date) }}">
    <label for="inputDate" class="form-label">Date</label>
    @error('date')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('total_price') is-invalid @enderror" name="total_price"
        id="inputTotalPrice" {{ $disabledStr }} value="{{ old('total_price', $order->total_price) }}">
    <label for="inputTotalPrice" class="form-label">Preço Total</label>
    @error('total_price')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('notes') is-invalid @enderror" name="notes" id="inputNotes"
        {{ $disabledStr }} value="{{ old('notes', $order->notes) }}">
    <label for="inputNotes" class="form-label">Notes</label>
    @error('notes')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('nif') is-invalid @enderror" name="nif" id="inputNif"
        {{ $disabledStr }} value="{{ old('nif', $order->nif) }}">
    <label for="inputNif" class="form-label">Nif</label>
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

<div class="mb-3 form-floating flex-grow-1 ms-2">
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
    <label for="inputDefaultPaymentType" class="form-label">Tipo Pagamento Predefenido</label>
    @error('payment_type')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('payment_ref') is-invalid @enderror" name="payment_ref"
        id="inputPaymentRef" {{ $disabledStr }} value="{{ old('payment_ref', $order->payment_ref) }}">
    <label for="inputPaymentRef" class="form-label">Ref Pagamento</label>
    @error('payment_ref')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('receipt_url') is-invalid @enderror" name="receipt_url"
        id="inputReceiptUrl" {{ $disabledStr }} value="{{ old('receipt_url', $order->receipt_url) }}">
    <label for="inputReceiptUrl" class="form-label">Url Recibo</label>
    @error('receipt_url')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


