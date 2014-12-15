<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mapper
 *
 * @author emmett.newman
 */
class Mapper {
    
    public static function mapLabel(Label $label, array $params) {
        
        if(array_key_exists('id', $params)){
            $label->setId($params['id']);
        }
        
        if(array_key_exists('name', $params)){
            $label->setName($params['name']);
        }
        
        if(array_key_exists('email', $params)){
            $label->setEmail($params['email']);
        }
        
        if(array_key_exists('country', $params)){
            $label->setCountry($params['country']);
        }
        
        if(array_key_exists('description', $params)){
            $label->setDescription($params['description']);
        }
        
        if(array_key_exists('genre', $params)){
            $label->setGenre($params['genre']);
        }
        
        if(array_key_exists('dateCreated', $params)){
            $label->setDateCreated($params['dateCreated']);
        }
        
        if(array_key_exists('cover', $params)){
            $label->setCover($params['cover']);
        }
        
        if(array_key_exists('logo', $params)){
            $label->setLogo($params['logo']);
        }
        
        return $label;
    }
    
    public static function mapUser(User $user, array $params) {
        
        if(array_key_exists('id', $params)){
            $user->setId($params['id']);
        }
        
        if(array_key_exists('role', $params)){
            $user->setRole($params['role']);
        }
        
        if(array_key_exists('username', $params)){
            $user->setUsername($params['username']);
        }
        
        if(array_key_exists('password', $params)){
            $user->setPassword($params['password']);
        }
        
        if(array_key_exists('labelId', $params)){
            $user->setLabelId($params['labelId']);
        }
        
        return $user;
    }
    
    public static function mapAlbum(Album $album, array $params) {
        
        if(array_key_exists('id', $params)){
            $album->setId($params['id']);
        }
        
        if(array_key_exists('labelId', $params)){
            $album->setLabelId($params['labelId']);
        }
        
        if(array_key_exists('name', $params)){
            $album->setName($params['name']);
        }
        
        if(array_key_exists('description', $params)){
            $album->setDescription($params['description']);
        }
        
        if(array_key_exists('genre', $params)){
            $album->setGenre($params['genre']);
        }
        
        if(array_key_exists('image', $params)){
            $album->setImage($params['image']);
        }
        
        if(array_key_exists('uploadDate', $params)){
            $album->setUploadDate($params['uploadDate']);
        }
        
        return $album;
    }
    
    public static function mapSong(Song $song, array $params) {
        
        if(array_key_exists('id', $params)){
            $song->setId($params['id']);
        }
        
        if(array_key_exists('albumId', $params)){
            $song->setAlbumId($params['albumId']);
        }
        
        if(array_key_exists('name', $params)){
            $song->setName($params['name']);
        }
        
        if(array_key_exists('trackNumber', $params)){
            $song->setTrackNumber($params['trackNumber']);
        }
        
        if(array_key_exists('description', $params)){
            $song->setDescription($params['description']);
        }
        
        if(array_key_exists('artist', $params)){
            $song->setArtist($params['artist']);
        }
        
        if(array_key_exists('genre', $params)){
            $song->setGenre($params['genre']);
        }
        
        if(array_key_exists('link', $params)){
            $song->setLink($params['link']);
        }
        
        if(array_key_exists('releaseDate', $params)){
            $song->setReleaseDate($params['releaseDate']);
        }
        
        if(array_key_exists('uploadDate', $params)){
            $song->setUploadDate($params['uploadDate']);
        }
        
        return $song;
    }
    
    public static function mapMix(Mix $mix, array $params) {
        
        if(array_key_exists('id', $params)){
            $mix->setId($params['id']);
        }
        
        if(array_key_exists('labelId', $params)){
            $mix->setLabelId($params['labelId']);
        }
        
        if(array_key_exists('name', $params)){
            $mix->setName($params['name']);
        }
        
        if(array_key_exists('artist', $params)){
            $mix->setArtist($params['artist']);
        }
        
        if(array_key_exists('description', $params)){
            $mix->setDescription($params['description']);
        }
        
        if(array_key_exists('link', $params)){
            $mix->setLink($params['link']);
        }
        
        if(array_key_exists('uploadDate', $params)){
            $mix->setUploadDate($params['uploadDate']);
        }
        
        return $mix;
    }
    
    public static function mapComment(Comment $comment, array $params) {
        
        if(array_key_exists('id', $params)){
            $comment->setId($params['id']);
        }
        
        if(array_key_exists('senderId', $params)){
            $comment->setSenderId($params['senderId']);
        }
        
        if(array_key_exists('receiverId', $params)){
            $comment->setReceiverId($params['receiverId']);
        }
        
        if(array_key_exists('comment', $params)){
            $comment->setComment($params['comment']);
        }
        
        if(array_key_exists('dateTime', $params)){
            $comment->setDateTime($params['dateTime']);
        }
        
        return $comment;
    }
    
    public static function mapContact(Contact $contact, array $params) {
        
        if(array_key_exists('id', $params)){
            $contact->setId($params['id']);
        }
        
        if(array_key_exists('userId', $params)){
            $contact->setUserId($params['userId']);
        }
        
        if(array_key_exists('firstName', $params)){
            $contact->setFirstName($params['firstName']);
        }
        
        if(array_key_exists('lastName', $params)){
            $contact->setLastName($params['lastName']);
        }
        
        if(array_key_exists('address', $params)){
            $contact->setAddress($params['address']);
        }
        
        if(array_key_exists('phoneNumber', $params)){
            $contact->setPhoneNumber($params['phoneNumber']);
        }
        
        if(array_key_exists('email', $params)){
            $contact->setEmail($params['email']);
        }
        
        if(array_key_exists('portrait', $params)){
            $contact->setPortrait($params['portrait']);
        }
        
        return $contact;
    }
}
