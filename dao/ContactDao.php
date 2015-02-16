<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContactDao
 *
 * @author emmett.newman
 */

include_once '../dao/Dao.php';

class ContactDao extends Dao {
    
    public function insert(Contact $contact) {
        $contact->setId(null);
        $sql = 'INSERT INTO contact
                VALUES(:id, :userId, :firstName, :lastName, :address, :phoneNumber, :email, :portrait);';
        return $this->execute($sql, $contact);
    }

    public function update(Contact $contact){
        $sql = '
            UPDATE contact
            SET id = :id, firstName = :firstName, lastName = :lastName, address = :address, phoneNumber = :phoneNumber, email = :email, portrait = :portrait  
            WHERE userId = :userId';
        return $this->execute($sql, $contact);
    }
    public function save(Contact $contact){
        if ($contact->getId() === null){
            return $this->insert($contact);
        }
        return $this->update($contact);

    }
    
    protected function getParams($contact) {
        $params = [
            ':id' => $contact->getId(),
            ':userId' => $contact->getUserId(),
            ':firstName' => $contact->getFirstName(),
            ':lastName' => $contact->getLastName(),
            ':address' => $contact->getAddress(),
            ':phoneNumber' => $contact->getPhoneNumber(),
            ':email' => $contact->getEmail(),
            ':portrait'=> $contact->getPortrait()
        ];
        
        return $params;
    }
    
    public function findById($id) {
        $sql = 'SELECT * FROM contact WHERE id = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(':id' => $id));
        $row = $statement->fetch();
        if (!$row) {
            return null;
        }
        $contact = new Contact();
        Mapper::mapContact($contact, $row);
        return $contact;
    }
    
    public function findByUserId($id) {
        $sql = 'SELECT * FROM contact WHERE userId = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(':id' => $id));
        $row = $statement->fetch();
        if (!$row) {
            return null;
        }
        $contact = new Contact();
        Mapper::mapContact($contact, $row);
        return $contact;
    }
    
    public function findByEmail($email) {
        $sql = 'SELECT * FROM contact WHERE email = :email';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(':email' => $email));
        $row = $statement->fetch();
        if (!$row) {
            return null;
        }
        $contact = new Contact();
        Mapper::mapContact($contact, $row);
        return $contact;
    }
    
    public function delete($id) {
        $sql = '
            DELETE * 
            FROM contact
            WHERE id = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(
            ':id' => $id
        ));
        return $statement->rowCount() == 1;
    }
}
