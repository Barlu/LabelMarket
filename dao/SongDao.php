<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SongDao
 *
 * @author emmett.newman
 */
class SongDao extends Dao {
    
    public function insert(Song $song) {
        $now = new DateTime;
        $song->setId(null);
        $song->setUploadDate($now->getTimestamp());
        $sql = 'INSERT INTO song
                VALUES(:id, :albumId, :name, :trackNumber, :description, :artist, :genre, :link, :releaseDate, :uploadDate);';
        
        return $this->execute($sql, $song);
    }

    public function update(Song $song){
        $sql = '
            UPDATE song
            SET name = :name, albumId = :albumId, trackNumber = :trackNumber, description = :description, artist = :artist, genre = :genre, link = :link, releaseDate = :releaseDate, uploadDate = :uploadDate
            WHERE id = :id';
               
        return $this->execute($sql, $song);
    }
    public function save(Song $song){
        if ($song->getId() === null){
            return $this->insert($song);
        }
        return $this->update($song);

    }
    
    protected function getParams($song) {
        $params = [
            ':id' => $song->getId(),
            ':albumId' => $song->getAlbumId(), 
            ':name' => $song->getName(), 
            ':trackNumber' => $song->getTrackNumber(), 
            ':description' => $song->getDescription(), 
            ':artist' => $song->getArtist(), 
            ':genre' => $song->getGenre(), 
            ':link' => $song->getLink(), 
            ':releaseDate' => $song->getReleaseDate(), 
            ':uploadDate' => $song->getUploadDate()
        ];
        
        return $params;
    }
    
    public function findById($id) {
        $sql = 'SELECT * FROM song WHERE id = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(':id' => $id));
        $row = $statement->fetch();
        if (!$row) {
            return null;
        }
        $song = new Song();
        Mapper::mapSong($song, $row);
        return $song;
    }
    
    public function findAllByLabel($labelId, $sortBy) {
        $albumDao = new AlbumDao();
        $albums = $albumDao->findAllByLabel($labelId, 'a-z');
        $songGroup = [];
        $songs = [];
        if($albums){
        foreach ($albums as $album) {
            $songGroup[] = $this->findAllByAlbum($album->getId(), 'a-z');
        }
        foreach ($songGroup as $album) {
            foreach ($album as $song) {
                $songs[] = $song;
            }
        }
        }else{
            return null;
        }
        return $songs;
    }
    
    public function findAllByAlbum($albumId, $sortBy) {
        $sql = Dao::compileSearchQuery('song', $sortBy, 'albumId');
        $statement = $this->getDb()->prepare($sql);
        if(!strpos($sql, 'LIKE')){
            $this->executeStatement($statement, array(':albumId' => $albumId));
        }else{
            $this->executeStatement($statement, array(
            ':albumId' => $albumId,
            ':sortBy' => '%'.$sortBy.'%'));
        }
        $results = $statement->fetchAll();
        $songs = [];
        foreach($results as $row){
            $song = new Song();
            $songs[] = Mapper::mapSong($song, $row);
        }
        if (!$songs) {
            return null;
        }
        return $songs;
    }
    
    public function delete($id) {
        $sql = '
            DELETE FROM song
            WHERE id = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(
            ':id' => (int) $id
        ));
        return $statement->rowCount() == 1;
    }
}
