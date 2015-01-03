<?php 
session_start();
$inactive = 1800; // Set timeout period in seconds

if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        session_destroy();
        header("Location: index.php");
    }
}
if (!isset($_SESSION['User'])){
    header("Location: index.php");
}
$_SESSION['timeout'] = time();
?>