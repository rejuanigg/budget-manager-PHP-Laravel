<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mis transacciones</title>
</head>
<body>
    <h1>Mis transacciones</h1>
    <table style="width:100%" border="2px">
        <tr>
            <th>Fecha</th>
            <th>Detalle</th>
            <th>Monto</th>
            <th>Tipo</th>
            <th>Categoria</th>
        </tr>
        @foreach ($misTransacciones as $item)
            <tr>
                <td>{{$item->transaction_date}}</td>
                <td>{{$item->detail}}</td>
                <td>{{$item->amount}}</td>
                <td>{{$item->type}}</td>
                <td>{{$item->category->name}}</td>
            </tr>
        @endforeach

    </table>
    <br>
    <br>
    <a href=" {{route('transactions.create')}} ">Volver al Inicio</a>
</body>
</html>
