<?php
    require('dashboard/assets/php/login.class.php');

    $login = new login(false, false, true);

    $login->setMYSQL('riverspoon.one.mysql', 'riverspoon_one', 'sascha', 'riverspoon_one');

    $login->getData();

    $stats_mysql = new mysqli('riverspoon.one.mysql', 'riverspoon_one', 'sascha', 'riverspoon_one');

    $stats = $stats_mysql->query("SELECT * FROM about")->fetch_row();
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
                        <img src="images/logo2.png" alt="Company Logo" class="logo" />
				
					</a>

					<nav class="main-navigation">
						<button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
						<ul class="menu">
							<li class="menu-item"><a href="index.php">Home</a></li>
							<li class="menu-item current-menu-item"><a href="about.php">Über uns</a></li>
							<li class="menu-item"><a href="services.php">Services</a></li>
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
						<p><?php echo $stats[1]; ?></p>
						
				</div>
				
				
				
	
			</div>
			
            <center style="margin-bottom: 40px">
			<div style="margin-right: 40px;" class="fb-page" data-href="https://www.facebook.com/KfzMeisterbetriebHake/" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true"  data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/KfzMeisterbetriebHake/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/KfzMeisterbetriebHake/">Kfz-Meisterbetrieb Hake</a></blockquote></div>
			<iframe src="https://snapwidget.com/embed/409426" class="snapwidget-widget" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:260px; height:496px; tmargin-left: 300020px;"></iframe>
            </center>
			


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


		</div> <!-- #site-content -->

		

		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
		<script src="js/plugins.js"></script>
		<script src="js/app.js"></script>
		
	</body>

</html>