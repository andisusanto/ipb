<?php
session_start();
if(!isset($_SESSION['Language']))
    $_SESSION['Language'] = 'id';
include_once('languages/'.$_SESSION['Language'].'.php');
?>