<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contact
 *
 * @author emmett.newman
 */
class Contact {

    private $id;
    private $userId;
    private $firstName;
    private $lastName;
    private $address;
    private $phoneNumber;
    private $email;
    private $portrait;

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPortrait() {
        return $this->portrait;
    }

    public function setId($id) {
        $this->id = (int) $id;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPortrait($portrait) {
        $this->portrait = $portrait;
    }

}
