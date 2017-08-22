<?php
require('assets/php/requirements.php');

$login = new login(false, false, true);

$login->setMYSQL('riverspoon.one.mysql', 'riverspoon_one', 'sascha', 'riverspoon_one');

$login->getData();

$login->login_check('index.php');


$stats_mysql = new mysqli('riverspoon.one.mysql', 'riverspoon_one', 'sascha', 'riverspoon_one');

$stats = $stats_mysql->query("SELECT * FROM homepage_stats")->fetch_row();


if($_POST['cars']){
    $new_cars = $stats_mysql->real_escape_string($_POST['cars']);
    $stats_mysql->query("UPDATE homepage_stats SET Autos = '".$new_cars."' WHERE Autos = '".$stats[0]."' LIMIT 1 ;");
    header("Location: home.php");
}elseif($_POST['diagnosen']){
    $new_diagnosen = $stats_mysql->real_escape_string($_POST['diagnosen']);
    $stats_mysql->query("UPDATE homepage_stats SET Diagnosen = '".$new_diagnosen."' WHERE Diagnosen = '".$stats[1]."' LIMIT 1 ;");
    header("Location: home.php");
}elseif($_POST['kunden']){
    $new_kunden = $stats_mysql->real_escape_string($_POST['kunden']);
    $stats_mysql->query("UPDATE homepage_stats SET Kunden = '".$new_kunden."' WHERE Kunden = '".$stats[2]."' LIMIT 1 ;");
    header("Location: home.php");
}elseif($_POST['oil']){
    $new_oil = $stats_mysql->real_escape_string($_POST['oil']);
    $stats_mysql->query("UPDATE homepage_stats SET Oil = '".$new_oil."' WHERE Oil = '".$stats[3]."' LIMIT 1 ;");
    header("Location: home.php");
}elseif($_POST['fb1']){
	$new_fb1 = $stats_mysql->real_escape_string($_POST['fb1']);
	$new_fb2 = $stats_mysql->real_escape_string($_POST['fb2']);
	$new_fb3 = $stats_mysql->real_escape_string($_POST['fb3']);
	$stats_mysql->query("UPDATE homepage_stats SET facebook_1 = '".$new_fb1."', facebook_2 = '".$new_fb2."', facebook_3 = '".$new_fb3."' WHERE facebook_1 = '".$stats[4]."' LIMIT 1 ;");
	header("Location: home.php");
}elseif($_POST['slider1']){
	$new_slider1 = $stats_mysql->real_escape_string($_POST['slider1']);
	$new_slider2 = $stats_mysql->real_escape_string($_POST['slider2']);
	$new_slider3 = $stats_mysql->real_escape_string($_POST['slider3']);
	$stats_mysql->query("UPDATE homepage_stats SET slider_1 = '".$new_slider1."', slider_2 = '".$new_slider2."', slider_3 = '".$new_slider3."' WHERE slider_1 = '".$stats[7]."' LIMIT 1 ;");
	header("Location: home.php");
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hake - Homepage</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/datepicker3.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
	<link href="assets/css/hake.min.css" rel="stylesheet">

    <!--Custom Font-->
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
    </div><!-- /.container-fluid -->
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
			<li><a href="dash.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li class="parent">
				<a data-toggle="collapse" href="#pages">
					<em class="fa fa-navicon">&nbsp;</em> Pages <span data-toggle="collapse" href="#pages" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse in" id="pages">
					<?php if($login->hasPerm($login->getUserData()[0], 'homepage')){ ?>
					<li>
						<a href="home.php">
							<span class="fa fa fa-home">&nbsp;</span> Homepage
						</a>
					</li>
				<?php } ?>


<?php if($login->hasPerm($login->getUserData()[0], 'services')){ ?>
					<li>
						<a href="services.php">
							<span class="fa fa-handshake-o">&nbsp;</span> Services
						</a>
					</li>
				<?php } ?>

				<?php if($login->hasPerm($login->getUserData()[0], 'about')){ ?>
					<li>
						<a href="about.php">
							<span class="fa fa-info">&nbsp;</span> Über uns
						</a>
					</li>
				<?php } ?>

				<?php if($login->hasPerm($login->getUserData()[0], 'contact')){ ?>
					<li>
						<a href="contact.php">
							<span class="fa fa-address-card">&nbsp;</span> Contact
						</a>
					</li>
				<?php } ?>

				</ul>
			</li>
            <?php if($login->hasPerm($login->getUserData()[0], 'admin.users')){ ?>
                <li><a href="users.php"><em class="fa fa-users">&nbsp;</em> Benutzer & Gruppen</a></li>
            <?php } ?>
            <li><a href="profil.php"><em class="fa fa-user">&nbsp;</em> Profil</a></li>
            <li><a href="index.php?logout=true"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
    </ul>
</div><!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Homepage</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Homepage</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Reparierte Autos <i class="fa fa-car" aria-hidden="true"></i>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="home.php" method="post">
                        <fieldset>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="cars">Autos</label>
                                <div class="col-md-9">
                                    <input value="<?php echo $stats[0]; ?>" id="cars" name="cars" type="text" placeholder="Anzahl" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <button type="submit" class="btn btn-default btn-md pull-right">Submit</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Erstellte Diagnosen <i class="fa fa-desktop" aria-hidden="true"></i>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="home.php" method="post">
                        <fieldset>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="diagnosen">Diagnosen</label>
                                <div class="col-md-9">
                                    <input value="<?php echo $stats[1]; ?>" id="diagnosen" name="diagnosen" type="text" placeholder="Anzahl" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <button type="submit" class="btn btn-default btn-md pull-right">Submit</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Zufriedene Kunden <i class="fa fa-check" aria-hidden="true"></i>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="home.php" method="post">
                        <fieldset>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="kunden">Kunden</label>
                                <div class="col-md-9">
                                    <input value="<?php echo $stats[2]; ?>" id="kunden" name="kunden" type="text" placeholder="Anzahl" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <button type="submit" class="btn btn-default btn-md pull-right">Submit</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liter Öl benutzt <i class="fa fa-tint" aria-hidden="true"></i>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="home.php" method="post">
                        <fieldset>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="oil">Öl</label>
                                <div class="col-md-9">
                                    <input value="<?php echo $stats[3]; ?>" id="oil" name="oil" type="text" placeholder="Liter" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <button type="submit" class="btn btn-default btn-md pull-right">Submit</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Facebook Empfehlungen <i class="fa fa-facebook-square" aria-hidden="true"></i>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="home.php" method="post">
                        <fieldset>

                            <div class="form-group">
                                <label class="col-md-1 control-label" for="fb1">1 : </label>
                                <div class="col-md-11">
                                    <input value='<?php echo $stats[4]; ?>' id="fb1" name="fb1" type="text" placeholder="Link" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-1 control-label" for="fb2">2 : </label>
                                <div class="col-md-11">
                                    <input value='<?php echo $stats[5]; ?>' id="fb2" name="fb2" type="text" placeholder="Link" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-1 control-label" for="fb3">3 : </label>
                                <div class="col-md-11">
                                    <input value='<?php echo $stats[6]; ?>' id="fb3" name="fb3" type="text" placeholder="Link" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <button type="submit" class="btn btn-default btn-md pull-right">Submit</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
		<div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Slider Bilder <i class="fa fa-picture-o" aria-hidden="true"></i>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="home.php" method="post">
                        <fieldset>

                            <div class="form-group">
                                <label class="col-md-1 control-label" for="slider1">1 : </label>
                                <div class="col-md-11">
                                    <input value='<?php echo $stats[7]; ?>' id="slider1" name="slider1" type="text" placeholder="Link" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-1 control-label" for="slider2">2 : </label>
                                <div class="col-md-11">
                                    <input value='<?php echo $stats[8]; ?>' id="slider2" name="slider2" type="text" placeholder="Link" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-1 control-label" for="slider3">3 : </label>
                                <div class="col-md-11">
                                    <input value='<?php echo $stats[9]; ?>' id="slider3" name="slider3" type="text" placeholder="Link" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <button type="submit" class="btn btn-default btn-md pull-right">Submit</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
				<p class="back-link">created by Sascha W. & Timo J.</p>
        </div>
    </div><!--/.row-->
</div>	<!--/.main-->

<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/chart.min.js"></script>
<script src="assets/js/chart-data.js"></script>
<script src="assets/js/easypiechart.js"></script>
<script src="assets/js/easypiechart-data.js"></script>
<script src="assets/js/bootstrap-datepicker.js"></script>
<script src="assets/js/custom.js"></script>
<script>
    window.onload = function () {
        var chart1 = document.getElementById("line-chart").getContext("2d");
        window.myLine = new Chart(chart1).Line(lineChartData, {
            responsive: true,
            scaleLineColor: "rgba(0,0,0,.2)",
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleFontColor: "#c5c7cc"
        });
    };
</script>

</body>
</html>