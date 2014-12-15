<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlbumDao
 *
 * @author emmett.newman
 */
class AlbumDao extends Dao{
    
    private function insert(Album $album) {
        $now = new DateTime;
        $album->setId(null);
        $album->setUploadDate($now->getTimestamp());
        $sql = 'INSERT INTO album
                VALUES(:id , :labelId, :name, :description, :genre, :image, :uploadDate);';
        
        return $this->execute($sql, $album);
    }

    private function update(Album $album){
        $sql = '
            UPDATE album
            SET labelId = :labelId, name = :name, description = :description, genre = :genre, image = :image, uploadDate = :uploadDate
            WHERE id = :id';
               
        return $this->execute($sql, $album);
    }
    public function save(Album $album){
        if ($album->getId() === null){
            return $this->insert($album);
        }
        return $this->update($album);

    }
    
    protected function getParams(Album $album) {
        $params = [
            ':id' => $album->getId(),
            ':labelId' => $album->getLabelId(),
            ':name' => $album->getName(),
            ':description' => $album->getDescription(),
            ':genre' => $album->getGenre(),
            ':image' => $album->getImage(),
            ':uploadDate' => $album->getUploadDate()
        ];
        
        return $params;
    }
    
    public function findById($id) {
        $row = $this->query('
                SELECT * 
                FROM album
                WHERE id = ' . (int) $id)->fetch();
        if (!$row) {
            return null;
        }
        $album = new Album();
        Mapper::mapAlbum($album, $row);
        return $album;
    }
    
    /**
     * 
     * @param type $labelId
     * @param type $sortBy
     * @return null
     * 
     * function returns result set based on search criteria and sort method.
     * 
     */
    public function findAll($sortBy) {
        $sql = Dao::compileSearchQuery('album', $sortBy);
        if(!strpos($sql, 'LIKE')){
            $statement = $this->query($sql);
        } else {
            $statement = $this->getDb()->prepare($sql);
            $this->executeStatement($statement, array(
            ':sortBy' => '%'.$sortBy.'%'
        ));
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
    
    public function findAllByLabel($labelId, $sortBy) {
        $sql = Dao::compileSearchQuery('album', $sortBy, 'labelId');
        $statement = $this->getDb()->prepare($sql);
        if(!strpos($sql, 'LIKE')){
            $this->executeStatement($statement, array(':labelId' => $labelId));
        }else{
            $this->executeStatement($statement, array(
            ':labelId' => $labelId,
            ':sortBy' => '%'.$sortBy.'%'
        ));
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
            DELETE FROM album
            WHERE id = :id;
            DELETE FROM song
            WHERE albumId = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(
            ':id' => $id
        ));
        return $statement->rowCount() == 1;
    }
}
