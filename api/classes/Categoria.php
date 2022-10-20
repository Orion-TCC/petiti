<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');
class categoria
{
    private $idCategoria;
    private $categoria;


    public function getCategoria()
    {
        return $this->categoria;
    }


    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }


    public function getIdCategoria()
    {
        return $this->idCategoria;
    }


    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;

        return $this;
    }

    public function cadastrar($categoria){
        $con = Conexao::conexao();
        $stmt = $con->prepare('INSERT INTO tbCategoria(idCategoria, categoria)
        VALUES (default, ?)');
        $stmt->bindValue(1, $categoria->getCategoria());
        $stmt->execute();
        $resultado = $con->query("SELECT MAX(idCategoria) FROM tbCategoria");
        $lista = $resultado->fetchAll();

        foreach ($lista as $linha) {
            $id = $linha[0];
        }
        return $id;
    }

    public function listar(){
        $con = Conexao::conexao();
        $query = "SELECT idCategoria, categoria FROM tbcategoria";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);

        return $lista;
    }

    public function listarCategoriasPopulares(){
        $con = Conexao::conexao();
        $query = "SELECT COUNT(tbcategoriapublicacao.idCategoria), 
        categoria  FROM tbcategoriapublicacao 
        INNER JOIN tbcategoria ON tbcategoriapublicacao.idCategoria = tbcategoria.idCategoria";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);

        return $lista;
    }

    public function verificarCategoria($categoria){
        $con = Conexao::conexao();
        $query = "SELECT COUNT(idCategoria) FROM tbcategoria WHERE categoria = $categoria";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach ($lista as $linha) {
            $qtdCat = $linha[0];
        }
        if ($qtdCat > 0) {
            return false;
        } else {
            return true;
        }
    }

}
