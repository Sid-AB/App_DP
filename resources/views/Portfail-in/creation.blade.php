{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation Portfail</title>
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
@include('side_bar.side-barV1') --}}

@extends('welcome')

@section('title', 'Creat')

@section('content')

    <body>
<div>
    <div id="progam-handle">
    <div class="form-container">
      <form action="{{ route('creation.portfail') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="input1">Programme 1</label>
          <input type="text" class="form-control" id="input1" placeholder="Donnee Nom Programme">
        </div>
        <div class="form-group">
          <label for="input2">Numero Journal :</label>
          <input type="text" class="form-control" id="input2" placeholder="Donnee Refrence Journal">
        </div>
        <div class="form-group">
          <label for="inputDate">Date Journal</label>
          <input type="date" class="form-control" id="inputDate">
        </div>
        <br>
        <div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
        <hr>
        <div class="file-handle">
        <input type="file" class="form-control" id="file">
        <button class="btn btn-primary">Journal</button>
        </div>
        </div>
      </form>
    </div>
    </div>
    <div id="sous_prog-handle">

    </div>
    <div id="act-handle">

    </div>
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
</div>
{{--
<script src="{{asset('assets/bootstrap-5.0.2/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/fontawesome-free/js/all.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
</body>
</html> --}}

</body>
@endsection
