<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACTION</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
<link href="{{asset('assets/css/tableTemplat.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/main.css')}}" rel="stylesheet"/>
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
<!-- Container for Car Cards -->
<div>
 {{--@include('progress_step.progress_step')--}}
 <br>
 </div>
 <div>
    <div class="T-handle">
        <div class="list-T-hanlde">
                <div class="TP-handle">
                <div class="card-T">
                  <div class="container-card bg-yellow-box">
                    <!--i class="fas fa-door-closed T-icon"></i-->
                    <i class="fas fa-door-closed T-icon icon icon-card"></i>
                    <i class="fas fa-door-open hover-icon icon icon-card"></i>
                    <p class="card-title-T">Titre Port 1</p>
                    <p class="card-description-T">AE 190,000 DZ.</p>
                    <p class="card-description-T">CP 100,000 DZ.</p>
                  </div>
                </div>
                </div>
                <div class="TP-handle">
                <div class="card-T">
                  <div class="container-card bg-yellow-box">
                  <i class="fas fa-door-closed T-icon icon icon-card"></i>
                  <i class="fas fa-door-open hover-icon icon icon-card"></i>
                    <p class="card-title-T">Titre Port 2</p>
                    <p class="card-description-T">AE 220,000 DZ.</p>
                    <p class="card-description-T">CP 180,000 DZ.</p>
                  </div>
                </div>
                </div>
                <div class="TP-handle">
                <div class="card-T">
                  <div class="container-card bg-yellow-box">
                  <i class="fas fa-door-closed T-icon icon icon-card"></i>
                  <i class="fas fa-door-open hover-icon icon icon-card"></i>
                    <p class="card-title-T">Titre Port 3</p>
                    <p class="card-description-T">AE 150,000 DZ.</p>
                    <p class="card-description-T">CP 100,000 DZ.</p>
                  </div>
                </div>
                </div>
                <div class="TP-handle">
               
                <div class="card-T">
                  <div class="container-card bg-yellow-box">
                  <i class="fas fa-door-closed T-icon icon icon-card"></i>
                  <i class="fas fa-door-open hover-icon icon icon-card"></i>
                    <p class="card-title-T">Titre Port 4</p>
                    <p class="card-description-T">AE 180,000 DZ.</p>
                    <p class="card-description-T">CP 180,000 DZ.</p>
                  </div>
                </div>
                </div>
        </div>
        <hr>
        <div class="table-T-handle">
            <table class="container-T" id="T-tables">
            <thead>
		<tr>
			<th><h1>Sites</h1></th>
			<th><h1>Views</h1></th>
			<th><h1>Clicks</h1></th>
			<th><h1>Average</h1></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Google</td>
			<td>9518</td>
			<td>6369</td>
			<td>01:32:50</td>
		</tr>
		<tr>
			<td>Twitter</td>
			<td>7326</td>
			<td>10437</td>
			<td>00:51:22</td>
		</tr>
		<tr>
			<td>Amazon</td>
			<td>4162</td>
			<td>5327</td>
			<td>00:24:34</td>
		</tr>
    <tr>
			<td>LinkedIn</td>
			<td>3654</td>
			<td>2961</td>
			<td>00:12:10</td>
		</tr>
    <tr>
			<td>CodePen</td>
			<td>2002</td>
			<td>4135</td>
			<td>00:46:19</td>
		</tr>
    <tr>
			<td>GitHub</td>
			<td>4623</td>
			<td>3486</td>
			<td>00:31:52</td>
		</tr>
	</tbody>
            </table>
        </div>
    </div>
 <div class="container">
 <div class="grid-container" id="Tport-handle">
        <!-- Card 1 -->
        <div class="col-md-15 hover-container">
            <div class="card">
                <div class="icon-holder">
                <i class="fas fa-door-closed default-icon icon icon-card"></i>
                <i class="fas fa-door-open hover-icon icon icon-card"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Titre 1</h5>
                    <p class="card-text">Description pour Titre 1.</p>
                    <button class="btn btn-primary" id="T1">Vers Tableau Operation</button>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-15 hover-container">
            <div class="card">
            <div class="icon-holder">
                <i class="fas fa-door-closed default-icon icon icon-card"></i>
                <i class="fas fa-door-open hover-icon icon icon-card"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Titre 2</h5>
                    <p class="card-text">Description pour Titre 2.</p>
                    <button class="btn btn-primary" id="T2">Vers Tableau Operation</button>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-15 hover-container">
            <div class="card">
            <div class="icon-holder">
                <i class="fas fa-door-closed default-icon icon icon-card"></i>
                <i class="fas fa-door-open hover-icon icon icon-card"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Titre 3</h5>
                    <p class="card-text">Description pour Titre 3.</p>
                    <button class="btn btn-primary" id="T3" >Vers Tableau Operation</button>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-md-15 hover-container">
            <div class="card">
            <div class="icon-holder">
                <i class="fas fa-door-closed default-icon icon icon-card"></i>
                <i class="fas fa-door-open hover-icon icon icon-card"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Titre 4</h5>
                    <p class="card-text">Description pour Titre 4.</p>
                    <button class="btn btn-primary" id="T4">Vers Les Operation</button>
                </div>
            </div>
        </div>
    </div>
 </div>

    </div>
   </div>
</body>
<script src="{{asset('assets/bootstrap-5.0.2/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/fontawesome-free/js/all.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
</html>