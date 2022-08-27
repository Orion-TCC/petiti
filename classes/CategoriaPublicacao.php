<?php
class categoriaPublicacao
{
    private $idCategoriaPublicacao;
    private $Categoria;
    private $Publicacao;

    public function getPublicacao(){
        return $this->Publicacao;
    }

    public function setPublicacao($Publicacao){
        $this->Publicacao = $Publicacao;

        return $this;
    }



    public function getCategoria(){
        return $this->Categoria;
    }



    public function setCategoria($Categoria){
        $this->Categoria = $Categoria;

        return $this;
    }


    public function getIdCategoriaPublicacao(){
        return $this->idCategoriaPublicacao;
    }


    public function setIdCategoriaPublicacao($idCategoriaPublicacao){
        $this->idCategoriaPublicacao = $idCategoriaPublicacao;

        return $this;
    }
}
