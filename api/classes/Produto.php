<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');

class Produto
{
    private $idProduto;
    private $textoProduto;
    private $descProduto;
    private $valorProduto;
    private $statusProduto;
    private $usuario;

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getStatusProduto()
    {
        return $this->statusProduto;
    }

    public function setStatusProduto($statusProduto)
    {
        $this->statusProduto = $statusProduto;

        return $this;
    }

    public function getValorProduto()
    {
        return $this->valorProduto;
    }

    public function setValorProduto($valorProduto)
    {
        $this->valorProduto = $valorProduto;

        return $this;
    }

    public function getDescProduto()
    {
        return $this->descProduto;
    }

    public function setDescProduto($descProduto)
    {
        $this->descProduto = $descProduto;

        return $this;
    }

    public function getTextoProduto()
    {
        return $this->textoProduto;
    }

    public function setTextoProduto($textoProduto)
    {
        $this->textoProduto = $textoProduto;

        return $this;
    }

    public function getIdProduto()
    {
        return $this->idProduto;
    }

    public function setIdProduto($idProduto)
    {
        $this->idProduto = $idProduto;

        return $this;
    }

    public function cadastrar($produto)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("
        INSERT INTO tbProduto(idProduto, textoProduto, descProduto, valorProduto, statusProduto, idUsuario)VALUES(
            default, ?, ?, ?, ?, ?)
        ");
        $stmt->bindValue(1, $produto->getTextoProduto());
        $stmt->bindValue(2, $produto->getDescProduto());
        $stmt->bindValue(3, $produto->getValorProduto());
        $stmt->bindValue(4, $produto->getStatusProduto());
        $stmt->bindValue(5, $produto->getUsuario()->getIdUsuario());
        $stmt->execute();
        $resultado = $con->query("SELECT MAX(idProduto) as id FROM tbProduto");
        $lista = $resultado->fetchAll();

        foreach ($lista as $linha) {
            $id = $linha['id'];
        }
        return $id;
    }

    public function listar()
    {
        $con = Conexao::conexao();
        $query = "SELECT idProduto, textoProduto, descProduto, valorProduto, statusProduto, idUsuario FROM tbProduto";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);

        return $lista;
    }
}
