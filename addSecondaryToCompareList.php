<?php
    session_start();
    if (!isset($_SESSION['SecondaryCompareList']))
        $_SESSION['SecondaryCompareList'] = array();
    
    $_SESSION['SecondaryCompareList'][] = $_POST['Id'];
    
    $lang = isset($_SESSION['Language']) ? $_SESSION['Language'] : 'en';
    $message = '';
    switch($lang){
        case 'en':
            $message = 'data added to compare list';
            break;
        case 'id':
            $message = 'data berhasil ditambahkan ke list perbandingan';
            break;        
    }
    echo $message;
?>