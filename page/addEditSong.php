<?php

if (array_key_exists('albumId', $_GET)) {
    $albumDao = new AlbumDao();
    $album = $albumDao->findById(Utils::strip($_GET['albumId']));
    $songDao = new SongDao();


    $songs = $songDao->findAllByAlbum($_GET['albumId'], 'trackNumber');
    if (array_key_exists('saveSong', $_POST)) {
        if( strlen(trim($_POST['releaseDate'])) !== 0){
            $releaseDate = Utils::convertDateToTimestamp($_POST['releaseDate']);
        }else{
            $now = new DateTime();
            $releaseDate = $now->getTimestamp();
        }
        if (strlen($_POST['songId']) > 0) {
            $data = [
                'id' => Utils::strip($_POST['songId']),
                'albumId' => Utils::strip($_GET['albumId']),
                'name' => Utils::strip($_POST['name']),
                'artist' => Utils::strip($_POST['artist']),
                'trackNumber' => Utils::strip($_POST['trackNumber']),
                'description' => Utils::strip($_POST['description']),
                'link' => Utils::stripSoundcloudId($_POST['link']),
                'genre' => Utils::strip($_POST['genre']),
                'releaseDate' => $releaseDate
            ];
        } else {
            $data = [
                'albumId' => Utils::strip($_GET['albumId']),
                'name' => Utils::strip($_POST['name']),
                'artist' => Utils::strip($_POST['artist']),
                'trackNumber' => Utils::strip($_POST['trackNumber']),
                'description' => Utils::strip($_POST['description']),
                'link' => Utils::stripSoundcloudId($_POST['link']),
                'genre' => Utils::strip($_POST['genre']),
                'releaseDate' => $releaseDate
            ];
        }
        $song = new Song();
        Mapper::mapSong($song, $data);
        $savedSong = $songDao->save($song);
        header('Location: index.php?page=addEditSong&albumId='.$_GET['albumId']);
        die();
    }
    if (array_key_exists('finish', $_POST)) {
        unset($_SESSION['albumId']);
        header('Location: index.php?page=albumDetail&albumId='.$_GET['albumId']);
        die();
    }
    if (array_key_exists('deleteSong', $_POST)) {
        $songDao->delete($_POST['songId']);
        header('Location: index.php?page=addEditSong&albumId='.$_GET['albumId']);
        die();
    }
} else {
    header('Location: index.php?page=addEditAlbum');
    die();
}
