<?php

$mixDao = new MixDao();
$mixes = [];

if (array_key_exists('labelId', $_SESSION)) {
    if (array_key_exists('sortBy', $_GET)) {
        $mixes = $mixDao->findAllByLabel($_SESSION['labelId'], $_GET['sortBy']);
    } else {
        $mixes = $mixDao->findAllByLabel($_SESSION['labelId'], 'artist');
    }
}else{
    header('Location: index.php');
}