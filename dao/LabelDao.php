<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LabelDao
 *
 * @author emmett.newman
 */
class LabelDao extends Dao{
    
    public function insert(Label $label) {
        $now = new DateTime;
        $label->setId(null);
        $label->setDateCreated($now->getTimestamp());
        $sql = 'INSERT INTO label
                VALUES(:id, :name, :email, :country, :description, :genre, :dateCreated, :cover, :logo);';
        return $this->execute($sql, $label);
    }

    public function update(Label $label){
        $sql = 'UPDATE label
                SET name = :name, email = :email, country = :country, description = :description, genre = :genre, dateCreated = :dateCreated, cover = :cover, logo = :logo 
                WHERE id = :id;';
               
        return $this->execute($sql, $label);
    }
    public function save(Label $label){
        if ($label->getId() === null){
            return $this->insert($label);
        }
        return $this->update($label);

    }
    
    protected function getParams(Label $label) {
        $params = [
            ':id' => $label->getId(),
            ':name' => $label->getName(),
            ':email' => $label->getEmail(),
            ':genre' => $label->getGenre(),
            ':country' => $label->getCountry(),
            ':description' => $label->getDescription(),
            ':cover' => $label->getCover(),
            ':logo' => $label->getLogo(),
            ':dateCreated' => $label->getDateCreated(),
        ];
        
        return $params;
    }
    
    public function findById($id) {
        $sql = 'SELECT * FROM label WHERE id = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(':id' => $id));
        $row = $statement->fetch();
        if (!$row) {
            return null;
        }
        $label = new Label();
        Mapper::mapLabel($label, $row);
        return $label;
    }
    
    public function findAll($sortBy) {
        $sql = Dao::compileSearchQuery('label', $sortBy);
        if(!strpos($sql, 'LIKE')){
            $statement = $this->query($sql);
        }else{
            $statement = $this->getDb()->prepare($sql);
            $this->executeStatement($statement, array(
            ':sortBy' => '%'.$sortBy.'%'));
        }
        $results = $statement->fetchAll();
        $labels = [];
        foreach($results as $row){
            $label = new Label();
            $labels[] = Mapper::mapLabel($label, $row);
        }
        if (!$labels) {
            return null;
        }
        return $labels;
    }
    
    public function delete($id) {
        $sql = '
            Delete *
            FROM label
            WHERE id = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(
            ':id' => $id
        ));
        return $statement->rowCount() == 1;
    }
}
