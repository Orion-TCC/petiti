<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');
class PetSeguidor
{
    private $idPetSeguidor;
    private $idSeguidor;
    private $idPetSeguido;

    public function getIdPetSeguidor()
    {
        return $this->idPetSeguidor;
    }

    public function setIdPetSeguidor($idPetSeguidor)
    {
        $this->idPetSeguidor = $idPetSeguidor;

        return $this;
    }

    public function getIdPetSeguido(){
        return $this->idPetSeguido;
    }

    public function setIdPetSeguido($idPetSeguido){
        $this->idPetSeguido = $idPetSeguido;

        return $this;
    }

    
    public function getIdSeguidor(){
        return $this->idSeguidor;
    }

   
    public function setIdSeguidor($idSeguidor){
        $this->idSeguidor = $idSeguidor;

    }



    public function delete($delete)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("DELETE FROM tbpetseguidor
         WHERE idPetSeguidor = ?");
        $stmt->bindValue(1, $delete->getIdPetSeguidor());

        $stmt->execute();
    }

    public function cadastrar($petseguidor)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("INSERT INTO tbpetseguidor
        (idSeguidor, idPetSeguido) 
        VALUES  (?, ?)");
        $stmt->bindValue(1, $petseguidor->getIdSeguidor());
        $stmt->bindValue(2, $petseguidor->getIdPetSeguido());
        $stmt->execute();
    }

    public function verificarSeguidor($idPetSeguido, $idSeguidor){
        $con = Conexao::conexao();
        $query = "SELECT COUNT(idPetSeguidor), idPetSeguidor
        FROM tbpetseguidor
        WHERE idPetSeguido = $idPetSeguido AND idSeguidor = $idSeguidor";
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

    public function pesquisaSeguidores($idPet){
        $con = Conexao::conexao();
        $query = "SELECT tbpetseguidor.idSeguidor, idPetSeguido, innerUsuario.loginUsuario, innerUsuario.nomeUsuario, innerTipoUsuario.tipousuario as tipoUsuario FROM tbpetseguidor
        INNER JOIN tbUsuario innerUsuario ON innerUsuario.idusuario = tbpetseguidor.idSeguidor
        INNER JOIN tbTipoUsuario innertipousuario ON innertipousuario.idTipoUsuario = innerUsuario.idTipoUsuario
        WHERE idPetSeguido = $idPet";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll();
        return $lista;
    }
}
?>