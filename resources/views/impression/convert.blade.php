<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convertir PDF en Word</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <script src="{{ asset('assets/js/docx.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
</head>
<body>
    <h1>Convertir le PDF en Word</h1>
    <button onclick="convertPdfToWord('{{ $numport }}')">Convertir en Word ({{ $numport }})</button>
    <div id="status"></div>

    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js';

        // Vérifications des bibliothèques
        console.log("pdfjsLib : ", typeof pdfjsLib);
        console.log("docx : ", typeof docx);
        console.log("saveAs : ", typeof saveAs);

        async function convertPdfToWord(numport) {
            const statusDiv = document.getElementById('status');
            statusDiv.textContent = "Chargement du PDF pour " + numport + "...";

            try {
                const url = "{{ route('print-dpa.lists', ['numport' => ':numport']) }}".replace(':numport', numport);
                console.log("URL appelée : ", url);

                const response = await fetch(url);
                if (!response.ok) {
                    const text = await response.text();
                    throw new Error(`Erreur HTTP ${response.status}: ${text.substring(0, 200)}...`);
                }

                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    const text = await response.text();
                    console.log("Réponse brute : ", text);
                    throw new Error(`Réponse inattendue (non JSON): ${text.substring(0, 200)}...`);
                }

                const data = await response.json();
                console.log("Données JSON : ", data);
                const pdfUrl = data.url;

                statusDiv.textContent = "Lecture du PDF...";
                const pdfResponse = await fetch(pdfUrl);
                if (!pdfResponse.ok) {
                    const text = await pdfResponse.text();
                    throw new Error(`Erreur lors du chargement du PDF (${pdfResponse.status}): ${text.substring(0, 200)}...`);
                }

                const arrayBuffer = await pdfResponse.arrayBuffer();
                const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;

                const doc = new docx.Document({
                    sections: []
                });

                statusDiv.textContent = "Conversion en cours...";
                for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                    const page = await pdf.getPage(pageNum);
                    const textContent = await page.getTextContent();
                    const pageText = textContent.items.map(item => item.str).join(" ");

                    doc.addSection({
                        properties: {
                            page: {
                                size: { width: 16838, height: 11906 },
                                orientation: docx.PageOrientation.LANDSCAPE
                            }
                        },
                        children: [
                            new docx.Paragraph({
                                text: pageText,
                                alignment: docx.AlignmentType.LEFT,
                            }),
                        ],
                    });
                }

                statusDiv.textContent = "Génération du fichier Word...";
                const blob = await docx.Packer.toBlob(doc);
                saveAs(blob, "impression_dpic_" + numport + ".docx");

                statusDiv.textContent = "Conversion terminée ! Le fichier Word pour " + numport + " a été téléchargé.";
            } catch (error) {
                statusDiv.textContent = "Erreur : " + error.message;
                console.error(error);
            }
        }
    </script>
</body>
</html>