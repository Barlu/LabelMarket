<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserDao
 *
 * @author emmett.newman
 */

include_once '../dao/Dao.php';

class UserDao extends Dao {
    
    public function insert(User $user) {
        $now = new DateTime;
        $user->setId(null);
        $sql = 'INSERT INTO user
                VALUES(:id, :role, :username, :password);';
        
        return $this->execute($sql, $user);
    }

    public function update(User $user){
        $sql = '
            UPDATE user
            SET username = :username, role = :role, password = :password
            WHERE id = :id';
               
        return $this->execute($sql, $user);
    }
    public function save(User $user){
        if ($user->getId() === null){
            return $this->insert($user);
        }
        return $this->update($user);

    }
    
    protected function getParams($user) {
        $params = [
            ':id' => $user->getId(),
            ':role' => $user->getRole(), 
            ':username' => $user->getUsername(), 
            ':password' => $user->getPassword()
        ];
        
        return $params;
    }
    
    public function findById($id) {
        $sql = 'SELECT * FROM user WHERE id = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(':id' => $id));
        $row = $statement->fetch();
        if (!$row) {
            return null;
        }
        $user = new User();
        Mapper::mapUser($user, $row);
        return $user;
    }
    
    public function findByUsername($username) {
        $sql = 'SELECT * FROM user WHERE username = :username';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(':username' => $username));
        $row = $statement->fetch();
        if (!$row) {
            return null;
        }
        $user = new User();
        Mapper::mapUser($user, $row);
        return $user;
    }
    
    public function delete($id) {
        $sql = '
            DELETE *
            FROM user
            WHERE id = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(
            ':id' => $id
        ));
        return $statement->rowCount() == 1;
    }
}
