<?php
require_once('/xampp/htdocs/projeto-Petiti/database/conexao.php');
class TipoUsuario
{
    private $idTipoUsuario;
    private $tipoUsuario;


    public function getIdTipoUsuario()
    {
        return $this->idTipoUsuario;
    }


    public function setIdTipoUsuario($idTipoUsuario)
    {
        $this->idTipoUsuario = $idTipoUsuario;
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
        $query = "SELECT idTipoUsuario, tipoUsuario FROM tbtipousuario";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll();
        return $lista;
    }
    public function cadastrar($tipoUsuario)
    {
        $con = Conexao::conexao();

        $tipo = $tipoUsuario->getTipoUsuario();
        $query = "SELECT tipoUsuario FROM tbtipousuario WHERE tipoUsuario = '$tipo'";
        $resultado = $con->query($query);

        $lista = $resultado->fetchAll();
        $lista_Array = (array) $lista;

        $msg = "";
        if (count($lista_Array) > 0) {
            return $msg = "Tipo de usuário já cadastrado";
        } else {
            $stmt = $con->prepare("INSERT INTO tbtipousuario VALUES (default, ?)");
            $stmt->bindValue(1, $tipoUsuario->getTipoUsuario());
            $stmt->execute();
            return $msg = "Tipo cadastrado com sucesso.";
        }
    }

    public function update($update)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("UPDATE `tbusuario` 
        SET `tipoUsuario`= ?,
    
        WHERE idTipoUsuario = ?");

        $stmt->bindValue(1, $update->getTipoUsuario());

        $stmt->bindValue(2, $update->getIdTipoUsuario());

        $stmt->execute();
    }

    public function delete($delete)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("
        DELETE FROM tbTipoUsuario WHERE idTipoUsuario = ?");
        $stmt->bindValue(1, $delete->getIdTipoUsuario());

        $stmt->execute();
    }
}
