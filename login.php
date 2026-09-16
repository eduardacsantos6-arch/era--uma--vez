<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Entrar | Era uma vez...</title>

<link rel="stylesheet" href="templates/global.css">
<link rel="stylesheet" href="templates/autenticacao.css">


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


                <form action="#" method="POST">

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


                    <button type="submit" class="botao botao-form">
                        Entrar
                    </button>

                </form>


                <p class="alternativa">
                    Ainda não possui uma conta?
                    <a href="cadastro.php">
                        Criar conta
                    </a>
                </p>

                <a href="index.php" class="voltar">
                    ← Voltar
                </a>

            </div>

        </section>

    </main>

</body>
</html>