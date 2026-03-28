<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Añadir Categoria</title>
</head>
<body>
    <h2>Crea una categoria</h2>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <label>Nombre de la categoria</label>
        <br>
        <input type="text" name="name" required placeholder="Escribe el nombre de la categoria">
        <br>
        <br>
        <button type="submit">Enviar</button>
        <br>


    </form>
    <br>
    <a href="{{ route('transactions.create') }}">Volver</a>
    <br>
    <br>
    <a href="{{ route('categories.index') }}">Ir a Lista de Categorias</a>
</body>
</html>
