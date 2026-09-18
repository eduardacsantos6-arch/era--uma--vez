<?php

namespace Model;

use Model\Connection;
use PDO;
use PDOException;

class Story {
    private $db;

     public function __construct() {

        $this->db = Connection::getInstance();
     }

     public function createStory(int $userId, int $movieId, string $title, string $content): bool {
        try {

             $sql = "INSERT INTO stories (user_id, movie_id, title, content) VALUES (:user_id, :movie_id, :title, :content)";

             $stmt = $this->db->prepare($sql);

              $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
              $stmt->bindParam(":movie_id", $movieId, PDO::PARAM_INT);
              $stmt->bindParam(":title", $title, PDO::PARAM_STR);
              $stmt->bindParam(":content", $content, PDO::PARAM_STR);

              return $stmt->execute();

        } catch (PDOException $error) {

           error_log("Erro ao criar história: " . $error->getMessage());

           return false;

        }

        }

         public function getStoriesByUser(int $userId): array{
            try {

               $sql = "SELECT stories.id, stories.title, stories.content, movies.title AS movie_title FROM stories INNER JOIN movies
               ON stories.movie_id = movies.id WHERE stories.user_id = :user_id ORDER BY stories.id DESC";

               $stmt = $this->db->prepare($sql);

               $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);

               $stmt->execute();

               return $stmt->fetchAll(PDO::FETCH_ASSOC);

                } catch (PDOException $error) {

                   error_log("Erro ao buscar histórias: " . $error->getMessage());

                   return [];
         }

         }

}