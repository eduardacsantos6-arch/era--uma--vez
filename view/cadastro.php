<?php

require_once "../vendor/autoload.php";

use Controller\UserController;

$mensagem = "";
$tipoMensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = $_POST["nome"] ?? "";
    $email = $_POST["email"] ?? "";
    $senha = $_POST["senha"] ?? "";
    $confirmarSenha = $_POST["confirmar_senha"] ?? "";

    $userController = new UserController();

    if (!$userController->checkPasswordMatch($senha, $confirmarSenha)) {

        $mensagem = "As senhas não são iguais!";
        $tipoMensagem = "erro";

    } elseif (!$userController->passwordValidation($senha)) {

        $mensagem = "A senha deve ter entre 8 e 33 caracteres, com letra maiúscula, minúscula e número.";
        $tipoMensagem = "erro";

    } elseif ($userController->checkUserByEmail($email)) {

        $mensagem = "Este e-mail já está cadastrado.";
        $tipoMensagem = "erro";

    } elseif ($userController->createUser($nome, $email, $senha)) {

        $mensagem = "Cadastro realizado com sucesso!";
        $tipoMensagem = "sucesso";

    } else {

        $mensagem = "Não foi possível realizar o cadastro.";
        $tipoMensagem = "erro";
    }
}

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Criar conta | Era uma vez...</title>

    <link rel="stylesheet" href="/templates/global.css">
    <link rel="stylesheet" href="/templates/autenticacao.css">

</head>

<body class="pagina-auth">

    <main class="auth">

        <section class="auth-apresentacao">

            <span class="auth-simbolo">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-moon-stars" viewBox="0 0 16 16">
        <path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278M4.858 1.311A7.27 7.27 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.32 7.32 0 0 0 5.205-2.162q-.506.063-1.029.063c-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.73 1.73 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.73 1.73 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.73 1.73 0 0 0 1.097-1.097zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.258.774a1.16 1.16 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732z"/>
    </svg>
</span>

            <h1>
                Era uma vez...
            </h1>

            <span>
                FILMES CLÁSSICOS DA DISNEY
            </span>

            <p>
                Crie sua conta e descubra histórias,
                curiosidades e clássicos inesquecíveis.
            </p>

        </section>


        <section class="auth-formulario">

            <div class="formulario-conteudo">

                <span class="tag">
                    SUA JORNADA COMEÇA AQUI
                </span>

                <h2>
                    Criar conta
                </h2>

                <p class="descricao-formulario">
                    Cadastre-se para começar sua viagem
                    pelos clássicos que acompanharam sua infância.
                </p>


                <?php if (!empty($mensagem)): ?>
    <p class="mensagem <?= $tipoMensagem ?>">
        <?= htmlspecialchars($mensagem) ?>
    </p>
<?php endif; ?>


                <form action="cadastro.php" method="POST">

                    <div class="campo">

                        <label for="nome">
                            Nome
                        </label>

                        <input
                            type="text"
                            id="nome"
                            name="nome"
                            placeholder="Como podemos te chamar?"
                            required
                        >

                    </div>


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
                            placeholder="Crie uma senha"
                            required
                        >

                    </div>


                    <div class="campo">

                        <label for="confirmar-senha">
                            Confirmar senha
                        </label>

                        <input
                            type="password"
                            id="confirmar-senha"
                            name="confirmar_senha"
                            placeholder="Digite a senha novamente"
                            required
                        >

                    </div>


                    <button
                        type="submit"
                        class="botao botao-form"
                    >
                        Criar minha conta
                    </button>

                </form>


                <p class="alternativa">

                    Já possui uma conta?

                    <a href="login.php">
                        Entrar
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