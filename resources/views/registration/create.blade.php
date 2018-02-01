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
        <div class="card card-register mx-auto mt-5 bottom5">
            <h4 class="card-header">Registro</h4>
            <div class="card-body">
                <form method="POST" action="/register">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="cedula">Nombre</label>
                        <input class="form-control" id="name" name="name" type="text" placeholder="Ingrese su nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Email</label>
                        <input class="form-control" id="email" name="email" type="email" placeholder="Ingrese su correo electronico" required>
                    </div>
                    <div class="form-group">
                        <div class="form-row"> 
                            <div class="col-md-6">
                                <label for="pw">Contraseña</label>
                                <input class="form-control" id="password" name="password" type="password" placeholder="Contraseña" required>
                            </div>
                            <div class="col-md-6"> 
                                <label for="pwconfirm">Confirmar contraseña</label> 
                                <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirmar contraseña" required> 
                            </div> 
                        </div>
                    </div>
                    <input class="btn btn-danger btn-block" type="submit" value="Registrarse">
                    @include ('errors')
                </form>
                <div class="text-center">
                    <a class="d-block small mt-3" href="/login">Regresar a Login</a>
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