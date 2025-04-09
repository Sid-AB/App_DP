<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impression_DPA</title>
    <style>
        @page { size: A4 landscape; }
    </style>
</head>
<body>
    <div id="content">
        <div class="page-break">
            <h1 class="section-title">Section 1</h1>
            @include('impression.impressioninit2tab', ['programmes' => $programmes, 'Ttportglob' => $Ttportglob])
        </div>
        <div>
            <h1 class="section-title">Section 2</h1>
            @include('impression.programmes-DPIC', ['programmes' => $programmes, 'Ttportglob' => $Ttportglob])
        </div>
    </div>

    <!-- Inclure les éléments interactifs uniquement pour le navigateur, pas pour le PDF -->
  
    <button onclick="generateWord()">Télécharger en Word (.docx)</button>

    <!-- Scripts pour le Word -->
    <script src="{{asset('assets/js/html-docx.min.js')}}"></script>

    <script>
        function generateWord() {
            const contentElement = document.getElementById('content');
            if (!contentElement) {
                alert("Erreur : contenu introuvable.");
                return;
            }
            const content = contentElement.innerHTML;

            const html = `
                <!DOCTYPE html>
                <html lang="fr">
                <head>
                    <meta charset="UTF-8">
                    <style>
                        @page { size: A4 landscape; }
                    </style>
                </head>
                <body>
                    ${content}
                </body>
                </html>
            `;

            const converted = htmlDocx.asBlob(html);
            saveAs(converted, 'impression_dpic.docx');
        }
    </script>
 
</body>
</html>