{{-- @extends('layouts.app') --}}

@extends('template.layout')

@section('titulo', '')

@section('main')

    {{-- @section('content') --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{-- <div class="card-header">{{ __('Register') }}</div> --}}
                    <div class="card-header bg-dark text-light">{{ __('Registar') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            {{-- ------------------------------ --}}
                            <br>
                            <div class="row mb-3">
                                <label for="address" class="col-md-4 col-form-label text-md-end">Morada</label>

                                <div class="col-md-6">
                                    <input id="address" type="address"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address') }}">

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="nif" class="col-md-4 col-form-label text-md-end">NIF</label>

                                <div class="col-md-6">
                                    <input id="nif" type="nif"
                                        class="form-control @error('nif') is-invalid @enderror" name="nif"
                                        value="{{ old('nif') }}">

                                    @error('nif')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="curso" class="col-md-4 col-form-label text-md-end">Tipo Pagamento
                                    Predefinido</label>
                                <div class="col-md-6">
                                    <select class="form-select @error('default_payment_type') is-invalid @enderror"
                                        name="default_payment_type" id="inputDefaultPaymentType">
                                        <option {{ old('default_payment_type', '') === null ? 'selected' : '' }}
                                            value="">-Nenhum-</option>
                                        <option {{ old('default_payment_type', '') == 'VISA' ? 'selected' : '' }}
                                            value="VISA">Visa
                                        </option>
                                        <option {{ old('default_payment_type', '') == 'MC' ? 'selected' : '' }}
                                            value="MC">MasterCard
                                        </option>
                                        <option {{ old('default_payment_type', '') == 'PAYPAL' ? 'selected' : '' }}
                                            value="PAYPAL">Paypal
                                        </option>
                                    </select>
                                    @error('default_payment_type')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="default_payment_ref" class="col-md-4 col-form-label text-md-end">Referência
                                    Pagamento Predef.</label>

                                <div class="col-md-6">
                                    <input id="default_payment_ref" type="default_payment_ref"
                                        class="form-control @error('default_payment_ref') is-invalid @enderror"
                                        name="default_payment_ref" value="{{ old('default_payment_ref') }}">

                                    @error('default_payment_ref')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- ------------------------------ --}}
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registar') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
