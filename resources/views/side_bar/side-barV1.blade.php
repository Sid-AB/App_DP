<input type="checkbox" id="menu-toggle" checked>
<div class="menu dflex">
  <div id="logoCSS3" class="text-center">
    <img src="{{asset('assets/img/logo_ministere.svg')}}"/>
  </div>
  <div class="elements-container dflex">
    <a class="element" href="/">
      <i class="fas fa-tachometer-alt"></i> Tableau du Portefeuille
      </a>
      @if(isset($port) || isset($allport) || isset($paths))
      @if(isset($port))
      <a class="element" href="/Portfail/{{$port}}">
      @else
        @if(isset($paths))
        <a class="element" href="/Portfail/{{$paths['code_port']}}">
        @else
      <a class="element" href="/Portfail/{{$allport['id']}}">
        @endif
      @endif
      <i class="fas fa-tools"></i> Suivi des Portefeuilles
      </a>
      @if( !isset($port) && !isset($prog) && !isset($sous_prog) && !isset($act))
      <a class="element" href="#">
      <div class="update-handl" style="display: flex;align-items: flex-start;justify-content: flex-start;flex-wrap: nowrap;">
        <i class="fas fa-edit"></i>
        <h6 >Creation Modifcation</h6>
      </div>
    </a>
    @endif
      @endif
   
      @if( isset($port) && isset($prog) && isset($sous_prog) && isset($act))
      @if(isset($s_act))
    <a class="element" href="/testing/{{$port}}/{{$prog}}/{{$sous_prog}}/{{$act}}/{{$s_act}}/pdf" target="_blank">
      <i class="fas fa-calendar-check"></i> DPA à imprimer
    </a>
    @else
    <a class="element" href="/testing/{{$port}}/{{$prog}}/{{$sous_prog}}/{{$act}}/{{$sact}}/pdf" target="_blank">
      <i class="fas fa-calendar-check"></i> DPA à imprimer
    </a>
    @endif
    @endif

      @if(isset($port) || isset($allport) || isset($paths))
      @if(isset($port))
      <a class="element" href="/affiche_transacation/{{$port}}">
      @else
        @if(isset($paths))
        <a class="element" href="/affiche_transacation/{{$paths['code_port']}}">
        @else
      <a class="element" href="/affiche_transacation/{{$allport['id']}}">
        @endif
      @endif
        <i class="fas fa-wrench"></i> Suivi Des Transaction Du Portfail
      </a>
      @endif
      @if(isset($port) || isset($allport) || isset($paths))
      @if(isset($port))
      <a class="element" href="/printdpic/{{$port}}" target="_blank">
      @else
        @if(isset($paths))
        <a class="element" href="/printdpic/{{$paths['code_port']}}" target="_blank">
        @else
      <a class="element" href="/printdpic/{{$allport['id']}}" target="_blank">
        @endif
      @endif
      <i class="fas fa-print"></i> Imprimer Dpic
      </a>
      @endif


      @if(isset($port) || isset($allport) || isset($paths))
      @if(isset($port))
        @if(isset($s_act))
         <a class="element" href="/printallemploi/{{$s_act}}" target="_blank">
        @else
        @if(isset($act))
          <a class="element" href="/printallemploi/{{$act.'-01'}}" target="_blank">
        @endif
        @endif
      @else
        @if(isset($paths))
        @if(isset($s_act))
        <a class="element" href="/printallemploi/{{$s_act}}" target="_blank">
  
          @else
          @if(isset($act))
          <a class="element" href="/printallemploi/{{$act.'-01'}}" target="_blank">
        @endif
          @endif
        @endif
      @endif
      <i class="fas fa-print"></i> Emploi Bugdetaire
      </a>
      @endif
      <div class="print_btn_holder">
      <button class="element" id="expExcel" style="display: none">
        <i class="fas fa-file-excel"></i> Export
      </button>
      <button class="element" id="expWord" style="display: none">
        <i class="fas fa-file-word"></i></i> Export
      </button>
      <button class="element" id="vider_t" style="display: none">
        <i class="fas fa-recycle"></i> Vider
      </button>
    </div>
  </div>
  <div class="menu-container-btn">
    <div class="menu-toggle-btn">
      <label class="menu-btn text-center" for="menu-toggle">
          <i class="fa fa-close"></i>
          <i class="fa fa-bars"></i>
        </label>
    </div>
  </div>
</div>
