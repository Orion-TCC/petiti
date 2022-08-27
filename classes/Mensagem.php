<?php

class Mensagem
{
    private $idMensagem;
    private $UsuarioOrigem;
    private $UsuarioDestino;
    private $textoMensagem;
    private $dataMensagem;


 
    public function getDataMensagem(){
        return $this->dataMensagem;
    }


    public function setDataMensagem($dataMensagem){
        $this->dataMensagem = $dataMensagem;

        return $this;
    }

 
    public function getTextoMensagem(){
        return $this->textoMensagem;
    }


    public function setTextoMensagem($textoMensagem){
        $this->textoMensagem = $textoMensagem;

        return $this;
    }


    public function getUsuarioDestino(){
        return $this->UsuarioDestino;
    }


    public function setUsuarioDestino($UsuarioDestino){
        $this->UsuarioDestino = $UsuarioDestino;

        return $this;
    }

    public function getUsuarioOrigem(){
        return $this->UsuarioOrigem;
    }



    public function setUsuarioOrigem($UsuarioOrigem){
        $this->UsuarioOrigem = $UsuarioOrigem;

        return $this;
    }


    public function getIdMensagem(){
        return $this->idMensagem;
    }


     
    public function setIdMensagem($idMensagem){
        $this->idMensagem = $idMensagem;

        return $this;
    }
}

?>
