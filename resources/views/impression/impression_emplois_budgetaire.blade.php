<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau des emplois budgétaires</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            font-family: Arial, sans-serif;
            
          
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            
        
        }
       
        .header-row {
            background-color:#FABF8F; /* Orange clair pour l'en-tête intermédiaire */
            font-weight: bold;
           
        }
        .category-header {
            background-color: #B299D7; /* Violet clair pour les catégories */
            font-weight: bold;
        }
       
        .highlight-gray {
            background-color:#D9D9D9; /* Gris pour la cellule spécifique */
        }
       
        tbody td {
            padding: 13px 20px;
        }
        tbody tr:hover {
            background-color: #E5E5E5; /* Gris foncé pour le survol */
        }
        .mauve {
            font-weight: bold;
            background-color: #60497A; /* Couleur plus sombre pour les programmes principaux */
            color:white;
            width:3000px;
            height:40px;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

<h2 style=" font-family: Cambria (Titres), sans-serif; font-size: 14pt; font-weight: bold;">2. LA PROGRAMMATION DES EMPLOIS BUDGÉTAIRES :</h2>
<h3 style="font-family: Cambria (Titres), sans-serif; font-size: 14pt; font-weight: bold;">2.1. POUR LES SERVICES CENTRAUX :</h3>

<table>
    <tr class="mauve">
        <th rowspan="1">ADMINISTRATION CENTRALE</th>
        <th colspan="3">EMPLOIS BUDGÉTAIRES</th>
        <th colspan="5">RÉMUNÉRATION</th>
    </tr>
    <tbody>
        <tr class="header-row">
            <td class="header-row">Catégorie du personnel</td>
            <td class="header-row">Ouverts (<?php echo date("Y"); ?>)</td>
            <td class="header-row">Occupés au 31 décembre (<?php echo (date("Y") - 1); ?>)</td>
            <td class="header-row">Vacants ou excédent</td>
            <td colspan="2" class="header-row">CLASSIFICATION</td>
            <td rowspan="2" class="header-row">TRAITEMENT ANNUEL</td>
            <td rowspan="2" class="header-row">PRIMES ET INDEMNITÉS</td>
            <td rowspan="2" class="header-row">DEPENSES ANNUELLES</td>
        </tr>
        <tr >
            <td class="mauve">Fonction supérieure</td>
            <td class="highlight-gray">{{ $totalOuvertsfct }}</td>
            <td class="highlight-gray">{{ $totalOccupesfct }}</td>
            <td class="highlight-gray">{{ $totalVacantsfct }}</td>
            <td class="highlight-gray">CATEGORIE</td>
            <td class="highlight-gray">MOYENNE</td>
        </tr>
        @foreach($fonctions as $fonction)
        <tr>
            <td>{{ $fonction->Nom_fonction }}</td>
            <td>{{ $fonction->EmploiesOuverts }}</td>
            <td>{{ $fonction->EmploiesOccupes }}</td>
            <td>{{ $fonction->EmploiesVacants }}</td>
            <td>{{ $fonction->CATEGORIE }}</td>
            <td>{{ $fonction->Moyenne }}</td>
            <td>{{ $fonction->TRAITEMENT_ANNUEL }}</td>
            <td>{{ $fonction->PRIMES_INDEMNITES }}</td>
            <td>{{ $fonction->DEPENSES_ANNUELLES }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="page-break"></div>

<table>
    <tr>
        <th rowspan="2" class="mauve">Poste supérieur</th>
        <th rowspan="2" class="highlight-gray">{{ $totalOuvertspost }}</th>
        <th rowspan="2" class="highlight-gray">{{ $totalOccupespost }}</th>
        <th rowspan="2" class="highlight-gray">{{ $totalVacantspost }}</th>
        <th rowspan="2" class="header-row">BONIFICATION INDICIAIRE / NIVEAU</th>
        <th rowspan="2" class="header-row">BONIFICATION INDICIAIRE / POINTS</th>
        <th rowspan="2" class="header-row">BONIFICATION INDICIAIRE / MONTANT</th>
        <th rowspan="2" colspan="2" class="header-row">DEPENSES ANNUELLES</th>
    </tr>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{ $post->Nom_postsup }}</td>
            <td>{{ $post->EmploiesOuverts }}</td>
            <td>{{ $post->EmploiesOccupes }}</td>
            <td>{{ $post->EmploiesVacants }}</td>
            <td>{{ $post->Niveau_sup }}</td>
            <td>{{ $post->point_indsup }}</td>
            <td>{{ $post->TRAITEMENT_ANNUEL }}</td>
            <td>{{ $post->PRIMES_INDEMNITES }}</td>
            <td>{{ $post->DEPENSES_ANNUELLES }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="page-break"></div>

<table>
    <tr>
        <th rowspan="2" class="mauve">Corps Communs</th>
        <th rowspan="2" class="highlight-gray">{{ $totalOuvertscomm }}</th>
        <th rowspan="2" class="highlight-gray">{{ $totalOccupescomm }}</th>
        <th rowspan="2" class="highlight-gray">{{ $totalVacantscomm }}</th>
        <th rowspan="2" class="header-row">CATEGORIE</th>
        <th rowspan="2" class="header-row">MOYENNE</th>
        <th rowspan="2" class="header-row">TRAITEMENT ANNUEL</th>
        <th rowspan="2" class="header-row">PRIMES ET INDEMNITÉS</th>
        <th rowspan="2" class="header-row">DEPENSES ANNUELLES</th>
    </tr>
    <tbody>
        @foreach($communs as $post)
        <tr>
            <td>{{ $post->Nom_post }}</td>
            <td>{{ $post->EmploiesOuverts }}</td>
            <td>{{ $post->EmploiesOccupes }}</td>
            <td>{{ $post->EmploiesVacants }}</td>
            <td>{{ $post->CATEGORIE_post }}</td>
            <td>{{ $post->MOYENNE_post }}</td>
            <td>{{ $post->TRAITEMENT_ANNUEL }}</td>
            <td>{{ $post->PRIMES_INDEMNITES }}</td>
            <td>{{ $post->DEPENSES_ANNUELLES }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<table>
    <tr>
        <th rowspan="2" class="mauve" style="width:15%;">OP + APPARITEURS + CONDUCTEURS</th>
        <th rowspan="2" class="highlight-gray">{{ $totalOuvertscomm }}</th>
        <th rowspan="2" class="highlight-gray">{{ $totalOccupescomm }}</th>
        <th rowspan="2" class="highlight-gray">{{ $totalVacantscomm }}</th>
        <th rowspan="2" class="header-row">CATEGORIE</th>
        <th rowspan="2" class="header-row">MOYENNE</th>
        <th rowspan="2" class="header-row">TRAITEMENT ANNUEL</th>
        <th rowspan="2" class="header-row">PRIMES ET INDEMNITÉS</th>
        <th rowspan="2" class="header-row">DEPENSES ANNUELLES</th>
    </tr>
    <tbody>
        @foreach($op as $post)
        <tr>
            <td>{{ $post->Nom_opconducteurs }}</td>
            <td>{{ $post->EmploiesOuverts }}</td>
            <td>{{ $post->EmploiesOccupes }}</td>
            <td>{{ $post->EmploiesVacants }}</td>
            <td>{{ $post->CATEGORIE_opconducteurs }}</td>
            <td>{{ $post->MOYENNE_opconducteurs }}</td>
            <td>{{ $post->TRAITEMENT_ANNUEL }}</td>
            <td>{{ $post->PRIMES_INDEMNITES }}</td>
            <td>{{ $post->DEPENSES_ANNUELLES }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="page-break"></div>

<table>
    <tr>
        <th rowspan="2" class="mauve">CDI</th>
        <th rowspan="2" class="highlight-gray">{{ $totalOuvertscomm }}</th>
        <th rowspan="2" class="highlight-gray">{{ $totalOccupescomm }}</th>
        <th rowspan="2" class="highlight-gray">{{ $totalVacantscomm }}</th>
        <th rowspan="2" class="header-row">CATEGORIE</th>
        <th rowspan="2" class="header-row">MOYENNE</th>
        <th rowspan="2" class="header-row">TRAITEMENT ANNUEL</th>
        <th rowspan="2" class="header-row">PRIMES ET INDEMNITÉS</th>
        <th rowspan="2" class="header-row">DEPENSES ANNUELLES</th>
    </tr>
    <tbody>
        @foreach($cdi as $post)
        <tr>
            <td>{{ $post->Nom_c_d_i_s }}</td>
            <td>{{ $post->EmploiesOuverts }}</td>
            <td>{{ $post->EmploiesOccupes }}</td>
            <td>{{ $post->EmploiesVacants }}</td>
            <td>{{ $post->CATEGORIE_c_d_i_s }}</td>
            <td>{{ $post->MOYENNE_c_d_i_s }}</td>
            <td>{{ $post->TRAITEMENT_ANNUEL }}</td>
            <td>{{ $post->PRIMES_INDEMNITES }}</td>
            <td>{{ $post->DEPENSES_ANNUELLES }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<table>
    <tr>
        <th rowspan="2" class="mauve">CDD</th>
        <th rowspan="2" class="highlight-gray">{{ $totalOuvertscomm }}</th>
        <th rowspan="2" class="highlight-gray">{{ $totalOccupescomm }}</th>
        <th rowspan="2" class="highlight-gray">{{ $totalVacantscomm }}</th>
        <th rowspan="2" class="header-row">CATEGORIE</th>
        <th rowspan="2" class="header-row">MOYENNE</th>
        <th rowspan="2" class="header-row">TRAITEMENT ANNUEL</th>
        <th rowspan="2" class="header-row">PRIMES ET INDEMNITÉS</th>
        <th rowspan="2" class="header-row">DEPENSES ANNUELLES</th>
    </tr>
    <tbody>
        @foreach($cdi as $post)
        <tr>
            <td>{{ $post->	Nom_c_d_i_s }}</td>
            <td>{{ $post->EmploiesOuverts }}</td>
            <td>{{ $post->EmploiesOccupes }}</td>
            <td>{{ $post->EmploiesVacants }}</td>
            <td>{{ $post->CATEGORIE_c_d_i_s }}</td>
            <td>{{ $post->MOYENNE_c_d_i_s }}</td>
            <td>{{ $post->TRAITEMENT_ANNUEL }}</td>
            <td>{{ $post->PRIMES_INDEMNITES }}</td>
            <td>{{ $post->DEPENSES_ANNUELLES }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>