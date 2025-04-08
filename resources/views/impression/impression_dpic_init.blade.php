<!DOCTYPE html>
<h<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impression_DPA</title>
  
</head>

<body>

    <div class="page-break">
        <h1 class="section-title"></h1>
        @include('impression.impressioninit2tab', ['programmes' => $programmes, 'Ttportglob' => $Ttportglob])
    </div>
   <div>
        <h1 class="section-title"></h1>
        @include('impression.programmes-DPIC', ['programmes' => $programmes, 'Ttportglob' => $Ttportglob])
    </div>
    
  
  

   

</body>
</html>