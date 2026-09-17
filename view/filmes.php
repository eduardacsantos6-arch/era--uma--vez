<?php

session_start();

require_once "../vendor/autoload.php";

use Controller\UserController;
use Controller\MovieController;

$userController = new UserController();

if (!$userController->isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$movieController = new MovieController();

$filmes = $movieController->getAllMovies();

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Filmes | Era uma vez...</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=DM+Sans:wght@400;500;600&display=swap"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="../templates/global.css">

    <link rel="stylesheet" href="../templates/filmes.css">

</head>

<body>

    <header class="navbar">

        <div class="logo">

            <span>✦</span>

            <div>

                <strong>Era uma vez...</strong>

                <small>FILMES CLÁSSICOS</small>

            </div>

        </div>

        <nav>

            <a href="../index.php">
                Início
            </a>

            <a href="filmes.php" class="ativo">
                Filmes
            </a>

            <a href="login.php">
                Entrar
            </a>

        </nav>

    </header>


    <main>

        <section class="pagina-topo">

            <span class="tag">
                NOSSO CATÁLOGO
            </span>

            <h1>
                Filmes que
                <span>fizeram história.</span>
            </h1>

            <p>
                Relembre alguns dos grandes clássicos da animação
                e descubra um pouco mais sobre cada história.
            </p>

        </section>


        <section class="catalogo">

            <div class="filtro-area">

                <h2>
                    Todos os filmes
                </h2>

                <p>
                    <?= count($filmes) ?> clássicos disponíveis
                </p>

            </div>


            <div class="cards catalogo-cards">

               <?php foreach ($filmes as $filme): ?>

    <article class="card">

        <img
            src="../img/<?= htmlspecialchars($filme["image"]) ?>"
            alt="<?= htmlspecialchars($filme["title"]) ?>"
        >

        <div class="card-conteudo">

            <span>
                <?= $filme["year"] ?> • <?= htmlspecialchars($filme["category"]) ?>
            </span>

            <h3>
                <?= htmlspecialchars($filme["title"]) ?>
            </h3>

            <p>
                <?= htmlspecialchars($filme["description"]) ?>
            </p>

        </div>

    </article>

<?php endforeach; ?>

            </div>

        </section>

    </main>


    <footer>

        <div class="footer-logo">

            <strong>
                Era uma vez...
            </strong>

            <span>
                Uma homenagem aos clássicos que fizeram história.
            </span>

        </div>

        <p>
            Projeto acadêmico • 2026
        </p>

    </footer>

</body>

</html>