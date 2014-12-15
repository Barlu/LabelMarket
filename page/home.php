<?php

//$data = [
//    'name' => 'The Thress',
//    'description' => 'the Bestester',
//    'labelId' => 12,
//    'image' => 'http://www.joomlaworks.net/images/demos/galleries/abstract/7.jpg',
//    'genre' => 'Drum&Bass'
//];
//$album = new Album();
//Mapper::mapAlbum($album, $data);
//$albumDao = new AlbumDao();
//$savedAlbum = $albumDao->save($album);
//echo '<p> Album has been saveed under the id ' . $savedAlbum->getId();
//$albumDao = new AlbumDao();
//$albums = $albumDao->findAll(12, 'poop');
//
//foreach ($ablums as $album) {
//    echo '<p>'.$album->getName() . $album->getId().'</p>';
//}

//$adminDao = new AdminDao();
//
//$data = [
//    'role' => 'admin',
//    'username' => 'Barlu',
//    'password' => 'timeless',
//    'labelId' => 12
//];
//
//$admin = new Admin();
//
//Mapper::mapUser($admin, $data);
//$savedAdmin = $adminDao->save($admin);
//echo $savedAdmin->getId();
//Utils::createMixcloudLinkDeatil();
$mixDao = new MixDao();
$albumDao = new AlbumDao();
$labelDao = new LabelDao();

$mix = new Mix();
$albums = [];
$labelId = '';

$mixes = $mixDao->findAll('mostRecent');
$mix = $mixes[0];
$albums = $albumDao->findAll('mostRecent');


if(isset($_SESSION['labelId'])){
    unset($_SESSION['labelId']);
}

        
 

