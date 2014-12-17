<?php
$error = '';
if (array_key_exists('submit', $_POST)) {
    $userDao = new UserDao();
    $user = $userDao->findByUsername($_SESSION['username']);

    if (Utils::checkPassword($_POST['oldPassword'], $user->getPassword())) {
        if (strcmp($_POST['newPassword'], Utils::strip($_POST['confirmPassword'])) === 0) {
            $data = [
                'password' => Utils::cryptPassword($_POST['newPassword'])
            ];
            Mapper::mapUser($user, $data);
            $userDao->save($user);
            header('Location: index.php?page=profile');
            die();
        } else {
            $error = '<p class="error" >New passwords don\'t match. Please re-enter</p>';
        }
    } else {
        $error = '<p class="error">Current password incorrect. Please re-enter</p>';
    }
}

