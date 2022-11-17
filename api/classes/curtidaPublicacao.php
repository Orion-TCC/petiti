<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');
require_once('/xampp/htdocs/petiti/api/classes/Notificacao.php');
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
    public function cadastrar($curtidaPublicacao)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("INSERT INTO tbcurtidapublicacao
        (idCurtidaPublicacao, idUsuarioCurtida, idPublicacaoCurtida) 
        VALUES (DEFAULT, ?, ?)");
        $stmt->bindValue(1, $curtidaPublicacao->getUsuarioCurtida()->getIdUsuario());
        $stmt->bindValue(2, $curtidaPublicacao->getPublicacaoCurtida()->getIdPublicacao());
        $stmt->execute();
        $query = "SELECT MAX(tbcurtidapublicacao.idcurtidapublicacao) as id FROM tbcurtidapublicacao";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll();
        foreach ($lista as $linha) {
            $id = $linha['id'];
        }
        $notificacao = new Notificacao();

        $notificacao->notificarCurtida($id);
    }
    public function delete($delete)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("DELETE FROM tbcurtidapublicacao WHERE idCurtidaPublicacao = ?");
        $stmt->bindValue(1, $delete->getIdCurtidaPublicacao());

        $stmt->execute();
    }
    public function verificarCurtida($idPub, $idUsuario){
        $con = Conexao::conexao();
        $query = "SELECT COUNT(idCurtidaPublicacao) as qtd, idCurtidaPublicacao
        FROM tbcurtidapublicacao
        WHERE idPublicacaoCurtida = $idPub
        AND
        idUsuarioCurtida = $idUsuario";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll();
        foreach ($lista as $linha) {
            $qtd = $linha[0];
            $id = $linha[1];
        }
        if ($qtd>0) {
            $array = array("boolean" => false, "id" => "$id");
            return $array;
        } else {
            $array = array("boolean" => true);
            return $array;

        }
        
    }
    public function procurarPub($idCurtidaPub){
        $con = Conexao::conexao();
        $query = "SELECT idPublicacaoCurtida as id
        FROM tbcurtidapublicacao
        WHERE idCurtidaPublicacao = $idCurtidaPub";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll();
        foreach ($lista as $linha) {
           return $linha['id'];
        }
    }

}
