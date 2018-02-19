@extends ('layouts.master', ['tipo' => 'Mi Perfil']) 

@section ('head')
@extends('layouts.head')
@endsection

@section ('content')
<section class="row"  style="margin-top: -2em;">
    <div class="col-12">
        <h3 class="mb-4">
            Mis Datos
        </h3>
    </div>
    <div class="col-7">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="/user/{{ auth()->id() }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input class="form-control" name="name" type="text" placeholder="Nombre" value="{{ Auth::user()->name }}" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="email" type="email" placeholder="Email" value="{{ Auth::user()->email }}" required>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <input class="form-control" name="password" type="password" placeholder="Contraseña nueva" required>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" name="password_confirmation" type="password" placeholder="Confirmar contraseña nueva" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-danger" style="background-color:#FF0022">Guardar Cambios</button>
                    </div>
                    @include ('errors')                 
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 top25">
        <h3 class="mb-4">
            Mis Peliculas
        </h3>
    </div>
    @foreach ($movies as $movie)
    @php
    $movieInfo = App\Http\Controllers\MoviesController::getMovie($movie->movie_id);
    @endphp
    <div class="col-md-6 col-lg-4 col-xl-2 mb-4">
        <div class="card" style="width:200px">
            <div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
                <a href="{!! '/movie/' . $movieInfo['id'] !!}" class="hvr-shutter-out-horizontal" style="margin-left: -18px;">
                    <img class="card-img-top" src="{!! 'https://image.tmdb.org/t/p/w185' . $movieInfo['poster_path'] !!}" alt="Card image" style="width: 200px;height: 300px;" title="{!! $movieInfo['title'] !!}" />
                    <div class="w3l-action-icon"><i class="fas fa-plus" aria-hidden="true"></i></div>
                </a>
            </div>
            <div class="card-body">
                <h5 class="card-title text-center">
                    {{ explode('-', $movieInfo['release_date'])[0] }}
                </h5>
                <div class="mid-2 agile_mid_2_home">
                    <p>Rate:</p>
                    @php
                    $rate = $movieInfo['vote_average'];
                    $rate = ($rate * 5) / 10;
                    $rate = intval(round($rate));
                    @endphp
                    <div class="block-stars">
                        <ul class="w3l-ratings">
                            @for ($i = 0; $i < $rate; $i++)
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            @endfor
                            @for ($i = 0; $i < 5 - $rate; $i++)
                            <li><i class="far fa-star" aria-hidden="true"></i></li>
                            @endfor
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>  
    </div> 
    @endforeach
    <div class="col-12">
        <h3 class="mb-4">
            Mis Series
        </h3>
    </div>
    @foreach ($series as $serie)
    @php
    $serieInfo = App\Http\Controllers\SeriesController::getSerie($serie->serie_id);
    @endphp
    <div class="col-md-6 col-lg-4 col-xl-2 mb-4">
        <div class="card" style="width:200px">
            <div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
                <a href="{!! '/serie/' . $serieInfo['id'] !!}" class="hvr-shutter-out-horizontal" style="margin-left: -18px;">
                    <img class="card-img-top" src="{!! 'https://image.tmdb.org/t/p/w185' . $serieInfo['poster_path'] !!}" alt="Card image" style="width: 200px;height: 300px;" title="{!! $serieInfo['name'] !!}" />
                    <div class="w3l-action-icon"><i class="fas fa-plus" aria-hidden="true"></i></div>
                </a>
            </div>
            <div class="card-body">
                <h5 class="card-title text-center">
                    {{ explode('-', $serieInfo['first_air_date'])[0] }}
                </h5>
                <div class="mid-2 agile_mid_2_home">
                    <p>Rate:</p>
                    @php
                    $rate = $serieInfo['vote_average'];
                    $rate = ($rate * 5) / 10;
                    $rate = intval(round($rate));
                    @endphp
                    <div class="block-stars">
                        <ul class="w3l-ratings">
                            @for ($i = 0; $i < $rate; $i++)
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            @endfor
                            @for ($i = 0; $i < 5 - $rate; $i++)
                            <li><i class="far fa-star" aria-hidden="true"></i></li>
                            @endfor
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>  
    </div> 
    @endforeach
</section>
@endsection
