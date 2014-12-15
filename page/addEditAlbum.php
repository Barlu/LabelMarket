<?php

$album = new Album();
$albumDao = new AlbumDao();

if (array_key_exists('albumId', $_GET)) {
    $album = $albumDao->findById($_GET['albumId']);
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
            'id' => $_SESSION['albumId'],
            'name' => $_POST['name'],
            'labelId' => $_SESSION['labelId'],
            'description' => $_POST['description'],
            'image' => $_POST['image'],
            'genre' => $_POST['genre']
        ];
    } else {
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'labelId' => $_SESSION['labelId'],
            'image' => $_POST['image'],
            'genre' => $_POST['genre']
        ];
    }
    Mapper::mapAlbum($album, $data);
    $savedAlbum = $albumDao->save($album);

    $_SESSION['albumId'] = $savedAlbum->getId();
    
    header('Location: index.php?page=addEditSong&albumId='.$_SESSION['albumId']);
    die();
}  
