<?php
require('assets/php/requirements.php');

$login = new login(false, false, true);

$login->setMYSQL('riverspoon.one.mysql', 'riverspoon_one', 'sascha', 'riverspoon_one');

$login->getData();

$login->login_check('index.php');


$stats_mysql = new mysqli('riverspoon.one.mysql', 'riverspoon_one', 'sascha', 'riverspoon_one');

$stats = $stats_mysql->query("SELECT * FROM about")->fetch_row();


if($_POST['title']){
    $new_title = $stats_mysql->real_escape_string($_POST['title']);
    $new_text = $stats_mysql->real_escape_string($_POST['text']);
    $stats_mysql->query("UPDATE about SET title = '".$new_title."', text = '".$new_text."' WHERE title = '".$stats[0]."' LIMIT 1 ;");
    header("Location: about.php");
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
			<li class="parent ">
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
						<a class="active" href="about.php">
							<span class="fa fa-info">&nbsp;</span> Über uns
						</a>
					</li>
				<?php } ?>

<?php if($login->hasPerm($login->getUserData()[0], 'contact')){ ?>
					<li>
						<a href="contact.php">
							<span class="fa fa-address-card">&nbsp;</span> Kontakt
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
            <li class="active">Über uns</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Über uns</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Nachricht <i class="fa fa-comment-o" aria-hidden="true"></i>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="about.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="title">Überschrift</label>
                                <div class="col-md-10">
                                    <input value="<?php echo $stats[0]; ?>" id="title" name="title" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="text">Text</label>
                                <div class="col-md-10">
                                    <textarea id="text" name="text" type="text" class="form-control"><?php echo $stats[1]; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <button type="submit" class="btn btn-default btn-md pull-right">�ndern</button>
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