<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- título da pág e icone (logo) -->
    <title>Pet iti - Criar uma nova senha</title>
    <link rel="icon" href="/petiti/views/assets/img/logo-icon.svg">
    <link rel="stylesheet" href="/petiti/views/assets/css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

    <script src="/petiti/views/assets/js/recover.js"></script>
</head>

<body>



    <div class="fundoRecuperarSenha">
        <img class="logoNavbar" src="/petiti/assets/images/logo_principal.svg" /></a>

        <?php
        @session_start();
        $nome = $_SESSION['nome-recuperacao'];
        ?>

        <form class="formRecover" style="height: fit-content;" method="post" action="/petiti/api/usuario/update/senha/recuperacao">
               
            <div class="formRecoverHolderPass">

                <h1>Crie uma nova senha</h1>

                <div class="formRecoverHolderElementPass">
                    <label  for="novaSenha">Insira sua nova senha</label>
                    <input  type="password" id="novaSenha" name="novaSenha">
                </div>

                <div class="formRecoverHolderElementPass">
                    <label  for="novaSenha">Confirme a senha</label>
                    <input  type="password"  id="confirmNovaSenha" name="confirmNovaSenha">
                </div>


                
                <button class="btn btn-primary" type="submit" value="Atualizar senha">Atualizar senha</button>

                <p id="senhaAvisoTamanho"></p>
                <p id="senhaAvisoVerificacao"></p>
            </div>
            
        </form>
            
    </div>

</body>

</html>