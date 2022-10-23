<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de senha</title>
    <style>
        .formulario {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    $nome = $_SESSION['nome-recuperacao'];
    echo "Olá " . $nome . "!";
    ?>
    <form method="post" action="/petiti/api/usuario/update/senha/recuperacao">
        <div class="formulario">
            <label for="novaSenha">Sua nova senha:</label>
            <input type="text" id="novaSenha" name="novaSenha">
            <label for="confirmNovaSenha">Confirme a senha:</label>
            <input type="text" id="confirmNovaSenha" name="confirmNovaSenha">
            <input type="submit" value="Atualizar senha">
        </div>
    </form>

</body>

</html>