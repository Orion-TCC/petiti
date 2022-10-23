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
    <form action="/petiti/api/email-recuperacao.php" method="post">
        <div class="formulario">
            <input type="email" name="txtEmail" id="txtEmail">
            <button type="submit">Enviar</button>
        </div>
    </form>
</body>

</html>