<?php
$EXISTS = $_GET['exists'];
$SUCCESS = $_GET['success'];

include '../validation/Validator.php';

if (array_key_exists('email', $_GET)) {
    if (Validator::checkEmail($_GET['email'])) {
        echo json_encode(['response' => $EXISTS, 'id' => 'email']);
    } else {
        echo json_encode(['response' => $SUCCESS, 'id' => 'email']);
    }
} else if (array_key_exists('username', $_GET)) {
    if (Validator::checkUsername($_GET['username'])) {
        echo json_encode(['response' => $EXISTS, 'id' => 'username']);
    } else {
        echo json_encode(['response' => $SUCCESS, 'id' => 'username']);
    }
}