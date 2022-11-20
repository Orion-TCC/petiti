<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');

class categoriaSeguida{
    private $idCategoriaSeguida;
    private $idCategoria;
    private $idUsuario;

    public function getIdCategoriaSeguida()
    {
        return $this->idCategoriaSeguida;
    }

    public function setIdCategoriaSeguida($idCategoriaSeguida)
    {
        $this->idCategoriaSeguida = $idCategoriaSeguida;

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

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    public function cadastrar($categoriaSeguida){
        $con = Conexao::conexao();
        $stmt = $con->prepare("INSERT INTO tbCategoriaSeguida
        (idCategoriaSeguida, idUsuario, idCategoria) 
        VALUES (default, ?, ?)");
        $stmt->bindValue(1, $categoriaSeguida->getIdUsuario());
        $stmt->bindValue(2, $categoriaSeguida->getIdCategoria());
        
        $stmt->execute();
    }

    public function delete($delete){
        $con = Conexao::conexao();
        $stmt = $con->prepare("DELETE FROM tbCategoriaSeguida WHERE idCategoriaSeguida = ?");
        $stmt->bindValue(1, $delete->getIdCategoriaSeguida());

        $stmt->execute();
    }

    public function verificarSeguida($idUsuario, $idCategoria){
        $con = Conexao::conexao();
        $query = "SELECT COUNT(idCategoriaSeguida), idCategoriaSeguida FROM tbCategoriaSeguida
        WHERE idUsuario = $idUsuario AND idCategoria = $idCategoria";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll();
        foreach ($lista as $linha) {
            $qtd = $linha[0];
            $id = $linha[1];
        }
        if($qtd>0){
            $array = array("boolean" => false, "id" => "$id");
            return $array;
        }else{
            $array = array("boolean" => true);
            return $array;
        }
    }
}

?>