<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <title>Tables | PlainAdmin Demo</title>
    <meta name="csrf-token" content=" {{csrf_token()}}">
    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{asset('assets/css_admin/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css_admin/lineicons.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css_admin/materialdesignicons.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css_admin/fullcalendar.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css_admin/main.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/fontawesome-free/css/all.css')}}" rel="stylesheet"/>
  </head>
  <body>
    <!-- ======== Preloader =========== -->
    <div id="preloader">
      <div class="spinner"></div>
    </div>
    <!-- ======== Preloader =========== -->

    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">

      <!-- ========== table components start ========== -->

      <div style="display: flex;align-items: center;justify-content: center;flex-direction: row;flex-wrap: wrap;">
       <div class="card align-items-center" style="width: 60%">
         <div class="row align-items-center"style="justify-content: center;">
          <img src="{{asset('assets/img/logo_ministere.svg')}}" alt="" style="width: 60%"/>


          <div >
          <form class="row g-3 needs-validation" action="{{route('account_insertion') }}" style="padding: 5px 10px 15px 10px; " enctype="multipart/form-data" method="POST"  novalidate>
            @csrf
            <div class="col-md-3">
              <label for="nome" class="form-label">Nom</label>
              <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{$account->nome ?? old('nome') }}" required>
              @error('nome')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          </div>
      
          <div class="col-md-3">
              <label for="prenom" class="form-label">Prénom</label>
              <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" value="{{$account->prenom ??  old('prenom') }}" required>
              @error('prenom')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          </div>
      
          <div class="col-md-6">
              <label for="validationCustomUsername" class="form-label">Email Local</label>
              <div class="input-group has-validation">
                @php
                $emailParts = explode('@', optional($account)->email ?? old('email'));
                @endphp
                  <input type="text" class="form-control @error('email') is-invalid @enderror" id="validationCustomUsername" name="email" value="{{$emailParts[0] ?? old('email') }}" required>
                  <span class="input-group-text" id="email">@mcomm.local</span>
                  @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>
      
          <div class="col-md-4">
              <label for="sous_direction" class="form-label">Organe</label>
              <select class="form-select @error('sous_direction') is-invalid @enderror" id="sous_direction" name="sous_direction" required>
                  <option selected {{ is_null($account) ? 'disabled' :''}} value="">Choisir...</option>
                  <option value="Minister"  {{ !is_null($account) ?? $account->post_occupe == 'Minister' ? 'selected':''}}>Ministère</option>
                  <option value="DEV" {{!is_null($account) ?? $account->sous_direction == 'DEV' ? 'selected':''}}>Direction du Développement et de l'Investissement</option>
                  <option value="FORMATION" {{ !is_null($account) ?? $account->sous_direction == 'formation' ? 'selected':''}}>Direction de la Coopération et de la Formation</option>

                  <option value="Administration" {{!is_null($account) ?? $account->sous_direction == 'Administration' ? 'selected':''}}>Direction de l'Administration et des Moyens</option>
                  <option value="Communication" {{ !is_null($account) ?? $account->sous_direction == 'Communication ' ? 'selected':''}}>Direction de la Communication Institutionnelle</option>
                 
                  <option value="Affaires" {{!is_null($account) ?? $account->sous_direction == 'Affaires' ? 'selected':''}}>Direction des Affaires Juridiques, de la Documentation et des Archives</option>
                  <option value="MEDIA" {{ !is_null($account) ?? $account->sous_direction == 'MEDIA' ? 'selected':''}}>Direction des Médias</option>

                  <option value="coordination" {{ !is_null($account) ?? $account->sous_direction == ' coordination' ? 'selected':''}}>Sous-direction de la coordination des Actions de Communication</option>

                  <option value=" budget" {{!is_null($account) ?? $account->sous_direction == ' budget' ? 'selected':''}}> Sous-direction du budget, de la comptabilité et des marchés publics</option>
                  
                  <option value=" moyens" {{!is_null($account) ?? $account->sous_direction == 'moyens' ? 'selected':''}}>Sous-direction des moyens généraux</option>


               
              </select>
              @error('sous_direction')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          </div>
      
          <div class="col-md-4">
              <label for="post_occupe" class="form-label">Position</label>
              <select class="form-select @error('post_occupe') is-invalid @enderror" id="post_occupe" name="post_occupe" required>
                  <option selected {{ is_null($account) ? 'disabled' :''}} value="">Choisir...</option>
                  <option value="Ministre"  {{ !is_null($account) ?? $account->post_occupe == 'Ministre' ? 'selected':''}}>Ministre</option>
                  <option value="DIR"  {{ !is_null($account) ?? $account->post_occupe == 'DIR' ? 'selected':''}}>Directeur</option>
                  <option value="SOUS_DIR"  {{ !is_null($account) ?? $account->post_occupe == 'SOUS_DIR' ? 'selected':''}}>Sous Directeur</option>
              </select>
              @error('post_occupe')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          </div>
      
          <div class="col-md-3">
              <label for="privilege" class="form-label">Privilège</label>
              <select class="form-select @error('privilege') is-invalid @enderror" id="privilege" name="privilege" required>
                  <option selected {{ is_null($account) ? 'disabled' :''}} value="">Choisir...</option>
                  <option value="0" {{ !is_null($account) ?? $account->privilege == 2 ? 'selected':''}}>Administrateur</option>
                  <option value="2" {{ !is_null($account) ?? $account->privilege == 2 ? 'selected':''}}>Insertion</option>
                  <option value="1" {{ !is_null($account) ?? $account->privilege == 1 ? 'selected':''}}>Modification</option>
              </select>
              @error('privilege')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          </div>
          {{-- cote progs  --}}
          <div class="col-md-4">
            <label for="progs" class="form-label">Programmes</label>
            <select class="form-select @error('progs') is-invalid @enderror" id="progs" name="progs" >
                <option selected {{ is_null($account) ? 'disabled' :''}} value="">Choisir...</option>
                @foreach ($prog as $progs)
                <option value="{{$progs['num_prog']}}"  {{ !is_null($account) ?? $account->num_prog == $progs['num_prog'] ? 'selected':''}}>{{$progs['num_prog']}} {{$progs['nom_prog']}}</option>
                @endforeach
                
            </select>
            @error('progs')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4">
          <label for="sous_progs" class="form-label">Sous Programmes</label>
          <select class="form-select @error('sous_progs') is-invalid @enderror" id="sous_progs" name="sous_progs">
              <option selected {{ is_null($account) ? 'disabled' :''}} value="">Choisir...</option>
              @foreach ($sprog as $sprogs)
              <option value="{{$sprogs['num_sous_prog']}}" {{!is_null($account) ?? $account->num_sous_prog == $sprogs['num_sous_prog'] ? 'selected':''}}>{{$sprogs['num_sous_prog']}} {{$sprogs['nom_sous_prog']}}</option>
              @endforeach
          </select>
          @error('sous_progs')
              <div class="invalid-feedback">{{ $message }}</div>
          @enderror
      </div>

      <div class="col-md-4">
        <label for="acts" class="form-label">Actions </label>
        <select class="form-select @error('acts') is-invalid @enderror" id="acts" name="acts" >
            <option selected {{ is_null($account) ? 'disabled' :''}} value="">Choisir...</option>
            @foreach ($act as $acts)
            <option value="{{$acts['num_action']}}" {{ !is_null($account) ?? $account->num_action == $acts['num_action'] ? 'selected':''}}>{{$acts['num_action']}} {{$acts['nom_action']}}</option>
            @endforeach
        </select>
        @error('acts')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
      
     {{-- cote progs  --}}
          <div class="col-md-6">
              <label for="code_generated" class="form-label">Le Code</label>
              <input type="text" class="form-control @error('code_generated') is-invalid @enderror" id="code_generated" name="code_generated" value="{{ old('code_generated') }}" required>
              @error('code_generated')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          </div>
          <div class="col-md-6">
            <input type="checkbox" class="@error('code_generated') is-invalid @enderror" id="select-deleg" name="select-deleg" >
            @error('code_generated')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="code_generated" class="form-label">Delegué </label>
            <div class="col-md-6" id="deleg-handle">

            </div>
        </div>
      
          <div class="col-12">
              <div class="form-check">
                  <input class="form-control @error('profile_picture') is-invalid @enderror" type="file" id="profile_picture" name="profile_picture" required>
                  <label class="form-check-label" for="profile_picture">
                      Ajouter la Décision
                  </label>
                  @error('profile_picture')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>
            <div class="col-12">
              <button class="btn btn-primary" type="submit">Soumettre le formulaire</button>
            </div>
          </form>
          </div>


         </div>
        </div>
      </div>
      <section class="table-components">

        <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h2>Tables</h2>
                </div>
              </div>
              <!-- end col -->
              <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="#0">Tableau de bord</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">
                       <a href="/admin/"> Tables</a>
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->

          <!-- ========== tables-wrapper start ========== -->
          <div class="tables-wrapper">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-style mb-30">
                  <h6 class="mb-10"> Liste des Compts</h6>
                  @if(session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
                 @endif
                  <div class="table-wrapper table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>
                            <h6>Code</h6>
                          </th>
                          <th>
                            <h6>Nom complet</h6>
                          </th>
                          <th>
                            <h6>Email</h6>
                          </th>
                          <th>
                            <h6>Organe</h6>
                          </th>
                          <th>
                            <h6>Poste occupé</h6>
                          </th>
                          <th>
                            <h6>Privilège</h6>
                          </th>
                          <th>
                            <h6>Délégué</h6>
                          </th>
                          <th>
                            <h6>Résponsable</h6>
                          </th>
                          <th>
                            <h6>Décision</h6>
                          </th>
                          <th>
                            <h6>Action</h6>
                          </th>
                        </tr>
                        <!-- end table row-->
                      </thead>
                      <tbody>
                        @php
                        $i=1;    
                        //dd($full_account );
                        @endphp
                        @foreach($full_account as $accountloop)
                        <tr>
                          <td>
                            <div class="min-width">
                              <p>{{$i}}</p>
                            </div>
                          </td>
                          <td class="min-width">
                            <p>{{$accountloop->nome}} {{$accountloop->prenom}}</p>
                          </td>
                          <td class="min-width">
                            <p><a href="#0">{{$accountloop->email}}</a></p>
                          </td>
                          <td class="min-width">
                            <p>{{$accountloop->sous_direction}}</p>
                          </td>
                          <td class="min-width">
                            <p>{{$accountloop->post_occupe}}</p>
                          </td>

                          @if($accountloop->privilege == 2)
                          <td class="min-width">
                            <span class="status-btn {{ $accountloop->id_deleg_resp  ? 'close-btn':' active-btn'}}">Insertion</span>
                          </td>
                          @else
                            @if($accountloop->privilege == 1)
                            <td class="min-width">
                              <span class="status-btn {{ $accountloop->id_deleg_resp  ? 'close-btn':' active-btn'}}">Modification</span>
                            </td>
                            @else
                            <td class="min-width">
                              <span class="status-btn {{ $accountloop->id_deleg_resp  ? 'close-btn':' active-btn'}}">Administrateur</span>
                            </td>
                            @endif
                          @endif
                          <td class="min-width" id="deleg_of{{ $accountloop->id_deleg_resp}}">
                            <span class="status-btn">{{ $accountloop->id_deleg_resp  ? $accountloop->delege_prenom.' '.$accountloop->delege_nome :'R'}}</span>
                          </td>
                          <td>
                            <div class="min-width">
                              @if($accountloop->num_portefeuil)
                              <p class="status-btn success-btn" id="{{$accountloop->id}}">{{$accountloop->num_portefeuil}}</p>

                              @else
                               @if($accountloop->num_action)
                                <p class="status-btn success-btn" id="{{$accountloop->id}}">{{$accountloop->nom_action}}</p>
                               @else
                                @if($accountloop->num_prog)
                                 <p class="status-btn success-btn" id="{{$accountloop->id}}">{{$accountloop->nom_prog }}</p>
                                @else
                                <p class="status-btn close-btn" id="{{$accountloop->id}}">Annuller</p>
                                @endif
                              @endif
                            @endif
                            </div>
                          </td>
                          <td style="
                          text-align: center;
                      ">
                            <div class="min-width">
                              <a href="/live-pdf/{{$accountloop->id}}" target="_blank"><i class="fas fa-file-alt"></i></a>
                            </div>
                          </td>
                          <td>
                            <div class="action">
                              <a href="/admin?idedit={{$accountloop->id}}" class="text-warning">
                                <i class="fas fa-user-edit"></i>
                              </a>
                              <a href="/admin/delete/{{$accountloop->id}}" class="text-danger">
                                <i  class="lni lni-trash-can"></i>
                              </a>
                            </div>
                          </td>
                        </tr>
                        @php
                        $i++;
                        @endphp
                        @endforeach
                        <!-- end table row -->
                      </tbody>
                    </table>
                    <!-- end table -->
                  </div>
                </div>
                <!-- end card -->
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- ========== tables-wrapper end ========== -->
        </div>
        <!-- end container -->
      </section>
      <!-- ========== table components end ========== -->
    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('assets/js_admin/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js_admin/Chart.min.js')}}"></script>
    <script src="{{asset('assets/js_admin/dynamic-pie-chart.js')}}"></script>
    <script src="{{asset('assets/js_admin/moment.min.js')}}"></script>
    <script src="{{asset('assets/js_admin/fullcalendar.js')}}"></script>
    <script src="{{asset('assets/js_admin/jvectormap.min.js')}}"></script>
    <script src="{{asset('assets/js_admin/world-merc.js')}}"></script>
    <script src="{{asset('assets/js_admin/polyfill.js')}}"></script>
    <script src="{{asset('assets/js_admin/main.js')}}"></script>
    <script>
    $(document).ready(function(){

//  $('#Submit').on('click',function(){}) 
      var allaccount;
    $('#select-deleg').change(function(){
      console.log('i click')
      $('#deleg-handle').empty()
      if( $(this).is(":checked"))
      {
        $.ajax({
        url:'/get-accounts/',
        type:'GET',
        success:function(response)
        {
          allaccount=response.data
          var options='';
          allaccount.forEach(element => {
            console.log('click'+JSON.stringify(element))
            options+='<option value='+element.id+'>'+element.nome+' '+element.prenom+'</option>'
          });
      var html=' <select class="form-select" id="id_deleg_resp" name="id_deleg_resp">'+
                '<option disabled value="" selected>Choisir...</option>'+
                  options+
                '</select>';
                $('#deleg-handle').append(html)
        },
      })
     }
     else
     {
      $('#deleg-handle').empty()
     }
    })

})
    </script>
  </body>
</html>
