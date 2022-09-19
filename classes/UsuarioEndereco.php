<?php
require_once('/xampp/htdocs/petiti/database/conexao.php');
class usuarioEndereco
{
    private $idUsuarioEndereco;
    private $logradouroUsuario;
    private $numeroUsuario;
    private $cepUsuario;
    private $bairroUsuario;
    private $complementoUsuario;
    private $cidadeUsuario;
    private $estadoUsuario;
    private $usuario;

    public function getIdUsuarioEndereco()
    {
        return $this->idUsuarioEndereco;
    }

    public function setIdUsuarioEndereco($idUsuarioEndereco)
    {
        $this->idUsuarioEndereco = $idUsuarioEndereco;

        return $this;
    }

    public function getLogradouroUsuario()
    {
        return $this->logradouroUsuario;
    }

    public function setLogradouroUsuario($logradouroUsuario)
    {
        $this->logradouroUsuario = $logradouroUsuario;

        return $this;
    }

    public function getNumeroUsuario()
    {
        return $this->numeroUsuario;
    }

    public function setNumeroUsuario($numeroUsuario)
    {
        $this->numeroUsuario = $numeroUsuario;

        return $this;
    }

    public function getCepUsuario()
    {
        return $this->cepUsuario;
    }

    public function setCepUsuario($cepUsuario)
    {
        $this->cepUsuario = $cepUsuario;

        return $this;
    }

    public function getBairroUsuario()
    {
        return $this->bairroUsuario;
    }

    public function setBairroUsuario($bairroUsuario)
    {
        $this->bairroUsuario = $bairroUsuario;

        return $this;
    }

    public function getComplementoUsuario()
    {
        return $this->complementoUsuario;
    }

    public function setComplementoUsuario($complementoUsuario)
    {
        $this->complementoUsuario = $complementoUsuario;

        return $this;
    }

    public function getCidadeUsuario()
    {
        return $this->cidadeUsuario;
    }

    public function setCidadeUsuario($cidadeUsuario)
    {
        $this->cidadeUsuario = $cidadeUsuario;

        return $this;
    }

    public function getEstadoUsuario()
    {
        return $this->estadoUsuario;
    }

    public function setEstadoUsuario($estadoUsuario)
    {
        $this->estadoUsuario = $estadoUsuario;

        return $this;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function cadastrar($usuarioEndereco)
    {
        $con = Conexao::conexao();

        $stmt = $con->prepare(
            "
            INSERT INTO `tbusuarioendereco`(
                `idUsuarioEndereco`, `logradouroUsuario`, `numeroEnderecoUsuario`,
                `cepUsuario`, `bairroUsuario`, `complementoUsuario`,
                `cidadeUsuario`, `estadoUsuario`, `idUsuario`
            ) VALUES (
                default, ?,?,?,?,?,?,?,?)
            "
        );

        $stmt->bindValue(1, $usuarioEndereco->getLogradouroUsuario());
        $stmt->bindValue(2, $usuarioEndereco->getNumeroUsuario());
        $stmt->bindValue(3, $usuarioEndereco->getCepUsuario());
        $stmt->bindValue(4, $usuarioEndereco->getBairroUsuario());
        $stmt->bindValue(5, $usuarioEndereco->getComplementoUsuario());
        $stmt->bindValue(6, $usuarioEndereco->getCidadeUsuario());
        $stmt->bindValue(7, $usuarioEndereco->getEstadoUsuario());
        $stmt->bindValue(8, $usuarioEndereco->getUsuario()->getIdUsuario());

        $stmt->execute();
        $resultado = $con->query("SELECT MAX(idUsuarioEndereco) FROM tbUsuarioEndereco");
        $lista = $resultado->fetchAll();

        foreach ($lista as $linha) {
            $id = $linha[0];
        }
        $array = array("msg" => "Cadastro de endereço de usuário realizado com sucesso", "id: " => "$id");
        return $array;
    }

    public function update($update)
    {
        $con = Conexao::conexao();

        $stmt = $con->prepare(
            "
                UPDATE `tbUsuarioEndereco`
                SET `logradouroUsuario` = ?, `numeroEnderecoUsuario` = ?,
                `cepUsuario` = ?, `bairroUsuario` = ?, `complementoUsuario` = ?,
                `cidadeUsuario` = ?, `estadoUsuario` = ?, `idUsuario` = ?
                WHERE idUsuarioEndereco = ?
            "
        );

        $stmt->bindValue(1, $update->getLogradouroUsuario());
        $stmt->bindValue(2, $update->getNumeroUsuario());
        $stmt->bindValue(3, $update->getCepUsuario());
        $stmt->bindValue(4, $update->getBairroUsuario());
        $stmt->bindValue(5, $update->getComplementoUsuario());
        $stmt->bindValue(6, $update->getCidadeUsuario());
        $stmt->bindValue(7, $update->getEstadoUsuario());
        $stmt->bindValue(8, $update->getUsuario()->getIdUsuario());

        $stmt->execute();
        $array = array("msg" => "Dados de endereço do usuario atualizados com sucesso", "id: " => "$update->getIdUsuarioEndereco()");
    }

    public function delete($delete)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("DELETE FROM tbUsuarioEndereco WHERE idUsuarioEndereco = ?");
        $stmt->bindValue(1, $delete->getIdUsuarioEndereco());

        $stmt->execute();
        return $msg = "Endereço do usuário deletado.";
    }
}
