<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Album
 *
 * @author emmett.newman
 */
class Album {
    
    private $id;
    private $labelId;
    private $name;
    private $description;
    private $genre;
    private $image;
    private $uploadDate;
    
    public function getId() {
        return $this->id;
    }

    public function getLabelId() {
        return $this->labelId;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function getImage() {
        return $this->image;
    }

    public function setId($id) {
        $this->id = (int) $id;
    }

    public function setLabelId($labelId) {
        $this->labelId = $labelId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setGenre($genre) {
        $this->genre = $genre;
    }

    public function setImage($image) {
        $this->image = $image;
    }
    public function getUploadDate() {
        return $this->uploadDate;
    }

    public function setUploadDate($uploadDate) {
        $this->uploadDate = $uploadDate;
    }

}
