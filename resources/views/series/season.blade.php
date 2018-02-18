@extends ('layouts.master', ['tipo' => 'Series']) 

@section ('head')
@extends('layouts.head')
<style>
    p {
        display: block;
        margin-top: 1em;
        margin-bottom: 1em;
        margin-left: 0;
        margin-right: 0;
    }
</style>
@endsection

@section('content')
<section class="row" style="margin-top: -2em;">
    <div class="col-10">
        <h3 class="mb-4">
            @if ($seasons['season_number'] > 0)
            @php
            $temp = ' - Temporada ' . $seasons['season_number'];
            @endphp
            @else
            @php
            $temp = ' - Especiales';
            @endphp
            @endif
            {{ $name . $temp }}
        </h3>
    </div>
    <div class="col-sm-2">
        <h3 class="mb-4">
            <a class="btn btn-danger btn-block text-white" href="{!! '/serie/' . $id !!}">Regresar</a>
        </h3>
    </div>
    @if ($seasons['overview'] != '')
    <div class="col-12">
        <h3 class="mb-4">
            <font size="3">{{ $seasons['overview'] }}</font>
        </h3>
    </div>
    @endif
    @foreach ($seasons['episodes'] as $episode)
    <div class="container py-3">
        <div class="card">
            <div class="row ">
                <div class="col-md-4">
                    <img src="{!! 'https://image.tmdb.org/t/p/w342' . $episode['still_path'] !!}" class="w-100">
                </div>
                <div class="col-md-8 px-3">
                    <div class="card-block px-3">
                        <h4 class="card-title top5">{{ $season . 'x' . $episode['episode_number'] . ' ' . $episode['name'] }}</h4>
                        <p class="card-text">{{ $episode['overview'] }}</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    @endforeach
    
</section>
@endsection