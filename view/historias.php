<?php

session_start();

require_once "../vendor/autoload.php";

use Controller\UserController;
use Controller\MovieController;
use Controller\StoryController;

$userController = new UserController();
$movieController = new MovieController();
$storyController = new StoryController();

if (!$userController->isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION["id"];

$filmes = $movieController->getAllMovies();

$mensagem = "";
$tipoMensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $movieId = (int) ($_POST["movie_id"] ?? 0);
    $title = trim($_POST["title"] ?? "");
    $content = trim($_POST["content"] ?? "");

    if ($movieId <= 0 || empty($title) || empty($content)) {

        $mensagem = "Preencha todos os campos.";
        $tipoMensagem = "erro";

    } else {

        $resultado = $storyController->createStory($userId, $movieId, $title, $content);

        if ($resultado) {

            $mensagem = "Sua história foi criada com sucesso!";
            $tipoMensagem = "sucesso";

        } else {

            $mensagem = "Não foi possível criar sua história.";
            $tipoMensagem = "erro";
        }
    }
}

$historias = $storyController->getStoriesByUser($userId);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Minha História | Era uma vez...</title>

    <link
        rel="stylesheet"
        href="../templates/global.css"
    >

    <link
        rel="stylesheet"
        href="../templates/historias.css"
    >

</head>

<body>

<header class="navbar">

    <a href="../index.php" class="logo">
        ✦ Era uma vez...
    </a>

    <nav>

        <a href="../index.php">
            Início
        </a>

        <a href="filmes.php">
            Filmes
        </a>

        <a href="favoritos.php">
            Favoritos
        </a>

        <a href="curiosidades.php">
            Curiosidades
        </a>

        <a href="historias.php" class="ativo">
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
            ESCREVA SUA HISTÓRIA
        </span>

        <h1>
            Toda história pode ter
            <span>um novo final.</span>
        </h1>

        <p>
            Toda criança já sonhou em escrever sua própria história.
            Agora que você cresceu, que tal criar um novo roteiro
            para alguns filmes que te acompanharam em uma fase encantada?
        </p>

    </section>


    <?php if (!empty($mensagem)): ?>

        <div class="mensagem <?= $tipoMensagem ?>">

            <?= htmlspecialchars($mensagem) ?>

        </div>

    <?php endif; ?>


    <section class="criacao-historia">

        <div class="historia-formulario">

            <h2>
                Crie seu novo roteiro
            </h2>

            <form
                action="historias.php"
                method="POST"
            >

                <div class="campo">

                    <label for="movie_id">
                        Escolha um filme
                    </label>

                    <select
                        name="movie_id"
                        id="movie_id"
                        required
                    >

                        <option value="">
                            Selecione um clássico
                        </option>

                        <?php foreach ($filmes as $filme): ?>

                            <option
                                value="<?= $filme["id"] ?>"
                            >
                                <?= htmlspecialchars($filme["title"]) ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <div class="campo">

                    <label for="title">
                        Título da sua história
                    </label>

                    <input
                        type="text"
                        name="title"
                        id="title"
                        placeholder="Ex.: Um novo destino"
                        maxlength="150"
                        required
                    >

                </div>


                <div class="campo">

                    <label for="content">
                        Escreva seu roteiro
                    </label>

                    <textarea
                        name="content"
                        id="content"
                        rows="10"
                        placeholder="Era uma vez..."
                        required
                    ></textarea>

                </div>


                <button
                    type="submit"
                    class="botao"
                >
                    Criar história
                </button>

            </form>

        </div>

    </section>


    <section class="minhas-historias">

        <div class="filtro-area">

            <div>

                <h2>
                    Minhas histórias
                </h2>

                <p>
                    Veja os roteiros que você criou.
                </p>

            </div>

        </div>


        <?php if (empty($historias)): ?>

            <div class="sem-historias">

                <h3>
                    Ainda não existe nenhuma história.
                </h3>

                <p>
                    Crie seu primeiro roteiro e dê um novo destino
                    a um dos clássicos.
                </p>

            </div>

        <?php else: ?>

            <div class="historias-lista">

                <?php foreach ($historias as $historia): ?>

                    <article class="historia-card">

                        <span class="tag">
                            <?= htmlspecialchars($historia["movie_title"]) ?>
                        </span>

                        <h3>
                            <?= htmlspecialchars($historia["title"]) ?>
                        </h3>

                        <p>
                            <?= nl2br(
                                htmlspecialchars(
                                    $historia["content"]
                                )
                            ) ?>
                        </p>

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