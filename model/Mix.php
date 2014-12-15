<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mix
 *
 * @author emmett.newman
 */
class Mix {

    private $id;
    private $labelId;
    private $name;
    private $artist;
    private $description;
    private $link;
    private $uploadDate;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getId() {
        return $this->id;
    }

    public function getLabelId() {
        return $this->labelId;
    }

    public function getArtist() {
        return $this->artist;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getLink() {
        return $this->link;
    }

    public function getUploadDate() {
        return $this->uploadDate;
    }

    public function setId($id) {
        $this->id = (int) $id;
    }

    public function setLabelId($labelId) {
        $this->labelId = $labelId;
    }

    public function setArtist($artist) {
        $this->artist = $artist;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setLink($link) {
        
        $this->link = $link;
    }

    public function setUploadDate($uploadDate) {
        $this->uploadDate = $uploadDate;
    }

}
