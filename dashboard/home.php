<?php
require('assets/php/requirements.php');

/*--------------Login--------------*/
$login = new login(false, false, true);
$login->setMYSQL('riverspoon.one.mysql', 'riverspoon_one', 'sascha', 'riverspoon_one');
$login->getData();
$login->login_check('index.php');

/*--------------PAGE--------------*/

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

/*--------------Build the Page--------------*/
require('assets/templates/top.php');

breadcrumb('Homepage', 'Pages');
title('Homepage');

panel_textinput("Reparierte Autos", "fa-car", "Autos", "cars", $stats[0], 3, 0);
panel_textinput("Erstellte Diagnosen", "fa-desktop", "Diagnosen", "diagnosen", $stats[1], 3, 0);
panel_textinput("Zufriedene Kunden", "fa-check", "Kunden", "kunden", $stats[2], 3, 0);
panel_textinput("Liter Öl benutzt", "fa-tint", "Öl", "oil", $stats[3], 3, 0);

?>

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

<?php
require('assets/templates/bottom.php');
?>