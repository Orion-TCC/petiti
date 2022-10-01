<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


foreach (glob("classes/*") as $filename) {
    require_once $filename;
}

use Slim\Factory\AppFactory;
use Slim\Exception\NotFoundException;
use Slim\Http\UploadedFile;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$basePath = str_replace('/' . basename(__FILE__), '', $_SERVER['SCRIPT_NAME']);
$app = $app->setBasePath($basePath);

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});

// Usuario

$app->get('/usuarios', function (Request $request, Response $response, array $args) {
    $usuario = new Usuario();

    $json = "{\"usuarios\":" . json_encode($lista = $usuario->listar(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "}";
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

$app->get('/usuario/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $usuario = new Usuario();
    $json = json_encode($lista = $usuario->listarUsuario($id), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});



$app->post('/usuario/add', function (Request $request, Response $response, array $args) {
    $data = $request->getParsedBody();
    $usuario = new Usuario();
    $tipoUsuario = new TipoUsuario();
    $cookie = new Cookies();

    // Verficação 
    $email = $_POST['txtEmailUsuario'];
    $email = strtolower($email);
    $senha = $_POST['txtPw'];
    $senhaConfirmacao = $_POST['txtPwConfirm'];

    $validacaoEmail = $usuario->validarEmail($email);
    if ($validacaoEmail == false) {
        $cookie->criarCookie("erro-cadastro", "Email Inválido", 1);
        header('location: /petiti/cadastro-usuario');
    } elseif ($senha <> $senhaConfirmacao) {
        $cookie->criarCookie("erro-cadastro", "Senhas não coincindem", 1);
        header('location: /petiti/cadastro-usuario');
    } else {
        $senha = sha1("pet").sha1($_POST['txtPw']).sha1("iti");
        $usuario->setNomeUsuario($_POST['txtNomeUsuario']);
        $usuario->setLoginUsuario($_POST['txtLoginUsuario']);
        $usuario->setEmailUsuario($_POST['txtEmailUsuario']);
        $usuario->setSenhaUsuario($senha);
        $usuario->setVerificadoUsuario(0);
        $tipoUsuario->setIdTipoUsuario(1);
        $usuario->setTipoUsuario($tipoUsuario);

        // Cadastro
        $retorno = $usuario->cadastrar($usuario);
        $msg = $retorno["msg"];
        if ($msg == "Cadastro realizado com sucesso") {
            $id = $retorno["id"];
            @session_start();
            $_SESSION['id-cadastro'] = $id;
            if ($_SESSION['tipo-usuario'] == "empresa") {
                header('location: /petiti/foto-empresa');  
            }else{
            header('location: /petiti/foto-usuario');
            }
        } else {
            $cookie->criarCookie("erro-cadastro", $msg, 1);
            header('location: /petiti/cadastro-usuario');
        }
    }
});

$app->get('/usuario/delete/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $usuario = new Usuario();
    $usuario->setIdUsuario($id);
    $usuario->delete($usuario);
    return $response;
});

$app->post('/usuario/update', function (Request $request, Response $response, array $args) {
    $data = $request->getParsedBody();
    @session_start();
    $campo = $_POST['campo'];
    $id = $_SESSION['id-cadastro'];
    $usuario = new Usuario();
    switch ($campo) {
        case 'nome':
            $valor = "";
            $usuario->update($id, $campo, $valor);
            break;

        case 'ramo':
            $valor = $_POST['slRamo'];

            $usuario->update($id, $campo, $valor);

            header('location: /petiti/info-empresa');
            
            break;

        case 'senha':
            $valor = "";
            $usuario->update($id, $campo, $valor);
            break;

        case 'login':
            $valor = "";
            $usuario->update($id, $campo, $valor);
            break;

        case 'email':
            $valor = "";
            $usuario->update($id, $campo, $valor);
            break;
    }

  
 
});

$app->post('/login', function (Request $request, Response $response, array $args) {
    $data = $request->getParsedBody();
    $usuario = new Usuario();
    $cookie = new Cookies();


    $login_email = $_POST['txtLoginEmail'];
    $senha = sha1("pet") . sha1($_POST['pw']) . sha1("iti");

    $msg = $usuario->login($login_email, $senha);
    @session_start();


    $verificaEmail = $usuario->validarEmail($login_email);

    if ($verificaEmail == false) {
        $id = $usuario->procuraId2($login_email = $_POST['txtLoginEmail']);
    } else {
        $id = $usuario->procuraId($login_email = $_POST['txtLoginEmail']);
    }

    if ($msg == "Bem vindo.") {

        $url = "http://localhost/petiti/api/usuario/$id";

        $json = file_get_contents($url);
        $dados = json_decode($json);
        $login = $dados[0]->loginUsuario;

        $_SESSION['login'] = $login;
        header('location: /petiti/feed');
    } else {
        header('location: /petiti/login');
        $cookie->criarCookie('retorno-login', $msg, 2);
    }
});

// Usuario - Pet

$app->get('/usuario/{id}/pets', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $usuario = new Usuario();

    $json = "{\"pets\":" . json_encode($lista = $usuario->listarPetsUsuario($id), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "}";
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

// PET

$app->get('/pets', function (Request $request, Response $response, array $args) {
    $pet = new Pet();

    $json = "{\"pets\":" . json_encode($lista = $pet->listar(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "}";
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

$app->get('/pet/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $pet = new Pet();

    $json = "{\"pet\":" . json_encode($lista = $pet->listarPet($id), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "}";
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

$app->get('/pet/update/{id}/{campo}/{valor}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $campo = $args['campo'];
    $valor = $args['valor'];
    $pet = new Pet();

    $pet->update($id, $campo, $valor);
    return $response;
});

$app->get('/pet/delete/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $pet = new Pet();
    $pet->setIdPet($id);
    $pet->delete($pet);
    return $response;
});

$app->post('/pet/add', function (Request $request, Response $response, array $args) {
    $data = $request->getParsedBody();
    $usuario = new Usuario();
    $pet = new Pet();
    $cookie = new Cookies();
    $arrayEspecies = array(
        1 => "Cachorro",
        2 => "Gato",
        3 => "Roedor",
        4 => "Ave",
        5 => "Exótico"
    );
    $idade = $_POST['txtIdadePet'];
    $slDiaMesAno = $_POST['slIdade'];
    if ($idade > 1) {
        $arrayData = array(
            "d" => "dias",
            "m" => "meses",
            "y" => "anos",
        );
        $idadeCompleta = $idade . " " . $arrayData[$slDiaMesAno];
    } else {
        $arrayData = array(
            "d" => "dia",
            "m" => "mês",
            "y" => "ano",
        );
        $idadeCompleta = $idade . " " . $arrayData[$slDiaMesAno];
    }


    @session_start();


    if ($_POST['slEspecie'] == 0) {
        $cookie->criarCookie('retorno-erro-especie', "Selecione uma espécie", 1);
        header('location: ../formulario-pet2.php');
    }
    $especie = $arrayEspecies[$_POST['slEspecie']];

    $pet->setNomePet($_POST['txtNomePet']);
    $pet->setRacaPet($_POST['txtRacaPet']);
    $pet->setEspeciePet($especie);
    $pet->setIdadePet($idadeCompleta);
    $usuario->setIdUsuario($_SESSION['id-cadastro']);
    $pet->setUsuario($usuario);

    $return = $pet->cadastrar($pet);
    $id = $return['id'];
    $_SESSION['id-cadastro-pet'] = $id;

    header('location: /petiti/foto-pet');
});

try {
    $app->run();
} catch (Exception $e) {
    header('location: /petiti/views/erroGeral.php');
}
