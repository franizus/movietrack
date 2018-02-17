@extends ('layouts.master', ['tipo' => 'Series']) 

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
            @switch($type)
            @case('popular')
            Populares
            @break
            @case('airing_today')
            Al aire hoy
            @break
            @case('top_rated')
            Mejor Calificadas
            @break
            @case('on_the_air')
            Actualmente en TV
            @break
            @default
            @endswitch
        </h3>
    </div>
    <div class="w3_agile_featured_movies">
        @if ($page > 1)
        @php
        $var = 4;
        $var1 = 28;
        @endphp
        @else
        @php
        $var = 0;
        $var1 = 24;
        @endphp
        @endif
        @for ($i = $var; $i < $var1; $i++)
        <div class="col-md-2 w3l-movie-gride-agile">
            <a href="{!! '/serie/' . $series[$i]['id'] !!}" class="hvr-shutter-out-horizontal"><img src="{!! 'https://image.tmdb.org/t/p/w185' . $series[$i]['poster_path'] !!}" style="width: 200px;height: 300px;" title="{!! $series[$i]['name'] !!}" class="img-responsive" alt=" " />
                <div class="w3l-action-icon"><i class="fas fa-plus" aria-hidden="true"></i></div>
            </a>
            <div class="mid-1 agileits_w3layouts_mid_1_home">
                <div class="w3l-movie-text">
                    <h6><a href="{!! '/serie/' . $series[$i]['id'] !!}"></a></h6>							
                </div>
                <div class="mid-2 agile_mid_2_home">
                    <p>{{ explode('-', $series[$i]['first_air_date'])[0] }}</p>
                    <div class="block-stars">
                        <ul class="w3l-ratings">
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="far fa-star" aria-hidden="true"></i></li>
                            <li><i class="far fa-star" aria-hidden="true"></i></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        @endfor
    </div>
    <div class="col-4 bottom5">
        @if ($page > 1)
        <a class="btn btn-primary" href="{!! '/series/' . $type . '/' . ($page - 1) !!}">Anterior</a>
        @endif
    </div>
    <div class="col-4 bottom5 text-center">
        <h3>Pagina: {{ $page }}</h3>
    </div>
    <div class="col text-right bottom5">
        <a class="btn btn-primary" href="{!! '/series/' . $type . '/' . ($page + 1) !!}">Siguiente</a>
    </div>
</section>
@endsection