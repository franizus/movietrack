@extends ('layouts.master', ['tipo' => 'Mi Perfil']) 

@section ('head')
@extends('layouts.head')
<style>
    .col-md-2 {
        position: relative;
        min-height: 1px;
        padding-right: 15px;
        padding-left: 15px;
    }
    
    .col-md-2 {
        float: left;
    }
    
    .col-md-2 {
        width: 16.66666667%;
    }
</style>
@endsection

@section ('content')
<section class="row"  style="margin-top: -2em;">
    <div class="col-12">
        <h3 class="mb-4">
            Peliculas
        </h3>
    </div>
    <div class="w3_agile_featured_movies">
        @foreach ($movies as $movie)
        @php
        $movieInfo = App\Http\Controllers\MoviesController::getMovie($movie->movie_id);
        @endphp
        <div class="col-md-2 w3l-movie-gride-agile">
            <a href="{!! '/movie/' . $movieInfo['id'] !!}" class="hvr-shutter-out-horizontal"><img src="{!! 'https://image.tmdb.org/t/p/w185' . $movieInfo['poster_path'] !!}" style="width: 200px;height: 300px;" title="{!! $movieInfo['title'] !!}" class="img-responsive" alt=" " />
                <div class="w3l-action-icon"><i class="fas fa-plus" aria-hidden="true"></i></div>
            </a>
            <div class="mid-1 agileits_w3layouts_mid_1_home">
                <div class="w3l-movie-text">
                    <h6><a href="{!! '/movie/' . $movieInfo['id'] !!}"></a></h6>							
                </div>
                <div class="mid-2 agile_mid_2_home">
                    <p>{{ explode('-', $movieInfo['release_date'])[0] }}</p>
                    <ul class="w3l-ratings">
                        <li><i class="fas fa-star" aria-hidden="true"></i></li>
                        <li><i class="fas fa-star" aria-hidden="true"></i></li>
                        <li><i class="fas fa-star" aria-hidden="true"></i></li>
                        <li><i class="far fa-star" aria-hidden="true"></i></li>
                        <li><i class="far fa-star" aria-hidden="true"></i></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>       
        @endforeach
    </div>
    <div class="col-12">
        <h3 class="mb-4">
            Series
        </h3>
    </div>
    <div class="w3_agile_featured_movies bottom5">
        @foreach ($series as $serie)
        @php
        $serieInfo = App\Http\Controllers\SeriesController::getSerie($serie->serie_id);
        @endphp
        <div class="col-md-2 w3l-movie-gride-agile">
            <a href="{!! '/serie/' . $serieInfo['id'] !!}" class="hvr-shutter-out-horizontal"><img src="{!! 'https://image.tmdb.org/t/p/w185' . $serieInfo['poster_path'] !!}" style="width: 200px;height: 300px;" title="{!! $serieInfo['name'] !!}" class="img-responsive" alt=" " />
                <div class="w3l-action-icon"><i class="fas fa-plus" aria-hidden="true"></i></div>
            </a>
            <div class="mid-1 agileits_w3layouts_mid_1_home">
                <div class="w3l-movie-text">
                    <h6><a href="{!! '/serie/' . $serieInfo['id'] !!}"></a></h6>							
                </div>
                <div class="mid-2 agile_mid_2_home">
                    <p>{{ explode('-', $serieInfo['first_air_date'])[0] }}</p>
                    <ul class="w3l-ratings">
                        <li><i class="fas fa-star" aria-hidden="true"></i></li>
                        <li><i class="fas fa-star" aria-hidden="true"></i></li>
                        <li><i class="fas fa-star" aria-hidden="true"></i></li>
                        <li><i class="far fa-star" aria-hidden="true"></i></li>
                        <li><i class="far fa-star" aria-hidden="true"></i></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>       
        @endforeach
    </div>
</section>
@endsection
