@extends ('layouts.master', ['tipo' => 'Resultados de Busqueda']) 

@section ('head')
@extends('layouts.head')
@endsection

@section ('content')
<section class="row"  style="margin-top: -2em;">
    <div class="col-12">
        <h3 class="mb-4">
            Peliculas
        </h3>
    </div>
    @php
    $bandera = false;
    @endphp
    @foreach ($results as $item)
    @if ($item['media_type'] == 'movie')
    @php
    $bandera = true;
    @endphp
    <div class="col-md-6 col-lg-4 col-xl-2 mb-4">
        <div class="card" style="width:200px">
            <div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
                <a href="{!! '/movie/' . $item['id'] !!}" class="hvr-shutter-out-horizontal" style="margin-left: -18px;">
                    <img class="card-img-top" src="{!! 'https://image.tmdb.org/t/p/w185' . $item['poster_path'] !!}" alt="Card image" style="width: 200px;height: 300px;" title="{!! $item['title'] !!}" />
                    <div class="w3l-action-icon"><i class="fas fa-plus" aria-hidden="true"></i></div>
                </a>
            </div>
            <div class="card-body">
                <h5 class="card-title text-center">
                    {{ explode('-', $item['release_date'])[0] }}
                </h5>
                <div class="mid-2 agile_mid_2_home">
                    <p>Rate:</p>
                    @php
                    $rate = $item['vote_average'];
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
            @if (Auth::check())
            <div class="container">
                @if (! Illuminate\Support\Facades\DB::table('movies')->where([['user_id', auth()->id()], ['movie_id', $item['id']],])->exists())
                <form id="formF" method="POST" action="/movie/{{ $item['id'] }}/follow">
                    {{ csrf_field() }}
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-block btn-success">Seguir</button>
                    </div>
                </form>
                @else
                <form id="formU" method="POST" action="/movie/{{ $item['id'] }}/unfollow">
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
    @endif
    @endforeach
    @if (! $bandera)
    <div class="col-12 text-center top25 bottom25">
        <font size="4">
            <strong>
                No se ha encontrado nada.
            </strong>
        </font>
    </div>
    @endif
    <div class="col-12 top25">
        <h3 class="mb-4">
            Series
        </h3>
    </div>
    @php
    $bandera = false;
    @endphp
    @foreach ($results as $item)
    @if ($item['media_type'] == 'tv')
    @php
    $bandera = true;
    @endphp
    <div class="col-md-6 col-lg-4 col-xl-2 mb-4">
        <div class="card" style="width:200px">
            <div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
                <a href="{!! '/serie/' . $item['id'] !!}" class="hvr-shutter-out-horizontal" style="margin-left: -18px;">
                    <img class="card-img-top" src="{!! 'https://image.tmdb.org/t/p/w185' . $item['poster_path'] !!}" alt="Card image" style="width: 200px;height: 300px;" title="{!! $item['name'] !!}" />
                    <div class="w3l-action-icon"><i class="fas fa-plus" aria-hidden="true"></i></div>
                </a>
            </div>
            <div class="card-body">
                <h5 class="card-title text-center">
                    {{ explode('-', $item['first_air_date'])[0] }}
                </h5>
                <div class="mid-2 agile_mid_2_home">
                    <p>Rate:</p>
                    @php
                    $rate = $item['vote_average'];
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
            @if (Auth::check())
            <div class="container">
                @if (! Illuminate\Support\Facades\DB::table('series')->where([['user_id', auth()->id()], ['serie_id', $item['id']],])->exists())
                <form id="formF" method="POST" action="/serie/{{ $sitem['id'] }}/follow">
                    {{ csrf_field() }}
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-block btn-success">Seguir</button>
                    </div>
                </form>
                @else
                <form id="formU" method="POST" action="/serie/{{ $item['id'] }}/unfollow">
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
    @endif
    @endforeach
    @if (! $bandera)
    <div class="col-12 text-center top25 bottom25">
        <font size="4">
            <strong>
                No se ha encontrado nada.
            </strong>
        </font>
    </div>
    @endif
</section>
@endsection