<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content=" {{csrf_token()}}">
    <title>Portefeuille</title>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">

<link href="{{asset('assets/css/Tree.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/main.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/bootstrap-5.0.2/css/bootstrap.css')}}" rel="stylesheet"/>
<!--link href="{{--asset('assets/  ')--}}" rel="stylesheet"/-->
<link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<!-- Styles -->
</head>

<body>
@include('side_bar.side-barV1')
<!-- Container for Car Cards -->
<div>
 {{--@include('progress_step.progress_step')--}}
 <br>
 </div>
 @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('unsuccess'))
    <div class="alert alert-danger alert_func" style="
    text-align: center;
    width: 50%;
    left: 20%;
">
        {{ session('unsuccess') }}
    </div>
@endif
 <div class="container">
 <div class="container family-tree" id="{{$allport['id']}}">
    <div class="row justify-content-center">
      <div class="col-12 tree">
        <ul id="father0">
          <li>
          <div class="two_handel" style="display: flex;align-items: center;justify-content: center;" id="{{$allport['id']}}_file">
           <div class="modift_handler" id="{{$allport['id']}}_portf"><i class="far fa-edit"></i></div>
           <div class="delete_handler" id="port_{{$allport['id']}}"><i class="fas fa-trash-alt"></i></div>
           <div class="file_handler" id="{{$allport['id']}}"><i class="fas fa-file-pdf"></i></div>
           
          </div>
              <span class="member next" id="{{$allport['id']}}" style="display:inline-block;">

                <!--  -->
             
                <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-1">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Portefeuille</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">  Autorisations d’engagement :<p class="chiffre" >{{$allport['TotalAE']}}</p></h4>
                    <h4 class="card-subtitle text-body-secondary m-0"> Crédits de paiement :<p class="chiffre">{{$allport['TotalCP']}}</p></h4>
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-end">
                      <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-truck fs-4"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex align-items-center mt-3">
                      <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-right-short bsb-rotate-45"></i>
                      </span>
                      <div>
                        @foreach($allport['prgrammes'] as $portf)

                        <p class="fs-7 mb-0">Progamme : {{$portf['id_prog'] }}</p>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

                <!--  -->
            </span>
            <ul id="father1" style="display:none;">
            @foreach($allport['prgrammes'] as $portf)
              <li>
              <span class="next" id="{{$portf['id_prog']}}">
              <div class="edit-zone">
              <div class="two_handel" style="display: flex;align-items: center;justify-content: center;" id="{{$portf['id_prog']}}_file">
                <div class="modift_handler" id="{{$portf['id_prog']}}_prog"><i class="far fa-edit"></i></div>
                <div class="delete_handler" id="prog_{{$portf['id_prog']}}"><i class="fas fa-trash-alt"></i></div>
                <div class="file_handler" id="{{$portf['id_prog']}}"><i class="fas fa-file-pdf"></i></div>
              </div>
                
              @if($portf['TotalAE'] == $portf['init_AE'] && $portf['TotalCP'] ==  $portf['init_CP'])
              <div class="member">
                @else
                <div class="member alert_func">
              @endif
                <div class="col-12 col-sm-6" id="kids">  
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-1">
                <div class="row">
                  <div class="col-10">
                    <h5 class="card-title widget-card-title mb-3">{{$portf['data']['nom_prog']}}</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">
                      <p> Autorisations d’engagement:</p><p class="chiffre">{{$portf['init_AE']}}</p>
                    </h4>
                    <h4 class="card-subtitle text-body-secondary m-0">
                      <p> Crédits de paiement :</p><p class="chiffre">{{$portf['init_CP']}}</p>
                    </h4>
                  </div>
                  <div class="col-2">
                    <div class="d-flex justify-content-end">
                      <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-truck fs-4"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex align-items-center mt-3">
                      <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-right-short bsb-rotate-45"></i>
                      </span>
                      <div>
                      @if(count($portf['sous_program']) !=0) 
                      @foreach($portf['sous_program'] as $souportf)
                        @if(!empty($souportf['id_sous_prog']))
                        <p class="fs-7 mb-0">Sous_Progamme : {{$souportf['id_sous_prog'] }}</p>
                        @else
                        <p class="fs-7 mb-0">aucun Sous_Progamme</p>
                        @endif
                      @endforeach
                      @else
                      <p class="fs-7 mb-0">aucun Sous_Progamme</p>
                      @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
        </span>
              <ul id="father2" style="display:none">
                @foreach($portf['sous_program'] as $souportf)
                <li>
               
                <span class="next" id="{{$souportf['id_sous_prog']}}">
              
                <div class="edit-zone">
                <div class="two_handel" style="display: flex;align-items: center;justify-content: center;" id="{{$souportf['id_sous_prog']}}_file">
                  <div class="modift_handler" id="{{$souportf['id_sous_prog']}}_sprog"><i class="far fa-edit"></i></div> 
                  <div class="delete_handler" id="sousprog_{{$souportf['id_sous_prog']}}"><i class="fas fa-trash-alt"></i></div>
                  <div class="file_handler" id="{{$souportf['id_sous_prog']}}"><i class="fas fa-file-pdf"></i></div>
                </div>
                 
                @if($souportf['TotalAE'] == $souportf['init_AE'] && $souportf['TotalCP'] == $souportf['init_CP'])
                <div class="member" id="{{$souportf['id_sous_prog']}}">
                @else
                <div class="member alert_func" id="{{$souportf['id_sous_prog']}}">
                @endif
                <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-1">
                <div class="row">
                  <div class="col-10">
                    <h5 class="card-title widget-card-title mb-3">{{$souportf['data']['nom_sous_prog']}}</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">
                    <p> Autorisations d’engagement:<p class="chiffre">{{$souportf['init_AE']}}</p></p>
                    </h4>
                    <h4 class="card-subtitle text-body-secondary m-0">
                    <div>
                     <div> <p>Crédits de paiement:</p>
                      <p class="chiffre">{{$souportf['init_CP']}}</p></div>
                    </div> 
                    </h4>
                  </div>
                  <div class="col-2">
                    <div class="d-flex justify-content-end">
                      <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-truck fs-4"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex align-items-center mt-3">
                      <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-right-short bsb-rotate-45"></i>
                      </span>
                      <div>
                      @foreach($souportf['Action'] as $act)
                        <p class="fs-7 mb-0">Action : {{$act['num_act'] }}</p>
                      @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
            </div>
          </div>
        </span> 
                <ul id="father3" style="display:none">
                @foreach($souportf['Action'] as $act)
                  <li>
                  
                  @if(count($act['sous_action'])>0)
                  <div class="two_handel" style="display: flex;align-items: center;justify-content: center;" id="{{$act['num_act']}}_file">
                   <div class="modift_handler" id="act_{{$act['num_act']}}"><i class="far fa-edit"></i></div> 
                   <div class="delete_handler" id="act_{{$act['num_act']}}"><i class="fas fa-trash-alt"></i></div>
                   <div class="file_handler" id="{{$act['num_act']}}"><i class="fas fa-file-pdf"></i></div>
                </div>
                 
                  <span class="member next" id="act_{{$act['num_act']}}" style="display:inline-block">
                  @endif
                <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-1">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Action: {{$act['data']['nom_action'] }}</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">
                    <p>  Autorisations d’engagement :</p><p class="chiffre">{{$act['init_AE']}}</p>
                    </h4>
                    <h4 class="card-subtitle text-body-secondary m-0">
                    <p>  Crédits de paiement :</p><p class="chiffre">{{$act['init_CP']}}</p>
                    </h4>
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-end">
                      <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-truck fs-4"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex align-items-center mt-3">
                      <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-right-short bsb-rotate-45"></i>
                      </span>
                      <div style="display:flex;width: 23rem;">
               
                      @if(count($act['sous_action'])>0)
                      @foreach($act['sous_action'] as $sous_act)
    
                      @if(count($act['sous_action']) != 1)
                        <p class="fs-7 mb-0">Sous Action :{{$sous_act['num_act']}} </p>
                       
                       @else
                       @if($sous_act['type_act'] == 'centrale')
                       
                        
                       @foreach($sous_act['Tports']['centrale'] as $key=>$values)
                       

                       <div class="T-holder"> 
                        <p class="fs-7 mb-0"> {{$key}} </p>
                        <div class="TotalT-holder">
                          <p>AE : {{$values['total'][0]['values']['totalAE']}} </p>
                          <p>CP : {{$values['total'][0]['values']['totalCP']}} </p>
                        </div>
                        </div>
                      @endforeach
                      @else 
                      @foreach($sous_act['Tports']['delegation'] as $key=>$values)
                       

                       <div class="T-holder"> 
                        <p class="fs-7 mb-0"> {{$key}} </p>
                        <div class="TotalT-holder">
                          <p>AE : {{$values['total'][0]['values']['totalAE']}} </p>
                          <p>CP : {{$values['total'][0]['values']['totalCP']}} </p>
                        </div>
                        </div>
                      @endforeach
                      @endif
                       @endif 
                      @endforeach
                      @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </span>
            <ul id="father4" style="display:none;">
            @if(count($act['sous_action']) > 1 )
            @foreach($act['sous_action'] as $sous_act)
           
                  <li>
                <span class="member next" id="sact_{{$sous_act['num_act']}}" style="display:inline-block">
                <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-1">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Sous Action: {{$sous_act['num_act'] }}</h5>
                    <h4 class="card-subtitle text-body-secondary m-0"> Autorisations d’engagement : {{$sous_act['TotalAE']}}</h4>
                    <h4 class="card-subtitle text-body-secondary m-0"> Crédits de paiement :{{$sous_act['TotalCP']}}</h4>
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-end">
                      <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-truck fs-4"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex align-items-center mt-3">
                      <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-right-short bsb-rotate-45"></i>
                      </span>
                      <div class="Port-info-holder" style="display:flex;width: 23rem;">
                      @foreach($sous_act['Tports'] as $key=>$values)
                       <div class="T-holder"> 
                        <p class="fs-7 mb-0">{{$key}} </p>
                        <div class="TotalT-holder">
                          <p>AE : {{$values['total'][0]['values']['totalAE']}} </p>
                          <p>CP : {{$values['total'][0]['values']['totalCP']}} </p>
                        </div>
                        </div>
                      @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </span>     
         
              @endforeach
              @endif
              <li>
                  <span class="member next">
                  <button class="add-btn" id="{{$act['num_act'] }}_act">
                   <i class="fas fa-plus-circle icon-car" style='font-size:100px; color:#0dcaf0;'></i>
                  </button> 
                  </li>
            </ul>
                </li>
                  @endforeach
                  <li>
                  <span class="member next">
                  <button class="add-btn" id="{{$souportf['id_sous_prog']}}_sprog">
                   <i class="fas fa-plus-circle icon-car" style='font-size:100px; color:#0dcaf0;'></i>
                  </button> 
                  </li>
                </ul>
                @endforeach
                <li>
                <span class="member next">
                <button class="add-btn" id=" {{$portf['id_prog']}}_prog">
                   <i class="fas fa-plus-circle icon-car" style='font-size:100px; color:#0dcaf0;'></i>
                </button> 
                </li>
               </ul>
              </li>
            @endforeach
            <li>
                <span class="member next">
                <button class="add-btn" id="{{$allport['id']}}_all">
                   <i class="fas fa-plus-circle icon-car" style='font-size:100px; color:#0dcaf0;'></i>
                  </button> 
                </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
 </div>

 <div class="float-export">
    <div class="folder-box">
    <a href="/printDPA/{{$allport['id']}}" target="_blank">
    <i class="fas fa-print"></i>
    </a>
    </div>
</div>

<div class="modif-contiant">
</div>
<div class="modif-handler" style="display:none;">


<div class="back-flw"><i class="fas fa-arrow-left" ></i></div>
<div class="card-group">
  <div class="card mall5" id="wall_to_wall">
    <div>
      <div class="modif-icon-hndl">
      <i class="fas fa-wallet"></i> 
      <i class="fas fa-arrow-right" ></i>
      <i class="fas fa-wallet"></i>
      </div>
    </div>
    <div class="card-body" >
      <h5 class="card-title">Gestion des Opérations et Modifications sur ce Portefeuille</h5>
      <p class="card-text"> &nbsp;&nbsp;&nbsp;Ce formulaire permet de gérer l'ensemble des opérations sur ce portefeuille, incluant les reports de CP sur T3 (limités à 5 %)
        , les reports d'AE non engagée sur T3, les reports d'AE et de CP fonds de concours,
         les décrets d'avance, les virements, les transferts, ainsi que toute autre modification.</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Dernière Modification </small>
    </div>
  </div>
</div>
  <div>
    <p> Modfication : <p id="id_sprog_modif"></p></p>
    <!--form id="update_art_handler">
    <div class="Radio-ids">
        <div>
        <label for="Tports">Interieur</label>
         <input type="radio" class="form-check-input" id="intr" name="type_modif" value="inter" />
        </div>
        <div>
        <label for="Tports">Exterieur</label>
         <input type="radio" class="form-check-input" id="extr" name="type_modif" value="exter" />
        </div>
        </div>

        <div class="exter_type">
     
        </div>
        

        <hr>
        <div class="form-group">
          <label for="input1">Article</label>
          <select type="text" class="form-control" id="id" placeholder="Entrer le Nom du Programme">
           <option value="0" >Selectionner Article</option>
           @foreach ($art as $key=>$actelement )
           <option value="{{$actelement['id_art']}}" >{{$actelement['nom_art'].' / '.$actelement['code_art']}}</option>
           @endforeach
          </select>
</div>
  
        <div class="form-group">
         <div class="Radio-ids">
          <div>
          <label for="Tports">un seul modification</label>
          <input type="radio" class="form-check-input" id="single" name="multi_modif" value="single" />
          </div>
        <div>
         <label for="Tports">multiple modifications</label>
         <input type="radio" class="form-check-input" id="multi" name="multi_modif" value="muti" />
        </div>
        </div>
        </div>
  <div id="modif-dif"></div>
</form-->

<!--  the old modif -->
  <div>
    <form id="update_art_handler">
    
      <div class="Radio-ids">
        <div>
        <label for="Tports">Interieur</label>
         <input type="radio" class="form-check-input" id="intr" name="type_modif" value="inter"   />
        </div>
        <!--div>
        <label for="Tports">Exterieur</label>
         <input type="radio" class="form-check-input" id="extr" name="type_modif" value="exter" />
        </div-->
        <label for="Tports">Exterieur (Portefeuille vers Portefeuille)</label>
        <input type="radio" class="form-check-input" id="extr_port" name="type_modif" value="exter_port" />
       </div>
        </div>

        <div class="exter_type">
     
        </div>
        

        <hr>

        <div class="form-group">
          <label for="input1">L'Opération effectuée</label>
          <select type="text" class="form-control" id="id" placeholder="Entrer le Nom du Programme">
           <option value="0" >Séléctionner une opération  </option>
           @foreach ($art as $key=>$actelement )
           <option value="{{$actelement['id_art']}}" >{{$actelement['nom_art'].' / '.$actelement['code_art']}}</option>
           @endforeach
          </select>
</div>
  


        <div class="form-group">
          <label id="dif" for="input1">Sous Programmes</label>
          <select type="text" class="form-control" id="id_env" placeholder="Entrer le Nom du Programme">
           <option value="0" >Séléctionner le Sous Programme</option>
           @foreach($allsous_progr as $souportf)
           @foreach($souportf as $sp)
           <option value="{{$sp['id_sous_prog']}}" >{{$sp['data']['nom_sous_prog']}}</option>
           @endforeach
           @endforeach
          </select>
          <div id="prog_env"></div>
        </div>
  
        <div class="form-group">
        <fieldset>
        <legend>Choisir Les Ports </legend>
        <div class="Tchecks">
        <div class="Tfields" >
        <label for="Tports">T1</label>
         <input type="checkbox" class="form-check-input" id="T1" name="interest" value="T1" />
         <div id="T1-inpt-handle" style="display:none;">
         <label for="Tports">AE</label>
         <input type="number" class="form-control" id="AE_T1" name="interest" />
         <label for="number">CP</label>
         <input type="number" class="form-control" id="CP_T1" name="interest" />
         </div>
         </div>
          
         <div class="hr-vert"></div>


        <div class="Tfields" >
        <label for="Tports">T2</label>
         <input type="checkbox" class="form-check-input" id="T2" name="interest" value="T2" />
         <div id="T2-inpt-handle" style="display:none;">
         <label for="Tports">AE</label>
         <input type="number" class="form-control" id="AE_T2" name="interest" />
         <label for="number">CP</label>
         <input type="number" class="form-control" id="CP_T2" name="interest" />
         </div>
         </div>
         
         <div class="hr-vert"></div>

         <div class="Tfields" >
        <label for="Tports">T3</label>
         <input type="checkbox" class="form-check-input" id="T3" name="interest" value="T3" />
         <div id="T3-inpt-handle" style="display:none;">
         <label for="Tports">AE</label>
         <input type="number" class="form-control" id="AE_T3" name="interest" />
         <label for="number">CP</label>
         <input type="number" class="form-control" id="CP_T3" name="interest" />
         </div>
         </div>
         
         <div class="hr-vert"></div>

         <div class="Tfields" >
        <label for="Tports">T4</label>
         <input type="checkbox" class="form-check-input" id="T4" name="interest" value="T4" />
         <div id="T4-inpt-handle" style="display:none;">
         <label for="Tports">AE</label>
         <input type="number" class="form-control" id="AE_T4" name="interest" />
         <label for="number">CP</label>
         <input type="number" class="form-control" id="CP_T4" name="interest" />
         </div>
         </div>
         </div>
        </fieldset>
        </div>
        <hr>

        <div class="add-envoi">

        </div>

        <!--div class="form-group">
        <label for="input1">Action a modifier</label>
          <select type="text" class="form-control" id="id_cible" placeholder="Entrer le Nom du Programme">
           <option value="0" >Selectionner Article</option>
          </select>
        </div-->
      </div>
    </form>
    <button class="button-70" id="button-71" role="button" >Envoyer</button>
  </div>
  </div>
 </div>


<div class="confirm-justfie">
 
</div>
<div class="reload-handle reload-hidden" id="reloading">
  <div class="reload"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><radialGradient id="a12" cx=".66" fx=".66" cy=".3125" fy=".3125" gradientTransform="scale(1.5)"><stop offset="0" stop-color="#C6BC0A"></stop><stop offset=".3" stop-color="#C6BC0A" stop-opacity=".9"></stop><stop offset=".6" stop-color="#C6BC0A" stop-opacity=".6"></stop><stop offset=".8" stop-color="#C6BC0A" stop-opacity=".3"></stop><stop offset="1" stop-color="#C6BC0A" stop-opacity="0"></stop></radialGradient><circle transform-origin="center" fill="none" stroke="url(#a12)" stroke-width="29" stroke-linecap="round" stroke-dasharray="200 1000" stroke-dashoffset="0" cx="100" cy="100" r="70"><animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2" values="360;0" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform></circle><circle transform-origin="center" fill="none" opacity=".2" stroke="#C6BC0A" stroke-width="29" stroke-linecap="round" cx="100" cy="100" r="70"></circle></svg>
  </div>
</div>
<div class="form_holder_modif"></div>
<div class="hide-access-form"></div>
</body>
<script src="{{asset('assets/bootstrap-5.0.2/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/fontawesome-free/js/all.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/js/treeHandles.js')}}"></script>
<script>
  
  var path=Array();
  var path3=Array();
  var chekl='<div class="form-popup-access" id="myForm">'+
        //  '<div class="row align-items-center"style="justify-content: center;">'+
          '<img src="{{asset('assets/img/logo_ministere.svg')}}" alt="" style="width: 60%"/>'+
         // '<div >'+
        '<form class="form-container-access">'+
      
         '<h1>Login</h1>'+
          '<p id="alert-access"></p>'+
         '<label for="email"><b>Email</b></label>'+
         '<input class="form-control" type="text" placeholder="Veuillez entrer votre adresse email" name="email" id="email" required>'+

         '<label for="psw"><b>Password</b></label>'+
         '<input class="form-control" type="password" placeholder="Veuillez entrer votre mot de passe" name="psw" id="code_generated" required>'+

         '<button type="button" class="btn" id="btn-form-access">Se connecter</button>'+
         '<button type="button" class="btn cancel" id="form-cancel">Fermer</button>'+
        '</form>'+
      '</div>';
 document.querySelectorAll('.next').forEach(member => {
  member.addEventListener('dblclick', function(event) {
    const children = member.nextElementSibling;
    if (children) {
      if (children.style.display === 'flex') {
        
        children.style.display = 'none';
      } else {
      
        children.style.display = 'flex';
        
      }
    }
  });
  });
  $(document).ready(function(){
    $('.modift_handler').on('click',function(){

      
      var id=$(this).attr('id');
      console.log('the id is '+id)

      
        $('.hide-access-form').append(chekl)
        $('.hide-access-form').addClass('form-access')
        $('#myForm').css('display','block')
        $('#form-cancel').on('click',function(){
          $('#myForm').css('display','none')
          $(".hide-access-form").removeClass('form-access');
          $('.hide-access-form').empty()
        })

       
        var cosnt=0;
        $('#btn-form-access').on('click',function(){
          $.ajax({
            url:'/login/account',
            type:'POST',
            data:{
            email:$('#email').val(),
            code_generated:$('#code_generated').val(),
            _token: $('meta[name="csrf-token"]').attr("content"),
            _method: "POST",},
            success:function(response)
            {
              if(response.code == 200)
             {
              window.location.href='/DPC/modif/'+id+'/?code='+response.account
             } else {
              window.location.href='/update/pass?code='+response.code_generated+'&mail='+response.account
             }
             // 
            },
            error:function()
            {
              $('#email').css('border-color','red')
              $('#code_generated').css('border-color','red')
              console.log('out of range')
            }
          })
        })
      
    })

    $('.file_handler').on('click',function(){
      var id=$(this).attr('id');
      console.log('the id is '+id)
      window.open('/live-pdf/'+id,'_blank')
    })

    $('.delete_handler').on('click',function(){
      var id=$(this).attr('id');
      console.log('the id is '+id);

      $('#reloading').removeClass('reload-hidden')

      $('.hide-access-form').append(chekl)
        $('.hide-access-form').addClass('form-access')
        $('#myForm').css('display','block')
        $('#form-cancel').on('click',function(){
          $('#myForm').css('display','none')
          $(".hide-access-form").removeClass('form-access');
          $('.hide-access-form').empty()
          $('#reloading').addClass('reload-hidden')
        })

       
        var cosnt=0;
        $('#btn-form-access').on('click',function(){
          $.ajax({
            url:'/login/account',
            type:'POST',
            data:{
            email:$('#email').val(),
            code_generated:$('#code_generated').val(),
            _token: $('meta[name="csrf-token"]').attr("content"),
            _method: "POST",},
            success:function(response)
            {
              console.log('responsee',JSON.stringify(response))
              $.ajax({
        url:'/delete_from_portfeuille/'+id+'?code='+response.account,
        type:'GET',
        success:function(response)
        {
          if(response.code == 200)
        {
          alert('Supprimer Avec successe')
          $('#'+id).closest("li").remove();
          $('#myForm').css('display','none')
          $(".hide-access-form").removeClass('form-access');
          $('.hide-access-form').empty()
          $('#reloading').addClass('reload-hidden')
        }
        else
        {
          alert('Supprimer Avec unsuccesse')
          $('#myForm').css('display','none')
          $(".hide-access-form").removeClass('form-access');
          $('.hide-access-form').empty()
          $('#reloading').addClass('reload-hidden')
        }
          $('#reloading').addClass('reload-hidden')
        },
        error: function()
        {
          $('#reloading').addClass('reload-hidden')
          alert('Peut pas Etre supprimer')
          $('#myForm').css('display','none')
          $(".hide-access-form").removeClass('form-access');
          $('.hide-access-form').empty()
          $('#reloading').addClass('reload-hidden')
        }
      })
             // 
            },
            error:function()
            {
              $('#email').css('border-color','red')
              $('#code_generated').css('border-color','red')
              console.log('out of range')
            }
          })
        })

     
    })
    
    $('.next').on('dblclick',function(){
    id=$(this).attr('id');
    var index=path.indexOf(id)
    if( index !== -1)
    {
      path.splice(index);
      console.log('testing path '+JSON.stringify(path.length-1))
      var idfather="#father"+path.length
      console.log('t fther'+idfather)
      if(idfather == '#father1')
    {
      console.log('deleting part')
    }
      var listItemsWithNestedUl = $(''+idfather).find('ul');

// Iterate over and log each of these <li> elements
listItemsWithNestedUl.each(function(){
  if ($(this).css('display') === 'flex' && $(this).attr('id') != 'father4') {
                        console.log('displaying');
                    }
                    else
                    {
                      var fap=$(this).attr('id')
                      if($(this).attr('id') == 'father2')
                      console.log('display out'+fap )
                    }
});}
    else
    {
      path.push(id);
      path3.push(id);
    }
    var typeact=id.split('_',2)
    console.log('-<<'+JSON.stringify(path)+"-->>"+JSON.stringify(typeact))
    if(typeact[0] =='act')
    {
      $(this).on('click',function(){
       // window.location.href='/testing/Action/'+path3[0]+'/'+path3[1]+'/'+path3[2]+'/'+typeact[1]+'/?code='
        $('#myForm').css('display','block')
        $('.hide-access-form').append(chekl)
        $('.hide-access-form').addClass('form-access')
        $('#form-cancel').on('click',function(){
          $('#myForm').css('display','none')
          $(".hide-access-form").removeClass('form-access');
          $('.hide-access-form').empty()
        })

       
        var cosnt=0;
        $('#btn-form-access').on('click',function(){
          $.ajax({
            url:'/login/account',
            type:'POST',
            data:{
            email:$('#email').val(),
            code_generated:$('#code_generated').val(),
            _token: $('meta[name="csrf-token"]').attr("content"),
            _method: "POST",},
            success:function(response)
            {
                if(response.code == 200)
                {
              window.location.href='/testing/Action/'+path3[0]+'/'+path3[1]+'/'+path3[2]+'/'+typeact[1]+'/?code='+response.account
                }
                else
                {
                  window.location.href='/update/pass?code='+response.code_generated+'&mail='+response.account
                }
             // 
            },
            error:function()
            {
              $('#email').css('border-color','red')
              $('#code_generated').css('border-color','red')
              console.log('out of range')
            }
          })
        })
        //
      })
    
    }
    if(typeact[0] == 'sact')
    {
      console.log('sub action'+typeact[0])
    $(this).on('click',function(){

      
        $('#father4').append(chekl)
        openForm()
     window.location.href='/testing/S_action/'+path3[0]+'/'+path3[1]+'/'+path3[2]+'/'+path3[3]+'/'+typeact[1]+'/'
      })
   
    }
  })
  $('.add-btn').on('click',function(){
    
       var cosnt=0;
        var id = $(this).attr("id");
            var indice=id ;
            console.log('i m the level '+indice) 
        $('.hide-access-form').append(chekl)
        $('.hide-access-form').addClass('form-access')
        $('#myForm').css('display','block')
        $('#form-cancel').on('click',function(){
        $('#myForm').css('display','none')
        $(".hide-access-form").removeClass('form-access');
        $('.hide-access-form').empty()
        })
      
        $('#btn-form-access').on('click',function(){
          $.ajax({
            url:'/login/account',
            type:'POST',
            data:{
            email:$('#email').val(),
            code_generated:$('#code_generated').val(),
            _token: $('meta[name="csrf-token"]').attr("content"),
            _method: "POST",},
            success:function(response)
            {
              if(response.code == 200)
              {
              window.location.href='/creation/from/'+id+'/?code='+response.account;
              }
              else
                {
                  window.location.href='/update/pass?code='+response.code_generated+'&mail='+response.account
                }
             // 
            },
            error:function()
            {
              $('#email').css('border-color','red')
              $('#code_generated').css('border-color','red')
              console.log('out of range')
            }
          })
        })
           
            var  news;
        })
/*var idchfri=$('.chiffre')

idchfri.each(function(){
  var newl="";
  var trans=$(this).text();
  var list
  var list1
  var list2

if(trans.length % 3 == 0)
{
  list= trans.match(/.{1,3}/g);
  list.forEach(elemt => {
            newl+=" "+elemt;
        });
        console.log('chrunk slice 2'+JSON.stringify(list) +'data '+trans.length +'data final'+newl)
        $(this).text(newl)
        newl="";
}
else
{
  if(trans.length % 3 == 2 && !$(this).empty())
{
  console.log('before'+trans)
  var first=trans.slice(0,2);
  trans=trans.slice(2)
  list= trans.match(/.{1,3}/g);
  list.forEach(elemt => {
            newl+=" "+elemt;
        });
        console.log('chrunk slice 3'+JSON.stringify(list) +'data '+trans.length +'data final'+newl)
        $(this).text(first+newl)
        newl="";

}
else  
{
  console.log('before 3'+trans)
  var first=trans.slice(0,2);
  trans=trans.slice(2)
  list= trans.match(/.{1,3}/g);
  list.forEach(elemt => {
            newl+=" "+elemt;
        });
        console.log('chrunk slice 3'+JSON.stringify(list) +'data '+trans.length +'data final'+newl)
        $(this).text(first+newl)
        newl="";
  
}
}

})*/
})

</script>
</html>