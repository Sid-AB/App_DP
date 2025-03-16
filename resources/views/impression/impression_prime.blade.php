<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau Primes et Indemnités</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 12px;
            text-align: justify;;
            font-size: 14px;
        }
        th {
            background-color: #4c3278;
            color: #ffffff;
            font-weight: bold;
        }
        td {
            background-color: #fafafa;
            color: #000;
        }
        .title {
            background-color: #4c3278;
            color: white;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            padding: 12px;
            border: 1px solid #000;
        }
        .header-secondary {
            background-color: #4c3278;
            color: white;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            padding: 12px;
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
        }
        .sub-header {
            background-color: #ffffff;
            color: #000;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            padding: 12px;}
    </style>
</head>
<body>

<!-- Titre principal -->
<div class="title"> REGIMES INDEMNITAIRES APPLICABLES :</div>


<!-- Titre secondaire -->
<table>
    <thead>
        <tr>
            <th  class="header-secondary">ADMINISTRATION CENTRALE</th>
            <th colspan="2" class="header-secondary">PRIMES ET INDEMNITÉS</th>
        </tr>
        <tr>
            
            <th>(SERVICES CENTRAUX)</th>
            <th class="sub-header">AE</th>
            <th class="sub-header">CP</th>
        </tr>
    </thead>
    <tbody>
        
            @foreach ($primes as $prime)
                <tr>
                    <td>{{ $prime->nom }}</td>
                    <td>{{ number_format($prime->aep, 0, ',', ' ') }}</td>
                    <td>{{ number_format($prime->cpp, 0, ',', ' ') }}</td>
                </tr>
            @endforeach
        
    </tbody>
</table>

</body>
</html>

