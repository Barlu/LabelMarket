<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author emmett.newman
 */
class User {
    
    private $id;
    private $role;
    private $username;
    private $password;
    
    public function getId() {
        return $this->id;
    }

    public function getRole() {
        return $this->role;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setId($id) {
        $this->id = (int) $id;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }


}
