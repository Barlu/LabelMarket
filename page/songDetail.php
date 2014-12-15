<?php

$songDao = new SongDao();
$song = new Song();
$albumDao = new AlbumDao();
$album = new Album();


if(array_key_exists('songId', $_GET)){
    $song = $songDao->findById($_GET['songId']);
    $album = $albumDao->findById($song->getAlbumId());
}else{
    header('Location: index.php?page=songMaster');
}

