<?php
require_once('/xampp/htdocs/projeto-Petiti/database/conexao.php');
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
        $lista = $resultado->fetchAll();
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
        $lista = $resultado->fetchAll();
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
                    session_start();
                    $id = $usuario->procuraId($login_ou_email);
                    $lista = $usuario->listarUsuario($id);
                    $foto = $fotoUsuario->exibirFotoUsuario($id);
                    foreach ($lista as $linha) {
                        $_SESSION['id'] = $linha[0];
                        $_SESSION['nome'] = $linha[1];
                        $_SESSION['senha'] = $linha[2];
                        $_SESSION['login'] = $linha[3];
                        $_SESSION['verificado'] = $linha[4];
                        $_SESSION['email'] = $linha[5];
                        $_SESSION['tipo'] = $linha[6];
                        $_SESSION['foto'] = $foto;
                    }
                    
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
                    $lista = $usuario->listarUsuario($id);
                    $foto = $fotoUsuario->exibirFotoUsuario($id);
                    foreach ($lista as $linha) {
                        $_SESSION['id'] = $linha[0];
                        $_SESSION['nome'] = $linha[1];
                        $_SESSION['senha'] = $linha[2];
                        $_SESSION['login'] = $linha[3];
                        $_SESSION['verificado'] = $linha[4];
                        $_SESSION['email'] = $linha[5];
                        $_SESSION['tipo'] = $linha[6];
                        $_SESSION['foto'] = $foto;
                    }

                    return $msg = "Bem vindo.";
                } else {
                    return $msg = "Credenciais Inválidas.";
                }
            }
        } else {
            return $msg = "Credenciais Inválidas.";
        }
    }

    public function update($update)
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
        $stmt = $con->prepare("
        DELETE FROM tbusuario WHERE idUsuario = ?");
        $stmt->bindValue(1, $delete->getIdUsuario());

        $stmt->execute();

        return $msg = "Perfil deletado";
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
        $lista = $resultado->fetchAll();
        return $lista;
    }
}
