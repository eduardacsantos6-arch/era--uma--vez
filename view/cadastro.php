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

            <span class="auth-simbolo">✦</span>

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