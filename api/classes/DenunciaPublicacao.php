<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');
class DenunciaPublicacao
{
    private $idDenunciaPublicacao;
    private $usuarioDenunciado;
    private $usuarioDenunciador;
    private $Publicacao;
    private $textoDenunciaPublicacao;
    private $dataDenunciaPublicacao;
    private $statusDenunciaPublicacao;


    public function getDataDenunciaPublicacao(){
        return $this->dataDenunciaPublicacao;
    }

  
    public function setDataDenunciaPublicacao($dataDenunciaPublicacao){
        $this->dataDenunciaPublicacao = $dataDenunciaPublicacao;

        return $this;
    }

    public function getTextoDenunciaPublicacao(){
        return $this->textoDenunciaPublicacao;
    }


    public function setTextoDenunciaPublicacao($textoDenunciaPublicacao){
        $this->textoDenunciaPublicacao = $textoDenunciaPublicacao;

        return $this;
    }

  
    public function getPublicacao(){
        return $this->Publicacao;
    }


    public function setPublicacao($Publicacao){
        $this->Publicacao = $Publicacao;

        return $this;
    }

 
    public function getUsuarioDenunciado(){
        return $this->usuarioDenunciado;
    }


    public function setUsuarioDenunciado($usuarioDenunciado){
        $this->usuarioDenunciado = $usuarioDenunciado;

        return $this;
    }

    public function getIdDenunciaPublicacao(){
        return $this->idDenunciaPublicacao;
    }

    public function setIdDenunciaPublicacao($idDenunciaPublicacao){
        $this->idDenunciaPublicacao = $idDenunciaPublicacao;

        return $this;
    }

    public function getStatusDenunciaPublicacao(){
        return $this->statusDenunciaPublicacao;
    }

    public function setStatusDenunciaPublicacao($statusDenunciaPublicacao){
        $this->statusDenunciaPublicacao = $statusDenunciaPublicacao;

        return $this;
    }

    public function getUsuarioDenunciador(){
        return $this->usuarioDenunciador;
    }

    public function setUsuarioDenunciador($usuarioDenunciador){
        $this->usuarioDenunciador = $usuarioDenunciador;

        return $this;
    }

    public function cadastrar($denuncia){
        $con = Conexao::conexao();
        $stmt = $con->prepare('INSERT INTO tbDenunciaPublicacao(idDenunciaPublicacao, textoDenunciaPublicacao, statusDenunciaPublicacao, idUsuarioDenunciado, idUsuarioDenunciador, idPublicacao)
        VALUES (default, ?, ?, ?, ?, ?)');
        $stmt->bindValue(1, $denuncia->getTextoDenunciaPublicacao());
        $stmt->bindValue(2, $denuncia->getStatusDenunciaPublicacao());
        $stmt->bindValue(3, $denuncia->getUsuarioDenunciado()->getIdUsuario());
        $stmt->bindValue(4, $denuncia->getUsuarioDenunciador());
        $stmt->bindValue(5, $denuncia->getPublicacao()->getIdPublicacao());

        $stmt->execute();

        header("Location: /petiti/feed");
    }
}
