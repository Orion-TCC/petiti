<?php
class denunciaComentario
{
    private $idDenunciaComentario;
    private $Usuario;
    private $Comentario;
    private $textoDenunciaComentario;
    private $dataDenunciaComentario;

 
    public function getDataDenunciaComentario(){
        return $this->dataDenunciaComentario;
    }

  
    public function setDataDenunciaComentario($dataDenunciaComentario){
        $this->dataDenunciaComentario = $dataDenunciaComentario;

        return $this;
    }

 
    public function getTextoDenunciaComentario(){
        return $this->textoDenunciaComentario;
    }

   
    public function setTextoDenunciaComentario($textoDenunciaComentario){
        $this->textoDenunciaComentario = $textoDenunciaComentario;

        return $this;
    }

   
    public function getComentario(){
        return $this->Comentario;
    }


    public function setComentario($Comentario){
        $this->Comentario = $Comentario;

        return $this;
    }


    public function getUsuario(){
        return $this->Usuario;
    }

    public function setUsuario($Usuario){
        $this->Usuario = $Usuario;

        return $this;
    }

   
    public function getIdDenunciaComentario(){
        return $this->idDenunciaComentario;
    }

   
    public function setIdDenunciaComentario($idDenunciaComentario){
        $this->idDenunciaComentario = $idDenunciaComentario;

        return $this;
    }
}
?>