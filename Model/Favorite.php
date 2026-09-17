<?php

namespace Model;

use Model\Connection;
use PDO;
use PDOException;

class Favorite {

    private $db;

    public function __construct() {

        $this->db = Connection::getInstance();
    }

    public function is
}