<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edita tu Categoria</title>
</head>
<body>
    <h1>Edita tu Categoria</h1>
    <form action="{{route('categories.update', $category->id)}}" method="post">
        @csrf
        @method('PATCH')
        <input name="name" type="text" required value="{{$category->name}}">
        <button type="submit">Ok</button>
    </form>
    <a href="{{route('categories.index')}}">Volver</a>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
    @endif
</body>
</html>
