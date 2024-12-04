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
<table>
        <thead>
        
            <tr>
            <th>PROGRAMME {{ $prog->nom_prog ?? 'N/A'}}</th>
                <th>Code</th>
                <th>{{$prog-> num_prog ?? 'N/A'}} </th>
                <th colspan="2">T2 DANS LE DPIC</th>
            </tr>
            <tr>
                <th>AE Sous-Operation</th>
                <th>CP Sous-Operation</th>
            </tr>
            
        </thead>
        <tbody>
      
                @foreach ($resultstructur['T2']['groupedData'] as $groupData)
            
                <tr class="group-row">
                <td class="code">{{$prog-> num_prog}}</td>
                
            </tr>
            

            
        @endforeach
    </tbody>
            
</body>
</html>
