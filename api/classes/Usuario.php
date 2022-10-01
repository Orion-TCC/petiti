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

    public function listar()
    {
        $con = Conexao::conexao();
        $query = "
        SELECT `idUsuario`, 
        `nomeUsuario`, 
        `senhaUsuario`, 
        `loginUsuario`, 
        `verificadoUsuario`, 
        `emailUsuario`, 
        `idTipoUsuario` FROM `tbusuario`
        ";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }
    public function listarUsuario($id)
    {
        $con = Conexao::conexao();
        $query = "
        SELECT `idUsuario`, 
        `nomeUsuario`, 
        `senhaUsuario`, 
        `loginUsuario`, 
        `verificadoUsuario`, 
        `emailUsuario`, 
        `idTipoUsuario` FROM `tbusuario`
        WHERE idUsuario = $id
        ";
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

                    $_SESSION['id'] = $dados[0]->idUsuario;
                    $_SESSION['nome'] = $dados[0]->nomeUsuario;
                    $_SESSION['senha'] = $dados[0]->senhaUsuario;
                    $_SESSION['login'] = $dados[0]->loginUsuario;
                    $_SESSION['verificado'] = $dados[0]->verificadoUsuario;
                    $_SESSION['email'] = $dados[0]->emailUsuario;
                    $_SESSION['tipo'] = $dados[0]->tipoUsuario;
                    $_SESSION['foto'] = $foto;

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
                    $_SESSION['tipo'] = $dados[0]->idTipoUsuario;
                    $_SESSION['foto'] = $foto;


                    return $msg = "Bem vindo.";
                } else {
                    return $msg = "Credenciais Inválidas.";
                }
            }
        } else {
            return $msg = "Credenciais Inválidas.";
        }
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
        $query = "SELECT `idPet`,`nomePet`,`racaPet`,`especiePet`,`idadePet`
        FROM tbpet
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
            return 'fodase';
        }
    }
}
