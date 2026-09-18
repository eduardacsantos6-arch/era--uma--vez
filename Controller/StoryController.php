<?php

namespace Controller;

use Model\Story;

class StoryController {

    private $storyModel;

    public function __construct() {

        $this->storyModel = new Story();
    }

    public function createStory(int $userId, int $movieId, string $title, string $content): bool {

        if (empty($title) || empty($content) || $userId <= 0 || $movieId <= 0) {
            return false;
        }

        return $this->storyModel->createStory($userId, $movieId, $title, $content);
    }

    public function getStoriesByUser(int $userId): array {
        
        return $this->storyModel->getStoriesByUser($userId);
    }
}