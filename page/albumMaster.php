<?php

$albumDao = new AlbumDao();
$albums = [];
if (array_key_exists('labelId', $_SESSION)) {
    if (array_key_exists('sortBy', $_GET)) {
        $albums = $albumDao->findAllByLabel($_SESSION['labelId'], $_GET['sortBy']);
    } else {
        $albums = $albumDao->findAllByLabel($_SESSION['labelId'], 'a-z');
    }
}

