<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');
class FotoProduto
{
    private $idFotoProduto;
    private $caminhoFotoProduto;
    private $nomeFotoProduto;
    private $produto;

    public function getProduto()
    {
        return $this->produto;
    }

    public function setProduto($produto)
    {
        $this->produto = $produto;

        return $this;
    }

    public function getNomeFotoProduto()
    {
        return $this->nomeFotoProduto;
    }

    public function setNomeFotoProduto($nomeFotoProduto)
    {
        $this->nomeFotoProduto = $nomeFotoProduto;

        return $this;
    }

    public function getCaminhoFotoProduto()
    {
        return $this->caminhoFotoProduto;
    }

    public function setCaminhoFotoProduto($caminhoFotoProduto)
    {
        $this->caminhoFotoProduto = $caminhoFotoProduto;

        return $this;
    }

    public function getIdFotoProduto()
    {
        return $this->idFotoProduto;
    }

    public function setIdFotoProduto($idFotoProduto)
    {
        $this->idFotoProduto = $idFotoProduto;

        return $this;
    }

    public function cadastrar($fotoProduto)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("INSERT INTO tbFotoProduto(idFotoProduto, nomeFotoProduto, caminhoFotoProduto, idProduto) VALUES(
            default, ?, ?, ?)");
        $stmt->bindValue(1, $fotoProduto->getNomeFotoProduto());
        $stmt->bindValue(2, $fotoProduto->getCaminhoFotoProduto());
        $stmt->bindValue(3, $fotoProduto->getProduto()->getIdProduto());

        $stmt->execute();
    }

    public function exibirFotoProduto($id)
    {
        $con = Conexao::conexao();
        $query = "SELECT caminhoFotoProduto FROM `tbfotoProduto` WHERE idFotoProduto = (SELECT MAX(idFotoProduto) FROM tbfotoProduto WHERE idProduto = $id)";

        $resultado = $con->query($query);
        $lista = $resultado->fetchAll();
        foreach ($lista as $linha) {
            $caminhoFoto = $linha[0];
        }
        return $caminhoFoto;
    }
}
