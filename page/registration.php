<?php
$error = '';

$admin = new Admin();
$admin->setUsername('');

$contact = new Contact();
$contact->setEmail('');
$contact->setFirstName('');
$contact->setLastName('');
$contact->setPortrait('');

$label = new Label();
$label->setGenre('');
$label->setCountry('');
$label->setCover('');
$label->setLogo('');
$label->setDescription('');
$label->setEmail('');
$label->setName('');


if (array_key_exists('submit', $_POST)) {

    $adminData = [
        'username' => Utils::escape($_POST['username']),
        'password' => Utils::cryptPassword($_POST['password'])
    ];

    $contactData = [
        'firstName' => Utils::escape($_POST['firstName']),
        'lastName' => Utils::escape($_POST['lastName']),
        'email' => Utils::escape($_POST['email']),
        'portrait' => Utils::escape($_POST['portrait'])
    ];

    $labelData = [
        'name' => Utils::escape($_POST['labelName']),
        'email' => Utils::escape($_POST['labelEmail']),
        'country' => Utils::escape($_POST['country']),
        'logo' => Utils::escape($_POST['logo']),
        'cover' => Utils::escape($_POST['cover']),
        'genre' => Utils::escape($_POST['genre']),
        'description' => Utils::escape($_POST['description'])
    ];

    Mapper::mapUser($admin, $adminData);
    Mapper::mapContact($contact, $contactData);
    Mapper::mapLabel($label, $labelData);

    if (Validator::checkUsername($admin->getUsername())) {
        if (Utils::escape($_POST['password']) === Utils::escape($_POST['passwordRepeat']) && strlen(trim($_POST['passwordRepeat'])) > 5) {
            $labelDao = new LabelDao();
            $savedLabel = $labelDao->save($label);
            $adminDao = new AdminDao();
            $admin->setLabelId($savedLabel->getId());
            $savedAdmin = $adminDao->save($admin);
            $contactDao = new ContactDao();
            $contact->setUserId($savedAdmin->getId());
            $contactDao->save($contact);
            header('Location: index.php?page=logIn');
            die();
        }else {
            $error = '<p>Password doesnt Match</p>';
        }
    } else {
        $error = '<p>Username already taken</p>';
    }
}



