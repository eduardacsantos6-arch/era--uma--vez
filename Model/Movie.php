<?php

namespace Model;

use Model\Connection;
use PDO;
use PDOException;

class Movie
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function getAllMovies(): array
    {
        try {

            $sql = "SELECT
                        id,
                        title,
                        year,
                        category,
                        description,
                        curiosity,
                        image
                    FROM movies
                    ORDER BY year ASC";

            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

            error_log(
                "Erro ao buscar filmes: " .
                $error->getMessage()
            );

            return [];
        }
    }
}