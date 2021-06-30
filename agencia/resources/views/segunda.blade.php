<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Segunda Vista</title>
</head>
<body>
    <h1>Segunda vista</h1>

    {{ date('d/m/Y') }}
    <br>

    @if ( $nombre == 'marcos' )
        bienvenido {{ $nombre }}
    @else
        usuario deconocido
    @endif

</body>
</html>
