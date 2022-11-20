<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');
class denunciaComentario
{
    private $idDenunciaComentario;
    private $UsuarioDenunciado;
    private $UsuarioDenunciador;
    private $Comentario;
    private $textoDenunciaComentario;
    private $dataDenunciaComentario;
    private $statusDenunciaComentario;

 
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


    public function getUsuarioDenunciado(){
        return $this->UsuarioDenunciado;
    }

    public function setUsuario($UsuarioDenunciado){
        $this->UsuarioDenunciado = $UsuarioDenunciado;

        return $this;
    }

   
    public function getIdDenunciaComentario(){
        return $this->idDenunciaComentario;
    }

   
    public function setIdDenunciaComentario($idDenunciaComentario){
        $this->idDenunciaComentario = $idDenunciaComentario;

        return $this;
    }

    public function getUsuarioDenunciador()
    {
        return $this->UsuarioDenunciador;
    }

    public function setUsuarioDenunciador($UsuarioDenunciador)
    {
        $this->UsuarioDenunciador = $UsuarioDenunciador;

        return $this;
    }

    public function getStatusDenunciaComentario()
    {
        return $this->statusDenunciaComentario;
    }

    public function setStatusDenunciaComentario($statusDenunciaComentario)
    {
        $this->statusDenunciaComentario = $statusDenunciaComentario;

        return $this;
    }

    public function cadastrar($denuncia){
        $con = Conexao::conexao();
        $stmt = $con->prepare('INSERT INTO tbDenunciaComentario(idDenunciaComentario, textoDenunciaComentario) ');
    }
}
?>