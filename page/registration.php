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
        'username' => Utils::strip($_POST['username']),
        'password' => Utils::cryptPassword($_POST['password'])
    ];

    $contactData = [
        'firstName' => Utils::strip($_POST['firstName']),
        'lastName' => Utils::strip($_POST['lastName']),
        'email' => Utils::strip($_POST['email']),
        'portrait' => Utils::strip($_POST['portrait'])
    ];

    $labelData = [
        'name' => Utils::strip($_POST['labelName']),
        'email' => Utils::strip($_POST['labelEmail']),
        'country' => Utils::strip($_POST['country']),
        'logo' => Utils::strip($_POST['logo']),
        'cover' => Utils::strip($_POST['cover']),
        'genre' => Utils::strip($_POST['genre']),
        'description' => Utils::strip($_POST['description'])
    ];

    Mapper::mapUser($admin, $adminData);
    Mapper::mapContact($contact, $contactData);
    Mapper::mapLabel($label, $labelData);

    if (Validator::checkUsername($admin->getUsername())) {
        if (Utils::strip($_POST['password']) === Utils::strip($_POST['passwordRepeat']) && strlen(trim($_POST['passwordRepeat'])) > 5) {
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



