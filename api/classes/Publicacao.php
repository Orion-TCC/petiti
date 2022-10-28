<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');
class Publicacao
{
    private $idPublicacao;
    private $textoPublicacao;
    private $dataPublicacao;
    private $Usuario;
    private $localPub;
    private $impulsoPub;



    public function getUsuario()
    {
        return $this->Usuario;
    }


    public function setUsuario($Usuario)
    {
        $this->Usuario = $Usuario;
    }


    public function getDataPublicacao()
    {
        return $this->dataPublicacao;
    }


    public function setDataPublicacao($dataPublicacao)
    {
        $this->dataPublicacao = $dataPublicacao;
    }


    public function getTextoPublicacao()
    {
        return $this->textoPublicacao;
    }



    public function setTextoPublicacao($textoPublicacao)
    {
        $this->textoPublicacao = $textoPublicacao;
    }


    public function getIdPublicacao()
    {
        return $this->idPublicacao;
    }


    public function setIdPublicacao($idPublicacao)
    {
        $this->idPublicacao = $idPublicacao;
    }

    public function getImpulsoPub()
    {
        return $this->impulsoPub;
    }


    public function setImpulsoPub($impulsoPub)
    {
        $this->impulsoPub = $impulsoPub;
    }

    public function getLocalPub()
    {
        return $this->localPub;
    }


    public function setLocalPub($localPub)
    {
        $this->localPub = $localPub;
    }


    public function cadastrar($publicacao)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare('INSERT INTO tbpublicacao(idPublicacao, textoPublicacao, dataPublicacao, idUsuario, localPub)
        VALUES (default, ?, ?, ?, ?)');
        $stmt->bindValue(1, $publicacao->getTextoPublicacao());
        $stmt->bindValue(2, $publicacao->getDataPublicacao());
        $stmt->bindValue(3, $publicacao->getUsuario()->getIdUsuario());
        $stmt->bindValue(4, $publicacao->getLocalPub());

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
        $query = "SELECT tbpublicacao.idPublicacao as id, itimalias,
       textoPublicacao as texto, dataPublicacao as data, 
       localPub as local,
        tbpublicacao.idUsuario as idUsuario, nomeUsuario as nome, loginUsuario as login,caminhoFotoPublicacao as caminhoFoto, caminhoFoto as fotoUsuario
        FROM tbPublicacao 
        INNER JOIN tbusuario ON tbpublicacao.idUsuario = tbusuario.idUsuario 
        INNER JOIN tbfotopublicacao ON tbpublicacao.idPublicacao = tbfotopublicacao.idPublicacao
        INNER JOIN tbfotousuario ON tbusuario.idUsuario = tbfotousuario.idUsuario";

        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }
    public function listarImpulsao()
    {
        $con = Conexao::conexao();
        $query = "SELECT tbpublicacao.idPublicacao as id, itimalias,
       textoPublicacao as texto, dataPublicacao as data, 
       localPub as local,
        tbpublicacao.idUsuario as idUsuario, nomeUsuario as nome, loginUsuario as login,caminhoFotoPublicacao as caminhoFoto, caminhoFoto as fotoUsuario
        FROM tbPublicacao 
        INNER JOIN tbusuario ON tbpublicacao.idUsuario = tbusuario.idUsuario 
        INNER JOIN tbfotopublicacao ON tbpublicacao.idPublicacao = tbfotopublicacao.idPublicacao
        INNER JOIN tbfotousuario ON tbusuario.idUsuario = tbfotousuario.idUsuario
        WHERE pubImpulso = 1";

        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }
    public function listarPub($id)
    {
        $con = Conexao::conexao();
        $query = "SELECT tbpublicacao.idPublicacao as id, itimalias,
        textoPublicacao as texto, dataPublicacao as data, 
        localPub as local,
        tbpublicacao.idUsuario as idUsuario, nomeUsuario as nome, loginUsuario as login,caminhoFotoPublicacao as caminhoFoto
        FROM tbPublicacao 
        INNER JOIN tbusuario ON tbpublicacao.idUsuario = tbusuario.idUsuario 
        INNER JOIN tbfotopublicacao ON tbpublicacao.idPublicacao = tbfotopublicacao.idPublicacao
        WHERE tbpublicacao.idPublicacao = $id";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }
}
