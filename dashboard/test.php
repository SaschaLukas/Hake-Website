<?php
require('assets/php/requirements.php');

/*--------------Login--------------*/
$login = new login(false, false, true);
$login->setMYSQL('riverspoon.one.mysql', 'riverspoon_one', 'sascha', 'riverspoon_one');
$login->getData();
$login->login_check('index.php');


/*--------------Build the Page--------------*/
require('assets/templates/top.php');

breadcrumb('test', 'Pages');
title('test');

panel_textarea("TITEL", "fa-check-circle", "LABEL", "NAME", "VALUE", 4, 0); //Titel, FontAwesome-Icon, Label, name, Value, size, offset
panel_textinput("TITEL", "fa-check-circle", "LABEL", "NAME", "VALUE", 4, 0); //Titel, FontAwesome-Icon, Label, name, Value, size, offset

require('assets/templates/bottom.php');