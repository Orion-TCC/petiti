<?php
class Comentario
{
    private $idComentario;
    private $textoComentario;
    private $qtdCurtidaComentario;
    private $Usuario;
    private $Publicacao;


    public function getPublicacao(){
        return $this->Publicacao;
    }

    public function setIdPublicacao($Publicacao){
        $this->Publicacao = $Publicacao;

        return $this;
    }


    public function getUsuario(){
        return $this->Usuario;
    }


    public function setIdUsuario($Usuario){
        $this->Usuario = $Usuario;

        return $this;
    }


    public function getQtdCurtidaComentario(){
        return $this->qtdCurtidaComentario;
    }


    public function setQtdCurtidaComentario($qtdCurtidaComentario){
        $this->qtdCurtidaComentario = $qtdCurtidaComentario;

        return $this;
    }


    public function getTextoComentario(){
        return $this->textoComentario;
    }


    public function setTextoComentario($textoComentario){
        $this->textoComentario = $textoComentario;

        return $this;
    }


    public function getIdComentario(){
        return $this->idComentario;
    }


    public function setIdComentario($idComentario){
        $this->idComentario = $idComentario;

        return $this;
    }
}
