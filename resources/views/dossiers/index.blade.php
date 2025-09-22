<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('dossiers.create')}}">Ajouter un dossier</a>
    <h1>LISTE DES DOSSIERS</h1>
    <table>
        <tr>
            <th>Libelle</th>
            <th>Description</th>
        </tr>
        @foreach ($dossiers as $dossier )
        <tr>
            <th>{{ $dossier->libelle }}</th>
            <th>{{ $dossier->description }}</th>
        </tr>
        @endforeach
    </table>
</body>
</html>
