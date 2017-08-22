<?php
    require('dashboard/assets/php/login.class.php');

    $login = new login(false, false, true);

    $login->setMYSQL('riverspoon.one.mysql', 'riverspoon_one', 'sascha', 'riverspoon_one');

    $login->getData();

    $stats_mysql = new mysqli('riverspoon.one.mysql', 'riverspoon_one', 'sascha', 'riverspoon_one');

    $stats = $stats_mysql->query("SELECT * FROM contact")->fetch_row();
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
                        <img src="images/logo2.png" alt="Company Logo" class="logo" />
					</a>

					<nav class="main-navigation">
						<button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
						<ul class="menu">
							<li class="menu-item"><a href="index.php">Home</a></li>
							<li class="menu-item"><a href="about.php">Über uns</a></li>
							<li class="menu-item"><a href="services.php">Services</a></li>
							<li class="menu-item"><a href="gallery.php">Galerie</a></li>
							<li class="menu-item current-menu-item"><a href="contact.php">Contact</a></li>                       
                
						</ul>
					</nav>
					<nav class="mobile-navigation"></nav>
				</div>
			</header> <!-- .site-header -->

			<main class="main-content">
				
				<div class="fullwidth-block content">
					<div class="container">
						<h2 class="entry-title"><p><?php echo $stats[4]; ?></p></h2>

                        
                        
						<div class="row">
							<div class="col-md-5">
                <h3 style="line-height:20%;color: white"><i class="fa fa-user fa-1x" style="line-height:6%;color:white"></i> Inhaber</h3>
                <p style="margin-top:6%;line-height:35%"><p><?php echo $stats[0]; ?></p></p>
                                
				<h3 style="line-height:20%; color: white"><i class="fa fa-home fa-1x" style="line-height:6%;color:white"></i> Adresse:</h3>               
                <p style="margin-top:6%;line-height:35%"><p><?php echo $stats[1]; ?></p></p>
                                
                <h3 style="line-height:20%;color: white"><i class="fa fa-envelope fa-1x" style="line-height:6%;color:white"></i> E-Mail:</h3>
                <p style="margin-top:6%;line-height:35%"><p><?php echo $stats[2]; ?></p></p>
                                
                <h3 style="line-height:20%;color: white"><i class="fa fa-mobile" style="line-height:6%;color:white"></i> Kontakt:</h3>
                <p style="margin-top:6%;line-height:35%">
                                <p><?php echo $stats[3]; ?></p>
				</div>
                        
							<div class="col-md-6 col-md-offset-1">
								<div class="map-container">
									<div class="map2"></div>
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2525.451921023341!2d6.037405616032444!3d50.73010647951506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c09af576764cf1%3A0x4a75bc793368a3a8!2sL%C3%BCtticher+Str.+586%2C+52074+Aachen!5e0!3m2!1sde!2sde!4v1500073632685" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
								</div>
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
		
	</body>

</html>