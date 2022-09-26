<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once("classes/Usuario.php");
require_once("classes/Usuario.php");
require_once("classes/TipoUsuario.php");
require_once("classes/Cookies.php");

use Slim\Factory\AppFactory;
use Slim\Exception\NotFoundException;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$basePath = str_replace('/' . basename(__FILE__), '', $_SERVER['SCRIPT_NAME']);
$app = $app->setBasePath($basePath);

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});

$app->get('/usuarios', function (Request $request, Response $response, array $args) {
    $usuario = new Usuario();

    $json = "{\"usuarios\":" . json_encode($lista = $usuario->listar()) . "}";
    $response->getBody()->write($json);
    return $response;
});

$app->get('/usuario/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $usuario = new Usuario();

    $json = "{\"usuario\":" . json_encode($lista = $usuario->listarUsuario($id)) . "}";
    $response->getBody()->write($json);
    return $response;
});

$app->post('/usuario/add', function (Request $request, Response $response, array $args) {
    $data = $request->getParsedBody();
    $usuario = new Usuario();
    $tipoUsuario = new TipoUsuario();
    $cookie = new Cookies();


    // Verficação 
    $email = $_POST['txtEmailUsuario'];
    $senha = $_POST['txtPw'];
    $senhaConfirmacao = $_POST['txtPwConfirm'];

    $validacaoEmail = $usuario->validarEmail($email);
    if ($validacaoEmail == false) {
        $cookie->criarCookie("erro-cadastro", "Email Inválido", 1);
        header('location: /petiti/views/register/pages/register-comum/formulario-usuario.php');
    } elseif ($senha <> $senhaConfirmacao) {
        $cookie->criarCookie("erro-cadastro", "Senhas não coincindem", 1);
        header('location: /petiti/views/register/pages/register-comum/formulario-usuario.php');
    } else {
        $usuario->setNomeUsuario($_POST['txtNomeUsuario']);
        $usuario->setLoginUsuario($_POST['txtLoginUsuario']);
        $usuario->setEmailUsuario($_POST['txtEmailUsuario']);
        $usuario->setSenhaUsuario($_POST['txtPw']);
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

            header('location: /petiti/views/register/pages/register-comum/formulario-foto.php');
        } else {
            $cookie->criarCookie("erro-cadastro", $msg, 1);
            header('location: /petiti/views/register/pages/register-comum/formulario-usuario.php');
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

$app->get('/usuario/update/{id}/{campo}/{valor}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $campo = $args['campo'];
    $valor = $args['valor'];
    $usuario = new Usuario();

    $usuario->update($id, $campo, $valor);
    return $response;
});


$app->run();
