<?php

namespace Controller;

use Model\Movie;

class MovieController {

    private $movieModel;

    public function __construct() {

        $this->movieModel = new Movie();
    }

    public function getAllMovies(): array {
        
        return $this->movieModel->getAllMovies();
    }
}