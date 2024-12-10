<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impression_DPA</title>
   
</head>
<body>

    <div>
        <h1 class="section-title">1.1 LES CREDITS DES DEPENSES DE PERSONNEL:</h1>
        @include('impression.liste_impression', ['prog' => $prog, 'resultstructur' => $resultstructur, 'names' => $names])
    </div>

   
    <div>
        <h1 class="section-title">1.2 LES CREDITS DES DEPENSES DE FONCTIONNEMENT:</h1>
        @include('impression.liste_impression_t2', ['prog' => $prog, 'resultstructur' => $resultstructur, 'namesT2' => $namesT2])
    </div>

    <div>
        <h1 class="section-title">1.3 LISTE DES OPERATIONS D'INVESTISSEMENT PUBLIC:</h1>
        @include('impression.liste_impression_t3', ['resultstructur', 'sousProgramme', 'namesT3','portefeuille','prog' => $prog,'action','years'])
    </div>

 <div>
        <h1 class="section-title">1.4 LISTE DES DEPENSES DE TRANSFERTS:</h1>
        @include('impression.liste_impression_t4', ['prog' => $prog,'resultstructur', 'sousProgramme', 'namesT4','portefeuille','action'])
    </div>


</body>
</html>
