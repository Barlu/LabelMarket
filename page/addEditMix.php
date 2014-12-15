<?php

$mixDao = new MixDao();
$mix = new Mix();
$mixId = '';
if (array_key_exists('labelId', $_GET)) {
    $_SESSION['labelId'] = $_GET['labelId'];
}
if (array_key_exists('mixId', $_GET)) {
    $mix = $mixDao->findById($_GET['mixId']);
    $mixId = '&mixId='.$_GET['mixId'];
    if (array_key_exists('delete', $_POST)) {
        $mixDao->delete($mix->getId());
        header('Location: index.php?page=mixMaster');
    }
} else {
    $mix->setArtist('');
    $mix->setDescription('');
    $mix->setLink('');
}

if (array_key_exists('save', $_POST)) {

    if (array_key_exists('mixId', $_GET)) {
        $data = [
            'id' => $_GET['mixId'],
            'labelId' => $_SESSION['labelId'],
            'name' => $_POST['name'],
            'artist' => $_POST['artist'],
            'description' => $_POST['description'],
            'link' => Utils::stripMixcloudId($_POST['link']),
            'uploadDate' => $mix->getUploadDate()
        ];
    } else {
        $data = [
            'name' => $_POST['name'],
            'artist' => $_POST['artist'],
            'labelId' => $_SESSION['labelId'],
            'description' => $_POST['description'],
            'link' => Utils::stripMixcloudId($_POST['link'])
        ];
    }

    Mapper::mapMix($mix, $data);
    if($mix->getId()){
        $savedMix = $mixDao->save($mix);
        unset($_SESSION['mixId']);
        header('Location: index.php?page=mixDetail&mixId=' . $savedMix->getId());
        die();
    }else if (Validator::checkUniqueMix($_POST['name'])) {
        $savedMix = $mixDao->save($mix);
        unset($_SESSION['mixId']);
        header('Location: index.php?page=mixDetail&mixId=' . $savedMix->getId());
        die();
    }
}


