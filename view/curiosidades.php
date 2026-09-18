<?php

session_start();

require_once "../vendor/autoload.php";

use Controller\UserController;
use Controller\MovieController;

$userController = new UserController();
$movieController = new MovieController();

if(!$userController->isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$filmes = $movieController->getAllMovies();

$filmeSelecionado = null;

if(isset($_GET["id"])) {

   $movieId = (int) $_GET["id"];

   if($movieId > 0) {
    $filmeSelecionado = $movieController->getMovieById($movieId);
   }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Curiosidades | Era uma vez...</title>

    <link rel="stylesheet" href="../templates/global.css">
    <link rel="stylesheet" href="../templates/filmes.css">

</head>

<body>

    <header class="navbar">

        <a href="../index.php" class="logo">
            ✦ Era uma vez...
        </a>

   <nav>
    <a href="../index.php">Início</a>
    <a href="filmes.php">Filmes</a>
    <a href="favoritos.php">Favoritos</a>
    <a href="curiosidades.php" class="ativo">Curiosidades</a>
    <a href="historias.php">Histórias</a>
    <a href="login.php">Sair</a>
   </nav>

    </header>


    <main>

        <section class="pagina-topo">

            <span class="tag">
                VOCÊ SABIA?
            </span>

            <h1>
                Curiosidades que <span>marcaram história.</span>
            </h1>

            <p>
                Descubra pequenos detalhes e curiosidades
                sobre os clássicos que fizeram parte da infância
                de tantas gerações.
            </p>

        </section>


        <?php if ($filmeSelecionado): ?>

            <section class="curiosidade-destaque">

                <img
                    src="../img/<?= htmlspecialchars($filmeSelecionado["image"]) ?>"
                    alt="<?= htmlspecialchars($filmeSelecionado["title"]) ?>"
                >

                <div>

                    <span class="tag">
                        <?= $filmeSelecionado["year"] ?>
                        •
                        <?= htmlspecialchars($filmeSelecionado["category"]) ?>
                    </span>

                    <h2>
                        <?= htmlspecialchars($filmeSelecionado["title"]) ?>
                    </h2>

                    <p>
                        <?= htmlspecialchars($filmeSelecionado["curiosity"]) ?>
                    </p>

                    <a href="curiosidades.php" class="botao">
                        Ver outros filmes
                    </a>

                </div>

            </section>

        <?php else: ?>

            <section class="catalogo">

                <div class="filtro-area">

                    <h2>
                        Escolha um filme
                    </h2>

                    <p>
                        Clique em um clássico para descobrir
                        uma curiosidade.
                    </p>

                </div>


                <div class="cards catalogo-cards">

                    <?php foreach ($filmes as $filme): ?>

                        <article class="card">

                            <div class="card-imagem">

                                <img
                                    src="../img/<?= htmlspecialchars($filme["image"]) ?>"
                                    alt="<?= htmlspecialchars($filme["title"]) ?>"
                                >

                            </div>

                            <div class="card-conteudo">

                                <span>
                                    <?= $filme["year"] ?>
                                    •
                                    <?= htmlspecialchars($filme["category"]) ?>
                                </span>

                                <h3>
                                    <?= htmlspecialchars($filme["title"]) ?>
                                </h3>

                                <a
                                    href="curiosidades.php?id=<?= $filme["id"] ?>"
                                    class="botao"
                                >
                                    Ver curiosidade
                                </a>

                            </div>

                        </article>

                    <?php endforeach; ?>

                </div>

            </section>

        <?php endif; ?>

    </main>


    <footer>

        <p>
            © 2026 Era uma vez... · Projeto acadêmico
        </p>

    </footer>

</body>
</html>