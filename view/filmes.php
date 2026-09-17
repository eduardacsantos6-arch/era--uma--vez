<?php

session_start();

require_once "../vendor/autoload.php";

use Controller\UserController;

$userController = new UserController();

if (!$userController->isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$filmes = [

    1 => [
        "titulo" => "Branca de Neve e os Sete Anões",
        "ano" => 1937,
        "categoria" => "Princesas",
        "imagem" => "../img/branca-neve.jpg",
        "descricao" => "Uma jovem princesa precisa fugir da rainha má e encontra abrigo junto de sete anões."
    ],

    2 => [
        "titulo" => "Pinóquio",
        "ano" => 1940,
        "categoria" => "Aventura",
        "imagem" => "../img/pinocchio.jpg",
        "descricao" => "Um boneco de madeira sonha em se tornar um menino de verdade."
    ],

    3 => [
        "titulo" => "Cinderela",
        "ano" => 1950,
        "categoria" => "Princesas",
        "imagem" => "../img/cinderela.jpg",
        "descricao" => "Uma jovem maltratada pela própria família encontra uma oportunidade para mudar sua história."
    ],

    4 => [
        "titulo" => "Peter Pan",
        "ano" => 1953,
        "categoria" => "Aventura",
        "imagem" => "../img/peter-pan.jpg",
        "descricao" => "Peter Pan leva Wendy e seus irmãos para uma aventura na Terra do Nunca."
    ],

    5 => [
        "titulo" => "A Bela Adormecida",
        "ano" => 1959,
        "categoria" => "Princesas",
        "imagem" => "../img/bela-adormecida.jpg",
        "descricao" => "A princesa Aurora é envolvida por uma maldição que muda completamente seu destino."
    ],

    6 => [
        "titulo" => "A Pequena Sereia",
        "ano" => 1989,
        "categoria" => "Princesas",
        "imagem" => "../img/pequena-sereia.jpg",
        "descricao" => "Ariel sonha em conhecer o mundo humano e decide explorar o desconhecido."
    ],

    7 => [
        "titulo" => "A Bela e a Fera",
        "ano" => 1991,
        "categoria" => "Fantasia",
        "imagem" => "../img/bela-e-a-fera.jpg",
        "descricao" => "Belle acaba vivendo em um castelo encantado e conhece uma fera que esconde uma história."
    ],

    8 => [
        "titulo" => "Aladdin",
        "ano" => 1992,
        "categoria" => "Aventura",
        "imagem" => "../img/aladdin.jpg",
        "descricao" => "Um jovem encontra uma lâmpada mágica e descobre que sua vida pode mudar completamente."
    ],

    9 => [
        "titulo" => "O Rei Leão",
        "ano" => 1994,
        "categoria" => "Animais",
        "imagem" => "../img/rei-leao.jpg",
        "descricao" => "Simba precisa enfrentar desafios e descobrir seu lugar no ciclo da vida."
    ]

];

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
                            src="<?= $filme["imagem"] ?>"
                            alt="<?= htmlspecialchars($filme["titulo"]) ?>"
                        >

                        <div class="card-conteudo">

                            <span>
                                <?= $filme["ano"] ?> • <?= $filme["categoria"] ?>
                            </span>

                            <h3>
                                <?= htmlspecialchars($filme["titulo"]) ?>
                            </h3>

                            <p>
                                <?= htmlspecialchars($filme["descricao"]) ?>
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