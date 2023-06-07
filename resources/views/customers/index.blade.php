{{-- <!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customers</title>
</head>

<body>
    @dump($customers)
</body>

</html> --}}
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0,
maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clientes</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>NIF</th>
                <th>Morada</th>
                <th>Tipo Pagamento</th>
                <th>Referência Pagamento</th>
                <th>Data Criação</th>
                <th>Data Edição</th>
                <th>Data Remoção</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    {{-- usar campos iguais à db: --}}
                    <td>{{ $customer->nif }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->default_payment_type }}</td>
                    <td>{{ $customer->default_payment_ref }}</td>
                    <td>{{ $customer->created_at }}</td>
                    <td>{{ $customer->updated_at }}</td>
                    <td>{{ $customer->deleted_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
