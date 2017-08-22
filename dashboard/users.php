<?php
    require('assets/php/requirements.php');

    $login = new login(false, false, true);

    $login->setMYSQL('riverspoon.one.mysql', 'riverspoon_one', 'sascha', 'riverspoon_one');

    $login->getData();

    $login->login_check('index.php');

    if($login->hasPerm($login->getUserData()[0], 'admin.users')){
        
        if($_POST['name'] && $_POST['passwort'] && $_POST['gruppe']){
             $login->createUser(str_replace(' ', '_', $_POST['name']), $_POST['passwort']);
             $login->setGroup(str_replace(' ', '_', $_POST['name']), $_POST['gruppe']);
						 copy('assets/standard.png', '../images/team/'.str_replace(' ', '_', $_POST['name']).'.png');
            $created_successfully = true;
        }
        
        if($_POST['edit'] && $_POST['gruppe']){
            if($_POST['passwort'] != ""){
                $login->setPW($_POST['edit'], $_POST['passwort']);
            }
            if($_POST['blocked'] == true){
                $login->blockUser($_POST['edit']);
            }else{
                $login->unblockUser($_POST['edit']);
            }
            $login->setGroup($_POST['edit'], $_POST['gruppe']);
            header("location: users.php");
        }
        
        if($_GET['delete'] == true){
            $login->deleteUser($_GET['delete']);
						unlink('../images/team/'.$_GET['delete'].'.png');
            header("location: users.php");
        }
    
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hake - Users</title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="assets/css/datepicker3.css" rel="stylesheet">
	<link href="assets/css/styles.css" rel="stylesheet">
    	<link href="assets/css/hake.min.css" rel="stylesheet">

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
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
				<div class="profile-usertitle-name"><?php echo str_replace('_', ' ', $login->getUserData()[0]) ?></div>
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
				<ul class="children collapse" id="pages">
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
                <li class="active"><a href="users.php"><em class="fa fa-users">&nbsp;</em> Benutzer & Gruppen</a></li>
            <?php } ?>
            <li><a href="profil.php"><em class="fa fa-user">&nbsp;</em> Profil</a></li>
            <li><a href="wheel.php"><em class="fa fa-cog">&nbsp;</em> Reifeneinlagerung</a></li>
            <li><a href="index.php?logout=true"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
    </ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="dash.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Users</li>
			</ol>
		</div><!--/.row-->
        
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Benutzer & Gruppen</h1>
			</div>
            <div class="col-md-4">
                <?php if(@$created_successfully == true){ ?>
                    <div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Benutzer wurde erstellt <a href="#" data-dismiss="alert" class="pull-right"><em class="fa fa-lg fa-close"></em></a></div>
                <?php }elseif(@$created_error == true){ ?>
                    <div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Benutzer wurde <b>nicht</b> erstellt, da ein Fehler aufgetreten ist. <a href="#" data-dismiss="alert" class="pull-right"><em class="fa fa-lg fa-close"></em></a></div>
                <?php } ?>
            </div>
		</div><!--/.row-->
        
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Benutzer erstellen
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="users.php" method="post">
                            <fieldset>
                                <!-- Name input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="name">Name</label>
                                    <div class="col-md-9">
                                        <input id="name" name="name" type="text" placeholder="Name" class="form-control">
                                    </div>
                                </div>

                                <!-- Email input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="passwort">Passwort</label>
                                    <div class="col-md-9">
                                        <input id="passwort" name="passwort" type="text" placeholder="Passwort" class="form-control">
                                    </div>
                                </div>

                                    <!-- Message body -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="message">Gruppe</label>
                                    <div class="col-md-9">
                                        <select name="gruppe" class="form-control">
                                            <?php
                                                foreach($login->getAllGroups() as $group){
                                                    echo '<option value="'.$group.'">'.$group.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-9 col-md-offset-3">
                                    <p>Tipp: es werden keine User erstellt, wenn der Name berreits vorhanden ist.</p>
                                </div>

                                <!-- Form actions -->
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
                <ul class="list-group">
                    <?php
                        foreach($login->getAllUser() as $user){
                            echo '<li class="list-group-item"><a style="float:right" href="#" onclick=\'$(".hide_me").addClass("hidden");$("#edit_'.$user.'").removeClass("hidden");\'><span class="badge"><i class="fa fa-pencil" aria-hidden="true"></i></span></a>'.str_replace('_', ' ', $user).'</li>';
                        }
                    ?>
                </ul>
            </div>
            
            <?php foreach($login->getAllData() as $user){ ?>
                <div class="col-md-4 hidden hide_me" id="edit_<?php echo $user['name']; ?>">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo str_replace('_', ' ', $user['name']); ?> bearbeiten
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" action="users.php" method="post">
                                <input type="hidden" name="edit" value="<?php echo $user['name']; ?>">
                                <fieldset>

                                    <!-- Email input-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="passwort">Passwort</label>
                                        <div class="col-md-9">
                                            <input id="passwort" name="passwort" type="text" placeholder="Passwort" class="form-control">
                                        </div>
                                    </div>

                                        <!-- Message body -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="gruppe">Gruppe</label>
                                        <div class="col-md-9">
                                            <select id="gruppe" name="gruppe" class="form-control">
                                                <?php
                                                    foreach($login->getAllGroups() as $group){
                                                        if($group == $user['group']){
                                                            echo '<option value="'.$group.'" selected>'.$group.'</option>';
                                                        }else{
                                                            echo '<option value="'.$group.'">'.$group.'</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="blocked">Blockiert</label>
                                        <div class="col-md-6">
                                            <?php if($login->getAllData()[array_search($user['name'], array_column($login->getAllData(), 'name'))]['blocked'] == 'true'){ ?>
                                                <input checked id="blocked" name="blocked" data-toggle="toggle" data-onstyle="success" data-on="Ja" data-offstyle="danger" data-off="Nein " type="checkbox">
                                            <?php }else{ ?>
                                                <input id="blocked" name="blocked" data-toggle="toggle" data-onstyle="success" data-on="Ja" data-offstyle="danger" data-off="Nein " type="checkbox">
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-3">
                                            <a class="btn btn-warning btn-md pull-right" data-toggle="modal" href="#" data-target="#delete_<?php echo $user['name']; ?>">User löschen</a>
                                        </div>
                                    </div>

                                    <!-- Form actions -->
                                    <div class="form-group">
                                        <div class="col-md-12 widget-right">
                                            <button type="submit" class="btn btn-default btn-md pull-right">ändern</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="delete_<?php echo $user['name']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><?php echo str_replace('_', ' ', $user['name']); ?> wirklich löschen?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Nein</button>
                                <a href="users.php?delete=<?php echo $user['name']; ?>" type="button" class="btn btn-danger">löschen</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
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
    
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    
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
<?php
    }else{
        header("location: dash.php");
    }
?>