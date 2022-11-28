<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');
class FotoServico
{
    private $idFotoServico;
    private $caminhoFotoServico;
    private $nomeFotoServico;
    private $servico;

    public function getServico()
    {
        return $this->servico;
    }

    public function setServico($servico)
    {
        $this->servico = $servico;

        return $this;
    }

    public function getNomeFotoServico()
    {
        return $this->nomeFotoServico;
    }

    public function setNomeFotoServico($nomeFotoServico)
    {
        $this->nomeFotoServico = $nomeFotoServico;

        return $this;
    }

    public function getCaminhoFotoServico()
    {
        return $this->caminhoFotoServico;
    }

    public function setCaminhoFotoServico($caminhoFotoServico)
    {
        $this->caminhoFotoServico = $caminhoFotoServico;

        return $this;
    }

    public function getIdFotoServico()
    {
        return $this->idFotoServico;
    }

    public function setIdFotoServico($idFotoServico)
    {
        $this->idFotoServico = $idFotoServico;

        return $this;
    }

    public function cadastrar($fotoServico)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("INSERT INTO tbFotoServico(idFotoServico, nomeFotoServico, caminhoFotoServico, idServico) VALUES(
            default, ?, ?, ?)");
        $stmt->bindValue(1, $fotoServico->getNomeFotoServico());
        $stmt->bindValue(2, $fotoServico->getCaminhoFotoServico());
        $stmt->bindValue(3, $fotoServico->getServico()->getIdServico());

        $stmt->execute();
    }

    public function exibirFotoServico($id)
    {
        $con = Conexao::conexao();
        $query = "SELECT caminhoFotoServico FROM `tbfotoServico` WHERE idFotoServico = (SELECT MAX(idFotoServico) FROM tbfotoServico WHERE idServico = $id)";

        $resultado = $con->query($query);
        $lista = $resultado->fetchAll();
        foreach ($lista as $linha) {
            $caminhoFoto = $linha[0];
        }
        return $caminhoFoto;
    }
}
