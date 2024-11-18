<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content=" {{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation Portfail</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
     <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
<link href="{{asset('assets/css/main.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/steps.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/bootstrap-5.0.2/css/bootstrap.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/fontawesome-free/css/all.css')}}" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<link
        rel="stylesheet"
        href="https://unpkg.com/@patternfly/patternfly/patternfly.css"
        crossorigin="anonymous"
      >
</head>
<body>
@include('side_bar.side-barV1')
<div>
 {{-- @include('progress_step.program_steps') --}}
</div>
<div class="font-bk back-bk">
  <div class="wallet-path" style="display:none;">
    <div class="the-path">
      <div class="pinfo-handle">
      <i class="fas fa-wallet"></i>
      <p >code :</p>
      <p id="w_id"> </p>
      </div>
      <div class="next-handle">
      <i class="fas fa-angle-double-right complet-icon"></i>
      </div>
    </div>
  </div>
    <div class="wallet-handle">
    <div class="card">
            <div class="card-body"  id="creati-prog">
                <h5 class="card-title">
                    <i class="fas fa-file-alt"></i> Upload your document
                </h5>
                <form id="pdf-upload-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="num_port">Code du portefeuille</label>
                        <input type="text" class="form-control" id="num_portefeuil" placeholder="Code du portefeuille">

                    </div>
                    <div class="form-group">
                        <label for="date_crt_portf">Date de sortie du portefeuille</label>
                        <input type="date" class="form-control" id="date_crt_portf" placeholder="Date de sortie">
                    </div>
                    <div class="form-group">
                        <label for="nom_journ">Nom du Journal</label>
                        <input type="text" class="form-control" id="nom_journ" placeholder="Entrer le nom du journal">
                    </div>
                    <div class="form-group">
                        <label for="num_journ">Numéro de l'édition</label>
                        <input type="text" class="form-control" id="num_journ" placeholder="Entrer le numéro de l'édition">
                    </div>
                    <div class="form-group">
                        <label for="AE_portef">AE</label>
                        <input type="text" class="form-control" id="AE_portef" placeholder="AE">
                    </div>
                    <div class="form-group">
                        <label for="CP_portef">CP</label>
                        <input type="number" class="form-control" id="CP_portef" placeholder="CP">
                    </div>
                    <div class="form-group">
                        <label for="inputFile">Journal scanner</label>
                        <label for="pdf_file">Choisissez un fichier PDF :</label>
                        <input type="file" name="pdf_file" id="pdf_file" accept="application/pdf" required>

                    </div>

                </form>
                <div id="message"></div>

              <button type="submit" class="btn btn-primary" id="add-wallet">
                    <i class="fas fa-plus"></i> Add
                </button>


            </div>
        </div>
    </div>
    <div id="progam-handle" style="display:none;">
    <div class="form-container" id="creati-prog">
      <form >
        <div class="form-group">
          <label for="input1">Code_Programme</label>
          <input type="text" class="form-control" id="num_prog" placeholder="Donnee Code Programme">
        </div>
        <div class="form-group">
          <label for="input1">Programme</label>
          <input type="text" class="form-control" id="nom_prog" placeholder="Donnee Nom Programme">
        </div>
        <div class="form-group">
          <label for="input2">Date insertion :</label>
          <input type="date" class="form-control" id="date_insert_portef">
        </div>
        <div class="form-group">
          <label for="inputDate">AE</label>
          <input type="number" class="form-control" id="AE_prog">
        </div>
        <div class="form-group">
          <label for="inputDate">CP</label>
          <input type="number" class="form-control" id="CP_prog">
        </div>
        </form>

        <br>
        <div id="confirm-holder">
        <button class="btn btn-primary" id="add-prg">Ajouter</button>
        <hr>
        <div class="file-handle">
        <input type="file" class="form-control" id="file">
        <button class="btn btn-primary">Journal</button>
        </div>
        </div>

    </div>
    </div>
    <div id="sous_prog-handle">

    </div>
    <div id="act-handle">

    </div>
    <div id="gr_list_handle">
     <div id="T_List-handle">

        <div id="T1-handle">

        </div>
        <div id="T2-handle">

        </div>
        <div id="T3-handle">

        </div>
        <div id="T4-handle">

        </div>
    </div>
    <div id="table-T">
    </div>
    </div>
</div>
<script>
  var jsonpath="{{asset('assets/Titre/dataT1.json')}}"
  var path=new Array();
  var path3=new Array();
</script>
<script src="{{asset('assets/bootstrap-5.0.2/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/fontawesome-free/js/all.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>

<script>
    document.getElementById('pdf-upload-form').addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData();
        var pdfFile = document.getElementById('pdf_file').files[0];
        var relatedId = document.getElementById('num_portefeuil').value;

        formData.append('pdf_file', pdfFile);
        formData.append('related_id', relatedId);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]')?.content);
        console.log(document.querySelector('meta[name="csrf-token"]')?.content);




        fetch( route"{{('creation.portfail') }}", {

            method: 'POST',
            body: formData
        })

        .then(response => response.json())
        .then(data => {
            document.getElementById('message').textContent = data.message;
        })
        .catch(error => {
            document.getElementById('message').textContent = data.message;
        });
    })

</script>


<script>
    $("#add-wallet").on("click", function () {
      var num_wallet = $("#num_port").val();
      var dateprort = $("#date_crt_portf").val();
      var year = new Date(dateprort).getFullYear(); // Extraire l'année à partir de la date
      var numwall_year = num_wallet + year;
      var indice = 0;
      var isEmpty = false;
      var formId = $(this).parents(".card-body").attr("id");
      console.log("and form id" + formId);
      $("#" + formId + " form")
          .find("input")
          .each(function () {
              console.log("before the loop");
              var inputValue = $(this).val();

              // Check if the input is not empty
              if (inputValue.trim() === "") {
                  isEmpty = true;
                  indice++;
              }

              if (isEmpty) {
                  if (indice < 2) {
                      alert("Please fill in all required fields.");
                  }
                  $(this).css(
                      "box-shadow",
                      "0 0 0 0.25rem rgb(255 0 0 / 47%)"
                  );
              }
          });
      // console.log('id'+num_wallet)
      var formportinsert = {
          num_portefeuil: numwall_year,
          Date_portefeuille: $("#date_crt_portf").val(),
          nom_journal: $("#nom_journ").val(),
          num_journal: parseInt($("#num_journ").val()),
          AE_portef: parseFloat($("#AE_portef").val()),
          CP_portef: parseFloat($("#CP_portef").val()),
          //year: year,
          _token: $('meta[name="csrf-token"]').attr("content"),
          _method: "POST",
      };

           // Ajouter le fichier s'il est sélectionné HOUDAA
       var fileInput = $("#inputFile")[0]; // Assurez-vous que l'input de fichier a l'ID `file`
       if (fileInput && fileInput.files.length > 0) {
           formportinsert.append("inputFile", fileInput.files[0]);
       }
      $.ajax({
          url: "/creation",
          type: "POST",
          data: formportinsert,
          success: function (response) {
              if (response.code == 200 || response.code == 404) {
                  alert(response.message);
                  path.push(numwall_year);
                  path3.push(num_wallet);

                  console.log("numwall_year path: " + JSON.stringify(path));

                  $(".font-bk").removeClass("back-bk");
                  $(".wallet-path").css("display", "flex");
                  $(".wallet-handle").empty();
                  $("#progam-handle").css("display", "block");
                  $("#progam-handle").removeClass("scale-out");
                  $("#progam-handle").addClass("scale-visible");
                  $("#w_id").text(num_wallet);
              } else {
                  alert(response.message);
              }
          },
          error: function () {
              alert("error");
          },
      });
  });
</script>

</body>
</html>
