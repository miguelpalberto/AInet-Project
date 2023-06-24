@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('unit_price_catalog') is-invalid @enderror" name="unit_price_catalog" id="inputPriceCatalog"
        {{ $disabledStr }} value="{{ old('unit_price_catalog', $price->unit_price_catalog) }}">
    <label for="inputPriceCatalog" class="form-label">Preço Catalogo</label>
    @error('unit_price_catalog')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('unit_price_own') is-invalid @enderror" name="unit_price_own" id="inputPriceOwn"
        {{ $disabledStr }} value="{{ old('unit_price_own', $price->unit_price_own) }}">
    <label for="inputPriceOwn" class="form-label">Preço Own</label>
    @error('unit_price_own')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('unit_price_catalog_discount') is-invalid @enderror" name="unit_price_catalog_discount"
        id="inputPriceCatalogDiscount" {{ $disabledStr }} value="{{ old('unit_price_catalog_discount', $price->unit_price_catalog_discount) }}">
    <label for="inputPriceCatalogDiscount" class="form-label">Preço Catalogo Disc</label>
    @error('unit_price_catalog_discount')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('unit_price_own_discount') is-invalid @enderror" name="unit_price_own_discount" id="inputPriceOwnDiscount"
        {{ $disabledStr }} value="{{ old('unit_price_own_discount', $price->unit_price_own_discount) }}">
    <label for="inputDescription" class="form-label">Preço Own Disc</label>
    @error('unit_price_own_discount')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('qty_discount') is-invalid @enderror" name="qty_discount" id="inputQtyDiscount"
        {{ $disabledStr }} value="{{ old('qty_discount', $price->qty_discount) }}">
    <label for="inputQtyDiscount" class="form-label">Quantidade Disc</label>
    @error('qty_discount')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


