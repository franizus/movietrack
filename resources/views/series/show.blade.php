@extends ('layouts.master', ['tipo' => 'Series']) 

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
            {{ $serie['name'] . ' (' . explode('-', $serie['first_air_date'])[0] . ')' }}
        </h3>
    </div>
    @if (Auth::check())
    <div class="col-sm-2">
        <h3 class="mb-4">
            @if (! Illuminate\Support\Facades\DB::table('series')->where([['user_id', auth()->id()], ['serie_id', $id],])->exists())
            <form method="POST" action="/serie/{{ $id }}/follow">
                {{ csrf_field() }}
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-block btn-success">Seguir</button>
                </div>
            </form>
            @else
            <form method="POST" action="/serie/{{ $id }}/unfollow">
                {{ csrf_field() }}
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-block btn-danger"> Dejar de Seguir</button>
                </div>
            </form>
            @endif
        </h3>
    </div>
    @endif
    @if (isset($trailer['results']))
    <div class="col-sm-3 mb-4 w3l-movie-gride-agile w3l-movie-gride-agile1">
        <a href="javascript:changeVideo('{!! $trailer['results'][0]['key'] !!}')" class="hvr-shutter-out-horizontal">
            <img src="{!! 'https://image.tmdb.org/t/p/w500' . $serie['poster_path'] !!}" height="450px" class="img-responsive" />
            <div class="w3l-action-icon"><i class="fas fa-video" aria-hidden="true"></i></div>
        </a>
    </div>
    @else
    <div class="col-sm-3 mb-4">
        <img src="{!! 'https://image.tmdb.org/t/p/w500' . $serie['poster_path'] !!}" height="450px"/>
    </div>
    @endif
    <div class="col-sm mb-4">
        <strong>Resumen</strong>
        <p>{{ $serie['overview'] }}</p>
        <strong>Fecha primer episodio</strong>
        <p>{{ $serie['first_air_date'] }}</p>
        @if ($serie['homepage'] != '')
        <strong>Pagina web oficial</strong>
        <p><a href="{!! $serie['homepage'] !!}" target="_blank">{{ $serie['homepage'] }}</a></p>
        @endif
        <strong>Generos</strong>
        <p>
            @foreach ($serie['genres'] as $genre)
            {{ $genre['name'] }}, 
            @endforeach
        </p>
        <strong>Creado por</strong>
        <p>
            <ul style="margin-left: 2em;">
                @foreach ($serie['created_by'] as $created)
                <li style="color:#7c7c7c">{{ $created['name'] }}</li>
                @endforeach
            </ul>
        </p>
    </div>
    <div class="col-12 top25">
        <h3 class="mb-4">
            Temporadas
        </h3>
    </div>
    @foreach ($serie['seasons'] as $season)
    <div class="col-sm-2 mb-4">
        <div class="card" style="width:200px">
            <div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
                <a href="{!! '/serie/' . $id . '/' . $season['season_number'] !!}" class="hvr-shutter-out-horizontal" style="margin-left: -18px;">
                    <img class="card-img-top" src="{!! 'https://image.tmdb.org/t/p/w500' . $season['poster_path'] !!}" alt="Card image" style="width: 200px;height: 300px;">
                    <div class="w3l-action-icon"><i class="fas fa-expand" aria-hidden="true"></i></div>
                </a>
            </div>
            <div class="card-body">
                @if ($season['season_number'] > 0)
                <h5 class="card-title">Temporada {{ $season['season_number'] }}</h5>
                @else
                <h5 class="card-title">Especiales</h5>
                @endif
                <p class="card-text">{{ $season['episode_count'] }} Episodios</p>
            </div>
        </div>
    </div>
    @endforeach
    <div class="col-12 top25">
        <h3 class="mb-4">
            Comentarios
        </h3>
        <div class="container">
            <ul class="list-group">
                @foreach ($comments as $comment)
                <li class="list-group-item">
                    <font size="4">
                        <strong>
                            @php
                            $user = Illuminate\Support\Facades\DB::table('users')->where('id', $comment->user_id)->first();
                            Carbon\Carbon::setLocale('es');
                            @endphp
                            <u><span title="{{ $user->email }}">{{ $user->name }}</span></u>
                            {{ ' ' . Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}:
                        </strong>
                        {{ $comment->body }}
                    </font>
                </li>
                @endforeach
            </ul>
            @if (Auth::check())
            <div class="card" style="padding:2em;margin-top: -2em;padding-bottom:1em;">
                <div class="card-block">
                    <form method="POST" action="/serie/{{ $id }}/comments">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea class="form-control" name="body" placeholder="Ingrese su comentario" required></textarea>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Agregar Comentario</button>
                        </div>
                    </form>
                </div>
            </div>
            @else
            <div class="text-center" style="margin-top: -2em;">
                <font size="4">
                    <strong>
                        Por favor <a href="/login">ingrese</a> o <a href="/register">registrese</a> para comentar.
                    </strong>
                </font>
            </div>
            @endif
        </div>
    </div>
    @if ($similar)
    <div class="col-12 top25">
        <h3 class="mb-4">
            Series Similares
        </h3>
    </div>
    <div id="owl-demo" class="owl-carousel owl-theme top5 bottom5" style="background-color:#EEEEEE;">
        @for ($i = 0; $i < sizeof($similar); $i++)
        <div class="item">
            <div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
                <a href="{!! '/serie/' . $similar[$i]['id'] !!}" class="hvr-shutter-out-horizontal"><img src="{!! 'https://image.tmdb.org/t/p/w185' . $similar[$i]['poster_path'] !!}" style="width: 200px;height: 300px;" class="img-responsive" alt=" " />
                    <div class="w3l-action-icon"><i class="fas fa-plus" aria-hidden="true"></i></div>
                </a>
                <div class="mid-1 agileits_w3layouts_mid_1_home">
                    <div class="w3l-movie-text">
                        <h6><a href="{!! '/serie/' . $similar[$i]['id'] !!}">{{ $similar[$i]['name'] }}</a></h6>
                    </div>
                    <div class="mid-2 agile_mid_2_home">
                        <p>{{ explode('-', $similar[$i]['first_air_date'])[0] }}</p>
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