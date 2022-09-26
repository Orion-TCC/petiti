<?php
require_once('database/conexao.php');
require_once('FotoPet.php');
class Pet
{
    private $idPet;
    private $idUsuario;
    private $nomePet;
    private $especiePet;
    private $racaPet;
    private $idadePet;
    private $usuario;

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getIdPet()
    {
        return $this->idPet;
    }

    public function setIdPet($idPet)
    {
        $this->idPet = $idPet;

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

    public function getNomePet()
    {
        return $this->nomePet;
    }


    public function setNomePet($nomePet)
    {
        $this->nomePet = $nomePet;

        return $this;
    }

    public function getEspeciePet()
    {
        return $this->especiePet;
    }


    public function setEspeciePet($especiePet)
    {
        $this->especiePet = $especiePet;

        return $this;
    }

    public function getRacaPet()
    {
        return $this->racaPet;
    }


    public function setRacaPet($racaPet)
    {
        $this->racaPet = $racaPet;

        return $this;
    }

    public function getIdadePet()
    {
        return $this->idadePet;
    }



    public function setIdadePet($idadePet)
    {
        $this->idadePet = $idadePet;

        return $this;
    }



    public function listar()
    {
        $con = Conexao::conexao();
        $query = "
        SELECT `idPet`,
        `nomePet`,
        `racaPet`,
        `especiePet`,
        `idadePet`,
        `idUsuario` FROM tbpet
        ";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll();
        return $lista;
    }
    public function cadastrar($pet)
    {
        $con = Conexao::conexao();

        $stmt = $con->prepare(
            "
            INSERT INTO `tbpet`(
                `idPet`, `nomePet`,`racaPet`, `especiePet`, 
                `idadePet`, `idUsuario` 
            )VALUES (
                default, ?, ?, ?, ?, ?
                )
            "
        );

        $stmt->bindValue(1, $pet->getNomePet());
        $stmt->bindValue(2, $pet->getRacaPet());
        $stmt->bindValue(3, $pet->getEspeciePet());
        $stmt->bindValue(4, $pet->getIdadePet());
        $stmt->bindValue(5, $pet->getUsuario()->getIdUsuario());



        $stmt->execute();
        $resultado = $con->query("SELECT MAX(idPet) FROM tbpet");
        $lista = $resultado->fetchAll();

        foreach ($lista as $linha) {
            $id = $linha[0];
        }
        $array = array("msg" => "Cadastro de pet realizado com sucesso", "id" => "$id");
        return $array;
    }
    public function update($update)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare(
            "UPDATE `tbpet` 
                SET `nomePet`= ?,
                `racaPet`= ?,`especiePet`= ?,
                `idadePet`= ?,`idUsuario`= ? WHERE idPet = ?"
        );
        $stmt->bindValue(1, $update->getNomePet());
        $stmt->bindValue(2, $update->getRacaPet());
        $stmt->bindValue(3, $update->getEspeciePet());
        $stmt->bindValue(4, $update->getIdadePet());
        $stmt->bindValue(5, $update->getUsuario()->getIdUsuario());
        $stmt->bindValue(6, $update->getIdPet());

        $stmt->execute();
        $array = array("msg" => "Dados do pet atualizados com sucesso", "id" => "$update->getIdPet()");
        return $array;
    }

    public function delete($delete)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("DELETE FROM tbpet WHERE idPet = ?");
        $stmt->bindValue(1, $delete->getIdPet());

        $stmt->execute();
        return $msg = "Pet excluído :c";
    }
}
