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
    public function cadastrar($comentario){
        $con = Conexao::conexao();
        $stmt = $con->prepare("INSERT INTO tbcomentario 
             (idComentario, textoComentario, idUsuario, idPublicacao)
             VALUES (DEFAULT, ?, ?, ?)");
        $stmt->bindValue(1, $comentario->getTextoComentario());
        $stmt->bindValue(2, $comentario->getUsuario()->getIdUsuario());
        $stmt->bindValue(3, $comentario->getPublicacao()->getIdPublicacao());
        $stmt->execute();

        $resultado = $con->query("SELECT MAX(idComentario) FROM tbcomentario");
        $lista = $resultado->fetchAll();

        foreach ($lista as $linha) {
            $id = $linha[0];
        }
       
        return $id;
    }
    public function listar(){
        $con = Conexao::conexao();
        $query = "SELECT idComentario, 
        textoComentario,
        qtdcurtidaComentario,
        tbusuario.idUsuario FROM tbcomentario
        INNER JOIN tbcomentario ON tbusuario.idusuario = tbcomentario.idusuario";

    $resultado = $con->query($query);
    $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
    }

    public function listarComentarioPublicacao($id)
    {
        $con = Conexao::conexao();
        $query = "SELECT idComentario,
        tbcomentario.idPublicacao,
        nomeUsuario,
        textoComentario,
        qtdcurtidaComentario
        FROM tbcomentario
        INNER JOIN tbpublicacao ON tbpublicacao.idPublicacao = tbcomentario.idPublicacao
        INNER JOIN tbusuario ON tbusuario.idUsuario = tbcomentario.idUsuario
        WHERE tbcomentario.idPublicacao = ". $id;
            
        $resultado = $con->query($query);
        $lista =  $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }
    public function listarComentario($id)
    {
        $con = Conexao::conexao();
        $query = "SELECT idComentario,
        tbcomentario.idPublicacao,
        nomeUsuario,
        textoComentario,
        loginUsuario,
        qtdcurtidaComentario
        FROM tbcomentario
        INNER JOIN tbpublicacao ON tbpublicacao.idPublicacao = tbcomentario.idPublicacao
        INNER JOIN tbusuario ON tbusuario.idUsuario = tbcomentario.idUsuario
        WHERE tbcomentario.idComentario = " . $id;

        $resultado = $con->query($query);
        $lista =  $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }
} 
