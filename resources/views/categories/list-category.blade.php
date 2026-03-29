<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mis Categorias</title>
</head>
<body>
    @if (session('error'))
        <div style="background-color: rgb(254, 85, 85); padding: 10px; margin-bottom: 10px;">
            {{ session('error') }}
        </div>
    @endif
    <h1>Mis Categorias</h1>
    <table style="width: 50%" border="2px">
        <tr>
            <th>Nombre</th>
            <th>Opciones</th>
        </tr>
        @foreach ($misCategorias as $item)
            <tr>
                <td>{{$item->name}}</td>
                <td>
                    <form action="{{route('categories.destroy', $item->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar ❎</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <br>
    <br>
    <a href=" {{route('categories.create')}} ">Volver</a>
</body>
</html>
