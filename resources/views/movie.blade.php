@extends ('layouts.master', ['tipo' => 'Peliculas']) 

@section ('head')
@extends('layouts.head')
<style>
    .modal-content {
        width: 730px;
    }
    
    p {
        display: block;
        margin-top: 1em;
        margin-bottom: 1em;
        margin-left: 0;
        margin-right: 0;
    }
</style>
@endsection

@section ('content')
<section class="row" style="margin-top: -2em;">
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
    @if (isset($trailer['results']))
    <div class="col-sm-3 mb-4 w3l-movie-gride-agile w3l-movie-gride-agile1">
        <a href="javascript:changeVideo('{!! $trailer['results'][0]['key'] !!}')" class="hvr-shutter-out-horizontal">
            <img src="{!! 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] !!}" height="450px" class="img-responsive" />
            <div class="w3l-action-icon"><i class="fas fa-video" aria-hidden="true"></i></div>
        </a>
    </div>
    @else
    <div class="col-sm-3 mb-4">
        <img src="{!! 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] !!}" height="450px"/>
    </div>
    @endif
    <div class="col-sm mb-4">
        <strong>Resumen</strong>
        <p>{{ $movie['overview'] }}</p>
        <strong>Fecha de estreno</strong>
        <p>{{ $movie['release_date'] }}</p>
        @if ($movie['homepage'] != '')
        <strong>Pagina web oficial</strong>
        <p><a href="{!! $movie['homepage'] !!}" target="_blank">{{ $movie['homepage'] }}</a></p>
        @endif
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
    </div>
    @if ($similar)
    <br></br>
    <div class="col-12 top25">
        <h3 class="mb-4">
            Peliculas Similares
        </h3>
    </div>
    <div id="owl-demo" class="owl-carousel owl-theme top5 bottom5" style="background-color:#EEEEEE;">
        @for ($i = 0; $i < sizeof($similar); $i++)
        <div class="item">
            <div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
                <a href="{!! '/movie/' . $similar[$i]['id'] !!}" class="hvr-shutter-out-horizontal"><img src="{!! 'https://image.tmdb.org/t/p/w185' . $similar[$i]['poster_path'] !!}" style="width: 200px;height: 300px;" class="img-responsive" alt=" " />
                    <div class="w3l-action-icon"><i class="fas fa-plus" aria-hidden="true"></i></div>
                </a>
                <div class="mid-1 agileits_w3layouts_mid_1_home">
                    <div class="w3l-movie-text">
                        <h6><a href="{!! '/movie/' . $similar[$i]['id'] !!}">{{ $similar[$i]['title'] }}</a></h6>
                    </div>
                    <div class="mid-2 agile_mid_2_home">
                        <p>{{ explode('-', $similar[$i]['release_date'])[0] }}</p>
                        <div class="block-stars">
                            @php
                            $rate = $similar[$i]['vote_average'];
                            $rate = ($rate * 5) / 10;
                            $rate = intval(round($rate));
                            @endphp
                            <ul class="w3l-ratings">
                                <li><i class="fas fa-star" aria-hidden="true"></i></li>
                                <li><i class="fas fa-star" aria-hidden="true"></i></li>
                                <li><i class="fas fa-star" aria-hidden="true"></i></li>
                                <li><i class="far fa-star" aria-hidden="true"></i></li>
                                <li><i class="far fa-star" aria-hidden="true"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endfor        
    </div>
    <script src="/js/owl.carousel.js"></script>
    <script>
        $("#owl-demo").owlCarousel({
            autoPlay: 3000, //Set AutoPlay to 3 seconds
            items : 5,
            itemsDesktop : [640,4],
            itemsDesktopSmall : [414,3]
        });
    </script> 
    @endif
    
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: #272727;">
                <div class="modal-body">
                    <iframe id="iframeYoutube" width="700" height="415"  src="https://www.youtube.com/embed/{!! $trailer['results'][0]['key'] !!}" frameborder="0" allowfullscreen></iframe> 
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