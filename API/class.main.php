<?php
/**
 * Created by PhpStorm.
 * User: fokke
 * Date: 11/12/16
 * Time: 6:39 PM
 * Thiss class holds all the general api methods and holds the database construct
 */

require("class.database.php");

class Main {

    public $database;
    public $dbuser;
    public $dbpass;

    function __construct($dbuser, $dbpass, $db) {
        // set global database variables, init main db connection
        $this->dbuser = $dbuser;
        $this->dbpass = $dbpass;
        $this->database = new Database($dbuser, $dbpass, $db);
    }

    /**
     * @param      $data
     * @param bool $success
     */
    public function showResults($data, $success = true) {
        // successful or failed return code
        if (!$success)
            http_response_code(400);

        // print data
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    /**
     * @param $message
     */
    public function throwError($message) {
        // failed call, return failed request message
        $this->showResults($message, false);
        die();
    }

    public function validateParams($params, $required) {
        foreach($required as $p) {
            if(!isset($params[$p]) || $params[$p] == "") {
                $this->throwError("Missing parameter: ".$p);
            }
        }
    }

}
?>
