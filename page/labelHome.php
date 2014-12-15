<?php

$mixDao = new MixDao();
$albumDao = new AlbumDao();
$mix = new Mix();
$albums = [];
$labelId = '';

if (array_key_exists('labelId', $_GET)) {
    $labelId = $_GET['labelId'];
    $_SESSION['labelId'] = $_GET['labelId'];
} else if (array_key_exists('labelId', $_SESSION)) {
    $labelId = $_SESSION['labelId'];
} else {
    header('Location: index.php');
}

$mixes = $mixDao->findAllByLabel($labelId, 'mostRecent');
$mix = $mixes[0];
$albums = $albumDao->findAllByLabel($labelId, 'mostRecent');
