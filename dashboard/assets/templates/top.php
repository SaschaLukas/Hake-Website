<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Hake - ACP</title>
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<link href="assets/css/datepicker3.css" rel="stylesheet">
<link href="assets/css/styles.css" rel="stylesheet">
<link href="assets/css/hake.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
<div class="container-fluid">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span></button>
<a class="navbar-brand" href="#"><span>Hake</span>Admin</a>
</div>
</div>
</nav>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
<div class="profile-sidebar">
<div class="profile-userpic">
<img src="../images/team/<?php echo $login->getUserData()[0]; ?>.png" class="img-responsive" alt="<?php echo str_replace('_', ' ', $login->getUserData()[0]); ?>">
</div>
<div class="profile-usertitle">
<div class="profile-usertitle-name"><?php echo $login->getUserData()[0] ?></div>
<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
</div>
<div class="clear"></div>
</div>
<div class="divider"></div>
<ul class="nav menu">
<li <?php nav_active("dash.php"); ?>><a href="dash.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
<li class="parent ">
<a data-toggle="collapse" href="#pages">
<em class="fa fa-navicon">&nbsp;</em> Pages <span data-toggle="collapse" href="#pages" class="icon pull-right"><em class="fa <?php nav_icon("home.php,services.php,about.php"); ?>"></em></span>
</a>
<ul class="children collapse <?php nav_in("home.php,services.php,about.php"); ?>" id="pages">
<?php if($login->hasPerm($login->getUserData()[0], 'homepage')){ ?>
<li>
<a <?php nav_active("home.php"); ?> href="home.php">
<span class="fa fa fa-home">&nbsp;</span> Homepage
</a>
</li>
<?php } ?>
<?php if($login->hasPerm($login->getUserData()[0], 'services')){ ?>
<li>
<a <?php nav_active("services.php"); ?> href="services.php">
<span class="fa fa-handshake-o">&nbsp;</span> Services
</a>
</li>
<?php } ?>
<?php if($login->hasPerm($login->getUserData()[0], 'about')){ ?>
<li>
<a <?php nav_active("about.php"); ?> href="about.php">
<span class="fa fa-info">&nbsp;</span> Über uns
</a>
</li>
<?php } ?>
<?php if($login->hasPerm($login->getUserData()[0], 'contact')){ ?>
<li>
<a <?php nav_active("contact.php"); ?> href="contact.php">
<span class="fa fa-address-card">&nbsp;</span> Kontakt
</a>
</li>
<?php } ?>
</ul>
</li>
<?php if($login->hasPerm($login->getUserData()[0], 'admin.users')){ ?>
<li <?php nav_active("users.php"); ?>><a href="users.php"><em class="fa fa-users">&nbsp;</em> Benutzer & Gruppen</a></li>
<?php } ?>
<li <?php nav_active("profil.php"); ?>><a href="profil.php"><em class="fa fa-user">&nbsp;</em> Profil</a></li>
<li><a href="index.php?logout=true"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
</ul>
</div>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">