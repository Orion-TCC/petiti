<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');
class UsuarioSeguidor
{
    private $idUsuarioSeguidor;
    private $idSeguidor;
    private $idUsuarioSeguido;

    public function getIdUsuarioSeguido(){
        return $this->idUsuarioSeguido;
    }

    public function setIdUsuarioSeguido($idUsuarioSeguido){
        $this->idUsuarioSeguido = $idUsuarioSeguido;

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

    public function delete($delete)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("DELETE FROM tbusuarioseguidor
         WHERE idUsuarioseguidor = ?");
        $stmt->bindValue(1, $delete->getIdUsuarioSeguidor());

        $stmt->execute();
    }

    public function cadastrar($usuarioSeguidor)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("INSERT INTO tbusuarioseguidor
        (idUsuarioSeguidor, idSeguidor, idUsuario) 
        VALUES (DEFAULT, ?, ?)");
        $stmt->bindValue(1, $usuarioSeguidor->getIdSeguidor());
        $stmt->bindValue(2, $usuarioSeguidor->getIdUsuarioSeguido());
        $stmt->execute();
    }

    public function verificarSeguidor($idUsuario, $idSeguidor){
        $con = Conexao::conexao();
        $query = "SELECT COUNT(idUsuarioSeguidor), idUsuarioSeguidor
        FROM tbUsuarioSeguidor
        WHERE idUsuario = $idUsuario AND idSeguidor = $idSeguidor";
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