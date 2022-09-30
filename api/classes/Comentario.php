<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');
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

    public function setPublicacao($Publicacao){
        $this->Publicacao = $Publicacao;

        return $this;
    }


    public function getUsuario(){
        return $this->Usuario;
    }


    public function setUsuario($Usuario){
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
    public function listar(){
        $con = Conexao::conexao();
        $query = "SELECT idComentario, 
        textoComentario,
        qtdcurtidaComentario,
        (tbusuario.idUsuario) FROM tbcomentario
        INNER JOIN tbcomentario ON tbusuario.idusuario = tbcomentario.idusuario";

    $resultado = $con->query($query);
    $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
    }

    public function listarComentario($id)
    {
        $con = Conexao::conexao();
        $query = "SELECT idComentario,
        textoComentario,
        qtdcurtidaComentario,
        (tbusuario.idUsuario) FROM tbcomentario
        WHERE idUsuario = $id
        INNER JOIN tbcomentario ON tbusuario.idusuario = tbcomentario.idusuario";

        $resultado = $con->query($query);
        $lista =  $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }
} 
// faz um pra listar os comentarios de uma publicacao especifica, se baseia no listarUsuario da classe usuario. Nele passa um $id no parametro, dá uma olhada
