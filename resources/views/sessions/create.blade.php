@extends('layouts.session')

@section('content')
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
@endsection