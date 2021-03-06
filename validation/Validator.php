<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validator
 *
 * @author emmett.newman
 */

include '../dao/UserDao.php';
include '../dao/ContactDao.php';

class Validator {

    public static function checkUsername($username) {
        $userDao = new UserDao();
        if ($userDao->findByUsername($username)) {
            return true;
        }
        return false;
    }
    
    public static function checkEmail($email) {
        $contactDao = new ContactDao();
        if ($contactDao->findByEmail($email)) {
            return true;
        }
        return false;
    }

    public static function checkUniqueMix($name) {
        $mixDao = new MixDao();
        $mixes = $mixDao->findByName($_SESSION['labelId'], $name);
        if ($mixes) {
            foreach ($mixes as $mix) {
                if (strcmp($mix->getName(), $name) === 0) {
                    return false;
                }
            }
        }
        return true;
    }
}
