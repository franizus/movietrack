<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Por favor ingrese nombre de usuario.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Por favor ingrese contraseña.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT user, pwd FROM usuario WHERE user = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['username'] = $username;      
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'La contraseña que ingreso no es valida.';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'No existe cuenta con ese usuario.';
                }
            } else{
                echo "Algo salio mal intente mas tarde.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    	<head>
		<title>Movie Track!</title>
		<!-- for-mobile-apps -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="One Movies Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
		<script type="application/x-javascript">
			addEventListener("load", function () {
				setTimeout(hideURLbar, 0);
			}, false);

			function hideURLbar() {
				window.scrollTo(0, 1);
			}
		</script>
		<!-- //for-mobile-apps -->
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
		<link href="css/single.css" rel='stylesheet' type='text/css' />
		<link href="css/medile.css" rel='stylesheet' type='text/css' />
		<!-- banner-slider -->
		<link href="css/jquery.slidey.min.css" rel="stylesheet">
		<!-- //banner-slider -->
		<!-- pop-up -->
		<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
		<!-- //pop-up -->
		<!-- font-awesome icons -->
		<link rel="stylesheet" href="css/font-awesome.min.css" />
		<!-- //font-awesome icons -->
		<!-- js -->
		<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
		<!-- //js -->
		<!-- start-smoth-scrolling -->
		<script type="text/javascript" src="js/move-top.js"></script>
		<script type="text/javascript" src="js/easing.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				$(".scroll").click(function (event) {
					event.preventDefault();
					$('html,body').animate({
						scrollTop: $(this.hash).offset().top
					}, 1000);
				});
			});
		</script>
		<!-- start-smoth-scrolling -->
	</head>
    // Close connection
    mysqli_close($link);
}
?>

	<!DOCTYPE html>
	<html lang="en">



	<body>
		<!-- header -->
		<div class="header">
			<div class="container">
				<div class="w3layouts_logo">
					<a href="index.html">
						<h1>Movie
							<span>Track</span>
						</h1>
					</a>
				</div>
				<div class="w3_search">
					<form action="#" method="post">
						<input type="text" name="Search" placeholder="Search" required="">
						<input type="submit" value="Go">
					</form>
				</div>
				<div class="w3l_sign_in_register">
					<ul>
						<li>
							<a href="#" data-toggle="modal" data-target="#myModal">Ingreso</a>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<!-- //header -->
		<!-- bootstrap-pop-up -->
		<div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						Ingreso
						<button id="closemodal" type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<section>
						<div class="modal-body">
							<div class="w3_login_module">
								<div class="module form-module">
									<div>
										<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
											<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
												<input type="text" name="username" placeholder="Usuario" value="<?php echo $username; ?>" required>
												<span class="help-block">
													<?php echo $username_err; ?>
												</span>
											</div>
											<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
												<input type="password" name="password" placeholder="Contraseña" class="form-control" required>
												<span class="help-block">
													<?php echo $password_err; ?>
												</span>
											</div>
											<input type="submit" value="Ingresar">
										</form>
									</div>
									<div class="cta1">
										<a href="registro.html">Registrarse</a>
									</div>
									<div class="cta">
										<a href="#">¿Olvidaste tu contraseña?</a>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
		<script>
			$('.toggle').click(function () {
				// Switches the Icon
				$(this).children('i').toggleClass('fa-pencil');
				// Switches the forms  
				$('.form').animate({
					height: "toggle",
					'padding-top': 'toggle',
					'padding-bottom': 'toggle',
					opacity: "toggle"
				}, "slow");
			});
		</script>
		<!-- //bootstrap-pop-up -->
		<!-- nav -->
		<div class="movies_nav">
			<div class="container">
				<nav class="navbar navbar-default">
					<div class="navbar-header navbar-left">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
						<nav>
							<ul class="nav navbar-nav">
								<li class="active">
									<a href="index.html">Inicio</a>
								</li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Generos
										<b class="caret"></b>
									</a>
									<ul class="dropdown-menu multi-column columns-3">
										<li>
											<div class="col-sm-4">
												<ul class="multi-column-dropdown">
													<li>
														<a href="#">Accion</a>
													</li>
													<li>
														<a href="#">Crimen</a>
													</li>
													<li>
														<a href="#">Familiar</a>
													</li>
													<li>
														<a href="#">Horror</a>
													</li>
													<li>
														<a href="#">Romance</a>
													</li>
													<li>
														<a href="#">Deportes</a>
													</li>
													<li>
														<a href="#">Guerra</a>
													</li>
												</ul>
											</div>
											<div class="col-sm-4">
												<ul class="multi-column-dropdown">
													<li>
														<a href="#">Aventura</a>
													</li>
													<li>
														<a href="#">Comedia</a>
													</li>
													<li>
														<a href="#">Documentales</a>
													</li>
													<li>
														<a href="#">Fantasia</a>
													</li>
													<li>
														<a href="#">Suspenso</a>
													</li>
												</ul>
											</div>
											<div class="col-sm-4">
												<ul class="multi-column-dropdown">
													<li>
														<a href="#">Animacion</a>
													</li>
													<li>
														<a href="#">Drama</a>
													</li>
													<li>
														<a href="#">Historia</a>
													</li>
													<li>
														<a href="#">Musical</a>
													</li>
												</ul>
											</div>
											<div class="clearfix"></div>
										</li>
									</ul>
								</li>
								<li>
									<a href="#">Series</a>
								</li>
								<li>
									<a href="#">A - Z Todas</a>
								</li>
							</ul>
						</nav>
					</div>
				</nav>
			</div>
		</div>
		<!-- //nav -->
		<!-- general -->
		<div class="general">
			<h4 class="latest-text w3_latest_text">Peliculas Destacadas</h4>
			<div class="container">
				<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
					<ul id="myTab" class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active">
							<a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Destacadas</a>
						</li>
						<li role="presentation">
							<a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Mas Vistas</a>
						</li>
						<li role="presentation">
							<a href="#rating" id="rating-tab" role="tab" data-toggle="tab" aria-controls="rating" aria-expanded="true">Mejor Rating</a>
						</li>
						<li role="presentation">
							<a href="#imdb" role="tab" id="imdb-tab" data-toggle="tab" aria-controls="imdb" aria-expanded="false">Recien Agregadas</a>
						</li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
							<div class="w3_agile_featured_movies">
								<div class="col-md-2 w3l-movie-gride-agile">
									<a href="#" class="hvr-shutter-out-horizontal">
										<img src="images/m15.jpg" title="album-name" class="img-responsive" alt=" " />
										<div class="w3l-action-icon">
											<i class="fa fa-bars" aria-hidden="true"></i>
										</div>
									</a>
									<div class="mid-1 agileits_w3layouts_mid_1_home">
										<div class="w3l-movie-text">
											<h6>
												<a href="#">God’s Compass</a>
											</h6>
										</div>
										<div class="mid-2 agile_mid_2_home">
											<p>2016</p>
											<div class="block-stars">
												<ul class="w3l-ratings">
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-half-o" aria-hidden="true"></i>
														</a>
													</li>
												</ul>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<div class="ribben">
										<p>Nueva</p>
									</div>
								</div>
								<div class="col-md-2 w3l-movie-gride-agile">
									<a href="#" class="hvr-shutter-out-horizontal">
										<img src="images/m2.jpg" title="album-name" class="img-responsive" alt=" " />
										<div class="w3l-action-icon">
											<i class="fa fa-bars" aria-hidden="true"></i>
										</div>
									</a>
									<div class="mid-1 agileits_w3layouts_mid_1_home">
										<div class="w3l-movie-text">
											<h6>
												<a href="#">Bad Moms</a>
											</h6>
										</div>
										<div class="mid-2 agile_mid_2_home">
											<p>2016</p>
											<div class="block-stars">
												<ul class="w3l-ratings">
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-o" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-o" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-o" aria-hidden="true"></i>
														</a>
													</li>
												</ul>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<div class="col-md-2 w3l-movie-gride-agile">
									<a href="#" class="hvr-shutter-out-horizontal">
										<img src="images/m5.jpg" title="album-name" class="img-responsive" alt=" " />
										<div class="w3l-action-icon">
											<i class="fa fa-bars" aria-hidden="true"></i>
										</div>
									</a>
									<div class="mid-1 agileits_w3layouts_mid_1_home">
										<div class="w3l-movie-text">
											<h6>
												<a href="#">Jason Bourne</a>
											</h6>
										</div>
										<div class="mid-2 agile_mid_2_home">
											<p>2016</p>
											<div class="block-stars">
												<ul class="w3l-ratings">
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-half-o" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-o" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-o" aria-hidden="true"></i>
														</a>
													</li>
												</ul>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<div class="ribben">
										<p>Nueva</p>
									</div>
								</div>
								<div class="col-md-2 w3l-movie-gride-agile">
									<a href="#" class="hvr-shutter-out-horizontal">
										<img src="images/m16.jpg" title="album-name" class="img-responsive" alt=" " />
										<div class="w3l-action-icon">
											<i class="fa fa-bars" aria-hidden="true"></i>
										</div>
									</a>
									<div class="mid-1 agileits_w3layouts_mid_1_home">
										<div class="w3l-movie-text">
											<h6>
												<a href="#">Rezort</a>
											</h6>
										</div>
										<div class="mid-2 agile_mid_2_home">
											<p>2016</p>
											<div class="block-stars">
												<ul class="w3l-ratings">
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-half-o" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-o" aria-hidden="true"></i>
														</a>
													</li>
												</ul>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<div class="ribben">
										<p>Nueva</p>
									</div>
								</div>
								<div class="col-md-2 w3l-movie-gride-agile">
									<a href="#" class="hvr-shutter-out-horizontal">
										<img src="images/m17.jpg" title="album-name" class="img-responsive" alt=" " />
										<div class="w3l-action-icon">
											<i class="fa fa-bars" aria-hidden="true"></i>
										</div>
									</a>
									<div class="mid-1 agileits_w3layouts_mid_1_home">
										<div class="w3l-movie-text">
											<h6>
												<a href="#">Peter</a>
											</h6>
										</div>
										<div class="mid-2 agile_mid_2_home">
											<p>2016</p>
											<div class="block-stars">
												<ul class="w3l-ratings">
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-o" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-o" aria-hidden="true"></i>
														</a>
													</li>
												</ul>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<div class="col-md-2 w3l-movie-gride-agile">
									<a href="#" class="hvr-shutter-out-horizontal">
										<img src="images/m18.jpg" title="album-name" class="img-responsive" alt=" " />
										<div class="w3l-action-icon">
											<i class="fa fa-bars" aria-hidden="true"></i>
										</div>
									</a>
									<div class="mid-1 agileits_w3layouts_mid_1_home">
										<div class="w3l-movie-text">
											<h6>
												<a href="#">ISRA 88</a>
											</h6>
										</div>
										<div class="mid-2 agile_mid_2_home">
											<p>2016</p>
											<div class="block-stars">
												<ul class="w3l-ratings">
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-o" aria-hidden="true"></i>
														</a>
													</li>
												</ul>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<div class="col-md-2 w3l-movie-gride-agile">
									<a href="#" class="hvr-shutter-out-horizontal">
										<img src="images/m1.jpg" title="album-name" class="img-responsive" alt=" " />
										<div class="w3l-action-icon">
											<i class="fa fa-bars" aria-hidden="true"></i>
										</div>
									</a>
									<div class="mid-1 agileits_w3layouts_mid_1_home">
										<div class="w3l-movie-text">
											<h6>
												<a href="#">War Dogs</a>
											</h6>
										</div>
										<div class="mid-2 agile_mid_2_home">
											<p>2016</p>
											<div class="block-stars">
												<ul class="w3l-ratings">
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-half-o" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-o" aria-hidden="true"></i>
														</a>
													</li>
												</ul>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<div class="ribben">
										<p>Nueva</p>
									</div>
								</div>
								<div class="col-md-2 w3l-movie-gride-agile">
									<a href="#" class="hvr-shutter-out-horizontal">
										<img src="images/m14.jpg" title="album-name" class="img-responsive" alt=" " />
										<div class="w3l-action-icon">
											<i class="fa fa-bars" aria-hidden="true"></i>
										</div>
									</a>
									<div class="mid-1 agileits_w3layouts_mid_1_home">
										<div class="w3l-movie-text">
											<h6>
												<a href="#">The Other Side</a>
											</h6>
										</div>
										<div class="mid-2 agile_mid_2_home">
											<p>2016</p>
											<div class="block-stars">
												<ul class="w3l-ratings">
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-half-o" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-o" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-o" aria-hidden="true"></i>
														</a>
													</li>
												</ul>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<div class="ribben">
										<p>Nueva</p>
									</div>
								</div>
								<div class="col-md-2 w3l-movie-gride-agile">
									<a href="#" class="hvr-shutter-out-horizontal">
										<img src="images/m19.jpg" title="album-name" class="img-responsive" alt=" " />
										<div class="w3l-action-icon">
											<i class="fa fa-bars" aria-hidden="true"></i>
										</div>
									</a>
									<div class="mid-1 agileits_w3layouts_mid_1_home">
										<div class="w3l-movie-text">
											<h6>
												<a href="#">Civil War</a>
											</h6>
										</div>
										<div class="mid-2 agile_mid_2_home">
											<p>2016</p>
											<div class="block-stars">
												<ul class="w3l-ratings">
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-half-o" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-o" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-o" aria-hidden="true"></i>
														</a>
													</li>
												</ul>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<div class="ribben">
										<p>Nueva</p>
									</div>
								</div>
								<div class="col-md-2 w3l-movie-gride-agile">
									<a href="#" class="hvr-shutter-out-horizontal">
										<img src="images/m20.jpg" title="album-name" class="img-responsive" alt=" " />
										<div class="w3l-action-icon">
											<i class="fa fa-bars" aria-hidden="true"></i>
										</div>
									</a>
									<div class="mid-1 agileits_w3layouts_mid_1_home">
										<div class="w3l-movie-text">
											<h6>
												<a href="#">The Secret Life of Pets</a>
											</h6>
										</div>
										<div class="mid-2 agile_mid_2_home">
											<p>2016</p>
											<div class="block-stars">
												<ul class="w3l-ratings">
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-half-o" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-o" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-o" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-o" aria-hidden="true"></i>
														</a>
													</li>
												</ul>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<div class="col-md-2 w3l-movie-gride-agile">
									<a href="#" class="hvr-shutter-out-horizontal">
										<img src="images/m21.jpg" title="album-name" class="img-responsive" alt=" " />
										<div class="w3l-action-icon">
											<i class="fa fa-bars" aria-hidden="true"></i>
										</div>
									</a>
									<div class="mid-1 agileits_w3layouts_mid_1_home">
										<div class="w3l-movie-text">
											<h6>
												<a href="#">The Jungle Book</a>
											</h6>
										</div>
										<div class="mid-2 agile_mid_2_home">
											<p>2016</p>
											<div class="block-stars">
												<ul class="w3l-ratings">
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-half-o" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-o" aria-hidden="true"></i>
														</a>
													</li>
												</ul>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<div class="ribben">
										<p>Nueva</p>
									</div>
								</div>
								<div class="col-md-2 w3l-movie-gride-agile">
									<a href="#" class="hvr-shutter-out-horizontal">
										<img src="images/m22.jpg" title="album-name" class="img-responsive" alt=" " />
										<div class="w3l-action-icon">
											<i class="fa fa-bars" aria-hidden="true"></i>
										</div>
									</a>
									<div class="mid-1 agileits_w3layouts_mid_1_home">
										<div class="w3l-movie-text">
											<h6>
												<a href="#">Assassin's Creed 3</a>
											</h6>
										</div>
										<div class="mid-2 agile_mid_2_home">
											<p>2016</p>
											<div class="block-stars">
												<ul class="w3l-ratings">
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star" aria-hidden="true"></i>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="fa fa-star-half-o" aria-hidden="true"></i>
														</a>
													</li>
												</ul>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<div class="ribben">
										<p>Nueva</p>
									</div>
								</div>
								<div class="clearfix"> </div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
							<div class="col-md-2 w3l-movie-gride-agile">
								<a href="#" class="hvr-shutter-out-horizontal">
									<img src="images/m22.jpg" title="album-name" class="img-responsive" alt=" " />
									<div class="w3l-action-icon">
										<i class="fa fa-bars" aria-hidden="true"></i>
									</div>
								</a>
								<div class="mid-1 agileits_w3layouts_mid_1_home">
									<div class="w3l-movie-text">
										<h6>
											<a href="#">Assassin's Creed 3</a>
										</h6>
									</div>
									<div class="mid-2 agile_mid_2_home">
										<p>2016</p>
										<div class="block-stars">
											<ul class="w3l-ratings">
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-half-o" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-o" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-o" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-o" aria-hidden="true"></i>
													</a>
												</li>
											</ul>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="ribben">
									<p>Nueva</p>
								</div>
							</div>
							<div class="col-md-2 w3l-movie-gride-agile">
								<a href="#" class="hvr-shutter-out-horizontal">
									<img src="images/m2.jpg" title="album-name" class="img-responsive" alt=" " />
									<div class="w3l-action-icon">
										<i class="fa fa-bars" aria-hidden="true"></i>
									</div>
								</a>
								<div class="mid-1 agileits_w3layouts_mid_1_home">
									<div class="w3l-movie-text">
										<h6>
											<a href="#">Bad Moms</a>
										</h6>
									</div>
									<div class="mid-2 agile_mid_2_home">
										<p>2016</p>
										<div class="block-stars">
											<ul class="w3l-ratings">
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-o" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-o" aria-hidden="true"></i>
													</a>
												</li>
											</ul>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="ribben">
									<p>Nueva</p>
								</div>
							</div>
							<div class="col-md-2 w3l-movie-gride-agile">
								<a href="#" class="hvr-shutter-out-horizontal">
									<img src="images/m9.jpg" title="album-name" class="img-responsive" alt=" " />
									<div class="w3l-action-icon">
										<i class="fa fa-bars" aria-hidden="true"></i>
									</div>
								</a>
								<div class="mid-1 agileits_w3layouts_mid_1_home">
									<div class="w3l-movie-text">
										<h6>
											<a href="#">Central Intelligence</a>
										</h6>
									</div>
									<div class="mid-2 agile_mid_2_home">
										<p>2016</p>
										<div class="block-stars">
											<ul class="w3l-ratings">
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-half-o" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-o" aria-hidden="true"></i>
													</a>
												</li>
											</ul>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="ribben">
									<p>Nueva</p>
								</div>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="rating" aria-labelledby="rating-tab">
							<div class="col-md-2 w3l-movie-gride-agile">
								<a href="#" class="hvr-shutter-out-horizontal">
									<img src="images/m7.jpg" title="album-name" class="img-responsive" alt=" " />
									<div class="w3l-action-icon">
										<i class="fa fa-bars" aria-hidden="true"></i>
									</div>
								</a>
								<div class="mid-1 agileits_w3layouts_mid_1_home">
									<div class="w3l-movie-text">
										<h6>
											<a href="#">Light B/t Oceans</a>
										</h6>
									</div>
									<div class="mid-2 agile_mid_2_home">
										<p>2016</p>
										<div class="block-stars">
											<ul class="w3l-ratings">
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-half-o" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-o" aria-hidden="true"></i>
													</a>
												</li>
											</ul>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="ribben">
									<p>Nueva</p>
								</div>
							</div>
							<div class="col-md-2 w3l-movie-gride-agile">
								<a href="#" class="hvr-shutter-out-horizontal">
									<img src="images/m11.jpg" title="album-name" class="img-responsive" alt=" " />
									<div class="w3l-action-icon">
										<i class="fa fa-bars" aria-hidden="true"></i>
									</div>
								</a>
								<div class="mid-1 agileits_w3layouts_mid_1_home">
									<div class="w3l-movie-text">
										<h6>
											<a href="#">X-Men</a>
										</h6>
									</div>
									<div class="mid-2 agile_mid_2_home">
										<p>2016</p>
										<div class="block-stars">
											<ul class="w3l-ratings">
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-half-o" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-o" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-o" aria-hidden="true"></i>
													</a>
												</li>
											</ul>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="ribben">
									<p>Nueva</p>
								</div>
							</div>
							<div class="col-md-2 w3l-movie-gride-agile">
								<a href="#" class="hvr-shutter-out-horizontal">
									<img src="images/m8.jpg" title="album-name" class="img-responsive" alt=" " />
									<div class="w3l-action-icon">
										<i class="fa fa-bars" aria-hidden="true"></i>
									</div>
								</a>
								<div class="mid-1 agileits_w3layouts_mid_1_home">
									<div class="w3l-movie-text">
										<h6>
											<a href="#">The BFG</a>
										</h6>
									</div>
									<div class="mid-2 agile_mid_2_home">
										<p>2016</p>
										<div class="block-stars">
											<ul class="w3l-ratings">
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-half-o" aria-hidden="true"></i>
													</a>
												</li>
											</ul>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="ribben">
									<p>Nueva</p>
								</div>
							</div>
							<div class="col-md-2 w3l-movie-gride-agile">
								<a href="#" class="hvr-shutter-out-horizontal">
									<img src="images/m17.jpg" title="album-name" class="img-responsive" alt=" " />
									<div class="w3l-action-icon">
										<i class="fa fa-bars" aria-hidden="true"></i>
									</div>
								</a>
								<div class="mid-1 agileits_w3layouts_mid_1_home">
									<div class="w3l-movie-text">
										<h6>
											<a href="#">Peter</a>
										</h6>
									</div>
									<div class="mid-2 agile_mid_2_home">
										<p>2016</p>
										<div class="block-stars">
											<ul class="w3l-ratings">
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-o" aria-hidden="true"></i>
													</a>
												</li>
											</ul>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="ribben">
									<p>Nueva</p>
								</div>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="imdb" aria-labelledby="imdb-tab">
							<div class="col-md-2 w3l-movie-gride-agile">
								<a href="#" class="hvr-shutter-out-horizontal">
									<img src="images/m22.jpg" title="album-name" class="img-responsive" alt=" " />
									<div class="w3l-action-icon">
										<i class="fa fa-bars" aria-hidden="true"></i>
									</div>
								</a>
								<div class="mid-1 agileits_w3layouts_mid_1_home">
									<div class="w3l-movie-text">
										<h6>
											<a href="#">Assassin's Creed 3</a>
										</h6>
									</div>
									<div class="mid-2 agile_mid_2_home">
										<p>2016</p>
										<div class="block-stars">
											<ul class="w3l-ratings">
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-half-o" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-o" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-o" aria-hidden="true"></i>
													</a>
												</li>
											</ul>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="ribben">
									<p>Nueva</p>
								</div>
							</div>
							<div class="col-md-2 w3l-movie-gride-agile">
								<a href="#" class="hvr-shutter-out-horizontal">
									<img src="images/m2.jpg" title="album-name" class="img-responsive" alt=" " />
									<div class="w3l-action-icon">
										<i class="fa fa-bars" aria-hidden="true"></i>
									</div>
								</a>
								<div class="mid-1 agileits_w3layouts_mid_1_home">
									<div class="w3l-movie-text">
										<h6>
											<a href="#">Bad Moms</a>
										</h6>
									</div>
									<div class="mid-2 agile_mid_2_home">
										<p>2016</p>
										<div class="block-stars">
											<ul class="w3l-ratings">
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-half-o" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-o" aria-hidden="true"></i>
													</a>
												</li>
											</ul>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="ribben">
									<p>Nueva</p>
								</div>
							</div>
							<div class="col-md-2 w3l-movie-gride-agile">
								<a href="#" class="hvr-shutter-out-horizontal">
									<img src="images/m9.jpg" title="album-name" class="img-responsive" alt=" " />
									<div class="w3l-action-icon">
										<i class="fa fa-bars" aria-hidden="true"></i>
									</div>
								</a>
								<div class="mid-1 agileits_w3layouts_mid_1_home">
									<div class="w3l-movie-text">
										<h6>
											<a href="#">Central Intelligence</a>
										</h6>
									</div>
									<div class="mid-2 agile_mid_2_home">
										<p>2016</p>
										<div class="block-stars">
											<ul class="w3l-ratings">
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-o" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-o" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-o" aria-hidden="true"></i>
													</a>
												</li>
											</ul>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="ribben">
									<p>Nueva</p>
								</div>
							</div>
							<div class="col-md-2 w3l-movie-gride-agile">
								<a href="#" class="hvr-shutter-out-horizontal">
									<img src="images/m10.jpg" title="album-name" class="img-responsive" alt=" " />
									<div class="w3l-action-icon">
										<i class="fa fa-bars" aria-hidden="true"></i>
									</div>
								</a>
								<div class="mid-1 agileits_w3layouts_mid_1_home">
									<div class="w3l-movie-text">
										<h6>
											<a href="#">Don't Think Twice</a>
										</h6>
									</div>
									<div class="mid-2 agile_mid_2_home">
										<p>2016</p>
										<div class="block-stars">
											<ul class="w3l-ratings">
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-half-o" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-o" aria-hidden="true"></i>
													</a>
												</li>
											</ul>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="ribben">
									<p>Nueva</p>
								</div>
							</div>
							<div class="col-md-2 w3l-movie-gride-agile">
								<a href="#" class="hvr-shutter-out-horizontal">
									<img src="images/m23.jpg" title="album-name" class="img-responsive" alt=" " />
									<div class="w3l-action-icon">
										<i class="fa fa-bars" aria-hidden="true"></i>
									</div>
								</a>
								<div class="mid-1 agileits_w3layouts_mid_1_home">
									<div class="w3l-movie-text">
										<h6>
											<a href="#">Dead Island 2</a>
										</h6>
									</div>
									<div class="mid-2 agile_mid_2_home">
										<p>2016</p>
										<div class="block-stars">
											<ul class="w3l-ratings">
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-half-o" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-o" aria-hidden="true"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-star-o" aria-hidden="true"></i>
													</a>
												</li>
											</ul>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="ribben">
									<p>Nueva</p>
								</div>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- //general -->
		<!-- footer -->
		<div class="footer">
			<div class="container">
				<div class="col-md-5 w3ls_footer_grid1_left">
					<p>&copy; Copyright 2017</p>
				</div>
			</div>
		</div>
		<!-- //footer -->
		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>
		<script>
			$(document).ready(function () {
				$(".dropdown").hover(
					function () {
						$('.dropdown-menu', this).stop(true, true).slideDown("fast");
						$(this).toggleClass('open');
					},
					function () {
						$('.dropdown-menu', this).stop(true, true).slideUp("fast");
						$(this).toggleClass('open');
					}
				);
			});
		</script>
		<!-- //Bootstrap Core JavaScript -->
		<!-- here stars scrolling icon -->
		<script type="text/javascript">
			$(document).ready(function () {
				/*
					var defaults = {
					containerID: 'toTop', // fading element id
					containerHoverID: 'toTopHover', // fading element hover id
					scrollSpeed: 1200,
					easingType: 'linear' 
					};
				*/

				$().UItoTop({
					easingType: 'easeOutQuart'
				});

			});
		</script>
		<!-- //here ends scrolling icon -->
	</body>

	</html>