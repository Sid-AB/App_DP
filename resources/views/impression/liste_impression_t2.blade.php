<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>LES CREDITS DES DEPENSES DE FONCTIONNEMENT </title>
 
    <style>
    
    </style>
</head>
<body>
    
<h1>LES CREDITS DES DEPENSES DE FONCTIONNEMENT  : </h1>
table>
        <thead>
        
            <tr>
            <th>PROGRAMME  {{ $prog?? 'N/A'}}</th>
                <th>Code</th>
                <th>{{$portefeuille->Programme->num_prog ?? 'N/A'}} </th>
                <th>T2 DANS LE  DPIC</th>
            </tr>
        </thead>
        <tbody>
      
                @foreach ($resultstructur['T2']['groupedData'] as $groupData)
            
        @endforeach
    </tbody>
            
</body>
</html>
