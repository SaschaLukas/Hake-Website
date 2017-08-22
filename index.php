<?php
    require('dashboard/assets/php/login.class.php');

    $login = new login(false, false, true);

    $login->setMYSQL('riverspoon.one.mysql', 'riverspoon_one', 'sascha', 'riverspoon_one');

    $login->getData();

    $stats_mysql = new mysqli('riverspoon.one.mysql', 'riverspoon_one', 'sascha', 'riverspoon_one');

    $stats = $stats_mysql->query("SELECT * FROM homepage_stats")->fetch_row();
	
	$search_500 = array('width=500', 'width="500"', 'height="480"');
	$replace_350 = array('width=350', 'width="350"', 'height="600"');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		<meta name="language" content="de fr">
		<meta name="Copyright" content="kfz-hake.de">
		<meta name="author" content="Sascha W." >
		<meta name="page-topic" content="Business">
		<meta name="audience" content="all">
		<meta name="Keywords" lang="de" content="kfz-hake.de, Werkstatt-Service, Kfz-Reparaturen, Kfz, Werkstatt, Dennis Hake, Instandsetzung, Wartung, Pflege, Fahrzeug, Reperaturen, Aachen, Euregio, Auto, Reifen, Inspektion, Bremsen, Service, Aachen">
		<meta name="Keywords" lang="fr" content="kfz-hake.de">
		<meta name="Description" lang="de" content="kfz-hake.de Instandsetzung Wartung und Pflege von Fahrzeugen Dennis Hake">
		<meta http-equiv="expires" content="0">
		<title>KFZ-Meisterbetrieb HAKE // Instandsetzung Wartung und Pflege von Fahrzeugen</title>		
		
		<link href="http://fonts.googleapis.com/css?family=Titillium+Web:300,400,700|" rel="stylesheet" type="text/css">
		<link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">

		<link rel="stylesheet" href="style.css">
		
		<!--[if lt IE 9]>
		<script src="js/ie-support/html5.js"></script>
		<script src="js/ie-support/respond.js"></script>
		<![endif]-->

	</head>


	<body class="header-collapse">
	
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v2.9&appId=348466378614791";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
		
		<div id="site-content">
			
			<header class="site-header">
				<div class="container">
					<a id="branding" href="index.php">
						<img src="images/oie_transparent.png" alt="Logo" class="logo">
					</a>

					<nav class="main-navigation">
						<button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
						<ul class="menu">
							<li class="menu-item current-menu-item"><a href="index.php">Home</a></li>
							<li class="menu-item"><a href="about.php">Über uns</a></li>
							<li class="menu-item"><a href="services.php">Services</a></li>
							<li class="menu-item"><a href="gallery.php">Galerie</a></li>
							<li class="menu-item"><a href="contact.php">Kontakt</a></li>
						</ul>
					</nav>
					<nav class="mobile-navigation"></nav>
				</div>
			</header> <!-- .site-header -->

			<main class="main-content">
				<div class="hero hero-slider">
					<ul class="slides">
						<li data-bg-image="<?php echo $stats[7]; ?>">
							
						</li>
						<li data-bg-image="<?php echo $stats[8]; ?>">
							
						</li>
						<li data-bg-image="<?php echo $stats[9]; ?>">
							
						</li>
					</ul>
				</div> <!-- .hero-slider -->
				


				<div class="fullwidth-block">
					<div class="container">
						<h2 class="section-title">Schon mehr als</h2>

						<div class="row">
							
							<div class="counter">
								<img src="images/icons/icon-car.ico" class="counter-icon">
								<h3 class="counter-num"><?php echo $stats[0]; ?></h3>
								<small class="counter-label">Reparierte Autos</small>
							</div>
							
							
							<div class="counter">
								<img src="images/icons/icon-wrench.ico" class="counter-icon">
								<h3 class="counter-num"><?php echo $stats[1]; ?></h3>
								<small class="counter-label">Erstellte Diagnosen</small>
							</div>
							
							
							<div class="counter">
								<img src="images/icons/icon-client.ico" class="counter-icon">
								<h3 class="counter-num"><?php echo $stats[2]; ?></h3>
								<small class="counter-label">Zufriedene Kunden</small>
							</div>
							
							
							<div class="counter last">
								<img src="images/icons/icon-oil.ico" class="counter-icon">
								<h3 class="counter-num"><?php echo $stats[3]; ?></h3>
								<small class="counter-label">Liter Öl benutzt</small>
							</div>
							
						</div>
					</div> <!-- .container -->
				</div> <!-- .fullwidth-block -->

				<div class="fullwidth-block dark-bg" class="test">
					<div class="container">
						<h2 class="section-title">Unser Team</h2>
						<div class="row">
                            <?php
                                foreach($login->getAllData() as $user){
                            ?>
                                <div class="col-md-3 col-sm-6">
                                    <div class="team">
                                        <figure class="team-image"><img src="images/team/<?php echo $user['name']; ?>.png" alt="<?php echo str_replace('_', ' ', $user['name']); ?>" style="width:100%;"></figure>
                                        <h3 class="team-name"><?php echo str_replace('_', ' ', $user['name']); ?></h3>
                                        <small class="team-desc"><?php echo $user['group']; ?></small>

                                    </div>
                                </div>
                            <?php } ?>
							
						</div> <!-- .row -->
					</div> <!-- .container -->
				</div> <!-- .fullwidth-block -->

				<div class="fullwidth-block">
						<h2 class="section-title">Das sagen unsere Kunden</h2>
						<div class="row">
							<div class="col-md-4">
								<div class="feature">
								<?php echo preg_replace('/height=\"(.*?)\"/', 'height="600"', str_replace($search_500, $replace_350, $stats[4])); ?>
								</div>
							</div>
							<div class="col-md-4">
								<div class="feature">
								<?php echo preg_replace('/height=\"(.*?)\"/', 'height="600"', str_replace($search_500, $replace_350, $stats[5])); ?>
								</div>
							</div>			
							<div class="col-md-4">
								<div class="feature">
								<?php echo preg_replace('/height=\"(.*?)\"/', 'height="600"', str_replace($search_500, $replace_350, $stats[6])); ?>
								</div>
							</div>					
						</div> <!-- .row -->
				</div> <!-- .fullwidth-block -->

			
			</main> <!-- .main-content -->

			<footer class="site-footer">
				<div class="container">

					<div class="social-links">
                        <a href="https://www.facebook.com/KfzMeisterbetriebHake" target="_blank"><li class="fa fa-facebook"></li></a>
                        <a href="https://twitter.com/KfzHake" target="_blank"><li class="fa fa-twitter"></li></a>
                        <a href="https://www.instagram.com/hakedennis" target="_blank"><li class="fa fa-instagram"></li></a>
                        <a href="/Hake/dashboard" target="_blank"><li class="fa fa-sign-in"></li></a>

					</div>
					<div class="copy">
						<p>Copyright 2017 KFZ-Hake. All rights reserved.</p>
					</div>
				</div>
			</footer> <!-- .site-footer -->

		</div> <!-- #site-content -->

		

		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
		<script src="js/plugins.js"></script>
		<script src="js/app.js"></script>
		
	</body>

</html>