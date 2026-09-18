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

    public function isFavorite(int $userId, int $movieId): bool {
        try {

            $sql = "SELECT id FROM favorites WHERE user_id = :user_id AND movie_id = :movie_id";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
            $stmt->bindParam(":movie_id", $movieId, PDO::PARAM_INT);

            $stmt->execute();

            return (bool) $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

            error_log("Erro ao verificar favorito: " . $error->getMessage());

            return false;
        }
    }

    public function addFavorite(int $userId, int $movieId): bool {
        try {

            $sql = "INSERT INTO favorites(user_id, movie_id) VALUES (:user_id, :movie_id)";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
            $stmt->bindParam(":movie_id", $movieId, PDO::PARAM_INT);

            return $stmt->execute();

        } catch (PDOException $error) {

            error_log("Erro ao adicionar favorito: " . $error->getMessage());

            return false;
        }
    }

    public function removeFavorite(int $userId, int $movieId): bool {
        try {

            $sql = "DELETE FROM favorites WHERE user_id = :user_id AND movie_id = :movie_id";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
            $stmt->bindParam(":movie_id", $movieId, PDO::PARAM_INT);
            
            return $stmt->execute();

        } catch (PDOException $error) {

            error_log("Erro ao remover favorito: " . $error->getMessage());

            return false;
        }
    }

    public function getFavoritesByUser(int $userId): array {
        try {

            $sql = "SELECT movies.id, movies.title, movies.year, movies.category, movies.description, movies.curiosity, movies.image
                    FROM favorites INNER JOIN movies ON favorites.movie_id = movies.id WHERE favorites.user_id = :user_id ORDER BY movies.year ASC";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

            error_log("Erro ao buscar favoritos: " . $error->getMessage());

            return [];
        }
    }
}