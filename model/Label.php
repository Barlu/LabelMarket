<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Label
 *
 * @author emmett.newman
 */
class Label {

    private $id;
    private $name;
    private $email;
    private $country;
    private $uploadDate;
    private $cover;
    private $logo;
    private $genre;
    private $description;
    
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

        public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    
    public function getGenre() {
        return $this->genre;
    }

    public function setGenre($genre) {
        $this->genre = $genre;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getUploadDate() {
        return $this->uploadDate;
    }

    public function getCover() {
        return $this->cover;
    }

    public function getLogo() {
        return $this->logo;
    }

    public function setId($id) {
        $this->id = (int) $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function setUploadDate($uploadDate) {
        $this->uploadDate = $uploadDate;
    }

    public function setCover($cover) {
        $this->cover = $cover;
    }

    public function setLogo($logo) {
        $this->logo = $logo;
    }

}
