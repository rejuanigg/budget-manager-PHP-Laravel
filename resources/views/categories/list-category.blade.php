<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mis Categorias</title>
</head>
<body>
    <h1>Mis Categorias</h1>
    <table style="width: 50%" border="2px">
        <tr>
            <th>Nombre</th>
        </tr>
        @foreach ($misCategorias as $item)
            <tr>
                <td>{{$item->name}}</td>
            </tr>
        @endforeach
    </table>
    <br>
    <br>
    <a href=" {{route('categories.create')}} ">Volver</a>

</body>
</html>
