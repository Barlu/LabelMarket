<?php

$albumDao = new AlbumDao();
$songDao = new SongDao();
$album = new Album();

if(array_key_exists('albumId', $_GET)){
    $album = $albumDao->findById($_GET['albumId']);
    $songs = $songDao->findAllByAlbum($album->getId(), 'trackNumber');
}else{
    header('Location: index.php?page=albumMaster');
}

