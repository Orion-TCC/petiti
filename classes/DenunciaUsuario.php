<?php
class DenunciaUsuario
{
    private $idDenunciaUsuario;
    private $Usuario;
    private $UsuarioDenunciado;
    private $texoDenunciaUsuario;
    private $dataDenunciaUsuario;

  
    public function getDataDenunciaPublicacao(){
        return $this->dataDenunciaPublicacao;
    }

 
    public function setDataDenunciaPublicacao($dataDenunciaPublicacao){
        $this->dataDenunciaPublicacao = $dataDenunciaPublicacao;

        return $this;
    }

 
    public function getTexoDenunciaPublicacao(){
        return $this->texoDenunciaPublicacao;
    }


    public function setTexoDenunciaPublicacao($texoDenunciaPublicacao){
        $this->texoDenunciaPublicacao = $texoDenunciaPublicacao;

        return $this;
    }


    public function getIdUsuarioDenunciado(){
        return $this->idUsuarioDenunciado;
    }


    public function setUsuarioDenunciado($UsuarioDenunciado){
        $this->UsuarioDenunciado = $UsuarioDenunciado;

        return $this;
    }


    public function getUsuario(){
        return $this->Usuario;
    }

    public function setUsuario($Usuario){
        $this->Usuario = $Usuario;

        return $this;
    }

  
    public function getIdDenunciaUsuario(){
        return $this->idDenunciaUsuario;
    }


    public function setIdDenunciaUsuario($idDenunciaUsuario){
        $this->idDenunciaUsuario = $idDenunciaUsuario;

        return $this;
    }
}
