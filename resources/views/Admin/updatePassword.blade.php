<!DOCTYPE html>


<!--html lang="{{ str_replace('_', '-', app()->getLocale()) }}"-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--title>{{ __('lang.Changerlemotdepass') }}</title-->
    <title> Changer votre mot de passe</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

   <style>

        body {
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f2f5;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .container h2 {
            margin-bottom: 1rem;
            font-weight: 700;
            color: #333;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }

        .form-group .toggle-password {
            position: absolute;
            top: 65%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .form-group .error {
            color: #ff0000;
            font-size: 0.875rem;
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 0.75rem;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.875rem;
            color: #777;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
        .language-switcher {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 0.875rem;
        }

        .language-switcher a {
            color: #007bff;
            text-decoration: none;
            margin: 0 5px;
        }

        .language-switcher a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

     <div class="language-switcher">
    <a href="{{ url('lang/fr') }}">Français</a> |
    <a href="{{ url('lang/ar') }}">العربية</a>
    </div>

<div class="container">
    <!--h2>{{ __('lang.Changerlemotdepass') }}</h2-->
    <h2> Changer votre mot de passe</h2>
    <form method="POST" action="{{ route('password_update') }}">
        @csrf

        <div class="form-group">
            <!--label for="current_password">{{ __('lang.Ancienmotdepass') }}</label-->
            <label for="current_password">Ancien mot de passe</label>
            <input type="password" id="current_password" name="current_password" required>
           
            @if ($errors->has('current_password'))
                <span class="error">{{ $errors->first('current_password') }}</span>
            @endif
        </div>

        <div class="form-group">
            <!--label for="new_password">{{ __('lang.Nouveaumotdepass') }}</label-->
            <label for="new_password">Nouveau mot de passe</label>
            <input type="password" id="new_password" name="new_password" required>
   
            @if ($errors->has('new_password'))
                <span class="error">{{ $errors->first('new_password') }}</span>
            @endif
        </div>

        <div class="form-group">
            <!--label for="new_password_confirmation">{{ __('lang.Confirmervotrenouveaumotdepass') }}</label-->
            <label for="new_password_confirmation">Confirmer votre nouveau mot de passe</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
            
            @if ($errors->has('new_password_confirmation'))
                <span class="error">{{ $errors->first('new_password_confirmation') }}</span>
            @endif
        </div>
        <input id="mail" name="mail" value="{{$mail}}" hidden>
        <input id="code" name="code" value="{{$code}}" hidden>
        <!--button type="submit" class="btn">{{ __('lang.Changerlemotdepass') }}</button-->
        <button type="submit" class="btn">Changer le mot de passe</button>
    </form>

    <div class="footer">
        <!--a href="javascript:void(0);" onclick="goBack()">{{ __('lang.Retour') }}</a-->
        <a href="javascript:void(0);" onclick="goBack()">Retour</a>
    </div>
</div>

<script>

    function goBack() {
        window.history.back();
    }

  /*  function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
        field.setAttribute('type', type);
        const icon = field.nextElementSibling;
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    }*/
</script>

</body>
</html>
