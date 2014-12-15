<?php

$mixDao = new MixDao();
$mix = new Mix();

if(array_key_exists('mixId', $_GET)){
    $mix = $mixDao->findById($_GET['mixId']);
}else{
    header('Location: index.php?page=mixMaster');
}
