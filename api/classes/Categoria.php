<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');
class categoria
{
    private $idCategoria;
    private $categoria;
    private $statusCategoria;


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
    public function getStatusCategoria()
    {
        return $this->statusCategoria;
    }

    public function setStatusCategoria($statusCategoria)
    {
        $this->statusCategoria = $statusCategoria;
    }

    public function cadastrar($categoria)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare('INSERT INTO tbCategoria(idCategoria, categoria)
        VALUES (default, ?)');
        $stmt->bindValue(1, $categoria->getCategoria());
        $stmt->execute();
        $resultado = $con->query("SELECT MAX(idCategoria) as id FROM tbCategoria");
        $lista = $resultado->fetchAll();

        foreach ($lista as $linha) {
            $id = $linha['id'];
        }
        return $id;
    }

    public function listar()
    {
        $con = Conexao::conexao();
        $query = "SELECT idCategoria, categoria FROM tbcategoria";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);

        return $lista;
    }

    public function listarCategoriasPopulares()
    {
        $con = Conexao::conexao();
        $query = "SELECT count(tbcategoriapublicacao.idCategoria) as qtd, categoria FROM tbcategoriapublicacao INNER JOIN tbcategoria ON tbcategoriapublicacao.idCategoria = tbcategoria.idCategoria INNER JOIN tbpublicacao ON tbcategoriapublicacao.idPublicacao = tbpublicacao.idPublicacao WHERE dataPublicacao >= DATE_SUB(CURDATE(),INTERVAL 24 HOUR) AND categoria NOT LIKE '' GROUP BY categoria ORDER BY qtd DESC LIMIT 8";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }

    public function verificarCategoria($categoria)
    {
        $con = Conexao::conexao();
        $query = "SELECT COUNT(idCategoria) as qtd FROM tbcategoria WHERE categoria = '$categoria'";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach ($lista as $linha) {
            $qtdCat = $linha['qtd'];
        }
        if ($qtdCat > 0) {
            return false;
        } else {
            return true;
        }
    }
    public function categoriaPost($idPub)
    {
        $con = Conexao::conexao();
        $query = "SELECT categoria FROM tbcategoria
        INNER JOIN tbcategoriapublicacao t on tbcategoria.idCategoria = t.idCategoria
        INNER JOIN tbpublicacao t2 on t.idPublicacao = t2.idPublicacao
        WHERE t.idPublicacao = $idPub";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }
    public function pesquisarCategoria($categoria)
    {
        $con = Conexao::conexao();
        $query = "SELECT idCategoria as id FROM tbcategoria WHERE categoria = '$categoria'";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach ($lista as $linha) {
            $id = $linha['id'];
        }
        return $id;
    }

    public function buscaCategoriaAtiva()
    {
        $con = Conexao::conexao();
        $query = "SELECT idCategoria, categoria FROM tbcategoria WHERE statusCategoria = 1";
        $resultado = $con->query($query);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscaCategoriaBloqueada()
    {
        $con = Conexao::conexao();
        $query = "SELECT idCategoria, categoria FROM tbcategoria WHERE statusCategoria = 0";
        $resultado = $con->query($query);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscaQtdCategoriaAtiva()
    {
        $con = Conexao::conexao();
        $query = "SELECT COUNT(idCategoria) as qtd FROM tbcategoria WHERE statusCategoria = 1";
        $resultado = $con->query($query);
        $listaCatQtd = $resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach ($listaCatQtd as $linha) {
            return $linha['qtd'];
        }
    }

    public function buscaQtdCategoriaBloqueada()
    {
        $con = Conexao::conexao();
        $query = "SELECT COUNT(idCategoria) as qtd FROM tbcategoria WHERE statusCategoria = 0";
        $resultado = $con->query($query);
        $listaCatQtd = $resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach ($listaCatQtd as $linha) {
            return $linha['qtd'];
        }
    }
    public function updateStatus($update)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("UPDATE tbcategoria SET statusCategoria = ? WHERE idCategoria = ?");
        $stmt->bindValue(1, $update->getStatusCategoria());
        $stmt->bindValue(2, $update->getIdCategoria());

        $stmt->execute();
    }
}
