<?php

$songDao = new SongDao();
$songs = [];
if (array_key_exists('labelId', $_SESSION)) {
    if (array_key_exists('sortBy', $_GET)) {
        $songs = $songDao->findAllByLabel($_SESSION['labelId'], $_GET['sortBy']);
    } else {
        $songs = $songDao->findAllByLabel($_SESSION['labelId'], 'a-z');
    }
}

