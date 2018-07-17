@extends ('layouts.master', ['tipo' => 'Bienvenido'])

@section ('head')
@extends('layouts.head')
<link href="/css/jquery.slidey.min.css" rel="stylesheet">
<style>
    p {
        color: #fff;
        font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif;
    }

    a {
        color: #fff;
    }

    a:visited {
        color: #fff;
    }

    a:hover {
        color: #fff;
    }
</style>
@endsection

@section ('content')
<!--
<div style="margin-top: -2em;">
    <div id="slidey" style="display:none;">
        <ul>
            @for ($i = 0; $i < 3; $i++)
            <li><img src="{!! 'https://image.tmdb.org/t/p/w1280' . $movies[$i]['backdrop_path'] !!}" alt=" "><p class='title'><a href="{!! '/movie/' . $movies[$i]['id'] !!}">{{ $movies[$i]['title'] }}</a></p><p class='description'>{{ implode(' ', array_slice(explode(' ', $movies[$i]['overview']), 0, 30)) . '...' }}</p></li>
            @endfor
            @for ($i = 0; $i < 3; $i++)
            <li><img src="{!! 'https://image.tmdb.org/t/p/w1280' . $series[$i]['backdrop_path'] !!}" alt=" "><p class='title'><a href="{!! '/serie/' . $series[$i]['id'] !!}">{{ $series[$i]['name'] }}</a></p><p class='description'>{{ implode(' ', array_slice(explode(' ', $series[$i]['overview']), 0, 30)) . '...' }}</p></li>
            @endfor
        </ul>
    </div>
    <script src="/js/jquery.slidey.js"></script>
    <script src="/js/jquery.dotdotdot.min.js"></script>
    <script type="text/javascript">
        $("#slidey").slidey({
            interval: 8000,
            listCount: 5,
            autoplay: false,
            showList: true
        });
        $(".slidey-list-description").dotdotdot();
    </script>
</div>
-->
<section class="row">
    <div class="col-12 top25">
        <h3 class="mb-4">
            Peliculas Destacadas
        </h3>
    </div>
    <div id="owl-demo" class="owl-carousel owl-theme top5" style="background-color:#EEEEEE;">
        @for ($i = 3; $i < 15; $i++)
        <div class="item">
            <div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
                <a href="{!! '/movie/' . $movies[$i]['id'] !!}" class="hvr-shutter-out-horizontal"><img src="{!! 'https://image.tmdb.org/t/p/w185' . $movies[$i]['poster_path'] !!}" style="width: 200px;height: 300px;" class="img-responsive" alt=" " />
                    <div class="w3l-action-icon"><i class="fas fa-plus" aria-hidden="true"></i></div>
                </a>
                <div class="mid-1 agileits_w3layouts_mid_1_home">
                    <div class="w3l-movie-text">
                        <h6><a href="{!! '/movie/' . $movies[$i]['id'] !!}">{{ $movies[$i]['title'] }}</a></h6>
                    </div>
                    <div class="mid-2 agile_mid_2_home">
                        <p>{{ explode('-', $movies[$i]['release_date'])[0] }}</p>
                        <div class="block-stars">
                            @php
                            $rate = $movies[$i]['vote_average'];
                            $rate = ($rate * 5) / 10;
                            $rate = intval(round($rate));
                            @endphp
                            <ul class="w3l-ratings">

                              {{$movies[$i]['vote_average']}}
                                @for ($j = 0; $j < $rate; $j++)
                                <li><i class="fas fa-star" aria-hidden="true"></i></li>
                                @endfor
                                @for ($j = 0; $j < 5 - $rate; $j++)
                                <li><i class="far fa-star" aria-hidden="true"></i></li>
                                @endfor
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
    <div class="col-12 top25">
        <h3 class="mb-4">
            Series Destacadas
        </h3>
    </div>
    <div id="owl-demo1" class="owl-carousel owl-theme top5 bottom5" style="background-color:#EEEEEE;">
        @for ($i = 3; $i < 15; $i++)
        <div class="item">
            <div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
                <a href="{!! '/serie/' . $series[$i]['id'] !!}" class="hvr-shutter-out-horizontal"><img src="{!! 'https://image.tmdb.org/t/p/w185' . $series[$i]['poster_path'] !!}" style="width: 200px;height: 300px;" class="img-responsive" alt=" " />
                    <div class="w3l-action-icon"><i class="fas fa-plus" aria-hidden="true"></i></div>
                </a>
                <div class="mid-1 agileits_w3layouts_mid_1_home">
                    <div class="w3l-movie-text">
                        <h6><a href="{!! '/serie/' . $series[$i]['id'] !!}">{{ $series[$i]['name'] }}</a></h6>
                    </div>
                    <div class="mid-2 agile_mid_2_home">
                        <p>{{ explode('-', $series[$i]['first_air_date'])[0] }}</p>
                        <div class="block-stars">
                            @php
                            $rate = $series[$i]['vote_average'];
                            $rate = ($rate * 5) / 10;
                            $rate = intval(round($rate));
                            @endphp
                            <ul class="w3l-ratings">
                              {{$series[$i]['vote_average']}}
                                @for ($j = 0; $j < $rate; $j++)
                                <li><i class="fas fa-star" aria-hidden="true"></i></li>
                                @endfor
                                @for ($j = 0; $j < 5 - $rate; $j++)
                                <li><i class="far fa-star" aria-hidden="true"></i></li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endfor
    </div>
    <script>
        $("#owl-demo1").owlCarousel({
            autoPlay: 4000, //Set AutoPlay to 3 seconds
            items : 5,
            itemsDesktop : [640,4],
            itemsDesktopSmall : [414,3]
        });
    </script>
</section>
@endsection
