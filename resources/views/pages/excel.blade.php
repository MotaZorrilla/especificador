<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte  Pinturas</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>email</th>
                <th>País</th>
        </thead>
        <tbody>
            @foreach($files as $file)
                <tr>
                    <td>{{ $file->id }}</td> 
                    <td>{{ $file->pintura }}</td> 
                    <td>{{ $file->modelo }}</td>
                    <td>{{ $file->certificado }}</td>
                    <td>{{ $file->masividad }}</td>
                    <td>{{ $file->n15 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>