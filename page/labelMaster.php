<?php

$labelDao = new LabelDao();
if(array_key_exists('sortBy', $_GET)){
    $labels = $labelDao->findAll($_GET['sortBy']);
} else {
    $labels = $labelDao->findAll('a-z');
}

if(isset($_SESSION['labelId'])){
    unset($_SESSION['labelId']);
}

