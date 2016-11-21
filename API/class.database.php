<?php
/**
 * Created by PhpStorm.
 * User: fokke
 * Date: 11/12/16
 * Time: 6:39 PM
 * This file contains all the databas methods including the database connection. Please alter the mysql host and DBName
 * to your database
 */

class Database {
    private $instance;
    public $last_insert_id;
    public $rows_affected;

    function __construct($user, $pass, $db) {
        $this->instance = new PDO("mysql:host=;dbname=" . $db, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    public function fetchAll($query, $params = array()) {
        $r = $this->instance->prepare($query);
        $r->execute($params);
        return $r->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch($query, $params = array()) {
        $r = $this->instance->prepare($query);
        $r->execute($params);
        return $r->fetch(PDO::FETCH_ASSOC);
    }

    public function getVar($query, $params = array()) {
        $result = $this->fetch($query, $params);
        return reset($result);
    }

    public function query($query, $binds = null, $lastid = false) {

        $r      = $this->instance->prepare($query);
        $return = $r->execute($binds);

        $this->last_insert_id = $this->instance->lastInsertId();
        return $lastid ? $this->last_insert_id : $return;
    }
}
?>