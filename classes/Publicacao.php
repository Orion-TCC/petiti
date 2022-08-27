<?php
class Publicacao
{
    private $idPublicacao;
    private $textoPublicacao;
    private $dataPublicacao;
    private $Usuario;
    private $CategoriaPublicacao;

  
    public function getCategoriaPublicacao(){
        return $this->CategoriaPublicacao;
    }

   
    public function setCategoriaPublicacao($CategoriaPublicacao){
        $this->CategoriaPublicacao = $CategoriaPublicacao;

        return $this;
    }

 
    public function getUsuario(){
        return $this->Usuario;
    }

  
    public function setUsuario($Usuario){
        $this->Usuario = $Usuario;

        return $this;
    }

  
    public function getDataPublicacao(){
        return $this->dataPublicacao;
    }

  
    public function setDataPublicacao($dataPublicacao){
        $this->dataPublicacao = $dataPublicacao;

        return $this;
    }

    
    public function getTextoPublicacao(){
        return $this->textoPublicacao;
    }

    
   
    public function setTextoPublicacao($textoPublicacao){
        $this->textoPublicacao = $textoPublicacao;

        return $this;
    }

  
    public function getIdPublicacao(){
        return $this->idPublicacao;
    }

 
    public function setIdPublicacao($idPublicacao){
        $this->idPublicacao = $idPublicacao;

        return $this;
    }
}
?>