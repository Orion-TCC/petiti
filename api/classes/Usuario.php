<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');
require_once("FotoUsuario.php");
class Usuario
{

    private $idUsuario;
    private $nomeUsuario;
    private $senhaUsuario;
    private $loginUsuario;
    private $verificadoUsuario;
    private $emailUsuario;
    private $tipoUsuario;
    private $bioUsuario;
    private $localizacaoUsuario;
    private $siteUsuario;
    private $statusUsuario;


    public function getIdUsuario()
    {
        return $this->idUsuario;
    }


    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getNomeUsuario()
    {
        return $this->nomeUsuario;
    }


    public function setNomeUsuario($nomeUsuario)
    {
        $this->nomeUsuario = $nomeUsuario;
    }


    public function getSenhaUsuario()
    {
        return $this->senhaUsuario;
    }


    public function setSenhaUsuario($senhaUsuario)
    {
        $this->senhaUsuario = $senhaUsuario;
    }

    public function getLoginUsuario()
    {
        return $this->loginUsuario;
    }


    public function setLoginUsuario($loginUsuario)
    {
        $this->loginUsuario = $loginUsuario;
    }


    public function getVerificadoUsuario()
    {
        return $this->verificadoUsuario;
    }


    public function setVerificadoUsuario($verificadoUsuario)
    {
        $this->verificadoUsuario = $verificadoUsuario;
    }


    public function getEmailUsuario()
    {
        return $this->emailUsuario;
    }



    public function setEmailUsuario($emailUsuario)
    {
        $this->emailUsuario = $emailUsuario;
    }


    public function getTipoUsuario()
    {
        return $this->tipoUsuario;
    }

    public function setTipoUsuario($tipoUsuario)
    {
        $this->tipoUsuario = $tipoUsuario;
    }

    public function getBioUsuario()
    {
        return $this->bioUsuario;
    }

    public function setBioUsuario($bioUsuario)
    {
        $this->bioUsuario = $bioUsuario;
    }


    public function getLocalizacaoUsuario()
    {
        return $this->localizacaoUsuario;
    }


    public function setLocalizacaoUsuario($localizacaoUsuario)
    {
        $this->localizacaoUsuario = $localizacaoUsuario;
    }

    public function getSiteUsuario()
    {
        return $this->siteUsuario;
    }


    public function setSiteUsuario($siteUsuario)
    {
        $this->siteUsuario = $siteUsuario;
    }

    public function getStatusUsuario()
    {
        return $this->statusUsuario;
    }


    public function setStatusUsuario($statusUsuario)
    {
        $this->statusUsuario = $statusUsuario;

        return $this;
    }
    public function listar()
    {
        $con = Conexao::conexao();
        $query = "SELECT idUsuario, 
        nomeUsuario, 
        senhaUsuario, 
        loginUsuario, 
        verificadoUsuario, 
        emailUsuario, 
        statusUsuario,
        tbusuario.idTipoUsuario,
        tipoUsuario,
        bioUsuario,
        localizacaoUsuario, 
        dataCriacaoConta,
        siteUsuario
        FROM tbusuario 
        INNER JOIN tbtipousuario ON tbtipousuario.idTipoUsuario = tbusuario.idTipoUsuario";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }

    public function listarUsuario($id)
    {
        $con = Conexao::conexao();
        $query = "SELECT tbusuario.idUsuario, 
        nomeUsuario, 
        senhaUsuario, 
        loginUsuario, 
        verificadoUsuario, 
        emailUsuario, 
        statusUsuario,
        tbusuario.idTipoUsuario,
        tipoUsuario,
        bioUsuario,  
        caminhoFoto,      
        dataCriacaoConta,
        localizacaoUsuario, 
        siteUsuario
        FROM tbusuario 
        INNER JOIN tbtipousuario ON tbtipousuario.idTipoUsuario = tbusuario.idTipoUsuario
        INNER JOIN tbfotousuario
        WHERE tbusuario.idUsuario = $id AND tbfotousuario.idFotoUsuario =(
                            SELECT
                                MAX(tbfotousuario.idFotoUsuario)
                            FROM
                                tbfotousuario
                            WHERE
                                tbfotousuario.idUsuario = tbUsuario.idUsuario
        )";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }
    public function procuraId($email)
    {
        $con = Conexao::conexao();
        $query = "SELECT idUsuario FROM tbusuario WHERE emailUsuario = '$email'";

        $resultado = $con->query($query);
        $lista = $resultado->fetchAll();
        foreach ($lista as $linha) {
            $id = $linha[0];
        }
        return $id;
    }

    public function procuraId2($login)
    {
        $con = Conexao::conexao();
        $query = "SELECT idUsuario FROM tbusuario WHERE loginUsuario = '$login'";

        $resultado = $con->query($query);
        $lista = $resultado->fetchAll();
        foreach ($lista as $linha) {
            $id = $linha[0];
        }
        return $id;
    }

    public function validarEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    public function cadastrar($usuario)
    {

        $con = Conexao::conexao();

        $emailUsuario = $usuario->getEmailUsuario();
        $loginUsuario = $usuario->getLoginUsuario();

        $query = "SELECT emailUsuario from tbusuario WHERE emailUsuario = '$emailUsuario'";
        $resultado = $con->query($query);
        $listaObject = $resultado->fetchAll();
        $listaArray = (array) $listaObject;
        $contagemEmail = count($listaArray);

        $query = "SELECT loginUsuario from tbusuario WHERE loginUsuario = '$loginUsuario'";
        $resultado = $con->query($query);
        $listaObject = $resultado->fetchAll();
        $listaArray = (array) $listaObject;
        $contagemLogin = count($listaArray);
        $msg = "";
        if ($contagemEmail > 0) {
            $array = array("msg" => "Email já cadastrado.");
            return $array;
        } elseif ($contagemLogin > 0) {
            $array = array("msg" => "Login já cadastrado.");
            return $array;
        } else {
            $stmt = $con->prepare(
                "
            INSERT INTO `tbusuario`(
                `idUsuario`, `nomeUsuario`, 
                `senhaUsuario`, `loginUsuario`, 
                `verificadoUsuario`, `emailUsuario`, `idTipoUsuario`) 
            VALUES (
               default, ?, ?, ?, ?, ?, ?)"
            );

            $stmt->bindValue(1, $usuario->getNomeUsuario());
            $stmt->bindValue(2, $usuario->getSenhaUsuario());
            $stmt->bindValue(3, $usuario->getLoginUsuario());
            $stmt->bindValue(4, $usuario->getVerificadoUsuario());
            $stmt->bindValue(5, $usuario->getEmailUsuario());
            $stmt->bindValue(6, $usuario->getTipoUsuario()->getIdTipoUsuario());

            $stmt->execute();
            $resultado = $con->query("SELECT MAX(idUsuario) FROM tbusuario");
            $lista = $resultado->fetchAll();

            foreach ($lista as $linha) {
                $id = $linha[0];
            }
            $array = array("msg" => "Cadastro realizado com sucesso", "id" => "$id");
            return $array;
        }
    }

    public function login($login_ou_email, $senha)
    {

        $con = Conexao::conexao();
        $queryUsuario = "SELECT loginUsuario FROM tbusuario WHERE loginUsuario = '$login_ou_email' ";
        $resultado = $con->query($queryUsuario);
        $lista = $resultado->fetchAll();
        $lista_Array = (array) $lista;
        $contagemLogin = count($lista_Array);

        $queryEmail = "SELECT emailUsuario FROM tbusuario WHERE emailUsuario = '$login_ou_email' ";
        $resultado = $con->query($queryEmail);
        $lista = $resultado->fetchAll();
        $lista_Array = (array) $lista;
        $contagemEmail = count($lista_Array);
        $msg = "";

        if (($contagemEmail > 0) || ($contagemLogin > 0)) {


            $fotoUsuario = new FotoUsuario();
            $usuario = new Usuario();
            $result = $usuario->validarEmail($login_ou_email);

            if ($result == true) {
                $querySenha = "SELECT senhaUsuario, emailUsuario FROM tbusuario WHERE senhaUsuario = '$senha' AND emailUsuario = '$login_ou_email'";
                $resultado = $con->query($querySenha);
                $lista = $resultado->fetchAll();
                $lista_Array = (array) $lista;
                $contagemValidacao = count($lista_Array);

                if ($contagemValidacao > 0) {
                    @session_start();
                    $id = $usuario->procuraId($login_ou_email);
                    $foto = $fotoUsuario->exibirFotoUsuario($id);
                    $url = "http://localhost/petiti/api/usuario/$id";
                    $json = file_get_contents($url);
                    $dados = json_decode($json);

                    $_SESSION['status'] = $dados[0]->statusUsuario;
                    $_SESSION['id'] = $dados[0]->idUsuario;
                    $_SESSION['nome'] = $dados[0]->nomeUsuario;
                    $_SESSION['senha'] = $dados[0]->senhaUsuario;
                    $_SESSION['login'] = $dados[0]->loginUsuario;
                    $_SESSION['verificado'] = $dados[0]->verificadoUsuario;
                    $_SESSION['email'] = $dados[0]->emailUsuario;
                    $_SESSION['tipo'] = $dados[0]->tipoUsuario;
                    $_SESSION['foto'] = $foto;
                    $_SESSION['bio'] = $dados[0]->bioUsuario;
                    $_SESSION['local'] = $dados[0]->local;
                    $_SESSION['site'] = $dados[0]->site;

                    return $msg = "Bem vindo.";
                } else {
                    return $msg = "Credenciais Inválidas.";
                }
            } else {
                $querySenha = "SELECT senhaUsuario, loginUsuario FROM tbusuario WHERE senhaUsuario = '$senha' AND loginUsuario = '$login_ou_email'";
                $resultado = $con->query($querySenha);
                $lista = $resultado->fetchAll();
                $lista_Array = (array) $lista;
                $contagemValidacao = count($lista_Array);

                if ($contagemValidacao > 0) {
                    @session_start();
                    $id = $usuario->procuraId2($login_ou_email);
                    $foto = $fotoUsuario->exibirFotoUsuario($id);
                    $url = "http://localhost/petiti/api/usuario/$id";
                    $json = file_get_contents($url);
                    $dados = json_decode($json);

                    $_SESSION['id'] = $dados[0]->idUsuario;
                    $_SESSION['nome'] = $dados[0]->nomeUsuario;
                    $_SESSION['senha'] = $dados[0]->senhaUsuario;
                    $_SESSION['login'] = $dados[0]->loginUsuario;
                    $_SESSION['verificado'] = $dados[0]->verificadoUsuario;
                    $_SESSION['email'] = $dados[0]->emailUsuario;
                    $_SESSION['tipo'] = $dados[0]->tipoUsuario;
                    $_SESSION['foto'] = $foto;
                    $_SESSION['bio'] = $dados[0]->bioUsuario;
                    $_SESSION['local'] = $dados[0]->localizacaoUsuario;
                    $_SESSION['site'] = $dados[0]->siteUsuario;


                    return $msg = "Bem vindo.";
                } else {
                    return $msg = "Credenciais Inválidas.";
                }
            }
        } else {
            return $msg = "Credenciais Inválidas.";
        }
    }
    public function updateNome($update)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("UPDATE tbusuario SET nomeUsuario = ? WHERE idUsuario = ?");
        $stmt->bindValue(1, $update->getNomeUsuario());
        $stmt->bindValue(2, $update->getIdUsuario());
        $stmt->execute();
    }

    public function updateTipo($update)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("UPDATE tbusuario SET idTipoUsuario = ? WHERE idUsuario = ?");
        $stmt->bindValue(1, $update->getTipoUsuario()->getIdTipoUsuario());
        $stmt->bindValue(2, $update->getIdUsuario());
        $stmt->execute();
    }
    public function updateLogin($update)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("UPDATE tbusuario SET loginUsuario = ? WHERE idUsuario = ?");
        $stmt->bindValue(1, $update->getLoginUsuario());
        $stmt->bindValue(2, $update->getIdUsuario());
        $stmt->execute();
    }
    public function updateEmail($update)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("UPDATE tbusuario SET emailUsuario = ? WHERE idUsuario = ?");
        $stmt->bindValue(1, $update->getEmailUsuario());
        $stmt->bindValue(2, $update->getIdUsuario());
        $stmt->execute();
    }
    public function updateSenha($update)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("UPDATE tbusuario SET senhaUsuario = ? WHERE idUsuario = ?");
        $stmt->bindValue(1, $update->getSenhaUsuario());
        $stmt->bindValue(2, $update->getIdUsuario());
        $stmt->execute();
    }
    public function updateBio($update)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("UPDATE tbusuario SET bioUsuario = ? WHERE idUsuario = ?");
        $stmt->bindValue(1, $update->getBioUsuario());
        $stmt->bindValue(2, $update->getIdUsuario());
        $stmt->execute();
    }
    public function updateLocalizacao($update)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("UPDATE tbusuario SET localizacaoUsuario = ? WHERE idUsuario = ?");
        $stmt->bindValue(1, $update->getLocalizacaoUsuario());
        $stmt->bindValue(2, $update->getIdUsuario());
        $stmt->execute();
    }
    public function updateSite($update)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("UPDATE tbusuario SET siteUsuario = ? WHERE idUsuario = ?");
        $stmt->bindValue(1, $update->getSiteUsuario());
        $stmt->bindValue(2, $update->getIdUsuario());
        $stmt->execute();
    }

    public function updateStatus($update)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("UPDATE tbusuario SET statusUsuario = ? WHERE idUsuario = ?");
        $stmt->bindValue(1, $update->getStatusUsuario());
        $stmt->bindValue(2, $update->getIdUsuario());
        $stmt->execute();
    }

    public function update($id, $campo, $valor)
    {
        $con = Conexao::conexao();

        switch ($campo) {
            case 'nome':
                $stmt = $con->prepare("UPDATE `tbusuario` 
                SET `nomeUsuario`= '$valor'
                WHERE idUsuario = $id");
                $stmt->execute();
                break;

            case 'ramo':
                $stmt = $con->prepare("UPDATE `tbusuario` 
                SET `idTipoUsuario`= $valor
                WHERE idUsuario = $id");
                $stmt->execute();
                break;

            case 'senha':
                $stmt = $con->prepare("UPDATE `tbusuario` 
                SET 
                `senhaUsuario`= '$valor'
                WHERE idUsuario = $id");
                $stmt->execute();
                break;

            case 'login':
                $stmt = $con->prepare("UPDATE `tbusuario` 
                SET `loginUsuario`= '$valor'
                WHERE idUsuario = $id");
                $stmt->execute();
                break;

            case 'email':
                $stmt = $con->prepare("UPDATE `tbusuario` 
                SET `emailUsuario`= '$valor'
                WHERE idUsuario = $id");
                $stmt->execute();
                break;


            default:

                break;
        }

        return $msg = "Seu perfil foi atualizado.";
    }

    public function updateFull($update)
    {
        $con = Conexao::conexao();

        $stmt = $con->prepare("UPDATE `tbusuario` 
        SET `nomeUsuario`= ?,
        `senhaUsuario`= ?,`loginUsuario`= ?,
        `verificadoUsuario`= ?,`emailUsuario`= ?,
        `idTipoUsuario`= ? 
        WHERE idUsuario = ?");

        $stmt->bindValue(1, $update->getNomeUsuario());
        $stmt->bindValue(2, $update->getSenhaUsuario());
        $stmt->bindValue(3, $update->getLoginUsuario());
        $stmt->bindValue(4, $update->getVerificadoUsuario());
        $stmt->bindValue(5, $update->getEmailUsuario());
        $stmt->bindValue(6, $update->getTipoUsuario());
        $stmt->bindValue(7, $update->getIdUsuario());

        $stmt->execute();

        return $msg = "Seu perfil foi atualizado.";
    }

    public function delete($delete)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("DELETE FROM tbusuario WHERE idUsuario = ?");
        $stmt->bindValue(1, $delete->getIdUsuario());

        $stmt->execute();
    }

    public function listarPetsUsuario($id)
    {
        $con = Conexao::conexao();
        $query = "SELECT tbpet.idPet, nomePet, racaPet, usuarioPet,especiePet, idadePet, dataCriacaoPet, tbpet.idUsuario, caminhoFotoPet
                FROM tbpet
                INNER JOIN tbfotopet ON tbpet.idPet  = tbfotopet.idPet
        INNER JOIN tbusuario ON tbusuario.idUsuario = tbpet.idUsuario
        WHERE tbusuario.idUsuario = $id
        ";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }
    public function procuraEmail($email)
    {
        $con = Conexao::conexao();
        $query = "SELECT emailUsuario FROM tbusuario WHERE emailUsuario = '$email'";
        $emailBanco = "";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll();
        foreach ($lista as $linha) {
            $emailBanco = $linha[0];
        }
        if ($email == $emailBanco) {
            return true;
        } else {
            return false;
        }
    }

    public function buscaUsuarioAtivo()
    {
        $con = Conexao::conexao();
        $query = "SELECT tbusuario.idUsuario, 
                        nomeUsuario, 
                        senhaUsuario, 
                        loginUsuario, 
                        verificadoUsuario, 
                        emailUsuario, 
                        tbusuario.idTipoUsuario,
                        tipoUsuario,
                        DAY(dataCriacaoConta) as dia, MONTHNAME(dataCriacaoConta) as mes, YEAR(dataCriacaoConta) as ano,
                        caminhoFoto,
                        dataCriacaoConta,
                        bioUsuario,
                        localizacaoUsuario, 
                        siteUsuario
                        FROM tbusuario 
                        INNER JOIN tbtipousuario ON tbtipousuario.idTipoUsuario = tbusuario.idTipoUsuario
                        INNER JOIN tbfotousuario ON tbfotousuario.idUsuario = tbusuario.idUsuario
                        WHERE statusUsuario = 1 AND tbusuario.idTipoUsuario = 1 AND tbfotousuario.idFotoUsuario =(
                            SELECT
                                MAX(tbfotousuario.idFotoUsuario)
                            FROM
                                tbfotousuario
                            WHERE
                                tbfotousuario.idUsuario = tbUsuario.idUsuario
                        )";

        $resultado = $con->query($query);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscaUsuarioBloqueado()
    {
        $con = Conexao::conexao();
        $query = "SELECT tbusuario.idUsuario, 
                        nomeUsuario, 
                        senhaUsuario, 
                        loginUsuario, 
                        verificadoUsuario, 
                        emailUsuario,
                        caminhoFoto,
                        dataCriacaoConta,
                        tbusuario.idTipoUsuario,
                        DAY(dataCriacaoConta) as dia, MONTHNAME(dataCriacaoConta) as mes, YEAR(dataCriacaoConta) as ano,

                        tipoUsuario,
                        bioUsuario,
                        localizacaoUsuario, 
                        siteUsuario
                        FROM tbusuario 
                        INNER JOIN tbtipousuario ON tbtipousuario.idTipoUsuario = tbusuario.idTipoUsuario
                        INNER JOIN tbfotousuario ON tbfotousuario.idUsuario = tbusuario.idUsuario

                        WHERE statusUsuario = 0 AND tbusuario.idTipoUsuario = 1 AND tbfotousuario.idFotoUsuario =(
    SELECT
        MAX(tbfotousuario.idFotoUsuario)
    FROM
        tbfotousuario
     WHERE
        tbfotousuario.idUsuario = tbUsuario.idUsuario
)";

        $resultado = $con->query($query);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscaQtdUsuarioAtivo()
    {
        $con = Conexao::conexao();
        $query = "SELECT COUNT(idUsuario) as qtd FROM tbusuario WHERE statusUsuario = 1 AND tbusuario.idTipoUsuario = 1";
        $resultado = $con->query($query);
        $listaUsuariosQtd = $resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach ($listaUsuariosQtd as $linha) {
            return $linha['qtd'];
        }
    }

    public function buscaQtdUsuarioBloqueado()
    {
        $con = Conexao::conexao();
        $query = "SELECT COUNT(idUsuario) as qtd FROM tbusuario WHERE statusUsuario = 0 AND tbusuario.idTipoUsuario = 1";
        $resultado = $con->query($query);
        $listaUsuariosQtd = $resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach ($listaUsuariosQtd as $linha) {
            return $linha['qtd'];
        }
    }

    public function buscaQtdUsuarioAtivoEmpresa()
    {
        $con = Conexao::conexao();
        $query = "SELECT COUNT(idUsuario) as qtd FROM tbusuario WHERE statusUsuario = 1 AND tbusuario.idTipoUsuario != 1 AND tbusuario.idTipoUsuario != 3";
        $resultado = $con->query($query);
        $listaUsuariosQtd = $resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach ($listaUsuariosQtd as $linha) {
            return $linha['qtd'];
        }
    }

    public function buscaQtdUsuarioBloqueadoEmpresa()
    {
        $con = Conexao::conexao();
        $query = "SELECT COUNT(idUsuario) as qtd FROM tbusuario WHERE statusUsuario = 0 AND tbusuario.idTipoUsuario != 1";
        $resultado = $con->query($query);
        $listaUsuariosQtd = $resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach ($listaUsuariosQtd as $linha) {
            return $linha['qtd'];
        }
    }

    public function buscaEmpresaAtiva()
    {
        $con = Conexao::conexao();
        $query = "SELECT tbusuario.idUsuario,
        nomeUsuario,
        senhaUsuario,
        loginUsuario,
        verificadoUsuario,
        emailUsuario,
        tbusuario.idTipoUsuario,
        tipoUsuario,
        bioUsuario,
        dataCriacaoConta,
        DAY(dataCriacaoConta) as dia, MONTHNAME(dataCriacaoConta) as mes, YEAR(dataCriacaoConta) as ano,
        localizacaoUsuario,
        caminhoFoto,
        siteUsuario
        FROM tbusuario 
        INNER JOIN tbtipousuario ON tbtipousuario.idTipoUsuario = tbusuario.idTipoUsuario
        INNER JOIN tbfotousuario ON tbfotousuario.idUsuario = tbusuario.idUsuario
        WHERE statusUsuario = 1 AND tbtipousuario.tipoUsuario != 'Tutor' AND tbtipousuario.tipoUsuario != 'Adm' AND tbfotousuario.idFotoUsuario =(
    SELECT
        MAX(tbfotousuario.idFotoUsuario)
    FROM
        tbfotousuario
     WHERE
        tbfotousuario.idUsuario = tbUsuario.idUsuario
)";

        $resultado = $con->query($query);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }
    public function buscaEmpresaBloqueada()
    {
        $con = Conexao::conexao();
        $query = "SELECT tbusuario.idUsuario,
        nomeUsuario,
        senhaUsuario,
        loginUsuario,
        verificadoUsuario,
        emailUsuario,
        dataCriacaoConta,
        DAY(dataCriacaoConta) as dia, MONTHNAME(dataCriacaoConta) as mes, YEAR(dataCriacaoConta) as ano,
        tbusuario.idTipoUsuario,
        caminhoFoto,
        tipoUsuario,
        bioUsuario,
        localizacaoUsuario,
        siteUsuario
        FROM tbusuario INNER JOIN tbtipousuario ON tbtipousuario.idTipoUsuario = tbusuario.idTipoUsuario
        INNER JOIN tbfotousuario ON tbfotousuario.idUsuario = tbusuario.idUsuario

        WHERE statusUsuario = 0 AND tbusuario.idTipoUsuario != 1 AND tbfotousuario.idFotoUsuario =(
    SELECT
        MAX(tbfotousuario.idFotoUsuario)
    FROM
        tbfotousuario
     WHERE
        tbfotousuario.idUsuario = tbUsuario.idUsuario
)";

        $resultado = $con->query($query);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }
}
