@extends ('layout')

@section ('style')
<style>
    .modalmy {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        padding-left: 250px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    .modalmy-content {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
            flex-direction: column;
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 60%;
        border-radius: 0.3rem;
        background-clip: padding-box;
        outline: 0;
    }

    .top5 {
      margin-top:15px;
    }

    .padding5 {
      padding-right: 45px;
    }

    .padding15 {
      padding-left: 0px;
    }
</style>
@endsection

@section ('content')
<header class="page-header row justify-center">
    <div class="col-md-6 col-lg-8">
        <h1 class="float-left text-center text-md-left">Peliculas</h1>
    </div>

    <div class="dropdown user-dropdown col-md-6 col-lg-4 text-center text-md-right">
        <a class="btn btn-stripped dropdown-toggle" href="https://example.com" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <div class="username mt-1">
                <h4 class="mb-1">Username</h4>
            </div>
        </a>

        <div class="dropdown-menu dropdown-menu-right" style="margin-right: 1.5rem;" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="/logout">
                <em class="fa fa-power-off mr-1"></em> Logout</a>
        </div>
    </div>

    <div class="clear"></div>
</header>
<section class="row">
    <div class="col-12">
        <h3 class="mb-4">Mas Populares</h3>
    </div>
    @foreach ($movies as $movie)
    <div class="col-3 mb-4">
        <div class="card" style="width:250px">
            <img class="card-img-top" src="{!! 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] !!}" alt="Card image" style="width:100%">
            <div class="card-body">
                <h4 class="card-title">{{ $movie['title'] }}</h4>
                <p class="card-text">Rating: {{ $movie['vote_average'] }}</p>
                <a class="btn btn-primary" onclick="openModal('{!! 'myModal' . $movie['id'] !!}')">Ver mas</a>
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