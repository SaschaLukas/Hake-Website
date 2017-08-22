<?php
    require('assets/php/requirements.php');

    $login = new login(false, false, true);

    $login->setMYSQL('riverspoon.one.mysql', 'riverspoon_one', 'sascha', 'riverspoon_one');

    $login->getData();

    $login->login_check('index.php');

    if($_POST['passwort1'] && $_POST['passwort2']){
			if($_POST['passwort1'] == $_POST['passwort2']){
				$login->setPW($login->getUserData()[0], $_POST['passwort1']);
				header("Location: index.php");
			}else{
				$change_error = true;
			}
		}
    
			if(isset($_FILES['image'])){
		$file_size =$_FILES['image']['size'];
		$file_tmp =$_FILES['image']['tmp_name'];
		$file_type=$_FILES['image']['type'];   
		$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
		
		$expensions= array("jpeg","jpg","png"); 		
		if(in_array($file_ext,$expensions)=== false){
			$error = "Dateityp nicht zulässig. Benutze jpg, jpeg oder png.";
		}else{
			if($file_size > 2097152){
				$error = 'Datei darf nur 2 MB groß sein.';
			}else{
				move_uploaded_file($file_tmp,"../images/team/".$login->getUserData()[0].".png");
				$refresh = true;
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<?php if(@$refresh == true){ ?>
		<meta http-equiv="refresh" content="0; URL=profil.php">
	<?php } ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hake - Profil</title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="assets/css/datepicker3.css" rel="stylesheet">
	<link href="assets/css/styles.css" rel="stylesheet">
		<link href="assets/css/hake.min.css" rel="stylesheet">

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
			<li class="parent ">
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
                <li><a href="users.php"><em class="fa fa-users">&nbsp;</em> Benutzer & Gruppen</a></li>
            <?php } ?>

            <li class="active"><a href="profil.php"><em class="fa fa-user">&nbsp;</em> Profil</a></li>
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
				<li class="active">Profil</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Mein Profil</h1>
			</div>
			
			<?php if(@$change_error == true){ ?>
			<div class="col-md-4">
        <div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Deine Passwörter stimmen nicht überein. <a href="#" data-dismiss="alert" class="pull-right"><em class="fa fa-lg fa-close"></em></a></div>
			</div>
      <?php }elseif(@$error == true){	?>
			<div class="col-md-4">
        <div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> <?php echo @$error; ?> <a href="#" data-dismiss="alert" class="pull-right"><em class="fa fa-lg fa-close"></em></a></div>
			</div>
			<?php } ?>
		</div><!--/.row-->
        
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Passwort ändern
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="profil.php" method="post">
                            <fieldset>

                                <!-- Passwort input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="passwort">Passwort</label>
                                    <div class="col-md-9">
                                        <input id="passwort" name="passwort1" type="password" placeholder="Passwort" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="passwort">Passwort wiederholen</label>
                                    <div class="col-md-9">
                                        <input id="passwort" name="passwort2" type="password" placeholder="Passwort wiederholt" class="form-control">
                                    </div>
                                </div>

                                
                                <div class="col-md-9 col-md-offset-3">
                                    <p>Wenn du dein Passwort geändert hast musst du dich erneut anmelden.</p>
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
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Profilbild
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="profil.php" method="post" enctype="multipart/form-data">
                            <fieldset>
<img src="../images/team/<?php echo $login->getUserData()[0]; ?>.png" alt="<?php echo str_replace('_', ' ', $login->getUserData()[0]); ?>" style="width:100%;margin-bottom:15px;">
															<div class="form-group">
                                <label class="col-md-3 control-label" for="profil">Profilbild hochladen</label>
                                <div class="col-md-9">
                                  <div class="input-group image-preview">
																		<input type="text" class="form-control image-preview-filename" disabled="disabled">
																		<span class="input-group-btn">
																			<button type="button" class="btn btn-default image-preview-clear" style="display:none;">
																				<span class="glyphicon glyphicon-remove"></span> Clear
																			</button>
																			<div class="btn btn-default image-preview-input">
																				<span class="glyphicon glyphicon-folder-open"></span>
																				<input type="file" accept="image/png, image/jpeg" name="image"/>
																			</div>
																		</span>
																	</div>
                                </div>
                              </div>
															<div class="form-group">
                                <div class="col-md-12 widget-right">
                                  <button type="submit" class="btn btn-default btn-md pull-right">Hochladen</button>
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
$(document).on('click', '#close-preview', function(){ 
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function () {
           $('.image-preview').popover('show');
        }, 
         function () {
           $('.image-preview').popover('hide');
        }
    );    
});

$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
        content: "There's no image",
        placement:'bottom'
    });
    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Browse"); 
    }); 
    // Create the preview image
    $(".image-preview-input input:file").change(function (){     
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200
        });      
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Change");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);            
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
        }        
        reader.readAsDataURL(file);
    });  
});
	</script>
		
</body>
</html>