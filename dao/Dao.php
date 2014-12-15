<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FlightBookingDao
 *
 * @author emmett.newman
 */
class Dao {

    private $db = null;

    public function getDb() {
        if ($this->db !== null) {
            return $this->db;
        }
        $config = Config::getConfig("db");
        try {
            $this->db = new PDO($config['dsn'], $config['username'], $config['password']);
        } catch (Exception $ex) {
            throw new Exception('DB connection error: ' . $ex->getMessage());
        }
        return $this->db;
    }

    protected function execute($sql, $object) {
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($object));
        if (!$object->getId()) {
            return $this->findById($this->getDb()->lastInsertId());
        }
//        if (!$statement->rowCount()) {
//            throw new NotFoundException('Object with ID "' . $object->getId() . '" does not exist.');
//        }
        return $object;
    }

    protected function executeStatement(PDOStatement $statement, array $params) {
        if (!$statement->execute($params)) {
            self::throwDbError($this->getDb()->errorInfo());
        }
    }

    /**
     * 
     * @param type $table
     * @param type $idType
     * @param type $sortBy
     * @return string
     * 
     * This function generates and returns and sql query as a string based on input type. 
     * Input is either from the 'Sort By' select box or is is direct input from the user via the search function.
     */
    protected function compileSearchQuery($table, $sortBy, $idType = null) {
        $query = '';
        $whereClause = '';
        
        if ($idType !== null) {
            $whereClause = ' WHERE ' . $idType . ' = :' . $idType;
        }
        switch ($sortBy) {
            case 'country':
                $query = 'SELECT * FROM ' . $table . $whereClause . ' ORDER BY country';
                break;
            case 'a-z':
                $query = 'SELECT * FROM ' . $table . $whereClause . ' ORDER BY name';
                break;
            case 'z-a':
                $query = 'SELECT * FROM ' . $table . $whereClause . ' ORDER BY name DESC';
                break;
            case 'genre':
                $query = 'SELECT * FROM ' . $table . $whereClause . ' ORDER BY genre';
                break;
            case 'mostRecent':
                $query = 'SELECT * FROM ' . $table . $whereClause . ' ORDER BY uploadDate DESC';
                break;
            case 'trackNumber':
                $query = 'SELECT * FROM ' . $table . $whereClause . ' ORDER BY trackNumber';
                break;
            case 'artist':
                $query = 'SELECT * FROM ' . $table . $whereClause . ' ORDER BY artist';
                break;
            default:
                $query = 'SELECT * FROM ' . $table . $whereClause . ' AND name LIKE :sortBy ORDER BY name DESC';
        }

        return $query;
    }

    protected function query($sql) {
        $statement = $this->getDb()->query($sql, PDO::FETCH_ASSOC);
        return $statement;
    }

    public function __destruct() {
        $this->db = null;
    }

    protected static function throwDbError(array $errorInfo) {
        throw new Exception('DB error [' . $errorInfo[0] . ', ' . $errorInfo[1] . ']: ' . $errorInfo[2]);
    }

    protected static function formatDateTime(DateTime $dateTime) {
        $dateTime->format(DateTime::ISO8601);
        return $dateTime;
    }

}
