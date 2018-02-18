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
    <div class="col-md-6 col-lg-4 col-xl-2 mb-4">
        <div class="card" style="width:200px">
            <div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
                <a href="{!! '/serie/' . $series[$i]['id'] !!}" class="hvr-shutter-out-horizontal" style="margin-left: -18px;">
                    <img class="card-img-top" src="{!! 'https://image.tmdb.org/t/p/w185' . $series[$i]['poster_path'] !!}" alt="Card image" style="width: 200px;height: 300px;" title="{!! $series[$i]['name'] !!}" />
                    <div class="w3l-action-icon"><i class="fas fa-plus" aria-hidden="true"></i></div>
                </a>
            </div>
            <div class="card-body">
                <h5 class="card-title text-center">
                    {{ explode('-', $series[$i]['first_air_date'])[0] }}
                </h5>
                <div class="mid-2 agile_mid_2_home">
                    <p>Rate:</p>
                    @php
                    $rate = $series[$i]['vote_average'];
                    $rate = ($rate * 5) / 10;
                    $rate = intval(round($rate));
                    @endphp
                    <div class="block-stars">
                        <ul class="w3l-ratings">
                            @for ($j = 0; $j < $rate; $j++)
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            @endfor
                            @for ($j = 0; $j < 5 - $rate; $j++)
                            <li><i class="far fa-star" aria-hidden="true"></i></li>
                            @endfor
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            @if (Auth::check())
            <div class="container">
                @if (! Illuminate\Support\Facades\DB::table('series')->where([['user_id', auth()->id()], ['serie_id', $series[$i]['id']],])->exists())
                <form id="formF" method="POST" action="/serie/{{ $series[$i]['id'] }}/follow">
                    {{ csrf_field() }}
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-block btn-success">Seguir</button>
                    </div>
                </form>
                @else
                <form id="formU" method="POST" action="/serie/{{ $series[$i]['id'] }}/unfollow">
                    {{ csrf_field() }}
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-block btn-danger">No Seguir</button>
                    </div>
                </form>
                @endif
            </div>
            @endif
        </div>  
    </div> 
    @endfor
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