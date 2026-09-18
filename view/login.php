<?php

session_start();

require_once "../vendor/autoload.php";

use Controller\UserController;

$mensagem = "";
$tipoMensagem = "";

if($_SERVER["REQUEST_METHOD"] === "POST") {

     $email = $_POST["email"] ?? "";
     $senha = $_POST["senha"] ?? "";

     $userController = new UserController();

     if(empty($email) || empty($senha)) {

        $mensagem = "Preencha todos os campos!";
        $tipoMensagem = "erro";

     } elseif ($userController->login($email, $senha)) {

         header("Location: filmes.php");
         exit;

     } else {

        $mensagem = "E-mail ou senha incorretos!";
        $tipoMensagem = "erro";
     }
}

?>


<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Entrar | Era uma vez...</title>

    <link rel="stylesheet" href="/templates/global.css">
    <link rel="stylesheet" href="/templates/autenticacao.css">

</head>

<body class="pagina-auth">

    <main class="auth">

        <section class="auth-apresentacao">

    <span class="auth-simbolo">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            class="bi bi-moon-stars-fill"
            viewBox="0 0 16 16"
        >
            <path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278"/>

            <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.73 1.73 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.73 1.73 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.73 1.73 0 0 0 1.097-1.097zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.16 1.16 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.16 1.16 0 0 0-.732-.732z"/>
        </svg>
    </span>

    <h1>
        Era uma vez...
    </h1>

            <span>
                FILMES CLÁSSICOS DA DISNEY
            </span>

            <p>
                Entre para continuar sua viagem
                pelos clássicos que marcaram gerações.
            </p>

        </section>


        <section class="auth-formulario">

            <div class="formulario-conteudo">

                <span class="tag">
                    BEM-VINDO DE VOLTA
                </span>

                <h2>
                    Entrar
                </h2>

                <p class="descricao-formulario">
                    Acesse sua conta para explorar os filmes.
                </p>


                <?php if (!empty($mensagem)): ?>

                    <p class="mensagem <?= $tipoMensagem ?>">
                        <?= htmlspecialchars($mensagem) ?>
                    </p>

                <?php endif; ?>


                <form action="login.php" method="POST">

                    <div class="campo">

                        <label for="email">
                            E-mail
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Digite seu e-mail"
                            required
                        >

                    </div>


                    <div class="campo">

                        <label for="senha">
                            Senha
                        </label>

                        <input
                            type="password"
                            id="senha"
                            name="senha"
                            placeholder="Digite sua senha"
                            required
                        >

                    </div>


                    <button
                        type="submit"
                        class="botao botao-form"
                    >
                        Entrar
                    </button>

                </form>


                <p class="alternativa">

                    Ainda não possui uma conta?

                    <a href="cadastro.php">
                        Criar conta
                    </a>

                </p>


                <a
                    href="../index.php"
                    class="voltar"
                >
                    ← Voltar
                </a>

            </div>

        </section>

    </main>

</body>
</html>