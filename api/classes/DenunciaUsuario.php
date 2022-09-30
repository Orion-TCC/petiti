<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');
class DenunciaUsuario
{
    private $idDenunciaUsuario;
    private $Usuario;
    private $UsuarioDenunciado;
    private $textoDenunciaUsuario;
    private $dataDenunciaUsuario;


    public function getDataDenunciaUsuario()
    {
        return $this->dataDenunciaUsuario;
    }


    public function setDataDenunciaUsuario($dataDenunciaUsuario)
    {
        $this->dataDenunciaUsuario = $dataDenunciaUsuario;

        return $this;
    }


    public function gettextoDenunciaUsuario()
    {
        return $this->textoDenunciaUsuario;
    }


    public function settextoDenunciaUsuario($textoDenunciaUsuario)
    {
        $this->textoDenunciaUsuario = $textoDenunciaUsuario;

        return $this;
    }


    public function getUsuarioDenunciado()
    {
        return $this->UsuarioDenunciado;
    }


    public function setUsuarioDenunciado($UsuarioDenunciado)
    {
        $this->UsuarioDenunciado = $UsuarioDenunciado;

        return $this;
    }


    public function getUsuario()
    {
        return $this->Usuario;
    }

    public function setUsuario($Usuario)
    {
        $this->Usuario = $Usuario;

        return $this;
    }


    public function getIdDenunciaUsuario()
    {
        return $this->idDenunciaUsuario;
    }


    public function setIdDenunciaUsuario($idDenunciaUsuario)
    {
        $this->idDenunciaUsuario = $idDenunciaUsuario;

        return $this;
    }
}
