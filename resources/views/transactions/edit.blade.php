<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Transaccion</title>
</head>
<body>
    <h1>Eeditar Transaccion</h1>
    <form action="{{route('transactions.edit')}}" method="post">
        <span>Cambia la fecha</span>
        <br>
        <input type="date" name="transaction_date">

        <span>Cambia el detalle</span>
        <br>
        <input type="text" placeholder="Cambia el detalle" name="detail">
        <br>
        <br>

        <span>Cambia el monto</span>
        <br>
        <input type="number" placeholder="Cambiá el monto" name="amount">
        <br>
        <br>

        <span>Cambia el tipo</span>
        <br>
        @foreach ($transaction as $item)
            <select name="type" >
                <option value="{{$item->type}}">{{$item->type}}</option>
            </select>
        @endforeach
        <br>
        <br>

        <span>Cambia de Categoria</span>
        <br>
        @foreach ($categories as $item)
            <select name="categories" >
                <option value="{{$item->id}}">
                    {{$item->name}}
                </option>
            </select>
        @endforeach

    </form>
</body>
</html>
