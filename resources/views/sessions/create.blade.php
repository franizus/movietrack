<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="/img/trakt.png">
	
	<title>MovieTrack</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <!-- Icons -->
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="/css/admin.css" rel="stylesheet">
    <style>
        .bottom5 {
            margin-bottom: 70px;
        }

        .jumbotron {
            background-color: #1D1D1D;
            text-transform: uppercase;
            font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
    </style>
</head>

<body style="background-color:#222222;">>
    <div class="text-white text-center jumbotron">
        <h1 class="site-title">
            <img src="/img/trakt.png" width=40px> Movie.Track</h1>
    </div>
    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Ingreso al Sistema</div>
                <div class="card-body">
                    <form method="POST" action="/login">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="inputUser">Email</label>
                            <input class="form-control" id="email" name="email" type="email" placeholder="Ingresar su correo" required>
                        </div>
                        <div class="form-group">
                            <label for="inputPW">Contraseña</label>
                            <input class="form-control" id="password" name="password" type="password" placeholder="Ingresar su contraseña" required>
                        </div>
                        <input class="btn btn-primary btn-block" type="submit" value="Log In">
                        <a class="btn btn-danger btn-block" href="/">Cancelar</a>
                        @include ('errors')
                    </form>
                <div class="text-center">
                    <a class="btn btn-link" href="/register">Registrarse</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>