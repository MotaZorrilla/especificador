<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report USUARIOS</title>
</head>
<body>
    <div >
        <h5 >
            {{ auth()->user()->firstname ?? 'Firstname' }} {{ auth()->user()->lastname ?? 'Lastname' }}
        </h5>
        <p >
            {{ auth()->user()->email ?? 'email' }}
        </p>
    </div>
    <div >
        <h5 >
            Para una masividad de: {{ $project->name }}
        </h5>
        <p>{{ $project->descripcion }}</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Pintura</th>
                <th>Modelo</th>
                <th>Certificado</th>
                <th>Numero</th>
                <th>15 m</th>
                <th>30 m</th>
                <th>60 m</th>
                <th>90 m</th>
        </thead>
        <tbody>
            @foreach($filedata as $filedatum)
                <tr>
                    <td>{{ $filedatum->pintura }}</td> 
                    <td>{{ $filedatum->modelo }}</td> 
                    <td>{{ $filedatum->certificado }}</td>
                    <td>{{ $filedatum->numero }}</td>
                    <td>{{ $filedatum->m15 }}</td>
                    <td>{{ $filedatum->m30 }}</td>
                    <td>{{ $filedatum->m60 }}</td>
                    <td>{{ $filedatum->m90 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>