<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminDao
 *
 * @author emmett.newman
 */
class AdminDao extends Dao {
    
    public function insert(Admin $admin) {
        $admin->setRole('admin');
        $adminCopy = $admin;
        $userDao = new UserDao();
        $savedUser = $userDao->save($admin);
        $adminCopy->setId($savedUser->getId());
        
        $sql = 'INSERT INTO admin
                VALUES(:userId, :labelId);';
        
        return $this->execute($sql, $adminCopy);
    }

    public function update(Admin $admin){
        $adminCopy = $admin;
        $userDao = new UserDao();
        $savedUser = $userDao->save($admin);
        
        $sql = '
            UPDATE admin
            SET labelId = :labelId
            WHERE userId = :userId';
               
        return $this->execute($sql, $adminCopy);
    }
    public function save($object){
        if ($object->getId() === null){
            return $this->insert($object);
        }
        return $this->update($object);

    }
    
    protected function getParams($object) {
        $params = [
            ':userId' => $object->getId(),
            ':labelId' => $object->getLabelId(),
        ];
        
        return $params;
    }
    
    public function findById($id) {
        $sql = 'SELECT * FROM user, admin WHERE user.id = :id AND admin.userId = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(':id' => $id));
        $row = $statement->fetch();
        if (!$row) {
            return null;
        }
        $admin = new Admin();
        Mapper::mapUser($admin, $row);
        return $admin;
    }
    
    public function findByUsername($username) {
        $sql = 'SELECT * FROM user, admin WHERE user.username = :username AND admin.userId = user.id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(':username' => $username));
        $row = $statement->fetch();
        if (!$row) {
            return null;
        }
        $admin = new Admin();
        Mapper::mapUser($admin, $row);
        return $admin;
    }

    
    public function delete($id) {
        $sql = '
            DELETE *
            FROM user, admin
            WHERE user.id = :id AND admin.userId = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(
            ':id' => $id
        ));
        return $statement->rowCount() == 1;
    }
}
