<?php
session_start();
if(!isset($_SESSION['Language']))
    $_SESSION['Language'] = 'en';
include_once('languages/'.$_SESSION['Language'].'.php');
?>