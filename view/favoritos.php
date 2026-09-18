<?php

session_start();

require_once "../vendor/autoload.php";

use Controller\UserController;
use Controller\FavoriteController;

$userController = new UserController();
$favoriteController = new FavoriteController();

if(!$userController->isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION["id"];

$filmesFavoritos = $favoriteController->getFavoritesByUser($userId);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Meus Favoritos | Era uma vez...</title>

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

    <a href="favoritos.php" class="ativo">
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


    <main>

        <section class="pagina-topo">

            <span class="tag">
                MINHA COLEÇÃO
            </span>

            <h1>
                Meus <span>favoritos.</span>
            </h1>

            <p>
                Os clássicos que você escolheu guardar
                para sempre.
            </p>

        </section>


        <section class="catalogo">

            <div class="filtro-area">

                <h2>
                    Filmes favoritos
                </h2>

                <p>
                    <?= count($filmesFavoritos) ?> filme(s) salvo(s)
                </p>

            </div>


            <?php if (empty($filmesFavoritos)): ?>

                <div class="sem-favoritos">

                    <h3>
                        Você ainda não tem favoritos.
                    </h3>

                    <p>
                        Volte para os filmes e escolha
                        alguns clássicos para guardar.
                    </p>

                    <a href="filmes.php" class="botao">
                        Ver filmes
                    </a>

                </div>

            <?php else: ?>

                <div class="cards catalogo-cards">

                    <?php foreach ($filmesFavoritos as $filme): ?>

                        <article class="card">

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

                                    <button
                                        type="submit"
                                        class="botao-favorito favorito"
                                        title="Remover dos favoritos"
                                    >
                                        ★
                                    </button>

                                </form>

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

    <p>
        <?= htmlspecialchars($filme["description"]) ?>
    </p>
</div>

                        </article>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        </section>

    </main>


    <footer>

        <p>
            © 2026 Era uma vez... · Projeto acadêmico
        </p>

    </footer>

</body>
</html>