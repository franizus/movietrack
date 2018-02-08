@extends ('layouts.master', ['tipo' => 'Peliculas'])

@section ('head')
@extends('layouts.head')
@endsection

@section ('content')
<section class="row">
    <div class="col-12">
        <h3 class="mb-4">
            @switch($type)
                @case('popular')
                    Populares
                    @break
                @case('now_playing')
                    En Cartelera
                    @break
                @case('top_rated')
                    Mejor Calificadas
                    @break
                @case('upcoming')
                    Proximas
                    @break
                @default
            @endswitch
        </h3>
    </div>
    @foreach ($movies as $movie)
    <div class="col-sm-3 mb-4">
        <div class="card" style="width:250px">
            <img class="card-img-top" src="{!! 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] !!}" alt="Card image" style="width:100%">
            <div class="card-body">
                <h4 class="card-title">{{ $movie['title'] }}</h4>
                <p class="card-text">Rating: {{ $movie['vote_average'] }}</p>
                <a class="btn btn-primary btn-block" onclick="location.href='{!! '/movie/' . $movie['id'] !!}'">Ver mas</a>
                <a class="btn btn-success btn-block text-white" onclick="">Seguir</a>
            </div>
        </div>
    </div>
    @endforeach
</section>
@endsection