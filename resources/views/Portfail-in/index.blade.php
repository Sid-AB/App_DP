<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content=" {{csrf_token()}}">
    <title>Portfail</title>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">

<link href="{{asset('assets/css/Tree.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/main.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/bootstrap-5.0.2/css/bootstrap.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/fontawesome-free/css/all.css')}}" rel="stylesheet"/>
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

 <div class="container">
 <div class="container family-tree">
    <div class="row justify-content-center">
      <div class="col-12 tree">
        <ul>
          <li>
            <span class="member" id="Portfail">

                <!--  -->

                <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Portfail</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">100,820,155 DZ</h4>
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
                        <p class="fs-7 mb-0">Progamme : 88</p>
                        <p class="fs-7 mb-0 text-secondary">Programme 89</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

                <!--  -->
            </span>
            <ul style="display: none;">
              <li>
                <span class="member" id="Progamme-89">
                <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Progamme 89</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">114,000,000 DZ</h4>
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
                        <p class="fs-7 mb-0">Sous-Progamme 1002</p>
                        <p class="fs-7 mb-0 text-secondary">Sous-Progamme 1003</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
                </span>
                <ul style="display: none;">
                <li>
                <span class="member">
                  <button class="add-btn">
                   <i class="fas fa-plus-circle icon-car" style='font-size:100px; color:#0dcaf0;'></i>
                  </button>
                </span>
          </li>
                  <li>
                    <span class="member" id="Sous-programme-1002">
                    <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Sous-programme 1002</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">100,000 DZ</h4>
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
                        <p class="fs-7 mb-0">ACTION 1012</p>
                        <p class="fs-7 mb-0 text-secondary">ACTION 1013</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
                    </span>
                  </li>
                  <li>
                    <span class="member" id="Sous-Programme-1003">
                    <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Sous-Programme 1003</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">14,000 DZ</h4>
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
                        <p class="fs-7 mb-0">ACTION 1021</p>
                        <p class="fs-7 mb-0 text-secondary">ACTION 1022</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
                    </span>
                 </li>
                </ul>
              </li>
              <li>
                <span class="member" id="Programme-88">
                <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Programme 88</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">152,820,000 DZ</h4>
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
                        <p class="fs-7 mb-0">Sous-programme 2002</p>
                        <p class="fs-7 mb-0 text-secondary">Sous-programme 2002</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
                </span>
                <ul style="display: none;">
                  <li>
                    <span class="member" id="Sour-program-2002">
                    <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Sour-program 2002</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">152,820 DZ</h4>
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
                        <p class="fs-7 mb-0">ACTION 001</p>
                        <p class="fs-7 mb-0 text-secondary">ACTION 002</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
                    </span>
                    <ul style="display: none;">
                      <li>
                        <span class="member" id="ACTION-001">
                        <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">ACTION 001</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">Sous_Action 001 </h4>
                    <h4 class="card-subtitle text-body-secondary m-0">Sous_Action 002 </h4>
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
                        <p class="fs-7 mb-0">AE : 250,000 DZ</p>
                        <p class="fs-7 mb-0 text-secondary">CP : 250,000 DZ</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
                        </span><ul style="display: none;">
                        <li>
                        <span class="member" id="S_ACTION-001">
                        <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Sous_ACTION 001</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">T1: , T2 : ,T3: ,T4: </h4>
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
                        <p class="fs-7 mb-0">AE : 250,000 DZ</p>
                        <p class="fs-7 mb-0 text-secondary">CP : 250,000 DZ</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
                        </span>
                        </li>
                        <li>
                        <span class="member" id="S_ACTION-002">
                        <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Sous_ACTION 002</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">T1: , T2 : ,T3: ,T4: </h4>
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
                        <p class="fs-7 mb-0">AE : 250,000 DZ</p>
                        <p class="fs-7 mb-0 text-secondary">CP : 250,000 DZ</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
                        </span>
                        </li>
                        <li>
                <span class="mem-add">
                  <button class="add-btn" id="1">
                   <i class="fas fa-plus-circle icon-car" style='font-size:100px; color:#0dcaf0;'></i>
                  </button>
                  </span>
                  </li>
                      </ul>
                      </li>
                      <li>
                        <span class="member" id="ACTION-002">
                        <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">ACTION 002</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">T1: , T2 : ,T3: ,T4: </h4>
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
                        <p class="fs-7 mb-0">AE : 250,000 DZ</p>
                        <p class="fs-7 mb-0 text-secondary">CP : 250,000 DZ</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
                        </span>
                      </li>
                      <li>
                <span class="mem-add">
                  <button class="add-btn" id="2">
                   <i class="fas fa-plus-circle icon-car" style='font-size:100px; color:#0dcaf0;'></i>
                  </button>
                </span>
          </li>
                    </ul>
                    <li>
                <span class="mem-add">
                  <button class="add-btn" id="3">
                   <i class="fas fa-plus-circle icon-car" style='font-size:100px; color:#0dcaf0;'></i>
                  </button>
                </span>
          </li>
                 </li>
                </ul>
              </li>
              <li>
                <span class="mem-add">
                  <button class="add-btn" id="4">
                   <i class="fas fa-plus-circle icon-car" style='font-size:100px; color:#0dcaf0;'></i>
                  </button>
                </span>
          </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
 </div>



</body>
<script src="{{asset('assets/bootstrap-5.0.2/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/fontawesome-free/js/all.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
<script>
  var path=Array();
 document.querySelectorAll('.member').forEach(member => {
  member.addEventListener('click', function(event) {
    const children = member.nextElementSibling;
    if (children) {
      if (children.style.display === 'flex') {
        children.style.display = 'none';
        if(member.id == 'Portfail')
        {
          path=Array();
        }
      } else {
        children.style.display = 'flex';
        if(children.id === 'father2')
        {
      console.log('id fterh in')
      $('#father2').css('display','none')
      $('#father3').css('display','none')
      $('#father4').css('display','none')
      }
      }
    }
  });
  });
  $(document).ready(function(){
    $('.member').on('click',function(){
    id=$(this).attr('id');
    var index=path.indexOf(id)
    if( index !== -1)
    {
      path.splice(index+1);
    }
    else
    {
      path.push(id);
    }
    if(id === 'father2')
        {
      document.querySelectorAll('#father2').forEach(function(element) {
    element.style.display = 'none';
});
      }
    console.log('-<<'+JSON.stringify(path))
    if(id =='ACTION-002')
    {
      window.location.href='/testing/Action/'+path[0]+'/'+path[1]+'/'+path[2]+'/'+path[3]+'/'
    }
    if(id =='S_ACTION-002' || id =='S_ACTION-001')
    {
       window.location.href='/testing/S_action/'+path[0]+'/'+path[1]+'/'+path[2]+'/'+path[3]+'/'+path[4]+'/'
    }
  })
  $('.add-btn').on('click',function(){
            var id = $(this).attr("id");
            var indice=id ;
            console.log('i m the level '+indice)
            var  news;
            switch(true)
            {
              case id=="4":
                indice=id-4
                var formapath={"portiel code":path[indice]}
                console.log('add new programe for portail avec '+typeof(indice)+' eest'+JSON.stringify(formapath))
                  news=new URLSearchParams(formapath).toString();
                window.location.href='/creation/from?'+news;
                break;
                case id=="3":
                indice=id-2
                var formapath={"portiel code":path[0],"Programme":path[indice]}
                console.log('add new sous_ programe for portailavec '+indice+' eest'+JSON.stringify(formapath))
                  news=new URLSearchParams(formapath).toString();
               window.location.href='/creation/from?'+news;
                break;
                case id=="2":
                indice=id
                var formapath={"portiel code":path[0],"Programme":path[1],"Sous Programme":path[indice]}
                console.log('add new action for portailavec '+indice+' eest'+JSON.stringify(formapath))
                  news=new URLSearchParams(formapath).toString();
                window.location.href='/creation/from?'+news;
                break;
                case id == "1":
                indice=parseInt(id)+2
                var formapath={"portiel code":path[0],"Programme":path[1],"Sous Programme":path[2],"Action":path[indice]}
                console.log('add new sous_action for portailavec '+indice+' eest'+formapath.Programme)
                  news=new URLSearchParams(formapath).toString();
                window.location.href='/creation/from?'+news;
                break;
                default:
                console.log("No level is select");
            }
        })
})
</script>
</html>
