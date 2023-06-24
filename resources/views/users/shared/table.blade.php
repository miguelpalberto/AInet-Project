<table class="table">
    <thead class="table-dark">
        <tr>
            @if ($showFoto)
                <th></th>
            @endif
            <th>Nome</th>
            <th>Email</th>
            <th>Tipo de User</th>
            <th>Bloqueado</th>
            <th>Foto</th>
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
                <th class="button-icon-col"></th>
            @endif
            @if ($showDelete)
                <th class="button-icon-col"></th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                @if ($showFoto)
                    <td width="45">
                        @if ($user->photo_url)
                            <img src="{{ $user->fullPhotoUrl }}" alt="Avatar" class="bg-dark rounded-circle"
                                width="45">
                    </td>
                @endif
        @endif
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->user_type }}</td>
        <td>{{ $user->blocked }}</td>
        <td>{{ $user->photo_url }}</td>

        @if ($showDates)
            <td>{{ $user->created_at }}</td>
            <td>{{ $user->updated_at }}</td>
            <td>{{ $user->deleted_at }}</td>
        @endif

        @if ($showDetail)
            <td class="button-icon-col"><a class="btn btn-secondary"
                    href="{{ route('users.show', ['user' => $user]) }}">
                    <i class="fas fa-eye"></i></a></td>
        @endif
        @if ($showEdit)
            <td class="button-icon-col"><a class="btn btn-dark" href="{{ route('users.edit', ['user' => $user]) }}">
                    <i class="fas fa-edit"></i></a></td>
            {{-- bloquear: --}}
            <td class="button-icon-col">
                <form method="POST" action="{{ route('usersBlock', ['user' => $user]) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" name="usersBlock" class="btn btn-dark">
                        <i class="fas fa-unlock"></i></button>
                </form>
            </td>
        @endif
        @if ($showDelete)
            <td class="button-icon-col">
                <form method="POST" action="{{ route('users.destroy', ['user' => $user]) }}">
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
