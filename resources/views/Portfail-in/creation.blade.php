<!DOCTYPE html>
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
@include('side_bar.side-barV1')
<div>
    <div>
    <div class="select" tabindex="1">
    <input class="selectopt" name="test" type="radio" id="opt1" checked>
    <label for="opt1" class="option">Oranges</label>
    <input class="selectopt" name="test" type="radio" id="opt2">
    <label for="opt2" class="option">Apples</label>
    <input class="selectopt" name="test" type="radio" id="opt3">
    <label for="opt3" class="option">Grapefruit</label>
    <input class="selectopt" name="test" type="radio" id="opt4">
    <label for="opt4" class="option">Bananas</label>
    <input class="selectopt" name="test" type="radio" id="opt5">
    <label for="opt5" class="option">Watermelon</label>
    </div>
    </div>
</div>

<script src="{{asset('assets/bootstrap-5.0.2/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/fontawesome-free/js/all.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
</body>
</html>