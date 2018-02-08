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
                <a class="btn btn-primary btn-block" onclick="openModal('{!! 'myModal' . $movie['id'] !!}')">Ver mas</a>
                <a class="btn btn-success btn-block text-white" onclick="">Seguir</a>
            </div>
        </div>
    </div>
    <div id="{!! 'myModal' . $movie['id'] !!}" class="modalmy">
        <div class="modalmy-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ $movie['title'] }}</h4>
                <button type="button" class="close" onclick="getElementById('{!! 'myModal' . $movie['id'] !!}').style.display ='none';">&times;</button>
            </div>
            <div class="container">
                <img src="{!! 'https://image.tmdb.org/t/p/w500' . $movie['backdrop_path'] !!}" width="100%">
                <div class="row top5">
                    <div class="col-4 text-right padding5">
                        <b>Fecha de Estreno:</b>
                    </div>
                    <div class="col text-justify padding15">
                    {{ $movie['release_date'] }}
                    </div>
                </div>
                <div class="row top5">
                    <div class="col-4 text-right padding5">
                        <b>Sinopsis:</b>
                    </div>
                    <div class="col text-justify padding15">
                    {{ $movie['overview'] }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</section>
@endsection

@section ('script')
<script>
    function openModal(modale) 
    {
        var modal = document.getElementById(modale);
        modal.style.display = "block";
        window.onclick = function (event) 
        {
            if (event.target == modal) 
            {
                modal.style.display = "none";
            }
        }
    }
</script>
@endsection