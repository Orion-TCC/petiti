<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


foreach (glob("classes/*") as $filename) {
    require_once $filename;
}
date_default_timezone_set('America/Sao_Paulo');


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
    $msg = "";
    $validacaoEmail = $usuario->validarEmail($email);
    if ($validacaoEmail == false) {
        $cookie->criarCookie("erro-cadastro", "Email Inválido", 1);
        header('location: /petiti/cadastro-usuario');
    } elseif ($senha <> $senhaConfirmacao) {
        $cookie->criarCookie("erro-cadastro", "Senhas não coincindem", 1);
        header('location: /petiti/cadastro-usuario');
    } else {
        $senha = $_POST['txtPw'];
        $usuario->setNomeUsuario(" ");
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
            } else {
                header('location: /petiti/tipo-usuario');
            }
        } else {
            $cookie->criarCookie("erro-cadastro", $msg, 1);
            header('location: /petiti/cadastro-usuario');
        }
    }
});

$app->post('/usuario/info', function (Request $request, Response $response, array $args) {
    $data = $request->getParsedBody();
    $usuario = new Usuario();
    $cookie = new Cookies();
    @session_start();
    $id = $_SESSION['id-cadastro'];

    $nome = $_POST['txNome'];
    $bio = $_POST['txBio'];
    $local = $_POST['txLocal'];
    $site = $_POST['txSite'];


    $usuario->setIdUsuario($id);
    $usuario->setNomeUsuario($nome);
    $usuario->setBioUsuario($bio);
    $usuario->setLocalizacaoUsuario($local);
    $usuario->setSiteUsuario($site);

    $usuario->updateNome($usuario);
    $usuario->updateSite($usuario);
    $usuario->updateLocalizacao($usuario);
    $usuario->updateBio($usuario);


    header('location: /petiti/foto-usuario');
});

$app->get('/usuario/delete/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $usuario = new Usuario();
    $usuario->setIdUsuario($id);
    $usuario->delete($usuario);
    return $response;
});

$app->get('/logins', function (Request $request, Response $response, array $args) {
    $usuario = new Usuario();
    $lista = $usuario->listar();
    $usuarios = array();
    
    foreach ($lista as $linha) {
       array_push($usuarios, $linha['loginUsuario']);
    }
    
    $response->getBody()->write(json_encode($usuarios));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

$app->post('/usuario/update/ramo', function (Request $request, Response $response, array $args) {
    @session_start();
    $usuario = new Usuario();
    $tipousuario = new TipoUsuario();
    $id = $_SESSION['id'];
    $valor = $_POST['slRamo'];


    $usuario->update($id, "ramo", $valor);

    header('location: /petiti/info-empresa');
});

$app->post('/usuario/cadastro/update/ramo', function (Request $request, Response $response, array $args) {
    @session_start();
    $usuario = new Usuario();
    $tipoUsuario = new TipoUsuario();
    $id = $_SESSION['id-cadastro'];
    $valor = $_POST['slRamo'];
    $usuario->setIdUsuario($id);
    $tipoUsuario->setIdTipoUsuario($valor);
    $usuario->setTipoUsuario($tipoUsuario);
    $usuario->updateTipo($usuario);

    // $usuario->update($id, "ramo", $valor);

    header('location: /petiti/info-empresa');
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
    $senha = $_POST['pw'];

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

$app->post('/usuario/endereco/add', function (Request $request, Response $response, array $args) {
    $data = $request->getParsedBody();
    $usuarioEndereco = new usuarioEndereco;
    $usuario = new Usuario();

    $cep = $_POST['txtCep'];

    $url = "https://viacep.com.br/ws/" . $cep . "/json";

    $json = file_get_contents($url);
    $dados = json_decode($json);
    $logradouro = $dados->logradouro;
    $numero = $_POST['txtNumeroEmpresa'];
    $bairro = $dados->bairro;
    $complemento = $_POST['txtComplementoEmpresa'];
    $cidade = $dados->localidade;
    $estado = $_POST['txtUfEmpresa'];

    @session_start();

    $usuarioEndereco->setLogradouroUsuario($logradouro);
    $usuarioEndereco->setNumeroUsuario($numero);
    $usuarioEndereco->setCepUsuario($cep);
    $usuarioEndereco->setBairroUsuario($bairro);
    $usuarioEndereco->setComplementoUsuario($complemento);
    $usuarioEndereco->setCidadeUsuario($cidade);
    $usuarioEndereco->setEstadoUsuario($estado);
    $usuario->setIdUsuario($_SESSION['id-cadastro']);

    $usuario->setNomeUsuario($_POST['txtNomeEmpresa']);
    $usuario->updateNome($usuario);

    $usuarioEndereco->setUsuario($usuario);

    $usuarioEndereco->cadastrar($usuarioEndereco);

    header('location: /petiti/final-empresa');
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



$app->get('/publicacoes', function (Request $request, Response $response, array $args) {
    $publicacao = new Publicacao();

    $json = "{\"publicacoes\":" . json_encode($lista = $publicacao->listar(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "}";
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});
$app->get('/publicacao/{id}', function (Request $request, Response $response, array $args) {
    $publicacao = new Publicacao();
    $id = $args['id'];
    $json = json_encode($lista = $publicacao->listar(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

$app->post(
    '/publicar',
    function (Request $request, Response $response, array $args) {
        $usuario = new Usuario();
        $publicacao = new Publicacao();
        $fotoPublicacao = new FotoPublicacao();
        $categoria = new Categoria();
        $cookie = new Cookies();
        $image = $_POST['baseFoto'];
        @session_start();
        $publicacao = new Publicacao();
        date_default_timezone_set('America/Sao_Paulo');
        $categorias = $_POST['categoriasValue'];
        $categoriasA = explode(",", $categorias);

        $DateAndTime = date('Y-m-d H:i:s');

        $publicacao->setTextoPublicacao($_POST['txtLegendaPub']);
        $usuario->setIdUsuario($_SESSION['id']);
        $publicacao->setUsuario($usuario);
        $publicacao->setDataPublicacao($DateAndTime);
        $id = $publicacao->cadastrar($publicacao);
        

        $caminhoSalvar = "/xampp/htdocs/petiti/private-user/fotos-publicacao/";

        $nomeArquivo = time() . ".png";
        $arquivoCompleto = $caminhoSalvar . $nomeArquivo;
        file_put_contents($arquivoCompleto, file_get_contents($image));

        $caminhoBanco = "private-user/fotos-publicacao/" . $nomeArquivo;
        $publicacao->setIdPublicacao($id);
        $fotoPublicacao->setPublicacao($publicacao);
        $fotoPublicacao->setNomeFotoPublicacao($nomeArquivo);
        $fotoPublicacao->setCaminhoFotoPublicacao($caminhoBanco);
        $fotoPublicacao->cadastrar($fotoPublicacao);

        foreach ($categoriasA as $categoriaAtual) {
            $categoria->setCategoria($categoriaAtual);
            $idCategoria = $categoria->cadastrar($categoria);
            $categoria->setIdCategoria($idCategoria);
        }
        
        

        //header('location: /petiti/feed');

    }
);
$app->post(
    '/curtir',
    function (Request $request, Response $response, array $args) {
        @session_start();
        $curtidaPub = new CurtidaPublicacao();
        $usuario = new Usuario();
        $publicacao = new Publicacao();
        $idPub = $_POST['id'];
        $idUser = $_SESSION['id'];

        $result = $curtidaPub->verificarCurtida($idPub, $idUser);
        $boolean = $result['boolean'];
        if ($boolean == true) {
            $usuario->setIdUsuario($idUser);
            $publicacao->setIdPublicacao($idPub);
            $curtidaPub->setPublicacaoCurtida($publicacao);
            $curtidaPub->setUsuarioCurtida($usuario);
            $curtidaPub->cadastrar($curtidaPub);
        } else {
            $idCurtidaExistente = $result['id'];
            $curtidaPub->setIdCurtidaPublicacao($idCurtidaExistente);
            $curtidaPub->delete($curtidaPub);
        }
        $json = json_encode($lista = $publicacao->listarPub($idPub), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        foreach ($lista as $linha) {
        $itimalias = $linha['itimalias'];
        }
        
        $response->getBody()->write("$itimalias");
        return $response;

    }
);



try {
    $app->run();
} catch (Exception $e) {
    print_r($e);
    //header('location: /petiti/views/erroGeral.php');
}

// $app->post('/usuario/update/conta', function (Request $request, Response $response, array $args) {
//     @session_start();
//     $usuario = new Usuario();
//     $tipoUsuario = new TipoUsuario();
//     $id = $_SESSION['id-cadastro'];


//     $usuario->setIdUsuario($id);
//     $usuario->setNomeUsuario($_POST['']);
//     $usuario->setLoginUsuario($_POST['']);
//     $usuario->setSenhaUsuario($_POST['']);
//     $usuario->setEmailUsuario($_POST['']);
//     $usuario->setVerificadoUsuario($_POST['']);
//     $tipoUsuario->setTipoUsuario($_POST['']);
//     $usuario->setTipoUsuario($tipoUsuario);
//     $usuario->updateFull($usuario);




//     header('location: /petiti/info-empresa');
// });

// $app->post('/usuario/update/perfil', function (Request $request, Response $response, array $args) {
//     @session_start();
//     $usuario = new Usuario();
//     $tipoUsuario = new TipoUsuario();
//     $id = $_SESSION['id-cadastro'];


//     $usuario->setIdUsuario($id);
//     $usuario->setNomeUsuario($_POST['']);
//     $usuario->setLoginUsuario($_POST['']);
//     $usuario->setSenhaUsuario($_POST['']);
//     $usuario->setEmailUsuario($_POST['']);
//     $usuario->setVerificadoUsuario($_POST['']);
//     $tipoUsuario->setTipoUsuario($_POST['']);
//     $usuario->setTipoUsuario($tipoUsuario);
//     $usuario->updateFull($usuario);




//     header('location: /petiti/info-empresa');
// });

// $app->post('/usuario/update/adm', function (Request $request, Response $response, array $args) {
//     @session_start();
//     $usuario = new Usuario();
//     $tipoUsuario = new TipoUsuario();
//     $id = $_SESSION['id-cadastro'];


//     $usuario->setIdUsuario($id);
//     $usuario->setNomeUsuario($_POST['']);
//     $usuario->setLoginUsuario($_POST['']);
//     $usuario->setSenhaUsuario($_POST['']);
//     $usuario->setEmailUsuario($_POST['']);
//     $usuario->setVerificadoUsuario($_POST['']);
//     $tipoUsuario->setTipoUsuario($_POST['']);
//     $usuario->setTipoUsuario($tipoUsuario);
//     $usuario->updateFull($usuario);




//     header('location: /petiti/info-empresa');
// });
