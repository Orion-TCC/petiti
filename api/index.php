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
use Slim\Psr7\Header;

require __DIR__ . '/vendor/autoload.php';


$app = AppFactory::create();


$basePath = str_replace('/' . basename(__FILE__), '', $_SERVER['SCRIPT_NAME']);
$app = $app->setBasePath($basePath);

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});
$app->get('/', function (Request $request, Response $response, array $args) {

    $response->getBody()->write("
    Bem vindo
    ");
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

$app->get('/qtd-notificacoes', function (Request $request, Response $response, array $args) {
    @session_start();
    $id = $_SESSION['id'];
    $notificacao = new Notificacao();
    $json = json_encode($qtd = $notificacao->qtdNotificacoesNaoVistas($id), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

$app->post('/usuario/add', function (Request $request, Response $response, array $args) {
    $data = $request->getParsedBody();
    $usuario = new Usuario();
    $tipoUsuario = new TipoUsuario();
    $cookie = new Cookies();
    @session_start();
    // Verficação 
    $email = $_POST['txtEmailUsuario'];
    $email = strtolower($email);
    $senha = $_POST['txtPw'];
    $senhaConfirmacao = $_POST['txtPwConfirm'];
    $msg = "";
    $validacaoEmail = $usuario->validarEmail($email);
    if ($validacaoEmail == false) {
        $cookie->criarCookie("erro-cadastro", "Email Inválido", 1);
        if ($_SESSION['tipo-usuario'] == "empresa") {
            header('location: /petiti/cadastro-empresa');
        } else {
            header('location: /petiti/cadastro-usuario');
        }
    } elseif ($senha <> $senhaConfirmacao) {
        $cookie->criarCookie("erro-cadastro", "Senhas não coincindem", 1);
        if ($_SESSION['tipo-usuario'] == "empresa") {
            header('location: /petiti/info-empresa');
        } else {
            header('location: /petiti/info-usuario');
        }
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
                header('location: /petiti/info-empresa');
            } else {
                header('location: /petiti/info-usuario');
            }
        } else {
            $cookie->criarCookie("erro-cadastro", $msg, 1);
            if ($_SESSION['tipo-usuario'] == "empresa") {
                header('location: /petiti/cadastro-empresa');
            } else {
                header('location: /petiti/cadastro-usuario');
            }
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

    if ($_SESSION['tipo-usuario'] == "empresa") {
        header('location: /petiti/foto-empresa');
    } else {
        header('location: /petiti/foto-usuario');
    }
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

$app->get('/logins-pets', function (Request $request, Response $response, array $args) {
    $pet = new Pet();
    $lista = $pet->listar();
    $pets = array();

    foreach ($lista as $linha) {
        array_push($pets, $linha['usuarioPet']);
    }

    $response->getBody()->write(json_encode($pets));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});


$app->post('/usuario/update/ramo', function (Request $request, Response $response, array $args) {
    @session_start();
    $usuario = new Usuario();
    $tipousuario = new TipoUsuario();
    $id = $_SESSION['id'];
    $valor = $_POST['slRamo'];


    $usuario->update($id, "ramo", $valor);

    header('location: /petiti/final-empresa');
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

    header('location: /petiti/final-empresa');
});

$app->get('/recuperar/senha/{login}', function (Request $request, Response $response, array $args) {
    @session_start();
    $login = $args['login'];
    $usuario = new Usuario();
    $idUsuario = $usuario->procuraId2($login);
    $lista = $usuario->listarUsuario($idUsuario);
    foreach ($lista as $linha) {
        $idRecover = $linha['idUsuario'];
        $nomeUsuario = $linha['nomeUsuario'];
    }
    $_SESSION['nome-recuperacao'] = $nomeUsuario;
    $_SESSION['id-senha-recuperacao'] = $idRecover;

    header('location: /petiti/views/recover/passrecover.php');
});

$app->post('/usuario/update/senha/recuperacao', function (Request $request, Response $response, array $args) {
    @session_start();
    $usuario = new Usuario();
    $senha = $_POST['novaSenha'];
    $usuario->setIdUsuario($_SESSION['id-senha-recuperacao']);
    $usuario->setSenhaUsuario($senha);
    $usuario->updateSenha($usuario);



    unset($_SESSION['id-senha-recuperacao']);
    unset($_SESSION['nome-recuperacao']);
    session_destroy();

    header('location: /petiti/login');
});

$app->get('/ativar-tutor/{id}', function (Request $request, Response $response, array $args) {
    $usuario = new Usuario();
    $cookie = new Cookies;
    $usuario->setIdUsuario($args['id']);
    $usuario->setStatusUsuario(1);
    $usuario->updateStatus($usuario);

    $cookie->criarCookie(
        "usuarioAtivado",
        "<div class='popup'></div>
            <div class='toast'>
                <div class='toast-content'>
                    <div class='message'>
                        <span class='texto-1'>Usuário Ativado com sucesso!</span>
                    </div>
                </div>
                 <i class='fa-sharp fa-solid fa-xmark' id='close' onclick='closePopup()'></i>
                <div class='progressbar'></div>
            </div>
  ",
        1
    );

    header('location:/petiti/tutores-dashboard');
});

$app->get('/bloquear-tutor-denunciado/{tipoDenuncia}/{idDenunciado}/{idDen}', function (Request $request, Response $response, array $args) {
    $usuario = new Usuario();
    $usuario->setIdUsuario($args['idDenunciado']);
    $usuario->setStatusUsuario(0);
    $usuario->updateStatus($usuario);
    $denunciaPublicacao = new DenunciaPublicacao();
    $denunciaUsuario = new DenunciaUsuario();
    $cookie = new Cookies;

    $cookie->criarCookie(
        "usuarioBloqueado",
        "<div class='popup'></div>
            <div class='toast'>
                <div class='toast-content'>
                    <div class='message'>
                        <span class='texto-1'>Usuário bloqueado com sucesso!</span>
                        <span class='texto-2'>Denúncia resolvida</span>
                    </div>
                </div>
                 <i class='fa-sharp fa-solid fa-xmark' id='close' onclick='closePopup()'></i>
                <div class='progressbar'></div>
            </div>
  ",
        1
    );

    if ($args['tipoDenuncia'] == "publicacao") {
        $denunciaPublicacao->setIdDenunciaPublicacao($args['idDen']);
        $denunciaPublicacao->setStatusDenunciaPublicacao(2);
        $denunciaPublicacao->updateStatus($denunciaPublicacao);
        $decisao = "Usuario bloqueado";
        $denunciaPublicacao->updateDecisao($args['idDen'], $decisao);
    } else if ($args['tipoDenuncia'] == "usuarioDenunciado") {
        $denunciaUsuario->setIdDenunciaUsuario($args['idDen']);
        $denunciaUsuario->setStatusDenunciaUsuario(2);
        $denunciaUsuario->updateStatus($denunciaUsuario);
        $decisao = "Usuario denunciado bloqueado";
        $denunciaUsuario->updateDecisao($args['idDen'], $decisao);
    } else if ($args['tipoDenuncia'] == "usuarioDenunciador") {
        $denunciaUsuario->setIdDenunciaUsuario($args['idDen']);
        $denunciaUsuario->setStatusDenunciaUsuario(2);
        $denunciaUsuario->updateStatus($denunciaUsuario);
        $decisao = "Usuario denunciador bloqueado";
        $denunciaUsuario->updateDecisao($args['idDen'], $decisao);
    } else if ($args['tipoDenuncia'] == "comentario") {
    }


    header('location:/petiti/denuncias-dashboard');
});

$app->get('/bloquear-tutor/{id}', function (Request $request, Response $response, array $args) {
    $usuario = new Usuario();
    $usuario->setIdUsuario($args['id']);
    $usuario->setStatusUsuario(0);
    $usuario->updateStatus($usuario);
    $cookie = new Cookies;

    $cookie->criarCookie(
        "usuarioBloqueado",
        "<div class='popup'></div>
            <div class='toast'>
                <div class='toast-content'>
                    <div class='message'>
                        <span class='texto-1'>Usuário bloqueado com sucesso!</span>
                    </div>
                </div>
                 <i class='fa-sharp fa-solid fa-xmark' id='close' onclick='closePopup()'></i>
                <div class='progressbar'></div>
            </div>
  ",
        1
    );
    header('location:/petiti/tutores-dashboard');
});

$app->get('/passar-denuncia-analise/{tipoDenuncia}/{id}', function (Request $request, Response $response, array $args) {
    if ($args['tipoDenuncia'] == "publicacao") {
        $denunciaPublicacao = new DenunciaPublicacao();
        $denunciaPublicacao->setIdDenunciaPublicacao($args['id']);
        $denunciaPublicacao->setStatusDenunciaPublicacao(1);
        $cookie = new Cookies();

        $denunciaPublicacao->updateStatus($denunciaPublicacao);

        $cookie->criarCookie(
            "denunciaParaAnalise",
            "<div class='popup'></div>
            <div class='toast'>
                <div class='toast-content'>
                    <div class='message'>
                        <span class='texto-1'>Denúncia passou para análise</span>
                    </div>
                </div>
                 <i class='fa-sharp fa-solid fa-xmark' id='close' onclick='closePopup()'></i>
                <div class='progressbar'></div>
            </div>
  ",
            1
        );
        header('location:/petiti/denuncias-dashboard');
    } else if ($args['tipoDenuncia'] == "usuario") {
        $denunciaUsuario = new DenunciaUsuario();
        $denunciaUsuario->setIdDenunciaUsuario($args['id']);
        $denunciaUsuario->setStatusDenunciaUsuario(1);
        $cookie = new Cookies();

        $denunciaUsuario->updateStatus($denunciaUsuario);

        $cookie->criarCookie(
            "denunciaParaAnalise",
            "<div class='popup'></div>
            <div class='toast'>
                <div class='toast-content'>
                    <div class='message'>
                        <span class='texto-1'>Denúncia passou para análise</span>
                    </div>
                </div>
                 <i class='fa-sharp fa-solid fa-xmark' id='close' onclick='closePopup()'></i>
                <div class='progressbar'></div>
            </div>
  ",
            1
        );
        header('location:/petiti/denuncias-dashboard');
    } else if ($args['tipoDenuncia'] == "comentario") {
    }
});

$app->get('/ativar-empresa/{id}', function (Request $request, Response $response, array $args) {
    $usuario = new Usuario();
    $cookie = new Cookies;
    $usuario->setIdUsuario($args['id']);
    $usuario->setStatusUsuario(1);
    $usuario->updateStatus($usuario);

    $cookie->criarCookie(
        "empresaAtivada",
        "<div class='popup'></div>
            <div class='toast'>
                <div class='toast-content'>
                    <div class='message'>
                        <span class='texto-1'>Empresa ativada com sucesso!</span>
                    </div>
                </div>
                 <i class='fa-sharp fa-solid fa-xmark' id='close' onclick='closePopup()'></i>
                <div class='progressbar'></div>
            </div>
  ",
        1
    );

    header('location:/petiti/empresas-dashboard');
});
$app->get('/bloquear-empresa/{id}', function (Request $request, Response $response, array $args) {
    $usuario = new Usuario();
    $cookie = new Cookies;
    $usuario->setIdUsuario($args['id']);
    $usuario->setStatusUsuario(0);
    $usuario->updateStatus($usuario);

    $cookie->criarCookie(
        "empresaBloqueada",
        "<div class='popup'></div>
            <div class='toast'>
                <div class='toast-content'>
                    <div class='message'>
                        <span class='texto-1'>Empresa bloqueada com sucesso!</span>
                    </div>
                </div>
                 <i class='fa-sharp fa-solid fa-xmark' id='close' onclick='closePopup()'></i>
                <div class='progressbar'></div>
            </div>
  ",
        1
    );

    header('location:/petiti/empresas-dashboard');
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

    $url = "http://localhost/petiti/api/usuario/$id";
    $json = file_get_contents($url);
    $dados = json_decode($json);
    $status = $dados[0]->statusUsuario;


    if ($msg == "Bem vindo.") {
        if ($status == 0) {
            header('location: /petiti/login');
            @session_start();
            @session_destroy();
            $cookie->criarCookie('retorno-login', "Usuário bloqueado.", 2);
        }
        if ($_SESSION['tipo'] != 'Adm') {
            $url = "http://localhost/petiti/api/usuario/$id";

            $json = file_get_contents($url);
            $dados = json_decode($json);
            $login = $dados[0]->loginUsuario;

            $_SESSION['login'] = $login;
            header('location: /petiti/feed');
        } else {
            $url = "http://localhost/petiti/api/usuario/$id";
            $json = file_get_contents($url);
            $dados = json_decode($json);
            $login = $dados[0]->loginUsuario;

            $_SESSION['login'] = $login;
            header('location: /petiti/dashboard');
        }
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

    header('location: /petiti/foto-empresa');
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

    $json = json_encode($lista = $pet->listarPet($id), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
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
    $categoria = new categoria();
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
        header('location: /petiti/formulario-pet');
    }
    $especie = $arrayEspecies[$_POST['slEspecie']];
    $raca = $_POST['txtRacaPet'];
    $boolCategoria = $categoria->verificarCategoria($raca);
    if ($boolCategoria == true) {
        $categoria->setCategoria($raca);
        $categoria->cadastrar($categoria);
    }
    $pet->setUsuarioPet($_POST['txtUserPet']);
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

$app->get('/ativar-pet/{id}', function (Request $request, Response $response, array $args) {
    $pet = new Pet();
    $cookie = new Cookies();
    $pet->setStatusPet(1);
    $pet->setIdPet($args['id']);
    $pet->updateStatus($pet);
    header("location: /petiti/pets-dashboard");

    $cookie->criarCookie(
        "petAtivado",
        "<div class='popup'></div>
            <div class='toast'>
                <div class='toast-content'>
                    <div class='message'>
                        <span class='texto-1'>Pet ativado com sucesso!</span>
                    </div>
                </div>
                 <i class='fa-sharp fa-solid fa-xmark' id='close' onclick='closePopup()'></i>
                <div class='progressbar'></div>
            </div>
  ",
        1
    );
});



$app->get('/bloquear-pet/{id}', function (Request $request, Response $response, array $args) {
    $pet = new Pet();
    $cookie = new Cookies();
    $pet->setStatusPet(0);
    $pet->setIdPet($args['id']);
    $pet->updateStatus($pet);

    $cookie->criarCookie(
        "petBloqueado",
        "<div class='popup'></div>
            <div class='toast'>
                <div class='toast-content'>
                    <div class='message'>
                        <span class='texto-1'>Pet bloqueado com sucesso!</span>
                    </div>
                </div>
                 <i class='fa-sharp fa-solid fa-xmark' id='close' onclick='closePopup()'></i>
                <div class='progressbar'></div>
            </div>
  ",
        1
    );

    header("location: /petiti/pets-dashboard");
});

$app->get('/excluir-pet-cadastro/{id}', function (Request $request, Response $response, array $args) {
    $pet = new Pet();
    $pet->setIdPet($args['id']);
    $pet->delete($pet);
    header("location: /petiti/final-usuario");
});

$app->get('/categorias', function (Request $request, Response $response, array $args) {
    $categoria = new Categoria();

    $json = "{\"categorias\":" . json_encode($lista = $categoria->listar(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "}";
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

$app->get('/ativar-categoria/{id}', function (Request $request, Response $response, array $args) {
    $categoria = new categoria();
    $cookie = new Cookies();
    $categoria->setStatusCategoria(1);
    $categoria->setIdCategoria($args['id']);
    $categoria->updateStatus($categoria);
    header("location: /petiti/categorias-dashboard/");

    $cookie->criarCookie(
        "categoriaAtivada",
        "<div class='popup'></div>
            <div class='toast'>
                <div class='toast-content'>
                    <div class='message'>
                        <span class='texto-1'>Categoria ativada com sucesso!</span>
                    </div>
                </div>
                 <i class='fa-sharp fa-solid fa-xmark' id='close' onclick='closePopup()'></i>
                <div class='progressbar'></div>
            </div>
  ",
        1
    );
});

$app->get('/bloquear-categoria/{id}', function (Request $request, Response $response, array $args) {
    $categoria = new categoria();
    $cookie = new Cookies();
    $categoria->setStatusCategoria(0);
    $categoria->setIdCategoria($args['id']);
    $categoria->updateStatus($categoria);

    $cookie->criarCookie(
        "categoriaBloqueada",
        "<div class='popup'></div>
            <div class='toast'>
                <div class='toast-content'>
                    <div class='message'>
                        <span class='texto-1'>Categoria bloqueada com sucesso!</span>
                    </div>
                </div>
                 <i class='fa-sharp fa-solid fa-xmark' id='close' onclick='closePopup()'></i>
                <div class='progressbar'></div>
            </div>
  ",
        1
    );

    header("location: /petiti/categorias-dashboard/");
});

$app->get('/publicacoes/personalizadas/{id}', function (Request $request, Response $response, array $args) {
    $publicacao = new Publicacao();
    $id = $args['id'];

    $json = "{\"publicacoes\":" . json_encode($lista = $publicacao->listar($id), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "}";
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

$app->get('/publicacoes/paraVoce/{id}', function (Request $request, Response $response, array $args) {
    $categoriaSeguida = new categoriaSeguida();
    $id = $args['id'];

    $json = "{\"publicacoes\":" . json_encode($lista = $categoriaSeguida->buscarCategoriasSeguidas($id), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "}";
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

$app->get('/publicacoes/perdidos', function (Request $request, Response $response, array $args) {
    $publicacao = new Publicacao();

    $json = "{\"publicacoes\":" . json_encode($lista = $publicacao->listarPubsPetsPerdidos(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "}";
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});
$app->get('/publicacoes/adocao', function (Request $request, Response $response, array $args) {
    $publicacao = new Publicacao();

    $json = "{\"publicacoes\":" . json_encode($lista = $publicacao->listarPubsPetsAdoção(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "}";
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});
$app->get('/publicacoes/impulsionadas', function (Request $request, Response $response, array $args) {
    $publicacao = new Publicacao();

    $json = "{\"publicacoes\":" . json_encode($lista = $publicacao->listarImpulsao(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "}";
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});
$app->get('/publicacoes/curtidas/{id}', function (Request $request, Response $response, array $args) {
    $publicacao = new Publicacao();
    $id = $args['id'];

    $json = "{\"publicacoes\":" . json_encode($lista = $publicacao->listarPubsCurtidas($id), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "}";
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});
$app->get('/publicacao/{id}', function (Request $request, Response $response, array $args) {
    $publicacao = new Publicacao();
    $id = $args['id'];
    $json = json_encode($lista = $publicacao->listarPub($id), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});
$app->get('/publicacoes/usuario/{id}', function (Request $request, Response $response, array $args) {
    $publicacao = new Publicacao();
    $id = $args['id'];
    $json = "{\"publicacoes\":" . json_encode($lista = $publicacao->listarPubUsuario($id), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "}";
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});
$app->get('/comentarios-post/{id}', function (Request $request, Response $response, array $args) {
    $comentario = new Comentario();
    $id = $args['id'];
    $json = "{\"comentarios\":" . json_encode($dadosComentario = $comentario->listarComentarioPublicacao($id), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "}";

    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

$app->get('/comentario/{id}', function (Request $request, Response $response, array $args) {
    $comentario = new Comentario();
    $id = $args['id'];
    $json = json_encode($dadosComentario = $comentario->listarComentario($id), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

$app->get('/categorias-post/{id}', function (Request $request, Response $response, array $args) {
    $categoria = new Categoria();
    $id = $args['id'];
    $json = json_encode($categoriasPub = $categoria->categoriaPost($id), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

$app->post(
    '/publicar',
    function (Request $request, Response $response, array $args) {
        $usuario = new Usuario();
        $curtidaPub = new CurtidaPublicacao();
        $publicacao = new Publicacao();
        $fotoPublicacao = new FotoPublicacao();
        $categoria = new Categoria();
        $cookie = new Cookies();
        $categoriaPublicacao = new categoriaPublicacao();
        $image = $_POST['baseFoto'];
        @session_start();
        $publicacao = new Publicacao();
        date_default_timezone_set('America/Sao_Paulo');
        $categorias = $_POST['categoriasValue'];
        $categoriasA = explode(",", $categorias);
        if (isset($_POST['txtLocalizacao'])) {
            $local = $_POST['txtLocalizacao'];
        } else {
            $local = "";
        }
        $publicacao->setLocalPub($local);

        $DateAndTime = date('Y-m-d H:i:s');

        $publicacao->setTextoPublicacao($_POST['txtLegendaPub']);
        $usuario->setIdUsuario($_SESSION['id']);
        $publicacao->setUsuario($usuario);
        $publicacao->setDataPublicacao($DateAndTime);
        if (isset($_POST['checkImp'])) {
            $publicacao->setImpulsoPub(1);
        } else {
            $publicacao->setImpulsoPub(0);
        }
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
            $boolCategoria = $categoria->verificarCategoria($categoriaAtual);
            if ($boolCategoria == true) {
                $categoria->setCategoria($categoriaAtual);
                $idCategoria = $categoria->cadastrar($categoria);
                $categoria->setIdCategoria($idCategoria);
                $idCategoriapPub = $categoria->pesquisarCategoria($categoriaAtual);
                $categoriaPublicacao->setCategoria($idCategoriapPub);
                $categoriaPublicacao->setPublicacao($publicacao);
                $categoriaPublicacao->cadastrar($categoriaPublicacao);
            } else {
                $idCategoriapPub = $categoria->pesquisarCategoria($categoriaAtual);
                $categoriaPublicacao->setCategoria($idCategoriapPub);
                $categoriaPublicacao->setPublicacao($publicacao);
                $categoriaPublicacao->cadastrar($categoriaPublicacao);
                echo $categoriaAtual;
            }
        }

        //$categoriaPublicacao->setIdCategoriaPublicacao();
        header('location: /petiti/feed');
    }
);

$app->post('/denunciaPublicacao', function (Request $request, Response $response, array $args) {
    $denunciaPublicacao = new DenunciaPublicacao();
    $publicacao = new Publicacao();
    $usuario = new Usuario();
    $cookie = new Cookies();

    @session_start();

    $denunciaPublicacao->setUsuarioDenunciador($_SESSION['id']);

    $usuario->setIdUsuario($_POST['idUsuarioPub']);
    $denunciaPublicacao->setUsuarioDenunciado($usuario);

    $publicacao->setIdPublicacao($_POST['idPost']);
    $denunciaPublicacao->setPublicacao($publicacao);

    $denunciaPublicacao->setTextoDenunciaPublicacao($_POST['txtDenuncia']);
    $denunciaPublicacao->setStatusDenunciaPublicacao(0);

    $denunciaPublicacao->cadastrar($denunciaPublicacao);

    $cookie->criarCookie("denuncia", "
    <div id='toast-denuncia' class='toast-denuncia'>
        <div class='toast-denuncia-content'>
            <div class='message-denuncia'>
                <span class='texto-1'> Obrigado por sua denúncia </span>
                <span class='texto-2'> Ela será analisada o mais rápido possível</span>
            </div>
        </div>
        <i class='fa-sharp fa-solid fa-xmark' id='close' onclick='closePopup()'></i>
        <div class='progressbardenuncia'></div>
    </div>
    ", 1);
});

$app->get('/publicacao/delete/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $publicacao =  new Publicacao();
    $publicacao->setIdPublicacao($id);
    $publicacao->delete($publicacao);
    header("Location: /petiti/feed");
});

$app->get('/publicacao-denunciada/delete/{id}/{idDenuncia}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $publicacao =  new Publicacao();
    $publicacao->setIdPublicacao($id);
    $publicacao->delete($publicacao);

    $denunciaPublicacao = new DenunciaPublicacao();

    $decisao = "Publicação excluída";

    $denunciaPublicacao->setIdDenunciaPublicacao($args['idDenPub']);
    $denunciaPublicacao->setStatusDenunciaPublicacao(2);
    $denunciaPublicacao->updateStatus($denunciaPublicacao);

    $denunciaPublicacao->updateDecisao($args['idDenuncia'], $decisao);

    header("Location: /petiti/denuncias-dashboard");
});

$app->post(
    '/curtir',
    function (Request $request, Response $response, array $args) {
        @session_start();
        $curtidaPub = new CurtidaPublicacao();
        $usuario = new Usuario();
        $publicacao = new Publicacao();
        $idPub = $_POST['idPub'];
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
        $lista = $publicacao->listarPub($idPub);
        $resultado =
            $json = json_encode($lista = $publicacao->listarPub($idPub), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        foreach ($lista as $linha) {
            $itimalias = $linha['itimalias'];
        }

        $response->getBody()->write("$itimalias");
        return $response;
    }
);

$app->post(
    '/comentar',
    function (Request $request, Response $response, array $args) {
        @session_start();
        $usuario = new Usuario();
        $publicacao = new Publicacao();
        $comentario = new Comentario();
        $idPub = $_POST['id'];
        $idUser = $_SESSION['id'];
        $usuario->setIdUsuario($idUser);
        $publicacao->setIdPublicacao($idPub);

        $comentario->setTextoComentario($_POST['texto']);
        $comentario->setPublicacao($publicacao);
        $comentario->setUsuario($usuario);


        $idComentario = $comentario->cadastrar($comentario);


        $json = json_encode($dadosComentario = $comentario->listarComentario($idComentario), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $response->getBody()->write($json);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
);

$app->post('/seguir', function (Request $request, Response $response, array $args) {
    @session_start();
    $usuarioSeguidor = new UsuarioSeguidor();
    $idUsuario = $_POST['id'];
    $idSeguidor = $_SESSION['id'];

    $ver = $usuarioSeguidor->verificarSeguidor($idUsuario, $idSeguidor);

    $verificador = $ver['boolean'];

    if ($verificador == true) {
        $usuarioSeguidor->setIdSeguidor($idSeguidor);
        $usuarioSeguidor->setIdUsuarioSeguido($idUsuario);
        $usuarioSeguidor->cadastrar($usuarioSeguidor);
    } else {
        $idSeguidorExistente = $ver['id'];
        $usuarioSeguidor->setIdUsuarioSeguidor($idSeguidorExistente);
        $usuarioSeguidor->delete($usuarioSeguidor);
    }
    $conexao = Conexao::conexao();
    $query = "SELECT COUNT(idUsuarioSeguidor) as qtdSeguindo FROM tbUsuarioSeguidor WHERE idSeguidor = $idUsuario";
    $resultado = $conexao->query($query);
    $lista = $resultado->fetchAll();
    $qtdSeguindo = $lista[0]['qtdSeguindo'];

    $query = "SELECT COUNT(idUsuarioSeguidor) as qtdSeguidores FROM tbUsuarioSeguidor WHERE idUsuario = $idUsuario";
    $resultado = $conexao->query($query);
    $lista = $resultado->fetchAll();
    $qtdSeguidores = $lista[0]['qtdSeguidores'];

    $arraySeguidores = array($qtdSeguidores, $qtdSeguindo, $verificador);
    $json = json_encode($arraySeguidores);

    $response->getBody()->write("$json");
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

$app->post('/seguir-pet', function (Request $request, Response $response, array $args) {
    @session_start();
    $petseguidor = new PetSeguidor();
    $idPet = $_POST['idPet'];
    $idSeguidor = $_SESSION['id'];

    $ver = $petseguidor->verificarSeguidor($idPet, $idSeguidor);

    $verificador = $ver['boolean'];

    if ($verificador == true) {
        $petseguidor->setIdSeguidor($idSeguidor);
        $petseguidor->setIdPetSeguido($idPet);
        $petseguidor->cadastrar($petseguidor);
    } else {
        $idSeguidorExistente = $ver['id'];
        $petseguidor->setIdPetSeguidor($idSeguidorExistente);
        $petseguidor->delete($petseguidor);
    }
    $conexao = Conexao::conexao();
    $query = "SELECT COUNT(idPetSeguidor) as qtdSeguindo FROM tbpetSeguidor WHERE idSeguidor = $idPet";
    $resultado = $conexao->query($query);
    $lista = $resultado->fetchAll();
    $qtdSeguindo = $lista[0]['qtdSeguindo'];

    $query = "SELECT COUNT(idPetSeguidor) as qtdSeguidores FROM tbpetseguidor WHERE idPetSeguido = $idPet";
    $resultado = $conexao->query($query);
    $lista = $resultado->fetchAll();
    $qtdSeguidores = $lista[0]['qtdSeguidores'];

    $arraySeguidores = array($qtdSeguidores, $qtdSeguindo, $verificador);
    $json = json_encode($arraySeguidores);

    $response->getBody()->write("$json");
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

$app->post('/editar-perfil', function (Request $request, Response $response, array $args) {
    @session_start();
    $usuario = new Usuario();
    $usuario->setIdUsuario($_SESSION['id']);
    if (isset($_POST['txtNome'])) {
        $usuario->setNomeUsuario($_POST['txtNome']);
        $usuario->updateNome($usuario);
    }
    if (isset($_POST['txtLocal'])) {
        $usuario->setLocalizacaoUsuario($_POST['txtLocal']);
        $usuario->updateLocalizacao($usuario);
    }
    if (isset($_POST['txtSite'])) {
        $usuario->setSiteUsuario($_POST['txtSite']);
        $usuario->updateSite($usuario);
    }
    if (isset($_POST['txtBio'])) {
        $usuario->setBioUsuario($_POST['txtBio']);
        $usuario->updateBio($usuario);
    }

    if ($_POST['baseFoto'] != 0) {
        $fotoUsuario = new FotoUsuario();
        $image = $_POST['baseFoto'];
        $caminhoSalvar = "/xampp/htdocs/petiti/private-user/fotos-perfil/";
        $nomeArquivo = time() . ".png";
        $arquivoCompleto = $caminhoSalvar . $nomeArquivo;
        $fotoUsuario->setUsuario($usuario);
        $fotoUsuario->setNomeFoto($nomeArquivo);
        $caminhoBanco = "private-user/fotos-perfil/" . $nomeArquivo;
        $fotoUsuario->setCaminhoFoto($caminhoBanco);
        $fotoUsuario->cadastrar($fotoUsuario);
        file_put_contents($arquivoCompleto, file_get_contents($image));
        echo $arquivoCompleto;
    }

    $usuario->login($_SESSION['login'], $_SESSION['senha']);
    if ($_SESSION['tipo'] == "Tutor") {
        $envio = "tutor-perfil";
    } else {
        $envio = "empresa-perfil";
    }
    header("location: /petiti/$envio");
});
$app->post('/editar-perfil-pet/{id}', function (Request $request, Response $response, array $args) {
    @session_start();
    $usuario = new Usuario();
    $pet = new Pet();
    $id = $args['id'];
    $pet->setIdPet($id);
    if (isset($_POST['txtNome'])) {
        $pet->setNomePet($_POST['txtNome']);
        $pet->updateNomePet($pet);
    }
    if (isset($_POST['txtRaca'])) {
        $pet->setRacaPet($_POST['txtRaca']);
        $pet->updateRacaPet($pet);
    }
    if (isset($_POST['txtEspecie'])) {
        $pet->setEspeciePet($_POST['txtEspecie']);
        $pet->updateEspeciePet($pet);
    }
    if (isset($_POST['txtIdade'])) {
        $pet->setIdadePet($_POST['txtIdade']);
        $pet->updateIdadePet($pet);
    }
    if ($_POST['baseFoto'] != 0) {
        $fotoPet = new FotoPet();
        $caminhoSalvar = "/xampp/htdocs/petiti/private-user/fotos-pet/";

        $nomeArquivo = time() . ".png";
        $arquivoCompleto = $caminhoSalvar . $nomeArquivo;
        $caminhoBanco = "private-user/fotos-pet/" . $nomeArquivo;

        $fotoPet->setPet($pet);
        $fotoPet->setNomeFotoPet($nomeArquivo);
        $fotoPet->setCaminhoFotoPet($caminhoBanco);
        $fotoPet->cadastrar($fotoPet);
        file_put_contents($arquivoCompleto, file_get_contents($_POST['baseFoto']));
        echo $arquivoCompleto;
    }


    $usuario->login($_SESSION['login'], $_SESSION['senha']);
    header("location: /petiti/pet-perfil");
});


$app->post('/config-conta', function (Request $request, Response $response, array $args) {
    @session_start();
    $usuario = new Usuario();
    $usuario->setIdUsuario($_SESSION['id']);
    if (isset($_POST['txtNome'])) {
        $usuario->setNomeUsuario($_POST['txtNome']);
        $usuario->updateNome($usuario);
    }
    if (isset($_POST['txtLogin'])) {
        $usuario->setLoginUsuario($_POST['txtLogin']);
        $usuario->updateLogin($usuario);
    }
    if (isset($_POST['txtEmail'])) {
        $usuario->setEmailUsuario($_POST['txtEmail']);
        $emailVerificacao = $usuario->verificarEmail($_POST['txtEmail']);
        if ($emailVerificacao == true) {
            $usuario->updateEmail($usuario);
        } else {
            $cookie = new Cookies();
            $cookie->criarCookie("erro-email", "Email inválido", 5);
        }
    }


    if ($_POST['baseFoto'] != 0) {
        $fotoUsuario = new FotoUsuario();
        $image = $_POST['baseFoto'];
        $caminhoSalvar = "/xampp/htdocs/petiti/private-user/fotos-perfil/";
        $nomeArquivo = time() . ".png";
        $arquivoCompleto = $caminhoSalvar . $nomeArquivo;
        $fotoUsuario->setUsuario($usuario);
        $fotoUsuario->setNomeFoto($nomeArquivo);
        $caminhoBanco = "private-user/fotos-perfil/" . $nomeArquivo;
        $fotoUsuario->setCaminhoFoto($caminhoBanco);
        $fotoUsuario->cadastrar($fotoUsuario);
        file_put_contents($arquivoCompleto, file_get_contents($image));
        echo $arquivoCompleto;
    }

    $usuario->login($_SESSION['login'], $_SESSION['senha']);

    header("location: /petiti/opcoes");
});



$app->post('/update-senha', function (Request $request, Response $response, array $args) {
    @session_start();
    $usuario = new Usuario();
    $usuario->setIdUsuario($_SESSION['id']);


    if ($_POST['txtSenhaAntiga'] != $_SESSION['senha']) {
        $cookie = new Cookies();
        $cookie->criarCookie("erro-senha", "Senha inválida", 5);
        $cookie->criarCookie("abrir-senha", "openTab(event, '2')", 5);
        header("location: /petiti/opcoes");
    } else {
        $cookie = new Cookies();
        $usuario->setSenhaUsuario($_POST['txtSenhaNova1']);
        $usuario->updateSenha($usuario);
        $usuario->login($_SESSION['login'], $_SESSION['senha']);
        $cookie->criarCookie("abrir-senha", "openTab(event, '2')", 5);

        header("location: /petiti/opcoes");
    }
});

$app->get('/escolher-pet/{id}', function (Request $request, Response $response, array $args) {
    @session_start();
    $_SESSION['pet-escolhido'] = $args['id'];

    header('location: /petiti/pet-perfil');
});

$app->get('/excluir-denuncia/{tipoDenuncia}/{id}', function (Request $request, Response $response, array $args) {
    $cookie = new Cookies();
    if ($args['tipoDenuncia'] == "publicacao") {
        $denunciaPublicacao = new DenunciaPublicacao();
        $denunciaPublicacao->setIdDenunciaPublicacao($args['id']);
        $denunciaPublicacao->setStatusDenunciaPublicacao(2);

        $denunciaPublicacao->updateStatus($denunciaPublicacao);

        $decisao = "Denúncia Excluída";

        $denunciaPublicacao->updateDecisao($args['id'], $decisao);

        $cookie->criarCookie(
            "denunciaApagada",
            "<div class='popup'></div>
            <div class='toast'>
                <div class='toast-content'>
                    <div class='message'>
                        <span class='texto-1'>Denúncia apagada com sucesso</span>
                    </div>
                </div>
                 <i class='fa-sharp fa-solid fa-xmark' id='close' onclick='closePopup()'></i>
                <div class='progressbar'></div>
            </div>
  ",
            1
        );

        header("location: /petiti/denuncias-dashboard");
    } else if ($args['tipoDenuncia'] == "usuario") {
        $denunciaUsuario = new DenunciaUsuario();
        $denunciaUsuario->setIdDenunciaUsuario($args['id']);
        $denunciaUsuario->setStatusDenunciaUsuario(2);

        $denunciaUsuario->updateStatus($denunciaUsuario);

        $decisao = "Denúncia Excluída";

        $denunciaUsuario->updateDecisao($args['id'], $decisao);

        $cookie->criarCookie(
            "denunciaApagada",
            "<div class='popup'></div>
            <div class='toast'>
                <div class='toast-content'>
                    <div class='message'>
                        <span class='texto-1'>Denúncia apagada com sucesso</span>
                    </div>
                </div>
                 <i class='fa-sharp fa-solid fa-xmark' id='close' onclick='closePopup()'></i>
                <div class='progressbar'></div>
            </div>
  ",
            1
        );

        header("location: /petiti/denuncias-dashboard");
    } else if ($args['tipoDenuncia'] == "comentario") {
    }
});

$app->post('/denunciaUsuario', function (Request $request, Response $response, array $args) {
    $denunciaUsuario = new DenunciaUsuario();
    $usuario = new Usuario();
    $cookie = new Cookies();

    @session_start();

    $denunciaUsuario->setUsuarioDenunciador($_SESSION['id']);

    $usuario->setIdUsuario($_POST['idDenunciado']);
    $denunciaUsuario->setUsuarioDenunciado($usuario);

    $denunciaUsuario->settextoDenunciaUsuario($_POST['textoDenuncia']);
    $denunciaUsuario->setStatusDenunciaUsuario(0);

    $denunciaUsuario->cadastrar($denunciaUsuario);

    $cookie->criarCookie("denuncia", "
    <div id='toast-denuncia' class='toast-denuncia'>
        <div class='toast-denuncia-content'>
            <div class='message-denuncia'>
                <span class='texto-1'> Obrigado por sua denúncia </span>
                <span class='texto-2'> Ela será analisada o mais rápido possível</span>
            </div>
        </div>
        <i class='fa-sharp fa-solid fa-xmark' id='close' onclick='closePopup()'></i>
        <div class='progressbardenuncia'></div>
    </div>
    ", 1);
});

$app->post('/seguir-categoria', function (Request $request, Response $response, array $args) {
    @session_start();
    $categoriaSeguida = new categoriaSeguida();
    $idCategoria = $_POST['id'];
    $idUsuario = $_SESSION['id'];

    $ver = $categoriaSeguida->verificarSeguida($idUsuario, $idCategoria);

    $verificador = $ver['boolean'];

    if ($verificador == true) {
        $categoriaSeguida->setIdCategoria($idCategoria);
        $categoriaSeguida->setidUsuario($idUsuario);
        $categoriaSeguida->cadastrar($categoriaSeguida);
    } else {
        $idCategoriaJaSeguida = $ver['id'];
        $categoriaSeguida->setIdCategoriaSeguida($idCategoriaJaSeguida);
        $categoriaSeguida->delete($categoriaSeguida);
    }

    $arrayVerificador = array($verificador);
    $json = json_encode($arrayVerificador);

    $response->getBody()->write("$json");
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

$app->post('/pesquisar', function (Request $request, Response $response, array $args) {
    if (isset($_POST['val'])) {
        error_reporting(0);
        $con = Conexao::conexao();
        $fotoUsuario = new FotoUsuario();
        $fotoPet = new FotoPet();
        $fotoPublicacao = new FotoPublicacao();

        $pesquisa = $_POST['val'];

        $queryQtdPesquisa = "SELECT tbusuario.idUsuario, loginUsuario, innerfotousuario.caminhoFoto as foto
        FROM tbUsuario 
        INNER JOIN tbfotousuario innerfotousuario ON innerfotousuario.idusuario = tbusuario.idusuario
        WHERE loginUsuario LIKE '$pesquisa%' 
        UNION
        SELECT tbpet.idPet, usuarioPet, innerfotopet.caminhofotopet as foto FROM tbPet
        INNER JOIN tbfotopet innerfotopet ON innerfotopet.idpet = tbpet.idpet
        WHERE usuarioPet LIKE '$pesquisa%'
        UNION
        SELECT tbpublicacao.idPublicacao, textoPublicacao, innerfotopub.caminhoFotoPublicacao as foto FROM tbPublicacao
        INNER JOIN tbfotopublicacao innerfotopub ON innerfotopub.idPublicacao = tbpublicacao.idpublicacao
        WHERE textoPublicacao LIKE '$pesquisa%'
        ";

        $resultadoQtd = $con->query($queryQtdPesquisa);
        $listaQtd = $resultadoQtd->fetchAll(PDO::FETCH_ASSOC);
        $countQtdResultado = count($listaQtd);

        if ($countQtdResultado > 0) {
            echo ("<div>");
            //Usuarios
            $queryUsuarios = "SELECT tbusuario.idUsuario, loginUsuario, idTipoUsuario, nomeUsuario
            FROM tbUsuario
            INNER JOIN tbfotousuario innerfotousuario ON innerfotousuario.idusuario = tbusuario.idusuario
            WHERE loginUsuario LIKE '$pesquisa%' ";

            $resultadoUsuarios = $con->query($queryUsuarios);
            $listaUsuarios = $resultadoUsuarios->fetchAll(PDO::FETCH_ASSOC);
            $countResultadoUsuarios = count($listaUsuarios);

            if ($countResultadoUsuarios != 0) {
                echo ("<div class='cardsResultadoPesquisaUsuarios cardResultadoPesquisa'>");
                echo ("<span class='spanUsuariosEncontrados'>Usuarios encontrados: </span>");

                for ($r = 0; $r < $countResultadoUsuarios; $r++) {
                    $caminhoFotoUsuario = $fotoUsuario->exibirFotoUsuario($listaUsuarios[$r]['idUsuario']);
                    $resultadoBuscaAtual = $listaUsuarios[$r]['loginUsuario'];
                    $nomeUsuario = $listaUsuarios[$r]['nomeUsuario'];
                    if ($listaUsuarios[$r]['idTipoUsuario'] != 1) {
                        $icon = "fa-building";
                    } else {
                        $icon = "fa-user";
                    }
                    echo ("
                        <div class='cardResultadoPesquisa'>
                            <a id='resultadoBuscaAtual' class='resultBusca$resultadoBuscaAtual' href='/petiti/$resultadoBuscaAtual'>
                                <img id='fotoUsuarioPesquisado' src='$caminhoFotoUsuario'>
                                <div id='infoResultadoUsuarios'>
                                    <span style='padding-left: 10px;'>$nomeUsuario</span>
                                    <span style='padding-left: 10px; padding-top; 5px;'>@$resultadoBuscaAtual</span>
                                </div>
                                <div class='icon-tipo-pesquisa'>
                                    <i class='fa-solid $icon'></i>
                                </div>
                            </a>
                        </div>
                ");
                }
                echo ("</div");
            }
            //Pets
            $queryPets = "SELECT tbpet.idPet, usuarioPet, nomePet FROM tbPet
            INNER JOIN tbfotopet innerfotopet ON innerfotopet.idpet = tbpet.idpet
            WHERE usuarioPet LIKE '$pesquisa%'";

            $resultadoPets = $con->query($queryPets);
            $listaPets = $resultadoPets->fetchAll(PDO::FETCH_ASSOC);
            $countResultadoPets = count($listaPets);

            if ($countResultadoPets != 0) {
                echo ("<div class='cardsResultadoPesquisaPets cardResultadoPesquisa'>");
                echo ("<span class='spanUsuariosEncontrados'>Pets encontrados: </span>");


                for ($r = 0; $r < $countResultadoPets; $r++) {
                    $caminhoFotoPet = $fotoPet->exibirFotopet($listaPets[$r]['idPet']);
                    $resultadoBuscaAtual = $listaPets[$r]['usuarioPet'];
                    $nomePet = $listaPets[$r]['nomePet'];

                    echo ("
                        <div class='cardResultadoPesquisa'>
                            <a id='resultadoBuscaAtual' class='resultBusca$resultadoBuscaAtual' href='/petiti/$resultadoBuscaAtual'>
                                <img id='fotoUsuarioPesquisado' src='$caminhoFotoPet'>     
                                <div id='infoResultadoUsuarios'>
                                    <span style='padding-left: 10px;'>$nomePet</span>
                                    <span style='padding-left: 10px; padding-top; 5px;'>@$resultadoBuscaAtual</span>
                                </div>
                                <div class='icon-tipo-pesquisa'>
                                    <i class='fa-regular fa-paw'></i>
                                </div>
                            </a>
                        </div>
                ");
                }
                echo ("</div");
            }

            //Publicacacoes
            $querypubs = "SELECT tbpublicacao.idPublicacao, textoPublicacao FROM tbPublicacao
            INNER JOIN tbfotopublicacao innerfotopub ON innerfotopub.idPublicacao = tbpublicacao.idpublicacao
            WHERE textoPublicacao LIKE '$pesquisa%'";

            $resultadopubs = $con->query($querypubs);
            $listapubs = $resultadopubs->fetchAll(PDO::FETCH_ASSOC);
            $countResultadopubs = count($listapubs);

            if ($countResultadopubs != 0) {
                echo ("<div class='cardsResultadoPesquisaPubs cardResultadoPesquisa'>");
                echo ("<span class='spanUsuariosEncontrados'>Publicações encontrados: </span>");

                for ($r = 0; $r < $countResultadopubs; $r++) {
                    $caminhoFotoPublicacao = $fotoPublicacao->exibirFotopublicacao($listapubs[$r]['idPublicacao']);
                    $resultadoBuscaAtual = $listapubs[$r]['textoPublicacao'];

                    echo ("
                        <div class='cardResultadoPesquisa'>
                            <a id='resultadoBuscaAtual' class='resultBusca$resultadoBuscaAtual' href='/petiti/$resultadoBuscaAtual'>
                                <img id='fotoUsuarioPesquisado' src='$caminhoFotoPublicacao'>     
                                <span style='padding-left: 10px;'>$resultadoBuscaAtual</span>
                                <div class='icon-tipo-pesquisa'>
                                    <i class='fa-regular fa-paw-simple'></i>
                                </div>
                            </a>
                        </div>
                ");
                }
                echo ("</div");
                echo ("</div>");
            }
        } else {
            echo ("
            <div class='divSemResultadoPesquisa'>
                <span class='semResultadoPesquisa'>
                    Usuario, publicação ou pet não encontrado :(
                </span>
            </div>
            ");
        }
    }
});

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