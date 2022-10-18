<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');
class Publicacao
{
    private $idPublicacao;
    private $textoPublicacao;
    private $dataPublicacao;
    private $Usuario;
    // private $CategoriaPublicacao;


    // public function getCategoriaPublicacao(){
    //     return $this->CategoriaPublicacao;
    // }


    // public function setCategoriaPublicacao($CategoriaPublicacao){
    //     $this->CategoriaPublicacao = $CategoriaPublicacao;

    //     return $this;
    // }


    public function getUsuario()
    {
        return $this->Usuario;
    }


    public function setUsuario($Usuario)
    {
        $this->Usuario = $Usuario;

        return $this;
    }


    public function getDataPublicacao()
    {
        return $this->dataPublicacao;
    }


    public function setDataPublicacao($dataPublicacao)
    {
        $this->dataPublicacao = $dataPublicacao;

        return $this;
    }


    public function getTextoPublicacao()
    {
        return $this->textoPublicacao;
    }



    public function setTextoPublicacao($textoPublicacao)
    {
        $this->textoPublicacao = $textoPublicacao;

        return $this;
    }


    public function getIdPublicacao()
    {
        return $this->idPublicacao;
    }


    public function setIdPublicacao($idPublicacao)
    {
        $this->idPublicacao = $idPublicacao;

        return $this;
    }


    public function cadastrar($publicacao)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare('INSERT INTO tbpublicacao(idPublicacao, textoPublicacao, dataPublicacao, idUsuario)
        VALUES (default, ?, ?, ?)');
        $stmt->bindValue(1, $publicacao->getTextoPublicacao());
        $stmt->bindValue(2, $publicacao->getDataPublicacao());
        $stmt->bindValue(3, $publicacao->getUsuario()->getIdUsuario());
        $stmt->execute();
        $resultado = $con->query("SELECT MAX(idPublicacao) FROM tbpublicacao");
        $lista = $resultado->fetchAll();

        foreach ($lista as $linha) {
            $id = $linha[0];
        }
        return $id;
    }

    public function listar()
    {
        $con = Conexao::conexao();
        $query = "SELECT tbpublicacao.idPublicacao,
        COUNT(idCurtidaPublicacao) as itimalias, 
        tbpublicacao.idPublicacao, textoPublicacao, dataPublicacao, 
        tbpublicacao.idUsuario, nomeUsuario, caminhoFotoPublicacao
        FROM tbPublicacao 
        INNER JOIN tbusuario ON tbpublicacao.idUsuario = tbusuario.idUsuario 
        INNER JOIN tbfotopublicacao ON tbpublicacao.idPublicacao = tbfotopublicacao.idPublicacao 
        INNER JOIN tbcurtidapublicacao ON tbcurtidapublicacao.idPublicacaoCurtida = tbpublicacao.idPublicacao;";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }
    public function listarPub($id){
        $con = Conexao::conexao();
        $query = "SELECT tbpublicacao.idPublicacao,
        COUNT(idCurtidaPublicacao) as itimalias, 
        tbpublicacao.idPublicacao, textoPublicacao, dataPublicacao, 
        tbpublicacao.idUsuario, nomeUsuario, caminhoFotoPublicacao
        FROM tbPublicacao 
        INNER JOIN tbusuario ON tbpublicacao.idUsuario = tbusuario.idUsuario 
        INNER JOIN tbfotopublicacao ON tbpublicacao.idPublicacao = tbfotopublicacao.idPublicacao 
        INNER JOIN tbcurtidapublicacao ON tbcurtidapublicacao.idPublicacaoCurtida = tbpublicacao.idPublicacao
        WHERE tbpublicacao.idPublicacao = $id;";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista; 
    }
}
