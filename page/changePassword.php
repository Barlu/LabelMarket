<?php

if (array_key_exists('submit', $_POST)) {
    $userDao = new UserDao();
    $user = $userDao->findByUsername($_SESSION['username']);

    if (Utils::checkPassword($_POST['password'], $user->getPassword())) {
        if (strcmp($_POST['newPassword'], $_POST['confirmPassword']) === 0) {
            $data = [
                'password' => Utils::cryptPassword($_POST['newPassword'])
            ];
            Mapper::mapUser($user, $data);
            $userDao->save($user);
            header('Location: index.php?page=profile');
            die();
        } else {
            $error = '<p>New passwords don\'t match. Please re-enter</p>';
        }
    } else {
        $error = '<p>Current password incorrect. Please re-enter</p>';
    }
}

