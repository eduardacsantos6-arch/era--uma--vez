<?php

session_start();

require_once "../vendor/autoload.php";

use Controller\UserController;
use Controller\MovieController;
use Controller\FavoriteController;

$userController = new UserController();

if (!$userController->isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$movieController = new MovieController();
$favoriteController = new FavoriteController();

$filmes = $movieController->getAllMovies();

$userId = $_SESSION["id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $movieId = $_POST["movie_id"] ?? 0;

    if ($movieId > 0) {

        $favoriteController->toggleFavorite(
            $userId,
            (int) $movieId
        );
    }

    header("Location: filmes.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Filmes | Era uma vez...</title>

    <link
        rel="stylesheet"
        href="../templates/global.css"
    >

    <link
        rel="stylesheet"
        href="../templates/filmes.css"
    >

</head>

<body>

    <!-- NAVBAR -->

    <header class="navbar">

        <a href="../index.php" class="logo">
            ✦ Era uma vez...
        </a>

        <nav>

            <a href="../index.php">
                Início
            </a>

            <a href="filmes.php" class="ativo">
                Filmes
            </a>

            <a href="favoritos.php">
                Favoritos
            </a>

            <a href="curiosidades.php">
                Curiosidades
            </a>

            <a href="historias.php">
                Minha história
            </a>

            <a href="login.php">
                Sair
            </a>

        </nav>

    </header>


    <!-- CONTEÚDO PRINCIPAL -->

    <main>

        <!-- APRESENTAÇÃO -->

        <section class="pagina-topo">

            <span class="tag">
                NOSSO CATÁLOGO
            </span>

            <h1>
                Filmes que <span>fizeram história.</span>
            </h1>

            <p>
                Relembre alguns dos grandes clássicos da
                animação e descubra um pouco mais sobre
                cada história.
            </p>

        </section>


        <!-- CATÁLOGO -->

        <section class="catalogo">

            <div class="filtro-area">

                <div>

                    <h2>
                        Todos os filmes
                    </h2>

                    <p>
                        <?= count($filmes) ?>
                        clássicos disponíveis
                    </p>

                </div>

            </div>


            <!-- CARDS -->

            <div class="cards catalogo-cards">

                <?php foreach ($filmes as $filme): ?>

                    <article class="card">

                        <!-- IMAGEM + FAVORITO -->

                        <div class="card-imagem">

                            <img
                                src="../img/<?= htmlspecialchars($filme["image"]) ?>"
                                alt="<?= htmlspecialchars($filme["title"]) ?>"
                            >

                            <form
                                action="filmes.php"
                                method="POST"
                                class="form-favorito"
                            >

                                <input
                                    type="hidden"
                                    name="movie_id"
                                    value="<?= $filme["id"] ?>"
                                >

                                <?php if (
    $favoriteController->isFavorite(
        $userId,
        $filme["id"]
    )
): ?>

    <button
        type="submit"
        class="botao-favorito favorito"
        title="Remover dos favoritos"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            class="bi bi-star-fill"
            viewBox="0 0 16 16"
        >
            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
        </svg>
    </button>

<?php else: ?>

    <button
        type="submit"
        class="botao-favorito"
        title="Adicionar aos favoritos"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            class="bi bi-star-fill"
            viewBox="0 0 16 16"
        >
            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
        </svg>
    </button>

<?php endif; ?>
                            </form>

                        </div>


                        <!-- INFORMAÇÕES DO FILME -->

                       <div class="card-conteudo">
    <span>
        <?= $filme["year"] ?>
        •
        <?= htmlspecialchars($filme["category"]) ?>
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


    <!-- FOOTER -->

    <footer>

        <p>
            © 2026 Era uma vez... · Projeto acadêmico
        </p>

    </footer>

</body>
</html>