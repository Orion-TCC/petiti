<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');
class DenunciaPublicacao
{
    private $idDenunciaPublicacao;
    private $Usuario;
    private $Publicacao;
    private $textoDenunciaPublicacao;
    private $dataDenunciaPublicacao;


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

 
    public function getUsuario(){
        return $this->Usuario;
    }


    public function setUsuario($Usuario){
        $this->Usuario = $Usuario;

        return $this;
    }

    public function getIdDenunciaPublicacao(){
        return $this->idDenunciaPublicacao;
    }

    public function setIdDenunciaPublicacao($idDenunciaPublicacao){
        $this->idDenunciaPublicacao = $idDenunciaPublicacao;

        return $this;
    }
}
