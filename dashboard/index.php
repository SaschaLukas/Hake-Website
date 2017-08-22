<?php
    require('assets/php/requirements.php');

    $login = new login(false, false, true);

    $login->setMYSQL('riverspoon.one.mysql', 'riverspoon_one', 'sascha', 'riverspoon_one');

    $login->getData();

    if($_GET['logout'] == true){
        add_log("logged out successfully");
        $login->logout();
        header("location: index.php");
    }

    $login->session_check('dash.php');
    
    if($_POST['name'] && $_POST['passwort']){
        if($login->login(str_replace(' ', '_', $_POST['name']), $_POST['passwort']) == true){
            add_log("logged in successfully");
            header("location: dash.php");
        }else{
            add_log("tried to login");
        }
    }


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hake - Login</title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/datepicker3.css" rel="stylesheet">
	<link href="assets/css/styles.css" rel="stylesheet">
	<link href="assets/css/hake.min.css" rel="stylesheet">

</head>
<body style="background-color: #014558;">
    
    
        
            <div class="branding" href="index.html">
						<img src="../images/oie_transparent.png" alt="Logo" class="logo">
					</div>
    
	<div class="row">
        

        
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4" style="margin-top: 50px;">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Login</div>
				<div class="panel-body">
					<form role="form" action="index.php" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Name" name="name" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Passwort" name="passwort" type="password" value="">
							</div>
							<input class="btn btn-primary" type="submit" value="Login">
                        </fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>