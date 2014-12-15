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
        'username' => escape($_POST['username']),
        'password' => Utils::cryptPassword($_POST['password'])
    ];

    $contactData = [
        'firstName' => escape($_POST['firstName']),
        'lastName' => escape($_POST['lastName']),
        'email' => escape($_POST['email']),
        'portrait' => escape($_POST['portrait'])
    ];

    $labelData = [
        'name' => escape($_POST['labelName']),
        'email' => escape($_POST['labelEmail']),
        'country' => escape($_POST['country']),
        'logo' => escape($_POST['logo']),
        'cover' => escape($_POST['cover']),
        'genre' => escape($_POST['genre']),
        'description' => escape($_POST['description'])
    ];

    Mapper::mapUser($admin, $adminData);
    Mapper::mapContact($contact, $contactData);
    Mapper::mapLabel($label, $labelData);

    if (Validator::checkUsername($admin->getUsername())) {
        if (escape($_POST['password']) === escape($_POST['passwordRepeat']) && strlen(trim($_POST['passwordRepeat'])) > 5) {
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



