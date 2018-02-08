<!DOCTYPE html>
<html lang="en">
<head>
	@yield('head')
</head>
<body>
	<div class="container-fluid" id="wrapper">
		<div class="row">
			<nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2 bg-faded sidebar-style-1">
				<h1 class="site-title"><a href="/"><img src="/img/trakt.png" width=25px> Movie.Track</a></h1>

				<a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><em class="fas fa-bars"></em></a>
				
				<ul class="nav nav-pills flex-column sidebar-nav">
					<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
						<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents">
							<em class="fas fa-film"></em> Peliculas
						</a>
						<ul class="sidenav-second-level collapse" id="collapseComponents">
							<li>
								<a href="/movies/popular">Populares</a>
							</li>
							<li>
								<a href="/movies/top_rated">Mejor Calificadas</a>
							</li>
							<li>
								<a href="/movies/upcoming">Proximas</a>
							</li>
							<li>
								<a href="/movies/now_playing">En Cartelera</a>
							</li>
						</ul>
					</li>
					<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
						<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents1">
							<em class="fas fa-tv"></em> Series
						</a>
						<ul class="sidenav-second-level collapse" id="collapseComponents1">
							<li>
								<a href="/series/popular">Populares</a>
							</li>
							<li>
								<a href="/series/top_rated">Mejor Calificadas</a>
							</li>
							<li>
								<a href="/series/airing_today">Al aire hoy</a>
							</li>
							<li>
								<a href="/series/on_the_air">Actualmente en TV</a>
							</li>
						</ul>
					</li>
				</ul>
				@if (! Auth::check())
					<a href="/login" class="logout-button d-none d-md-block"><em class="fas fa-sign-in-alt"></em> Login</a>
				@endif
			</nav>
			
			<main class="col-xs-12 col-sm-8 offset-sm-4 col-lg-9 offset-lg-3 col-xl-10 offset-xl-2 pt-3 pl-4" style="background-color:#EEEEEE;">
				<header class="page-header row">
					@if (!Auth::check())
					<div class="dropdown user-dropdown col-md-6 col-lg-4 text-center text-md-right d-block d-sm-none">
						<a href="/login" class="btn btn-stripped id="menu-toggle""><em class="fas fa-sign-in-alt"></em> Login</a>
					</div>
					@endif
					<div class="col-md-6 col-lg-8">
						<h1 class="float-left text-center text-md-left">{{ $tipo }}</h1>
					</div>
					@if (Auth::check())
					<div class="dropdown user-dropdown col-md-6 col-lg-4 text-center text-md-right">
						<a class="btn btn-stripped dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
							aria-expanded="false">
							<div class="username mt-1">
								<h4 class="mb-1">{{ Auth::user()->name }}</h4>
							</div>
						</a>

						<div class="dropdown-menu dropdown-menu-right" style="margin-right: 1.5rem;" aria-labelledby="dropdownMenuLink">
							<a class="dropdown-item" href="/logout">
								<em class="fa fa-power-off mr-1"></em> Logout</a>
						</div>
					</div>
					@endif
					<div class="clear"></div>
				</header>
				
				@yield('content')
			</main>

        </div>
	</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="/js/bootstrap-datepicker.js"></script>
    <script src="/js/custom.js"></script>
	@yield('script')
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    
</body>
</html>