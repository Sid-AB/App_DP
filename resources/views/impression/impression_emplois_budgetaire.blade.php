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
        tbody td {
            padding: 13px 20px;
        }
        .mauve {
            font-weight: bold;
            background-color: #60497A; /* Couleur plus sombre pour les programmes principaux */
            color:white;
            
            /*width:36.4%;
            height:40px;*/
        }
        .page-break {
            page-break-after: always;
        }
        .table {
        table-layout: fixed; 
        width: 100%; 
        border-collapse: collapse;
        text-align: center;
        font-family: Arial, sans-serif;
    }

    .table th, .table td {
       
        height: 50px;   
        border: 1px solid #000;
        padding: 8px;
        vertical-align: middle;
    }
    .large-col {
            width: 25%;
        }
    .larg{
        width:10%;
    }

    </style>
</head>
<body>

<h2 style=" font-family: Cambria (Titres), sans-serif; font-size: 14pt; font-weight: bold;">2. LA PROGRAMMATION DES EMPLOIS BUDGÉTAIRES :</h2>
<h3 style="font-family: Cambria (Titres), sans-serif; font-size: 14pt; font-weight: bold;">2.1. POUR LES SERVICES CENTRAUX :</h3>

<table  class="table" >
    <tr class="mauve">
        <th rowspan="1" class="large-col">ADMINISTRATION CENTRALE</th>
        <th colspan="3">EMPLOIS BUDGÉTAIRES</th>
        <th colspan="5" >RÉMUNÉRATION</th>
    </tr>
    <tbody>
        <tr >
            <td class="header-row large-col">Catégorie du personnel</td>
            <td class="header-row ">Ouverts (<?php echo date("Y"); ?>)</td>
            <td class="header-row ">Occupés au 31 décembre (<?php echo (date("Y") - 1); ?>)</td>
            <td class="header-row ">Vacants ou excédent</td>
            <td colspan="2" class="header-row larg">CLASSIFICATION</td>
            <td rowspan="2" class="header-row larg">TRAITEMENT ANNUEL</td>
            <td rowspan="2" class="header-row">PRIMES ET INDEMNITÉS</td>
            <td rowspan="2" class="header-row">DEPENSES ANNUELLES</td>
        </tr>
        <tr >
            <td class="mauve large-col">Fonction supérieure</td>
            <td class="highlight-gray">{{ $totalOuvertsfct }}</td>
            <td class="highlight-gray">{{ $totalOccupesfct }}</td>
            <td class="highlight-gray " >{{ $totalVacantsfct }}</td>
            <td class="highlight-gray larg">CATEGORIE</td>
            <td class="highlight-gray larg">MOYENNE</td>
        </tr>
        @foreach($fonctions as $fonction)
        <tr>
            <td class="large-col">{{ $fonction->Nom_fonction }}</td>
            <td>{{ $fonction->EmploiesOuverts }}</td>
            <td>{{ $fonction->EmploiesOccupes }}</td>
            <td>{{ $fonction->EmploiesVacants }}</td>
            <td class="larg">{{ $fonction->CATEGORIE }}</td>
            <td class="larg">{{ $fonction->Moyenne }}</td>
            <td class="larg">{{ $fonction->TRAITEMENT_ANNUEL }}</td>
            <td>{{ $fonction->PRIMES_INDEMNITES }}</td>
            <td>{{ $fonction->DEPENSES_ANNUELLES }}</td>
        </tr>
        @endforeach
    </tbody>
</table  >

<div class="page-break"></div>

<table  class="table">
    <tr>
        <th rowspan="2" class="mauve large-col">Poste supérieur</th>
        <th rowspan="2" class="highlight-gray">{{ $totalOuvertspost }}</th>
        <th rowspan="2" class="highlight-gray">{{ $totalOccupespost }}</th>
        <th rowspan="2" class="highlight-gray">{{ $totalVacantspost }}</th>
        <th rowspan="2" class="header-row larg ">BONIFICATION INDICIAIRE / NIVEAU</th>
        <th rowspan="2" class="header-row larg">BONIFICATION INDICIAIRE / POINTS</th>
        <th rowspan="2" class="header-row larg">BONIFICATION INDICIAIRE / MONTANT</th>
        <th rowspan="2" colspan="2" class="header-row">DEPENSES ANNUELLES</th>
    </tr>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td class="large-col">{{ $post->Nom_postsup }}</td>
            <td>{{ $post->EmploiesOuverts }}</td>
            <td>{{ $post->EmploiesOccupes }}</td>
            <td>{{ $post->EmploiesVacants }}</td>
            <td class="larg">{{ $post->Niveau_sup }}</td>
            <td class="larg">{{ $post->point_indsup }}</td>
            <td class="larg">{{ $post->TRAITEMENT_ANNUEL }}</td>
            <td>{{ $post->PRIMES_INDEMNITES }}</td>
            <td>{{ $post->DEPENSES_ANNUELLES }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="page-break"></div>

<table  class="table">
    <tr>
        <th rowspan="2" class="mauve large-col">Corps Communs</th>
        <th rowspan="2" class="highlight-gray">{{ $totalOuvertscomm }}</th>
        <th rowspan="2" class="highlight-gray">{{ $totalOccupescomm }}</th>
        <th rowspan="2" class="highlight-gray">{{ $totalVacantscomm }}</th>
        <th rowspan="2" class="header-row larg">CATEGORIE</th>
        <th rowspan="2" class="header-row larg">MOYENNE</th>
        <th rowspan="2" class="header-row larg">TRAITEMENT ANNUEL</th>
        <th rowspan="2" class="header-row">PRIMES ET INDEMNITÉS</th>
        <th rowspan="2" class="header-row">DEPENSES ANNUELLES</th>
    </tr>
    <tbody>
        @foreach($communs as $post)
        <tr>
            <td class="large-col">{{ $post->Nom_post }}</td>
            <td>{{ $post->EmploiesOuverts }}</td>
            <td>{{ $post->EmploiesOccupes }}</td>
            <td>{{ $post->EmploiesVacants }}</td>
            <td class="larg">{{ $post->CATEGORIE_post }}</td>
            <td class="larg">{{ $post->MOYENNE_post }}</td>
            <td class="larg">{{ $post->TRAITEMENT_ANNUEL }}</td>
            <td>{{ $post->PRIMES_INDEMNITES }}</td>
            <td>{{ $post->DEPENSES_ANNUELLES }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<table  class="table">
    <tr>
        <th rowspan="2" class="mauve large-col" >OP + APPARITEURS + CONDUCTEURS</th>
        <th rowspan="2" class="highlight-gray" >{{ $totalOuvertscomm }}</th>
        <th rowspan="2" class="highlight-gray">{{ $totalOccupescomm }}</th>
        <th rowspan="2" class="highlight-gray" >{{ $totalVacantscomm }}</th>
        <th rowspan="2" class="header-row larg">CATEGORIE</th>
        <th rowspan="2" class="header-row larg">MOYENNE</th>
        <th rowspan="2" class="header-row larg">TRAITEMENT ANNUEL</th>
        <th rowspan="2" class="header-row">PRIMES ET INDEMNITÉS</th>
        <th rowspan="2" class="header-row">DEPENSES ANNUELLES</th>
    </tr>
    <tbody>
        @foreach($op as $post)
        <tr>
            <td class="large-col">{{ $post->Nom_opconducteurs }}</td>
            <td>{{ $post->EmploiesOuverts }}</td>
            <td>{{ $post->EmploiesOccupes }}</td>
            <td>{{ $post->EmploiesVacants }}</td>
            <td class="larg">{{ $post->CATEGORIE_opconducteurs }}</td>
            <td class="larg">{{ $post->MOYENNE_opconducteurs }}</td>
            <td class="larg">{{ $post->TRAITEMENT_ANNUEL }}</td>
            <td>{{ $post->PRIMES_INDEMNITES }}</td>
            <td>{{ $post->DEPENSES_ANNUELLES }}</td>
        </tr>
        @endforeach
    </tbody>
</table >

<div class="page-break"></div>

<table  class="table">
    <tr>
        <th rowspan="2" class="mauve large-col">CDI</th>
        <th rowspan="2" class="highlight-gray">{{ $totalOuvertscomm }}</th>
        <th rowspan="2" class="highlight-gray">{{ $totalOccupescomm }}</th>
        <th rowspan="2" class="highlight-gray">{{ $totalVacantscomm }}</th>
        <th rowspan="2" class="header-row larg">CATEGORIE</th>
        <th rowspan="2" class="header-row larg">MOYENNE</th>
        <th rowspan="2" class="header-row larg">TRAITEMENT ANNUEL</th>
        <th rowspan="2" class="header-row">PRIMES ET INDEMNITÉS</th>
        <th rowspan="2" class="header-row">DEPENSES ANNUELLES</th>
    </tr>
    <tbody>
        @foreach($cdi as $post)
        <tr>
            <td class="large-col">{{ $post->Nom_c_d_i_s }}</td>
            <td>{{ $post->EmploiesOuverts }}</td>
            <td>{{ $post->EmploiesOccupes }}</td>
            <td>{{ $post->EmploiesVacants }}</td>
            <td class="larg">{{ $post->CATEGORIE_c_d_i_s }}</td>
            <td class="larg">{{ $post->MOYENNE_c_d_i_s }}</td>
            <td class="larg">{{ $post->TRAITEMENT_ANNUEL }}</td>
            <td>{{ $post->PRIMES_INDEMNITES }}</td>
            <td>{{ $post->DEPENSES_ANNUELLES }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<table  class="table">
    <tr>
        <th rowspan="2" class="mauve large-col">CDD</th>
        <th rowspan="2" class="highlight-gray">{{ $totalOuvertscomm }}</th>
        <th rowspan="2" class="highlight-gray">{{ $totalOccupescomm }}</th>
        <th rowspan="2" class="highlight-gray">{{ $totalVacantscomm }}</th>
        <th rowspan="2" class="header-row larg">CATEGORIE</th>
        <th rowspan="2" class="header-row larg">MOYENNE</th>
        <th rowspan="2" class="header-row larg">TRAITEMENT ANNUEL</th>
        <th rowspan="2" class="header-row">PRIMES ET INDEMNITÉS</th>
        <th rowspan="2" class="header-row">DEPENSES ANNUELLES</th>
    </tr>
    <tbody>
        @foreach($cdi as $post)
        <tr>
            <td class="large-col">{{ $post->Nom_c_d_i_s }}</td>
            <td>{{ $post->EmploiesOuverts }}</td>
            <td>{{ $post->EmploiesOccupes }}</td>
            <td>{{ $post->EmploiesVacants }}</td>
            <td class="larg">{{ $post->CATEGORIE_c_d_i_s }}</td>
            <td class="larg">{{ $post->MOYENNE_c_d_i_s }}</td>
            <td class="larg">{{ $post->TRAITEMENT_ANNUEL }}</td>
            <td>{{ $post->PRIMES_INDEMNITES }}</td>
            <td>{{ $post->DEPENSES_ANNUELLES }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>