<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');
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
    private $usuarioPet;
    private $statusPet;

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getUsuarioPet()
    {
        return $this->usuarioPet;
    }

    public function setUsuarioPet($usuarioPet)
    {
        $this->usuarioPet = $usuarioPet;

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

    public function getStatusPet()
    {
        return $this->statusPet;
    }

    public function setStatusPet($statusPet)
    {
        $this->statusPet = $statusPet;

        return $this;
    }

    public function listar()
    {
        $con = Conexao::conexao();
        $query = "SELECT tbpet.idPet, nomePet, racaPet, especiePet, idadePet, dataCriacaoPet, usuarioPet,tbusuario.idUsuario, loginUsuario, caminhoFotoPet
                    FROM tbpet
                    INNER JOIN tbfotopet ON tbpet.idPet  = tbfotopet.idPet                    
                    INNER JOIN tbusuario ON tbusuario.idUsuario = tbpet.idUsuario";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }

    public function listarPet($id)
    {
        $con = Conexao::conexao();
        $query = "SELECT tbpet.idPet, nomePet, usuarioPet,racaPet, especiePet, idadePet, dataCriacaoPet, tbusuario.idUsuario, loginUsuario, caminhoFotoPet
                    FROM tbpet
                    INNER JOIN tbfotopet ON tbpet.idPet  = tbfotopet.idPet
                    INNER JOIN tbusuario ON tbusuario.idUsuario = tbpet.idUsuario 
                    WHERE tbpet.idPet = '$id'";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }

    public function cadastrar($pet)
    {
        $con = Conexao::conexao();

        $stmt = $con->prepare(
            "
            INSERT INTO `tbpet`(
                `idPet`, `nomePet`,`racaPet`, `especiePet`, 
                `idadePet`, `idUsuario`, usuarioPet
            )VALUES (
                default, ?, ?, ?, ?, ?, ?
                )
            "
        );

        $stmt->bindValue(1, $pet->getNomePet());
        $stmt->bindValue(2, $pet->getRacaPet());
        $stmt->bindValue(3, $pet->getEspeciePet());
        $stmt->bindValue(4, $pet->getIdadePet());
        $stmt->bindValue(5, $pet->getUsuario()->getIdUsuario());
        $stmt->bindValue(6, $pet->getUsuarioPet());



        $stmt->execute();
        $resultado = $con->query("SELECT MAX(idPet) FROM tbpet");
        $lista = $resultado->fetchAll();

        foreach ($lista as $linha) {
            $id = $linha[0];
        }
        $array = array("msg" => "Cadastro de pet realizado com sucesso", "id" => "$id");
        return $array;
    }
    public function update($id, $campo, $valor)
    {
        $con = Conexao::conexao();

        switch ($campo) {
            case 'nome':
                $stmt = $con->prepare("UPDATE `tbpet` 
                SET `nomePet`= '$valor'
                WHERE idPet = $id");
                $stmt->execute();
                break;
            case 'raca':
                $stmt = $con->prepare("UPDATE `tbpet` 
                    SET `racaPet`= '$valor'
                    WHERE idPet = $id");
                $stmt->execute();
                break;
            case 'idade':
                $stmt = $con->prepare("UPDATE `tbpet` 
                        SET `idadePet`= '$valor'
                        WHERE idPet = $id");
                $stmt->execute();
                break;
        }

        return $msg = "Os dados do Pet foram atualizados.";
    }

    public function delete($delete)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("DELETE FROM tbpet WHERE idPet = ?");
        $stmt->bindValue(1, $delete->getIdPet());

        $stmt->execute();
        return $msg = "Pet excluído :c";
    }

    public function buscaPetAtivo()
    {
        $con = Conexao::conexao();
        $query = "SELECT tbpet.idPet, 
            nomePet,
            racaPet, 
            especiePet,
            statusPet, 
            usuarioPet,
            DAY(dataCriacaoPet) as dia, MONTHNAME(dataCriacaoPet) as mes, YEAR(dataCriacaoPet) as ano,
            idadePet, 
            dataCriacaoPet, 
            tbusuario.idUsuario, 
            loginUsuario,
            caminhoFotoPet
                FROM tbpet
                INNER JOIN tbfotopet ON tbpet.idPet  = tbfotopet.idPet
                INNER JOIN tbusuario ON tbusuario.idUsuario = tbpet.idUsuario
                WHERE statusPet = 1";

        $resultado = $con->query($query);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscaPetBloqueado()
    {
        $con = Conexao::conexao();
        $query = "SELECT tbpet.idPet, 
            nomePet, 
            racaPet, 
            usuarioPet,
            DAY(dataCriacaoPet) as dia, MONTHNAME(dataCriacaoPet) as mes, YEAR(dataCriacaoPet) as ano,
            especiePet, 
            idadePet, 
            dataCriacaoPet, 
            tbusuario.idUsuario, 
            loginUsuario,
            caminhoFotoPet
                FROM tbpet
                INNER JOIN tbfotopet ON tbpet.idPet  = tbfotopet.idPet
                INNER JOIN tbusuario ON tbusuario.idUsuario = tbpet.idUsuario
                WHERE statusPet = 0";

        $resultado = $con->query($query);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscaQtdPetAtivo()
    {
        $con = Conexao::conexao();
        $query = "SELECT COUNT(idPet) as qtd FROM tbPet WHERE statusPet = 1";
        $resultado = $con->query($query);
        $listaPetsQtd = $resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach ($listaPetsQtd as $linha) {
            return $linha['qtd'];
        }
    }
    public function buscaQtdPetBloqueado()
    {
        $con = Conexao::conexao();
        $query = "SELECT COUNT(idPet) as qtd FROM tbPet WHERE statusPet = 0";
        $resultado = $con->query($query);
        $listaPetsQtd = $resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach ($listaPetsQtd as $linha) {
            return $linha['qtd'];
        }
    }

    public function updateStatus($update){
        $con = Conexao::conexao();
        $stmt = $con->prepare("UPDATE tbpet SET statusPet = ? WHERE idPet = ?");
        $stmt->bindValue(1, $update->getStatusPet());
        $stmt->bindValue(2, $update->getIdPet());

        $stmt->execute();
    }
    public function buscaPets($usuarioPet)
    {
        $con = Conexao::conexao();
        $query = "SELECT idPet as id FROM tbPet WHERE usuarioPet = '$usuarioPet'";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach ($lista as $linha) {
            return $linha['id'];
        }
    }
}
