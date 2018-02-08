@extends ('layouts.master', ['tipo' => 'Peliculas']) 

@section ('head')
@extends('layouts.head')
<style>
    .modal-content {
        width: 730px;
    }
</style>
@endsection

@section ('content')
<section class="row">
    <div class="col-10">
        <h3 class="mb-4">
            {{ $movie['original_title'] . ' (' . explode('-', $movie['release_date'])[0] . ')' }}
        </h3>
    </div>
    <div class="col-sm-2">
        <h3 class="mb-4">
            <a class="btn btn-success btn-block text-white" onclick="">Seguir</a>
        </h3>
    </div>
    <div class="col-sm-3 mb-4">
        <img src="{!! 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] !!}" height="450px">
    </div>
    <div class="col-sm mb-4">
        <strong>Resumen</strong>
        <p>{{ $movie['overview'] }}</p>
        <strong>Fecha de estreno</strong>
        <p>{{ $movie['release_date'] }}</p>
        <strong>Pagina web oficial</strong>
        <p><a href="{!! $movie['homepage'] !!}" target="_blank">{{ $movie['homepage'] }}</a></p>
        <strong>Generos</strong>
        <p>
            @foreach ($movie['genres'] as $genre)
                {{ $genre['name'] }}, 
            @endforeach
        </p>
        <strong>Paises</strong>
        <p>
            @foreach ($movie['production_countries'] as $pais)
                {{ $pais['name'] }}, 
            @endforeach
        </p>
        <strong>Presupuesto</strong>
        <p>&dollar; {{ $movie['budget'] }}</p>
        @if (isset($trailer['results']))
            <a class="btn btn-primary btn-block" onclick="changeVideo('{!! $trailer['results'][0]['key'] !!}')">ver Trailer</a>
        @endif
    </div>
    @if ($similar)
        <br></br>
        <div class="col-12">
            <h3 class="mb-4">
                Peliculas Similares
            </h3>
        </div>
        <?php $var = 0; ?>
        @foreach ($similar as $movieS)
        <?php $var += 1; ?>
        <div class="col-sm-3 mb-4">
            <div class="card" style="width:250px">
                <img class="card-img-top" src="{!! 'https://image.tmdb.org/t/p/w500' . $movieS['poster_path'] !!}" alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">{{ $movieS['title'] }}</h4>
                    <p class="card-text">Rating: {{ $movieS['vote_average'] }}</p>
                    <a class="btn btn-primary btn-block" onclick="location.href='{!! '/movie/' . $movieS['id'] !!}'">mas</a>
                </div>
            </div>
        </div>
        @if ($var == 8)
            @break
        @endif
        @endforeach
    @endif
    
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-body">
                <iframe id="iframeYoutube" width="700" height="315"  src="https://www.youtube.com/embed/{!! $trailer['results'][0]['key'] !!}" frameborder="0" allowfullscreen></iframe> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section ('script')
<script>
    $(document).ready(function(){
        $("#myModal").on("hidden.bs.modal",function(){
            $("#iframeYoutube").attr("src","#");
        })
    })
          
    function changeVideo(vId){
        var iframe=document.getElementById("iframeYoutube");
        iframe.src="https://www.youtube.com/embed/"+vId;
          
        $("#myModal").modal("show");
    }
</script>
@endsection