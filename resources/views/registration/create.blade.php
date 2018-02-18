@extends('layouts.session')

@section('content')
<div class="card card-register mx-auto mt-5 bottom5">
    <h4 class="card-header">Registro</h4>
    <div class="card-body">
        <form method="POST" action="/register">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="cedula">Nombre</label>
                <input class="form-control" name="name" type="text" placeholder="Ingrese su nombre" required>
            </div>
            <div class="form-group">
                <label for="correo">Email</label>
                <input class="form-control" name="email" type="email" placeholder="Ingrese su correo electronico" required>
            </div>
            <div class="form-group">
                <div class="form-row"> 
                    <div class="col-md-6">
                        <label for="pw">Contraseña</label>
                        <input class="form-control" name="password" type="password" placeholder="Contraseña" required>
                    </div>
                    <div class="col-md-6"> 
                        <label for="pwconfirm">Confirmar contraseña</label> 
                        <input class="form-control" name="password_confirmation" type="password" placeholder="Confirmar contraseña" required> 
                    </div> 
                </div>
            </div>
            <input class="btn btn-danger btn-block" type="submit" value="Registrarse" style="background-color:#FF0022">
            @include ('errors')
        </form>
        <div class="text-center">
            <a class="d-block small mt-3" href="/login">Regresar a Login</a>
        </div>
    </div>
</div>
@endsection