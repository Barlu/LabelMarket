<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommentDao
 *
 * @author emmett.newman
 */
class CommentDao extends Dao {
    
    public function insert(Comment $comment) {
        $now = new DateTime;
        $comment->setId(null);
        $comment->setDateTime($now->getTimestamp());
        $sql = 'INSERT INTO comment
                VALUES(:id, :senderId, :receiverId, :comment, :dateTime);';
        
        return $this->execute($sql, $object);
    }

    public function update(Comment $comment){
        $sql = '
            UPDATE comment
            SET comment = :comment
            WHERE id = :id';
               
        return $this->execute($sql, $comment);
    }
    public function save($comment){
        if ($comment->getId() === null){
            return $this->insert($comment);
        }
        return $this->update($comment);

    }
    
    protected function getParams($comment) {
        $params = [
            ':id' => $comment->getId(),
            ':senderId' => $comment->getSenderId(),
            ':receiverId' => $comment->getReceiverId(),
            ':comment' => $comment->getComment(),
            ':dateTime' => $comment->getDateTime(),
        ];
        
        return $params;
    }
    
    public function findById($id) {
        $sql = 'SELECT * FROM comment WHERE id = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(':id' => $id));
        $row = $statement->fetch();
        if (!$row) {
            return null;
        }
        $comment = new Comment();
        Mapper::mapComment($comment, $row);
        return $comment;
    }
    
    public function findAll($receiverId, $sortBy) {
        $sql = Dao::compileSearchQuery('comment', $sortBy, 'receiverId');
        $statement = $this->getDb()->prepare($sql);
        if(!strpos($sql, 'LIKE')){
            $this->executeStatement($statement, array(':receiverId' => $receiverId));
        }else{
            $this->executeStatement($statement, array(
            ':receiverId' => $receiverId,
            ':sortBy' => '%'.$sortBy.'%'));
        }
        $results = $statement->fetchAll();
        $albums = [];
        foreach($results as $row){
            $album = new Album();
            $albums[] = Mapper::mapAlbum($album, $row);
        }
        if (!$albums) {
            return null;
        }
        return $albums;
    }
    
    public function delete($id) {
        $sql = '
            DELETE *
            FROM comment
            WHERE id = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(
            ':id' => $id
        ));
        return $statement->rowCount() == 1;
    }
}
