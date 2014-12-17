<?php

$error = '';

$admin = new Admin();
$admin->setUsername('');

$contact = new Contact();
$contact->setEmail('');
$contact->setFirstName('');
$contact->setLastName('');
$contact->setPortrait('');
$contact->setAddress('');
$contact->setPhoneNumber('');

$label = new Label();
$label->setGenre('');
$label->setCountry('');
$label->setCover('');
$label->setLogo('');
$label->setDescription('');
$label->setEmail('');
$label->setName('');

if (array_key_exists('username', $_SESSION)) {
    $labelDao = new LabelDao();
    $contactDao = new ContactDao();
    $adminDao = new AdminDao();
    $admin = $adminDao->findByUsername($_SESSION['username']);
    $contact = $contactDao->findByUserId($admin->getId());
    $label = $labelDao->findById($admin->getLabelId());
     
    if (array_key_exists('submit', $_POST)) {

        $adminData = [
            'username' => $_POST['username']
        ];

        $contactData = [
            'firstName' => $_POST['firstName'],
            'lastName' => $_POST['lastName'],
            'email' => $_POST['email'],
            'portrait' => $_POST['portrait'],
            'address' => $_POST['address'],
            'phoneNumber' => $_POST['international'] . '-' . $_POST['area'] . '-' . $_POST['phone']
        ];

        $labelData = [
            'name' => $_POST['labelName'],
            'email' => $_POST['labelEmail'],
            'country' => $_POST['country'],
            'logo' => $_POST['logo'],
            'cover' => $_POST['cover'],
            'genre' => $_POST['genre'],
            'description' => $_POST['description']
        ];
        
        if ($_POST['username'] !== $admin->getUsername()) {
            if(!Validator::checkUsername($_POST['username'])) {

//                header('Location: index.php?page=logIn');
//                die();

                $error = '<p>Username already taken</p>';
            }
        }
        
        Mapper::mapUser($admin, $adminData);
        Mapper::mapContact($contact, $contactData);
        Mapper::mapLabel($label, $labelData);

        
        
            
            $savedLabel = $labelDao->save($label);
            $savedAdmin = $adminDao->save($admin);
            $contactDao->save($contact);
        
    }
    if($contact->getPortrait()){
        $portrait = $contact->getPortrait();
    } else {
        $portrait = $defaultPortrait;
    }
    if($contact->getPhoneNumber()){
        $phoneArr = explode('-', $contact->getPhoneNumber());
    } else {
        $phoneArr = ['','',''];
    }
} else {
    header('Location: index.php');
}

