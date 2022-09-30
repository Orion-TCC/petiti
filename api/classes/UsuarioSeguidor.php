<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');
class UsuarioSeguidor
{
    private $idUsuarioSeguidor;
    private $idSeguidor;
    private $idUsuario;

    
    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;

        return $this;
    }

    
    public function getIdSeguidor(){
        return $this->idSeguidor;
    }

   
    public function setIdSeguidor($idSeguidor){
        $this->idSeguidor = $idSeguidor;

        return $this;
    }

   
    public function getIdUsuarioSeguidor(){
        return $this->idUsuarioSeguidor;
    }

  
    public function setIdUsuarioSeguidor($idUsuarioSeguidor){
        $this->idUsuarioSeguidor = $idUsuarioSeguidor;

        return $this;
    }
}
?>