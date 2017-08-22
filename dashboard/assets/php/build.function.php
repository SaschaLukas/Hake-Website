<?php

function nav_active($path){
	$file = ltrim(strrchr ($_SERVER['SCRIPT_NAME'], "/"), "/");
	if($path == $file){
		echo 'class="active"';;
	}
}

function nav_in($pages){
	$array = explode(",", $pages);
	$file = ltrim(strrchr ($_SERVER['SCRIPT_NAME'], "/"), "/");
	if(in_array($file, $array)){echo 'in';}
}

function nav_icon($pages){
	$array = explode(",", $pages);
	$file = ltrim(strrchr ($_SERVER['SCRIPT_NAME'], "/"), "/");
	if(in_array($file, $array)){echo 'fa-minus';}else{echo 'fa-plus';}
}

function breadcrumb($active, $path=""){
	echo '<div class="row"><ol class="breadcrumb"><li><em class="fa fa-home"></em></li>';
	if($path!=""){
		foreach(explode("/", $path) as $way){echo '<li>'.$way.'</li>';}
	}
	echo '<li class="active">'.$active.'</li></ol></div>';
}

function title($title){
	echo '<div class="row"><div class="col-lg-12"><h1 class="page-header">'.$title.'</h1></div></div>';
}

function panel_textarea($title, $icon, $label, $name, $value, $size, $offset=0){
	echo '<div class="col-md-'.$size;
	if($offset!=0){echo ' col-md-offset-'.$offset;}
	echo '"><div class="panel panel-default"><div class="panel-heading">'.$title.' <i class="fa '.$icon.'" aria-hidden="true"></i></div><div class="panel-body"><form class="form-horizontal" method="post"><fieldset><div class="form-group">';
	if($label!=""){echo '<label class="col-md-3 control-label" for="'.$name.'">'.$label.'</label><div class="col-md-9">';}else{echo '<div class="col-md-12">';}
	echo '<textarea id="'.$name.'" name="'.$name.'" type="text" class="form-control">'.$value.'</textarea></div></div><div class="form-group"><div class="col-md-12 widget-right"><button type="submit" class="btn btn-default btn-md pull-right">ändern</button></div></div></fieldset></form></div></div></div>';
}

function panel_textinput($title, $icon, $label, $name, $value, $size, $offset=0){
	echo '<div class="col-md-'.$size;
	if($offset!=0){echo ' col-md-offset-'.$offset;}
	echo '"><div class="panel panel-default"><div class="panel-heading">'.$title.' <i class="fa '.$icon.'" aria-hidden="true"></i></div><div class="panel-body"><form class="form-horizontal" method="post"><fieldset><div class="form-group">';
	if($label!=""){echo '<label class="col-md-3 control-label" for="'.$name.'">'.$label.'</label><div class="col-md-9">';}else{echo '<div class="col-md-12">';}
	echo '<input id="'.$name.'" name="'.$name.'" type="text" class="form-control" value="'.$value.'"></input></div></div><div class="form-group"><div class="col-md-12 widget-right"><button type="submit" class="btn btn-default btn-md pull-right">ändern</button></div></div></fieldset></form></div></div></div>';
}