<?php

$error = '';
if (array_key_exists('submit', $_POST)) {
    $userDao = new UserDao();
    $user = $userDao->findByUsername($_POST['username']);
    $setPage = '';
    if ($user) {
        if (Utils::checkPassword($_POST['password'], $user->getPassword())) {
            if ($user->getRole() === 'admin') {
                $adminDao = new AdminDao();
                $user = $adminDao->findById($user->getId());
                $_SESSION['labelId'] = $user->getLabelId();
                $setPage = '?page=labelHome&labelId=' . $user->getLabelId();
            }
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['role'] = $user->getRole();

            header('Location: index.php' . $setPage);
        } else {
            $error = '<p>Username/password incorrect</p>';
        }
    } else {
        $error = '<p>Username/password incorrect</p>';
    }
}

