<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Song
 *
 * @author emmett.newman
 */
class Song {
    
    private $id;
    private $albumId;
    private $name;
    private $trackNumber;
    private $description;
    private $artist;
    private $genre;
    private $link;
    private $releaseDate;
    private $uploadDate;
    
    public function getId() {
        return $this->id;
    }

    public function getAlbumId() {
        return $this->albumId;
    }

    public function getName() {
        return $this->name;
    }

    public function getTrackNumber() {
        return $this->trackNumber;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getArtist() {
        return $this->artist;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function getLink() {
        return $this->link;
    }

    public function getReleaseDate() {
        return $this->releaseDate;
    }

    public function getUploadDate() {
        return $this->uploadDate;
    }

    public function setId($id) {
        $this->id = (int) $id;
    }

    public function setAlbumId($albumId) {
        $this->albumId = $albumId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setTrackNumber($trackNumber) {
        $this->trackNumber = $trackNumber;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setArtist($artist) {
        $this->artist = $artist;
    }

    public function setGenre($genre) {
        $this->genre = $genre;
    }

    public function setLink($link) {
        $this->link = $link;
    }

    public function setReleaseDate($releaseDate) {
        $this->releaseDate = $releaseDate;
    }

    public function setUploadDate($uploadDate) {
        $this->uploadDate = $uploadDate;
    }


}
