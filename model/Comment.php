<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Comment
 *
 * @author emmett.newman
 */
class Comment {
    
    private $id;
    private $senderId;
    private $receiverId;
    private $comment;
    private $dateTime;
    
    public function getId() {
        return $this->id;
    }

    public function getSenderId() {
        return $this->senderId;
    }

    public function getReceiverId() {
        return $this->receiverId;
    }

    public function getComment() {
        return $this->comment;
    }

    public function getDateTime() {
        return $this->dateTime;
    }

    public function setId($id) {
        $this->id = (int) $id;
    }

    public function setSenderId($senderId) {
        $this->senderId = $senderId;
    }

    public function setReceiverId($receiverId) {
        $this->receiverId = $receiverId;
    }

    public function setComment($comment) {
        $this->comment = $comment;
    }

    public function setDateTime($dateTime) {
        $this->dateTime = $dateTime;
    }


}
