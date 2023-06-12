<table class="table">
    <thead class="table-dark">
        <tr>
            @if ($showFoto)
                <th></th>
            @endif
            <th>Nome</th>
            <th>E-Mail</th>

            <th>NIF</th>
            <th>Morada</th>
            <th>Tipo Pagamento</th>
            <th>Referência Pagamento</th>
            @if ($showDates)
                <th>Data Criação</th>
                <th>Data Edição</th>
                <th>Data Remoção</th>
            @endif
            @if ($showDetail)
                <th class="button-icon-col"></th>
            @endif
            @if ($showEdit)
                <th class="button-icon-col"></th>
            @endif
            @if ($showDelete)
                <th class="button-icon-col"></th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
            <tr>
                @if ($showFoto)
                {{-- TODO --}}
                    <td><img src="/img/avatar_unknown.png" alt="Avatar" class="bg-dark rounded-circle" width="45"
                            height="45"></td>
                @endif
                <td>{{ $customer->user->name }}</td>
                <td>{{ $customer->user->email }}</td>

                <td>{{ $customer->nif }}</td>
                <td>{{ $customer->address }}</td>
                <td>{{ $customer->default_payment_type }}</td>
                <td>{{ $customer->default_payment_ref }}</td>

                {{-- TODO - show cenas é diferente ficha 9--}}
                @if ($showDates)
                    <td>{{ $customer->created_at }}</td>
                    <td>{{ $customer->updated_at }}</td>
                    <td>{{ $customer->deleted_at }}</td>
                @endif

                @if ($showDetail)
                    <td class="button-icon-col"><a class="btn btn-secondary"
                            href="{{ route('customers.show', ['customer' => $customer]) }}">
                            <i class="fas fa-eye"></i></a></td>
                @endif
                @if ($showEdit)
                    <td class="button-icon-col"><a class="btn btn-dark"
                            href="{{ route('customers.edit', ['customer' => $customer]) }}">
                            <i class="fas fa-edit"></i></a></td>
                @endif
                @if ($showDelete)
                    <td class="button-icon-col">
                        <form method="POST" action="{{ route('customers.destroy', ['customer' => $customer]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="delete" class="btn btn-danger">
                                <i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>











