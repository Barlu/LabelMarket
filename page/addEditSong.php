<?php

if (array_key_exists('albumId', $_GET)) {
    $albumDao = new AlbumDao();
    $album = $albumDao->findById($_GET['albumId']);
    $songDao = new SongDao();


    $songs = $songDao->findAllByAlbum($_GET['albumId'], 'trackNumber');
    if (array_key_exists('saveSong', $_POST)) {
        if (strlen($_POST['songId']) > 0) {
            $data = [
                'id' => $_POST['songId'],
                'albumId' => $_GET['albumId'],
                'name' => $_POST['name'],
                'artist' => $_POST['artist'],
                'trackNumber' => $_POST['trackNumber'],
                'description' => $_POST['description'],
                'link' => Utils::stripSoundcloudId($_POST['link']),
                'genre' => $_POST['genre'],
                'releaseDate' => $_POST['releaseDate']
            ];
        } else {
            $data = [
                'albumId' => $_GET['albumId'],
                'name' => $_POST['name'],
                'artist' => $_POST['artist'],
                'trackNumber' => $_POST['trackNumber'],
                'description' => $_POST['description'],
                'link' => Utils::stripSoundcloudId($_POST['link']),
                'genre' => $_POST['genre'],
                'releaseDate' => $_POST['releaseDate']
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
