<?php

namespace Controller;

use Model\Favorite;

class FavoriteController {

    private $favoriteModel;

    public function __construct() {

        $this->favoriteModel = new Favorite();
    }

    public function isFavorite(int $userId, int $movieId): bool {

        return $this->favoriteModel->isFavorite($userId, $movieId);
    }

    public function toggleFavorite(int $userId, int $movieId): bool {

        if ($this->isFavorite($userId, $movieId)) {

            return $this->favoriteModel->removeFavorite($userId, $movieId);
        }

        return $this->favoriteModel->addFavorite($userId, $movieId);
    }

    public function getFavoritesByUser(int $userId): array {

        return $this->favoriteModel->getFavoritesByUser($userId);
    }
}