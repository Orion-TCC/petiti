<?php
class curtidaPublicacao
{
    private $idCurtidaPublicacao;
    private $UsuarioCurtida;
    private $PublicacaoCurtida;


    public function getPublicacaoCurtida(){
        return $this->PublicacaoCurtida;
    }


    public function setPublicacaoCurtida($PublicacaoCurtida){
        $this->PublicacaoCurtida = $PublicacaoCurtida;

        return $this;
    }


    public function getUsuarioCurtida(){
        return $this->UsuarioCurtida;
    }


    public function setUsuarioCurtida($UsuarioCurtida){
        $this->UsuarioCurtida = $UsuarioCurtida;

        return $this;
    }


    public function getIdCurtidaPublicacao(){
        return $this->idCurtidaPublicacao;
    }


    public function setIdCurtidaPublicacao($idCurtidaPublicacao){
        $this->idCurtidaPublicacao = $idCurtidaPublicacao;

        return $this;
    }
}
