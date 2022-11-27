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
    private $tipoPublicacao;

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

    public function getTipoPublicacao()
    {
        return $this->tipoPublicacao;
    }

    public function setTipoPublicacao($tipoPublicacao)
    {
        $this->tipoPublicacao = $tipoPublicacao;

        return $this;
    }

    public function delete($delete)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("DELETE FROM tbpublicacao WHERE idPublicacao = ?");
        $stmt->bindValue(1, $delete->getIdPublicacao());

        $stmt->execute();
    }

    public function cadastrar($publicacao)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare('INSERT INTO tbpublicacao(idPublicacao, textoPublicacao, dataPublicacao, idUsuario, localPub, pubImpulso)
        VALUES (default, ?, ?, ?, ?, ?)');
        $stmt->bindValue(1, $publicacao->getTextoPublicacao());
        $stmt->bindValue(2, $publicacao->getDataPublicacao());
        $stmt->bindValue(3, $publicacao->getUsuario()->getIdUsuario());
        $stmt->bindValue(4, $publicacao->getLocalPub());
        $stmt->bindValue(5, $publicacao->getImpulsoPub());

        $stmt->execute();
        $resultado = $con->query("SELECT MAX(idPublicacao) FROM tbpublicacao");
        $lista = $resultado->fetchAll();

        foreach ($lista as $linha) {
            $id = $linha[0];
        }
        return $id;
    }

    public function listar($id)
    {


        $con = Conexao::conexao();
        $query = "SELECT
    tbpublicacao.idPublicacao AS id,
    itimalias,
    textoPublicacao AS texto,
    dataPublicacao AS data,
    localPub AS local,
    tbpublicacao.idUsuario AS idUsuario,
    nomeUsuario AS nome,
    loginUsuario AS login,
    tbfotousuario.idFotoUsuario,
    caminhoFotoPublicacao AS caminhoFoto,
    caminhoFoto AS fotoUsuario
        FROM
            tbPublicacao
        INNER JOIN tbusuario ON tbpublicacao.idUsuario = tbusuario.idUsuario
        INNER JOIN tbfotopublicacao ON tbpublicacao.idPublicacao = tbfotopublicacao.idPublicacao
        INNER JOIN tbfotousuario ON tbusuario.idUsuario = tbfotousuario.idUsuario
        LEFT JOIN tbusuarioseguidor ON tbusuarioseguidor.idUsuario = tbusuario.idUsuario 

        WHERE
        tbfotousuario.idFotoUsuario =(
            SELECT
                MAX(tbfotousuario.idFotoUsuario)
            FROM
                tbfotousuario
            WHERE
                tbfotousuario.idUsuario = tbpublicacao.idUsuario
        )
        AND
        tbusuarioseguidor.idSeguidor = $id OR tbpublicacao.idUsuario = $id AND
            statusUsuario = 1 
        GROUP BY tbpublicacao.dataPublicacao
        ORDER BY dataPublicacao desc";

        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }


    public function listarPubsPetsPerdidos()
    {
        $con = Conexao::conexao();
        $query = "SELECT
    tbpublicacao.idPublicacao AS id,
    itimalias,
    textoPublicacao AS texto,
    dataPublicacao AS data,
    localPub AS local,
    tbpublicacao.idUsuario AS idUsuario,
    nomeUsuario AS nome,
    loginUsuario AS login,
    caminhoFotoPublicacao AS caminhoFoto,
    categoria
FROM
    `tbpublicacao`
INNER JOIN tbcategoriapublicacao ON tbpublicacao.idPublicacao = tbcategoriapublicacao.idPublicacao
INNER JOIN tbcategoria ON tbcategoriapublicacao.idCategoria = tbcategoria.idCategoria
INNER JOIN tbusuario ON tbpublicacao.idUsuario = tbusuario.idUsuario
INNER JOIN tbfotopublicacao ON tbpublicacao.idPublicacao = tbfotopublicacao.idPublicacao

WHERE
    statusUsuario = 1
AND categoria = 'Perdido' OR categoria = 'Animal Perdido' OR categoria = 'Pet Perdido' OR categoria = 'Desaparecido'
GROUP BY dataPublicacao
ORDER BY dataPublicacao desc";

        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }

    public function listarPubsPetsAdoção()
    {
        $con = Conexao::conexao();
        $query = "SELECT
    tbpublicacao.idPublicacao AS id,
    itimalias,
    textoPublicacao AS texto,
    dataPublicacao AS data,
    localPub AS local,
    tbpublicacao.idUsuario AS idUsuario,
    nomeUsuario AS nome,
    loginUsuario AS login,
    caminhoFotoPublicacao AS caminhoFoto,
    categoria
FROM
    `tbpublicacao`
INNER JOIN tbcategoriapublicacao ON tbpublicacao.idPublicacao = tbcategoriapublicacao.idPublicacao
INNER JOIN tbcategoria ON tbcategoriapublicacao.idCategoria = tbcategoria.idCategoria
INNER JOIN tbusuario ON tbpublicacao.idUsuario = tbusuario.idUsuario
INNER JOIN tbfotopublicacao ON tbpublicacao.idPublicacao = tbfotopublicacao.idPublicacao
WHERE
    statusUsuario = 1
AND categoria = 'Adoção' OR categoria = 'Animal em adoção' OR categoria = 'Adotar' OR categoria = 'Adote um amigo'
GROUP BY dataPublicacao
ORDER BY dataPublicacao desc";

        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }

    public function listarPubsCurtidas($id)
    {
        $con = Conexao::conexao();
        $query = "SELECT  tbpublicacao.idPublicacao as idPub, caminhoFotoPublicacao as caminhoFoto
        FROM tbPublicacao 
        INNER JOIN tbusuario ON tbpublicacao.idUsuario = tbusuario.idUsuario 
        INNER JOIN tbfotopublicacao ON tbpublicacao.idPublicacao = tbfotopublicacao.idPublicacao
        INNER JOIN tbcurtidapublicacao ON tbpublicacao.idPublicacao = tbcurtidapublicacao.idPublicacaoCurtida
        WHERE tbcurtidapublicacao.idUsuarioCurtida = $id AND statusUsuario = 1
        ORDER BY dataPublicacao DESC";
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
        WHERE pubImpulso = 1 AND statusUsuario = 1 AND tbfotousuario.idFotoUsuario =(
    SELECT
        MAX(tbfotousuario.idFotoUsuario)
    FROM
        tbfotousuario
     WHERE
        tbfotousuario.idUsuario = tbpublicacao.idUsuario
) ORDER BY dataPublicacao DESC";

        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }
    public function listarPub($id)
    {
        $con = Conexao::conexao();
        $query = "SELECT tbpublicacao.idPublicacao AS id,
            itimalias,
            textoPublicacao AS texto,
            dataPublicacao AS data,
            localPub AS local,
            tbpublicacao.idUsuario AS idUsuario,
            nomeUsuario AS nome,
            loginUsuario AS login,
            caminhoFotoPublicacao AS caminhoFoto
        FROM
            tbPublicacao
        INNER JOIN tbusuario ON tbpublicacao.idUsuario = tbusuario.idUsuario
        INNER JOIN tbfotopublicacao ON tbpublicacao.idPublicacao = tbfotopublicacao.idPublicacao
        WHERE tbpublicacao.idPublicacao = $id AND statusUsuario = 1";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }
    public function listarPubUsuario($id)
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
        WHERE tbusuario.idUsuario = $id AND statusUsuario = 1  AND tbfotousuario.idFotoUsuario =(
    SELECT
        MAX(tbfotousuario.idFotoUsuario)
    FROM
        tbfotousuario
     WHERE
        tbfotousuario.idUsuario = tbpublicacao.idUsuario
) ORDER BY dataPublicacao DESC";

        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }
}
