<?php
/**
 * Created by PhpStorm.
 * User: Timo
 * Date: 18.08.2017
 * Time: 21:43
 */

function add_log($action){
    global $login;
    $user = str_replace('_', ' ', $login->getUserData()[0]);
    $ip = $_SERVER['REMOTE_ADDR'];
    $path = "logs/";
    $date = date("Y-m-d");
    $time = date("H:i:s");
    $document = fopen($path.$date.".txt", "a+");
    fwrite($document, "[".$time."]-[".$ip."]-[".$user."] ".$action."\n");
    fclose($document);
}