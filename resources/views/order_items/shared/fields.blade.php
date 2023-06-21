@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp
{{-- <div class="mb-3 form-floating">
    <input type="text" class="form-control @error('customer_id') is-invalid @enderror" name="customer_id" id="inputCustomerID"
        {{ $disabledStr }} value="{{ old('customer_id', $tshirtImage->customer_id) }}">
    <label for="inputCustomerID" class="form-label">ID Order</label>
    @error('customer_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div> --}}
{{-- <div class="mb-3 form-floating">
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
        id="inputName" {{ $disabledStr }} value="{{ old('name', $tshirtImage->name) }}">
    <label for="inputName" class="form-label">ID Imagem</label>
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div> --}}
<div class="mb-3 form-floating">
    <span class="form-control-plaintext">{{ $tshirtImage->id }}</span>
    <label for="inputImageId" class="form-label">ID Imagem</label>
</div>
{{-- <div class="mb-3 form-floating">
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
        id="inputName" {{ $disabledStr }} value="{{ old('name', $tshirtImage->name) }}">
    <label for="inputName" class="form-label">Nome Imagem</label>
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div> --}}
{{-- TODO: trazer nome da tshirt para aqui consoante o seu id --}}
{{-- <div class="mb-3 form-floating">
    <span class="form-control-plaintext">{{ $tshirtImage->name }}</span>
    <label for="inputName" class="form-label">Nome Imagem</label>
</div> --}}
<div class="mb-3 form-floating ms-2">
    <select class="form-control @error('size') is-invalid @enderror" name="size" id="inputSize" {{ $disabledStr }}>
        <option {{ old('size', $orderItem->size) == 'XS' ? 'selected' : '' }} value="XS">XS</option>
        <option {{ old('size', $orderItem->size) == 'S' ? 'selected' : '' }} value="S">S</option>
        <option {{ old('size', $orderItem->size) == 'M' ? 'selected' : '' }} value="M">M</option>
        <option {{ old('size', $orderItem->size) == 'L' ? 'selected' : '' }} value="L">L</option>
        <option {{ old('size', $orderItem->size) == 'XL' ? 'selected' : '' }} value="XL">XL</option>
    </select>
    <label for="inputSize" class="form-label">Tamanho</label>
    @error('size')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


<div class="mb-3 form-floating">
    <select class="form-select @error('color') is-invalid @enderror" name="color" id="inputColor"
        {{ $disabledStr }}>
        @foreach ($colors as $color)
            <option {{ $color->code == old('color', $order_item->color_code) ? 'selected' : '' }}
                value="{{ $color->code }}">
                {{ $color->name }}</option>
        @endforeach
    </select>
    <label for="inputColor" class="form-label">Cor</label>
    @error('color')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>



<div class="mb-3 form-floating">
    <input type="number" class="form-control @error('qty') is-invalid @enderror" name="qty"
        id="inputQty" {{ $disabledStr }} value="{{ old('qty', $order_item->qty) }}">
    <label for="inputQty" class="form-label">Quantidade</label>
    @error('qty')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
{{-- <div class="mb-3 form-floating">
    <input type="text" class="form-control @error('image_url') is-invalid @enderror" name="image_url"
        id="inputImageURL" {{ $disabledStr }} value="{{ old('image_url', $tshirtImage->image_url) }}">
    <label for="inputImageURL" class="form-label">Preço</label>
    @error('image_url')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div> --}}
<div class="mb-3 form-floating">
    <span class="form-control-plaintext">{{ $price->unit_price_catalog }}</span>
    <label for="inputPrice" class="form-label">Preço</label>
</div>
{{-- <div class="mb-3 form-floating">
    <input type="text" class="form-control @error('extra_info') is-invalid @enderror" name="extra_info"
        id="inputExtraInfo" {{ $disabledStr }} value="{{ old('extra_info', $tshirtImage->extra_info) }}">
    <label for="inputExtraInfo" class="form-label">Total</label>
    @error('extra_info')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div> --}}
<div class="mb-3 form-floating">
    <span class="form-control-plaintext">{{ $price->unit_price_catalog*quant }}</span>
    <label for="inputTotal" class="form-label">Total</label>
</div>
