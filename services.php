
<?php
    require('dashboard/assets/php/login.class.php');

    $login = new login(false, false, true);

    $login->setMYSQL('riverspoon.one.mysql', 'riverspoon_one', 'sascha', 'riverspoon_one');

    $login->getData();

    $stats_mysql = new mysqli('riverspoon.one.mysql', 'riverspoon_one', 'sascha', 'riverspoon_one');

    $stats = $stats_mysql->query("SELECT * FROM services")->fetch_row();
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


	<body>
		
		<div id="site-content">
			
			<header class="site-header">
				<div class="container">
					<a id="branding" href="index.php">
						<img src="images/logo2.png" alt="Company Logo" class="logo">
					</a>

					<nav class="main-navigation">
						<button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
						<ul class="menu">
							<li class="menu-item"><a href="index.php">Home</a></li>
		                    <li class="menu-item"><a href="about.php">Über uns</a></li>
                            <li class="menu-item current-menu-item"><a href="services.php">Services</a></li>
							<li class="menu-item"><a href="gallery.php">Galerie</a></li>
							<li class="menu-item"><a href="contact.php">Kontakt</a></li>
						</ul>
					</nav>
					<nav class="mobile-navigation"></nav>
				</div>
			</header> <!-- .site-header -->

			<main class="main-content">
				
				<div class="fullwidth-block content">
					<div class="container">
						<h2 class="entry-title"><?php echo $stats[0]; ?></h2>

						
						<p>   </p>
						<div class="filterable-item" style="display: none">
							<a href="images/galerie/Werkstatt/Werkstatt1.jpg" class="1">
								<img src="EMPTY" alt="">
							</a>
						</div>
						
						<div class="filterable-item" style="display: none">
							<a href="images/galerie/Werkstatt/Werkstatt3.jpg" class="2">
								<img src="EMPTY" alt="">
							</a>
						</div>
						
						<div class="feature-grid">
							<div class="feature filterable-item" id="1">
								<a href="images/galerie/Werkstatt/Werkstatt2.jpg" class="1">
									<figure class="feature-image"><img src="images/holiday-check.png" alt=""></figure>
									<h2 class="feature-title" style="color: white"><?php echo $stats[6]; ?></h2>
									<p style="color: white"><?php echo $stats[1]; ?></p>
								</a>
							</div>
							<div class="feature filterable-item" id="2">
								<a href="images/galerie/Werkstatt/Werkstatt4.jpg" class="2">
									<figure class="feature-image"><img src="images/all-repair.png" alt=""></figure>
									<h2 class="feature-title"><?php echo $stats[7]; ?></h2>
									<p><?php echo $stats[2]; ?></p>
								</a>
							</div>
							<div class="feature">
								<figure class="feature-image"><img src="images/icon-engine.png" alt=""></figure>
								<h2 class="feature-title"><?php echo $stats[8]; ?></h2>
								<p><br><?php echo $stats[3]; ?> <br></p>
							</div>
							<div class="feature">
								<figure class="feature-image"><img src="images/icon-brake.png" alt=""></figure>
								<h2 class="feature-title"><?php echo $stats[9]; ?></h2>
								<p><?php echo $stats[4]; ?></p>
							</div>
							<div class="feature">
								<figure class="feature-image"><img src="images/icon-steering.png" alt=""></figure>
								<h2 class="feature-title"><?php echo $stats[10]; ?></h2>
								<p><?php echo $stats[5]; ?></p>
							</div>
                            
							<div class="feature" class="filterable-items" class="gallery-item filterable-item workshop">

								<a href="images/galerie/Werkstatt/Werkstatt10.jpg"><figure class="feature-image"><img src="images/icon-exhaust.png" alt="">
								        <h2 class="feature-title" style="color: white"><?php echo $stats[11]; ?></h2>
								    <p style="color: white"><?php echo $stats[6]; ?></p>
                                    </figure></a>
							</div>
						</div>
					</div>
				</div>

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
		
		<script>
		$(document).on("click", "#1", function(){
			$(".2").setAttribute("href", "");
   
		});
		$(document).on("click", "#2", function(){
			$(".2").addClass("filterable-item");
			$(".1").removeClass("filterable-item");
		});
		</script>
		
	</body>

</html>