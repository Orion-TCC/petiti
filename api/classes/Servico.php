<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');

class Servico{
    private $idServico;
    private $textoServico;
    private $descServico;
    private $valorServico;
    private $statusServico;
    private $usuario;
    

    public function getIdServico()
    {
        return $this->idServico;
    }

    public function setIdServico($idServico)
    {
        $this->idServico = $idServico;

        return $this;
    }

    public function getTextoServico()
    {
        return $this->textoServico;
    }

    public function setTextoServico($textoServico)
    {
        $this->textoServico = $textoServico;

        return $this;
    }

    public function getDescServico()
    {
        return $this->descServico;
    }

    public function setDescServico($descServico)
    {
        $this->descServico = $descServico;

        return $this;
    }

    public function getValorServico()
    {
        return $this->valorServico;
    }

    public function setValorServico($valorServico)
    {
        $this->valorServico = $valorServico;

        return $this;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getStatusServico()
    {
        return $this->statusServico;
    }

    public function setStatusServico($statusServico)
    {
        $this->statusServico = $statusServico;

        return $this;
    }

    public function cadastrar($servico)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("
        INSERT INTO tbServico(idServico, textoServico, descServico, valorServico, statusServico, idUsuario)VALUES(
            default, ?, ?, ?, ?, ?)
        ");
        $stmt->bindValue(1, $servico->getTextoServico());
        $stmt->bindValue(2, $servico->getDescServico());
        $stmt->bindValue(3, $servico->getValorServico());
        $stmt->bindValue(4, $servico->getStatusServico());
        $stmt->bindValue(5, $servico->getUsuario()->getIdUsuario());
        $stmt->execute();
        $resultado = $con->query("SELECT MAX(idservico) as id FROM tbservico");
        $lista = $resultado->fetchAll();

        foreach ($lista as $linha) {
            $id = $linha['id'];
        }
        return $id;
    }

    public function listar(){
        $con = Conexao::conexao();
        $query = "SELECT idServico, textoServico, descServico, valorServico, statusServico, idUsuario FROM tbServico";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);

        return $lista;
    }
}
