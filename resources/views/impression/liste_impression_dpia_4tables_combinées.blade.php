<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impression_DPA</title>
    <style>
        /* Ajout du style pour les sauts de page */
        .page-break {
            page-break-after: always;
        }

        .section-title {
            font-size: 1.5em;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="page-break" id="print_T1">
    
        <h1 class="section-title">1.1 LES CREDITS DES DEPENSES DE PERSONNEL:</h1>
        @include('impression.liste_impression', ['resultstructur' => $resultstructur, 'sousProgramme' => $sousProgramme, 'namesT3' => $namesT3, 'portefeuille' => $portefeuille, 'prog' => $prog, 'action' => $action, 'years' => $years])
    </div>
 
    <div class="page-break" id="print_T2">

        <h1 class="section-title">1.2 LES CREDITS DES DEPENSES DE FONCTIONNEMENT:</h1>
        @include('impression.liste_impression_t2',['resultstructur' => $resultstructur, 'sousProgramme' => $sousProgramme, 'namesT3' => $namesT3, 'portefeuille' => $portefeuille, 'prog' => $prog, 'action' => $action, 'years' => $years])
    </div>
  
    <div class="page-break" id="print_T3">
        <h1 class="section-title">1.3 LISTE DES OPERATIONS D'INVESTISSEMENT PUBLIC:</h1>
        @include('impression.liste_impression_t3', ['resultstructur' => $resultstructur, 'sousProgramme' => $sousProgramme, 'namesT3' => $namesT3, 'portefeuille' => $portefeuille, 'prog' => $prog, 'action' => $action, 'years' => $years])
    </div>
   
    <div class="page-break" id="print_T4">
        <h1 class="section-title">1.4 LISTE DES DEPENSES DE TRANSFERTS:</h1>
        @include('impression.liste_impression_t4',['resultstructur' => $resultstructur, 'sousProgramme' => $sousProgramme, 'namesT3' => $namesT3, 'portefeuille' => $portefeuille, 'prog' => $prog, 'action' => $action, 'years' => $years])
    </div>
   
   
    
    <script src="{{asset('assets/js/html-docx.min.js')}}"></script>
    <!--script>
    
            var content1 = document.getElementById("print_T1").innerHTML;
            var content2 = document.getElementById("print_T2").innerHTML;
            var content3 = document.getElementById("print_T3").innerHTML;
            var content4 = document.getElementById("print_T4").innerHTML;

            // Combine all parts
            var fullContent = `
                <html>
                    <head><meta charset='UTF-8'></head>
                    <body>
                        ${content1}
                        <hr>
                        ${content2}
                        <hr>
                        ${content3}
                        <hr>
                        ${content4}
                    </body>
                </html>`;

            // Convert HTML to Word format
            var converted = htmlDocx.asBlob(fullContent);
            var link = document.createElement("a");
            link.href = URL.createObjectURL(converted);
            link.download = "document.docx";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
    
    </script-->
</body>
</html>
