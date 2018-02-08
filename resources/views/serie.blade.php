@extends ('layouts.master', ['tipo' => 'Series']) 

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
    <div class="col-12">
        <h3 class="mb-4">
            {{ $serie['name'] . ' (' . explode('-', $serie['first_air_date'])[0] . ')' }}
        </h3>
    </div>
    <div class="col-sm-3 mb-4">
        <img src="{!! 'https://image.tmdb.org/t/p/w500' . $serie['poster_path'] !!}" height="450px">
    </div>
    <div class="col-sm mb-4">
        <strong>Resumen</strong>
        <p>{{ $serie['overview'] }}</p>
        <strong>Fecha primer episodio</strong>
        <p>{{ $serie['first_air_date'] }}</p>
        <strong>Pagina web oficial</strong>
        <p><a href="{!! $serie['homepage'] !!}" target="_blank">{{ $serie['homepage'] }}</a></p>
        <strong>Generos</strong>
        <p>
            @foreach ($serie['genres'] as $genre)
                {{ $genre['name'] }}, 
            @endforeach
        </p>
        <strong>Creado por</strong>
        <ul>
            @foreach ($serie['created_by'] as $created)
                <li>{{ $created['name'] }}</li>
            @endforeach
        </ul>
        @if (isset($trailer['results']))
            <a class="btn btn-primary btn-block" onclick="changeVideo('{!! $trailer['results'][0]['key'] !!}')">ver Trailer</a>
        @endif
    </div>
    <div class="col-12">
        <h3 class="mb-4">
            Temporadas
        </h3>
    </div>
    @foreach ($serie['seasons'] as $season)
    <div class="col-sm-2 mb-4">
        <div class="card" style="width:200px">
            <img class="card-img-top" src="{!! 'https://image.tmdb.org/t/p/w500' . $season['poster_path'] !!}" alt="Card image" style="width:100%">
            <div class="card-body">
                @if ($season['season_number'] > 0)
                    <h4 class="card-title">Temporada {{ $season['season_number'] }}</h4>
                @else
                    <h4 class="card-title">Especiales</h4>
                @endif
                <p class="card-text">No. de Episodios: {{ $season['episode_count'] }}</p>
            </div>
        </div>
    </div>
    @endforeach

    <br></br>
    <div class="col-12">
        <h3 class="mb-4">
            Series Similares
        </h3>
    </div>
    <?php $var = 0; ?>
    @foreach ($similar as $serieS)
    <?php $var += 1; ?>
    <div class="col-sm-3 mb-4">
        <div class="card" style="width:250px">
            <img class="card-img-top" src="{!! 'https://image.tmdb.org/t/p/w500' . $serieS['poster_path'] !!}" alt="Card image" style="width:100%">
            <div class="card-body">
                <h4 class="card-title">{{ $serieS['original_name'] }}</h4>
                <p class="card-text">Rating: {{ $serieS['vote_average'] }}</p>
                <a class="btn btn-primary btn-block" onclick="location.href='{!! '/serie/' . $serieS['id'] !!}'">mas</a>
            </div>
        </div>
    </div>
    @if ($var == 8)
        @break
    @endif
    @endforeach

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-body">
                <iframe id="iframeYoutube" width="700" height="315"  src="https://www.youtube.com/embed/e80BbX05D7Y" frameborder="0" allowfullscreen></iframe> 
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