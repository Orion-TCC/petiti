<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');
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

    public function listar(){
        $con = Conexao::conexao();
        $query = "SELECT idCategoriaPublicacao, idPublicacao, idCategoria FROM tbcategoriapublicacao";
        $resultado = $con->query($query);
        $listar = $resultado->fetchAll();
        return $resultado;
    }

    public function cadastrar($categoriapublicacao){
        $con = Conexao::conexao();
        $stmt = $con->prepare("INSERT INTO tbcategoriapublicacao (idCategoria, idPublicacao) VALUES ?, ?");
        $stmt->bindValue(1, $categoriapublicacao->getCategoria()->getIdCategoria());
        $stmt->bindValue(2, $categoriapublicacao->getPublicacao()->getIdPublicacao());
        $stmt->execute();
        $resultado = $con->query("SELECT MAX(idCategoriaPublicacao) FROM tbcategoriapublicacao");
        $lista = $resultado->fetchAll();
        foreach ($lista as $linha) {
            $id = $linha[0];
        }
        return $id;
    }

    public function update($update){
        $con = Conexao::conexao();
        $stmt = $con->prepare("UPDATE tbcategoriapublicacao SET idCategoria = ? WHERE idCategoriaPublicacao = ? ");

        $stmt->bindValue(1, $update->getCategoria()->getIdCategoria());
        $stmt->bindValue(2, $update->getIdCategoriaPublicacao());

        $stmt->execute();
    }
    public function delete($delete){
        $con = Conexao::conexao();
        $stmt = $con->prepare("DELETE FROM tbcategoriapublicacao WHERE idCategoriaPublicacao = ?");
        $stmt->bindValue(1, $delete->getIdCategoriaPublicacao());

        $stmt->execute();
    }
}
