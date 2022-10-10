<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');
class FotoPublicacao
{
    private $idFotoPublicacao;
    private $caminhoFotoPublicacao;
    private $nomeFotoPublicacao;
    private $publicacao;

    public function getPublicacao(){
        return $this->Publicacao;
    }

    public function setPublicacao($Publicacao){
        $this->Publicacao = $Publicacao;

        return $this;
    }

    public function getNomeFotoPublicacao(){
        return $this->nomeFotoPublicacao;
    }

    public function setNomeFotoPublicacao($nomeFotoPublicacao){
        $this->nomeFotoPublicacao = $nomeFotoPublicacao;

        return $this;
    }

    public function getCaminhoFotoPublicacao(){
        return $this->caminhoFotoPublicacao;
    }

    public function setCaminhoFotoPublicacao($caminhoFotoPublicacao){
        $this->caminhoFotoPublicacao = $caminhoFotoPublicacao;

        return $this;
    }

    public function getIdFotoPublicacao(){
        return $this->idFotoPublicacao;
    }

    public function setIdFotoPublicacao($idFotoPublicacao){
        $this->idFotoPublicacao = $idFotoPublicacao;

        return $this;
    }
    public function cadastrar($fotoPublicacao)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("INSERT INTO tbFotoPublicacao VALUES(DEFAULT, ?, ?, ?)");
        $stmt->bindValue(1, $fotoPublicacao->getNomeFotoPublicacao());
        $stmt->bindValue(2, $fotoPublicacao->getCaminhoFotoPublicacao());
        $stmt->bindValue(3, $fotoPublicacao->getPublicacao()->getIdPublicacao());
        $stmt->execute();
    }
}
