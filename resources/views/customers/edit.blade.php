@extends('template.layout')

@section('titulo', 'Alterar Cliente')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Clientes</a></li>
        <li class="breadcrumb-item"><strong>{{ $customer->user->name }}</strong></li>
        <li class="breadcrumb-item active">Alterar</li>
    </ol>
@endsection

@section('main')
    <form id="form_customer" novalidate class="needs-validation" method="POST"
        action="{{ route('customers.update', ['customer' => $customer]) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $customer->id }}">
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('users.shared.fields', ['user' => $customer->user, 'readonlyData' => false,  'isCliente' => true])
                @include('customers.shared.fields', ['customer' => $customer, 'readonlyData' => false])
                <div class="my-1 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="ok" form="form_customer">Guardar
                        Alterações</button>
                    <a href="{{ route('customers.index', ['customer' => $customer]) }}"
                        class="btn btn-secondary ms-3">Cancelar</a>
                </div>
            </div>
            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                @include('users.shared.fields_foto', [
                    'user' => $customer->user,
                    'allowUpload' => true,
                    'formToDelete' => 'form_delete_photo',
                ])
            </div>
        </div>
    </form>
    <form id="form_delete_photo" action="#" method="POST" class="d-none" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
    </form>
@endsection
