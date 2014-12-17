<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MixDao
 *
 * @author emmett.newman
 */
class MixDao extends Dao {

    public function insert(Mix $mix) {
        $now = new DateTime;
        $mix->setId(null);
        $mix->setUploadDate($now->getTimestamp());
        $sql = 'INSERT INTO mix
                VALUES(:id, :labelId, :name, :artist, :description, :link, :uploadDate);';
        ;

        return $this->execute($sql, $mix);
    }

    public function update(Mix $mix) {
        $sql = '
            UPDATE mix
            SET labelId = :labelId, name = :name, artist = :artist, description = :description, link = :link, uploadDate = :uploadDate
            WHERE id = :id';

        return $this->execute($sql, $mix);
    }

    public function save(Mix $mix) {
        if ($mix->getId() === null) {
            return $this->insert($mix);
        }
        return $this->update($mix);
    }

    protected function getParams($mix) {
        $params = [
            ':id' => $mix->getId(),
            ':labelId' => $mix->getLabelId(),
            ':name' => $mix->getName(),
            ':artist' => $mix->getArtist(),
            ':description' => $mix->getDescription(),
            ':link' => $mix->getLink(),
            ':uploadDate' => $mix->getUploadDate(),
        ];

        return $params;
    }

    public function findById($id) {
        $sql = 'SELECT * FROM mix WHERE id = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(':id' => $id));
        $row = $statement->fetch();
        if (!$row) {
            return null;
        }
        $mix = new Mix();
        Mapper::mapMix($mix, $row);
        return $mix;
    }

    public function findAll($sortBy) {
        $sql = Dao::compileSearchQuery('mix', $sortBy);
        if (!strpos($sql, 'LIKE')) {
            $statement = $this->query($sql);
        } else {
            $statement = $this->getDb()->prepare($sql);
            $this->executeStatement($statement, array(
                ':sortBy' => '%' . $sortBy . '%'));
        }
        $results = $statement->fetchAll();
        $mixes = [];
        foreach ($results as $row) {
            $mix = new Mix();
            $mixes[] = Mapper::mapMix($mix, $row);
        }
        if (!$mixes) {
            return null;
        }
        return $mixes;
    }

    public function findByName($labelId, $name) {
        $sql = 'SELECT * FROM mix WHERE labelId = :labelId AND name = :name';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(
            ':labelId' => $labelId,
            ':name' => $name));
        $row = $statement->fetch();
        if ($row) {
            $mix = new Mix();
            Mapper::mapMix($mix, $row);
            return $mix;
        }
        return null;
    }

    public function findAllByLabel($labelId, $sortBy) {
        $sql = Dao::compileSearchQuery('mix', $sortBy, 'labelId');
        $statement = $this->getDb()->prepare($sql);
        if (!strpos($sql, 'LIKE')) {
            $this->executeStatement($statement, array(':labelId' => $labelId));
        } else {
            $this->executeStatement($statement, array(
                ':labelId' => $labelId,
                ':sortBy' => '%' . $sortBy . '%'));
        }
        $results = $statement->fetchAll();
        $mixes = [];
        foreach ($results as $row) {
            $mix = new Mix();
            $mixes[] = Mapper::mapMix($mix, $row);
        }
        if (!$mixes) {
            return null;
        }
        return $mixes;
    }

    public function delete($id) {
        $sql = '
            DELETE FROM mix 
            WHERE id = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(
            ':id' => $id
        ));
        return $statement->rowCount() == 1;
    }

}
