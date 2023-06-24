@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp


{{-- <div class="mb-3 form-floating ms-2">
    <span class="form-control-plaintext">{{ $tshirtImage->id }}</span>
    <label for="inputImageId" class="form-label">ID Imagem</label>
</div> --}}
<div class="mb-3 form-floating ms-2">
    <span class="form-control-plaintext">{{ $tshirtImage->name }}</span>
    <label for="inputImageId" class="form-label">Nome Imagem</label>
</div>


<div class="row">
    <div class="col-md-6">

        <div class="mb-3 form-floating ms-2">
            <select class="form-control @error('size') is-invalid @enderror" name="size" id="inputSize"
                {{ $disabledStr }}>
                <option {{ old('size', $orderItem->size) == 'XS' ? 'selected' : '' }} value="XS">XS</option>
                <option {{ old('size', $orderItem->size) == 'S' ? 'selected' : '' }} value="S">S</option>
                <option {{ old('size', $orderItem->size) == 'M' ? 'selected' : 'selected' }} value="M">M</option>
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

        <div class="mb-3 form-floating ms-2">
            <select class="form-select @error('color') is-invalid @enderror" name="color" id="inputColor"
                {{ $disabledStr }}>
                @foreach ($colors as $color)
                    <option {{ $color->code == old('color', $orderItem->color_code) ? 'selected' : '' }}
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

        <div class="mb-3 form-floating ms-2">
            <input type="number" class="form-control" name="qty" id="inputQty"
                value="{{ old('qty', $orderItem->qty ?? 1) }}" onchange="updateTotal(this.value)">
            <label for="inputQty" class="form-label">Quantidade</label>
            @error('qty')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>


        <div class="mb-3 form-floating ms-2">
            @php
                if ($tshirtImage->customer_id == null) {
                    $preço = $price->unit_price_catalog;
                } else {
                    $preço = $price->unit_price_own;
                }
            @endphp
            <span class="form-control-plaintext">{{ $preço }}</span>
            <label for="inputPrice" class="form-label">Preço Unitário</label>
        </div>

        <div class="mb-3 form-floating ms-2">

            <input type="text" class="form-control-plaintext" id="inputTotal" name="total"
                value="{{ old('total', $total ?? '') }}" readonly>
            <label for="inputTotal" class="form-label">Total</label>
        </div>


    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <h3>Preview da T-Shirt</h3>
            <img src="storage/tshirt_preview.png" alt="Preview da T-Shirt" style="max-width: 100%">
        </div>
    </div>
</div>






<script>
    function updateTotal(qty) {
        const preço = {{ $preço }};
        const total = preço * qty;
        document.getElementById("inputTotal").value = total.toFixed(2);
    }
</script>
