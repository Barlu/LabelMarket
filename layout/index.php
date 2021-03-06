<?php

$cover = 'images/cover.jpg';
$logo = 'images/logo.jpg';
$labelName = 'Label Market';
$labelId;
$adminDao = new AdminDao();
$defaultPortrait = 'https://c1.staticflickr.com/5/4067/4570107261_d1c99c07e0_z.jpg';
$defaultLogo = 'http://cdn0.capterra-static.com/logos/150/vendor-placeholder-logo.png';
$title;

if (array_key_exists('labelId', $_SESSION) || array_key_exists('labelId', $_GET)) {
    if (array_key_exists('labelId', $_SESSION)) {
        $labelId = $_SESSION['labelId'];
    } else if (array_key_exists('labelId', $_GET)) {
        $labelId = $_GET['labelId'];
    }
    $labelDao = new LabelDao();
    $label = $labelDao->findById($labelId);
    $cover = $label->getCover();
    if ($label->getLogo()) {
        $logo = $label->getLogo();
    }else{
        $logo = $defaultLogo;
    }
    $labelName = $label->getName();
}

if (array_key_exists('page', $_GET)){
    switch ($_GET['page']) {
        case 'home' : 
            $title = 'Home | Label Market | Create your own Record Label to promote your Music';
            break;
        case 'labelMaster' : 
            $title = 'Browse | Label Market | Search all currently registered Labels';
            break;
        case 'register' : 
            $title = 'Registration | Label Market | Label/Account Registration';
            break;
        case 'logIn' : 
            $title = 'Log In | Label Market | Log In to your Label account';
            break;
        case 'labelHome' : 
            $title = $labelName.' | Label Market | Wanaka/Queenstown Scenic Adventures';
            break;
        case 'albumMaster' :
            $title = 'Albums | '.$labelName.' | Wanaka/Queenstown Scenic Adventures';
            break;
        case 'albumDetail' :
            $title = 'Album | '.$labelName.' | Wanaka/Queenstown Scenic Adventures';
            break;
        case 'songMaster' :
            $title = 'Songs | '.$labelName.' | Wanaka/Queenstown Scenic Adventures';
            break;
        case 'songDaster' :
            $title = 'Song | '.$labelName.' | Wanaka/Queenstown Scenic Adventures';
            break;
        case 'mixMaster' :
            $title = 'Mixes | '.$labelName.' | Wanaka/Queenstown Scenic Adventures';
            break;
        case 'mixDetail' :
            $title = 'Mix | '.$labelName.' | Wanaka/Queenstown Scenic Adventures';
            break;
        case 'addEditSong' :
            $title = 'Add/Edit Song | '.$labelName.' | Wanaka/Queenstown Scenic Adventures';
            break; 
        case 'addEditAlbum' :
            $title = 'Add/Edit Album | '.$labelName.' | Wanaka/Queenstown Scenic Adventures';
            break; 
        case 'addEditMix' :
            $title = 'Add/Edit Mix | '.$labelName.' | Wanaka/Queenstown Scenic Adventures';
            break; 
    }
}else{
    $title = 'Home | Label Market | Create your own Record Label to promote the Music you love';
}



if (array_key_exists('username', $_SESSION)) {
    $admin = $adminDao->findByUsername($_SESSION['username']);
}

$labelSortByArr = [['A-z', 'a-z'], ['Z-a', 'z-a'], ['Genre', 'genre'], ['Most Recent', 'mostRecent']];
$musicSortByArr = [['A-z', 'a-z'], ['Z-a', 'z-a'], ['Most Recent', 'mostRecent']];

//--------------------REGISTRATION
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

//--------------------REGISTRATION END

$genreArr = ['Breaks', 'Chill Out', 'Deep House', 'Drum & Bass', "Dubstep", 'Electro House', 'Electronica', 'Funk/R&B', 'Glitch Hop', 'Hard Dance', 'Hardcore/Hard Techno', 'Hip-hop', 'House', 'Indie Dance/Nu Disco', 'Minimal', 'Pop/Rock', 'Progressive House', 'Psy-Trance', 'Reggae/Dub', 'Tech House', 'Techno', 'Trance'];

$countryList = array(
    "AF" => "Afghanistan",
    "AL" => "Albania",
    "DZ" => "Algeria",
    "AS" => "American Samoa",
    "AD" => "Andorra",
    "AO" => "Angola",
    "AI" => "Anguilla",
    "AQ" => "Antarctica",
    "AG" => "Antigua and Barbuda",
    "AR" => "Argentina",
    "AM" => "Armenia",
    "AW" => "Aruba",
    "AU" => "Australia",
    "AT" => "Austria",
    "AZ" => "Azerbaijan",
    "BS" => "Bahamas",
    "BH" => "Bahrain",
    "BD" => "Bangladesh",
    "BB" => "Barbados",
    "BY" => "Belarus",
    "BE" => "Belgium",
    "BZ" => "Belize",
    "BJ" => "Benin",
    "BM" => "Bermuda",
    "BT" => "Bhutan",
    "BO" => "Bolivia",
    "BA" => "Bosnia and Herzegovina",
    "BW" => "Botswana",
    "BV" => "Bouvet Island",
    "BR" => "Brazil",
    "BQ" => "British Antarctic Territory",
    "IO" => "British Indian Ocean Territory",
    "VG" => "British Virgin Islands",
    "BN" => "Brunei",
    "BG" => "Bulgaria",
    "BF" => "Burkina Faso",
    "BI" => "Burundi",
    "KH" => "Cambodia",
    "CM" => "Cameroon",
    "CA" => "Canada",
    "CT" => "Canton and Enderbury Islands",
    "CV" => "Cape Verde",
    "KY" => "Cayman Islands",
    "CF" => "Central African Republic",
    "TD" => "Chad",
    "CL" => "Chile",
    "CN" => "China",
    "CX" => "Christmas Island",
    "CC" => "Cocos [Keeling] Islands",
    "CO" => "Colombia",
    "KM" => "Comoros",
    "CG" => "Congo - Brazzaville",
    "CD" => "Congo - Kinshasa",
    "CK" => "Cook Islands",
    "CR" => "Costa Rica",
    "HR" => "Croatia",
    "CU" => "Cuba",
    "CY" => "Cyprus",
    "CZ" => "Czech Republic",
    "CI" => "Côte d’Ivoire",
    "DK" => "Denmark",
    "DJ" => "Djibouti",
    "DM" => "Dominica",
    "DO" => "Dominican Republic",
    "NQ" => "Dronning Maud Land",
    "DD" => "East Germany",
    "EC" => "Ecuador",
    "EG" => "Egypt",
    "SV" => "El Salvador",
    "GQ" => "Equatorial Guinea",
    "ER" => "Eritrea",
    "EE" => "Estonia",
    "ET" => "Ethiopia",
    "FK" => "Falkland Islands",
    "FO" => "Faroe Islands",
    "FJ" => "Fiji",
    "FI" => "Finland",
    "FR" => "France",
    "GF" => "French Guiana",
    "PF" => "French Polynesia",
    "TF" => "French Southern Territories",
    "FQ" => "French Southern and Antarctic Territories",
    "GA" => "Gabon",
    "GM" => "Gambia",
    "GE" => "Georgia",
    "DE" => "Germany",
    "GH" => "Ghana",
    "GI" => "Gibraltar",
    "GR" => "Greece",
    "GL" => "Greenland",
    "GD" => "Grenada",
    "GP" => "Guadeloupe",
    "GU" => "Guam",
    "GT" => "Guatemala",
    "GG" => "Guernsey",
    "GN" => "Guinea",
    "GW" => "Guinea-Bissau",
    "GY" => "Guyana",
    "HT" => "Haiti",
    "HM" => "Heard Island and McDonald Islands",
    "HN" => "Honduras",
    "HK" => "Hong Kong SAR China",
    "HU" => "Hungary",
    "IS" => "Iceland",
    "IN" => "India",
    "ID" => "Indonesia",
    "IR" => "Iran",
    "IQ" => "Iraq",
    "IE" => "Ireland",
    "IM" => "Isle of Man",
    "IL" => "Israel",
    "IT" => "Italy",
    "JM" => "Jamaica",
    "JP" => "Japan",
    "JE" => "Jersey",
    "JT" => "Johnston Island",
    "JO" => "Jordan",
    "KZ" => "Kazakhstan",
    "KE" => "Kenya",
    "KI" => "Kiribati",
    "KW" => "Kuwait",
    "KG" => "Kyrgyzstan",
    "LA" => "Laos",
    "LV" => "Latvia",
    "LB" => "Lebanon",
    "LS" => "Lesotho",
    "LR" => "Liberia",
    "LY" => "Libya",
    "LI" => "Liechtenstein",
    "LT" => "Lithuania",
    "LU" => "Luxembourg",
    "MO" => "Macau SAR China",
    "MK" => "Macedonia",
    "MG" => "Madagascar",
    "MW" => "Malawi",
    "MY" => "Malaysia",
    "MV" => "Maldives",
    "ML" => "Mali",
    "MT" => "Malta",
    "MH" => "Marshall Islands",
    "MQ" => "Martinique",
    "MR" => "Mauritania",
    "MU" => "Mauritius",
    "YT" => "Mayotte",
    "FX" => "Metropolitan France",
    "MX" => "Mexico",
    "FM" => "Micronesia",
    "MI" => "Midway Islands",
    "MD" => "Moldova",
    "MC" => "Monaco",
    "MN" => "Mongolia",
    "ME" => "Montenegro",
    "MS" => "Montserrat",
    "MA" => "Morocco",
    "MZ" => "Mozambique",
    "MM" => "Myanmar [Burma]",
    "NA" => "Namibia",
    "NR" => "Nauru",
    "NP" => "Nepal",
    "NL" => "Netherlands",
    "AN" => "Netherlands Antilles",
    "NT" => "Neutral Zone",
    "NC" => "New Caledonia",
    "NZ" => "New Zealand",
    "NI" => "Nicaragua",
    "NE" => "Niger",
    "NG" => "Nigeria",
    "NU" => "Niue",
    "NF" => "Norfolk Island",
    "KP" => "North Korea",
    "VD" => "North Vietnam",
    "MP" => "Northern Mariana Islands",
    "NO" => "Norway",
    "OM" => "Oman",
    "PC" => "Pacific Islands Trust Territory",
    "PK" => "Pakistan",
    "PW" => "Palau",
    "PS" => "Palestinian Territories",
    "PA" => "Panama",
    "PZ" => "Panama Canal Zone",
    "PG" => "Papua New Guinea",
    "PY" => "Paraguay",
    "YD" => "People's Democratic Republic of Yemen",
    "PE" => "Peru",
    "PH" => "Philippines",
    "PN" => "Pitcairn Islands",
    "PL" => "Poland",
    "PT" => "Portugal",
    "PR" => "Puerto Rico",
    "QA" => "Qatar",
    "RO" => "Romania",
    "RU" => "Russia",
    "RW" => "Rwanda",
    "RE" => "Réunion",
    "BL" => "Saint Barthélemy",
    "SH" => "Saint Helena",
    "KN" => "Saint Kitts and Nevis",
    "LC" => "Saint Lucia",
    "MF" => "Saint Martin",
    "PM" => "Saint Pierre and Miquelon",
    "VC" => "Saint Vincent and the Grenadines",
    "WS" => "Samoa",
    "SM" => "San Marino",
    "SA" => "Saudi Arabia",
    "SN" => "Senegal",
    "RS" => "Serbia",
    "CS" => "Serbia and Montenegro",
    "SC" => "Seychelles",
    "SL" => "Sierra Leone",
    "SG" => "Singapore",
    "SK" => "Slovakia",
    "SI" => "Slovenia",
    "SB" => "Solomon Islands",
    "SO" => "Somalia",
    "ZA" => "South Africa",
    "GS" => "South Georgia and the South Sandwich Islands",
    "KR" => "South Korea",
    "ES" => "Spain",
    "LK" => "Sri Lanka",
    "SD" => "Sudan",
    "SR" => "Suriname",
    "SJ" => "Svalbard and Jan Mayen",
    "SZ" => "Swaziland",
    "SE" => "Sweden",
    "CH" => "Switzerland",
    "SY" => "Syria",
    "ST" => "São Tomé and Príncipe",
    "TW" => "Taiwan",
    "TJ" => "Tajikistan",
    "TZ" => "Tanzania",
    "TH" => "Thailand",
    "TL" => "Timor-Leste",
    "TG" => "Togo",
    "TK" => "Tokelau",
    "TO" => "Tonga",
    "TT" => "Trinidad and Tobago",
    "TN" => "Tunisia",
    "TR" => "Turkey",
    "TM" => "Turkmenistan",
    "TC" => "Turks and Caicos Islands",
    "TV" => "Tuvalu",
    "UM" => "U.S. Minor Outlying Islands",
    "PU" => "U.S. Miscellaneous Pacific Islands",
    "VI" => "U.S. Virgin Islands",
    "UG" => "Uganda",
    "UA" => "Ukraine",
    "SU" => "Union of Soviet Socialist Republics",
    "AE" => "United Arab Emirates",
    "GB" => "United Kingdom",
    "US" => "United States",
    "ZZ" => "Unknown or Invalid Region",
    "UY" => "Uruguay",
    "UZ" => "Uzbekistan",
    "VU" => "Vanuatu",
    "VA" => "Vatican City",
    "VE" => "Venezuela",
    "VN" => "Vietnam",
    "WK" => "Wake Island",
    "WF" => "Wallis and Futuna",
    "EH" => "Western Sahara",
    "YE" => "Yemen",
    "ZM" => "Zambia",
    "ZW" => "Zimbabwe",
    "AX" => "Åland Islands",
);
