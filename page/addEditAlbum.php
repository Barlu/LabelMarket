<?php

$album = new Album();
$albumDao = new AlbumDao();

if (array_key_exists('albumId', $_GET)) {
    $album = $albumDao->findById(Utils::strip($_GET['albumId']));
    $_SESSION['albumId'] = $_GET['albumId'];
} else {
    $album->setName('');
    $album->setDescription('');
    $album->setGenre('');
    $album->setImage('');
}
if (array_key_exists('albumDelete', $_POST)){
    $albumDao->delete($_SESSION['albumId']);
    unset($_SESSION['albumId']);
    header('Location: index.php');
    die();
}
if (array_key_exists('albumSave', $_POST)) {
    if (array_key_exists('albumId', $_SESSION)) {
        $data = [
            'id' => Utils::strip($_SESSION['albumId']),
            'name' => Utils::strip($_POST['name']),
            'labelId' => Utils::strip($_SESSION['labelId']),
            'description' => Utils::strip($_POST['description']),
            'image' => Utils::strip($_POST['image']),
            'genre' => Utils::strip($_POST['genre'])
        ];
    } else {
        $data = [
            'name' => Utils::strip($_POST['name']),
            'description' => Utils::strip($_POST['description']),
            'labelId' => Utils::strip($_SESSION['labelId']),
            'image' => Utils::strip($_POST['image']),
            'genre' => Utils::strip($_POST['genre'])
        ];
    }
    Mapper::mapAlbum($album, $data);
    $savedAlbum = $albumDao->save($album);

    $_SESSION['albumId'] = $savedAlbum->getId();
    
    header('Location: index.php?page=addEditSong&albumId='.$_SESSION['albumId']);
    die();
}  
