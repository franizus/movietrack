@extends ('layouts.master', ['tipo' => 'Bienvenido'])

@section ('head')
@extends('layouts.head')
@endsection

@section ('content')
<section class="row">
    <div class="col-12">
        <h3 class="mb-4">
            Peliculas Destacadas
        </h3>
    </div>
    <?php $var = 0; ?>
    @foreach ($movies as $movie)
    <?php $var += 1; ?>
    <div class="col-sm-2 mb-2">
        <div class="card" style="width:200px">
            <img class="card-img-top" src="{!! 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] !!}" alt="Card image" style="width:100%">
            <div class="card-body">
                <h4 class="card-title">{{ $movie['title'] }}</h4>
                <a class="btn btn-primary btn-block" onclick="location.href='{!! '/movie/' . $movie['id'] !!}'">Ver mas</a>
            </div>
        </div>
    </div>
    @if ($var == 6)
        @break
    @endif
    @endforeach
    <div class="col-12">
        <h3 class="mb-4">
            Series Destacadas
        </h3>
    </div>
    <?php $var = 0; ?>
    @foreach ($series as $serie)
    <?php $var += 1; ?>
    <div class="col-sm-2 mb-4">
        <div class="card" style="width:200px">
            <img class="card-img-top" src="{!! 'https://image.tmdb.org/t/p/w500' . $serie['poster_path'] !!}" alt="Card image" style="width:100%">
            <div class="card-body">
                <h4 class="card-title">{{ $serie['original_name'] }}</h4>
                <a class="btn btn-primary btn-block" onclick="location.href='{!! '/serie/' . $serie['id'] !!}'">mas</a>
            </div>
        </div>
    </div>
    @if ($var == 6)
        @break
    @endif
    @endforeach
</section>
@endsection