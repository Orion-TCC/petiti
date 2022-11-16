<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');

class DenunciaPublicacao
{
    private $idDenunciaPublicacao;
    private $usuarioDenunciado;
    private $usuarioDenunciador;
    private $Publicacao;
    private $textoDenunciaPublicacao;
    private $dataDenunciaPublicacao;
    private $statusDenunciaPublicacao;


    public function getDataDenunciaPublicacao()
    {
        return $this->dataDenunciaPublicacao;
    }


    public function setDataDenunciaPublicacao($dataDenunciaPublicacao)
    {
        $this->dataDenunciaPublicacao = $dataDenunciaPublicacao;

        return $this;
    }

    public function getTextoDenunciaPublicacao()
    {
        return $this->textoDenunciaPublicacao;
    }


    public function setTextoDenunciaPublicacao($textoDenunciaPublicacao)
    {
        $this->textoDenunciaPublicacao = $textoDenunciaPublicacao;

        return $this;
    }


    public function getPublicacao()
    {
        return $this->Publicacao;
    }


    public function setPublicacao($Publicacao)
    {
        $this->Publicacao = $Publicacao;

        return $this;
    }


    public function getUsuarioDenunciado()
    {
        return $this->usuarioDenunciado;
    }


    public function setUsuarioDenunciado($usuarioDenunciado)
    {
        $this->usuarioDenunciado = $usuarioDenunciado;

        return $this;
    }

    public function getIdDenunciaPublicacao()
    {
        return $this->idDenunciaPublicacao;
    }

    public function setIdDenunciaPublicacao($idDenunciaPublicacao)
    {
        $this->idDenunciaPublicacao = $idDenunciaPublicacao;

        return $this;
    }

    public function getStatusDenunciaPublicacao()
    {
        return $this->statusDenunciaPublicacao;
    }

    public function setStatusDenunciaPublicacao($statusDenunciaPublicacao)
    {
        $this->statusDenunciaPublicacao = $statusDenunciaPublicacao;

        return $this;
    }

    public function getUsuarioDenunciador()
    {
        return $this->usuarioDenunciador;
    }

    public function setUsuarioDenunciador($usuarioDenunciador)
    {
        $this->usuarioDenunciador = $usuarioDenunciador;

        return $this;
    }

    public function cadastrar($denuncia)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare('INSERT INTO tbDenunciaPublicacao(idDenunciaPublicacao, textoDenunciaPublicacao, statusDenunciaPublicacao, idUsuarioDenunciado, idUsuarioDenunciador, idPublicacao)
        VALUES (default, ?, ?, ?, ?, ?)');
        $stmt->bindValue(1, $denuncia->getTextoDenunciaPublicacao());
        $stmt->bindValue(2, $denuncia->getStatusDenunciaPublicacao());
        $stmt->bindValue(3, $denuncia->getUsuarioDenunciado()->getIdUsuario());
        $stmt->bindValue(4, $denuncia->getUsuarioDenunciador());
        $stmt->bindValue(5, $denuncia->getPublicacao()->getIdPublicacao());

        $stmt->execute();

        header("Location: /petiti/feed");
    }

    public function updateDecisao($id, $decisao)
    {
        $con = Conexao::conexao();

        $stmt = $con->prepare("UPDATE `tbdenunciapublicacao`
        SET `textoDenunciapublicacao` = '$decisao'
        WHERE idDenunciapublicacao = $id");

        $stmt->execute();
    }

    public function delete($delete)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("DELETE FROM tbDenunciaPublicacao WHERE idDenunciaPublicacao = ?");
        $stmt->bindValue(1, $delete->getIdDenunciaPublicacao());

        $stmt->execute();
    }

    public function buscaDenunciaPubicacaoAtiva()
    {
        $con = Conexao::conexao();
        $query = "SELECT idDenunciaPublicacao, textoDenunciaPublicacao, statusDenunciaPublicacao,
        DAY(dataDenunciaPublicacao) as dia, MONTHNAME(dataDenunciaPublicacao) as mes, YEAR(dataDenunciaPublicacao) as ano, caminhoFotoPublicacao, pub.textoPublicacao as texto,
        idUsuarioDenunciado as denunciado, idUsuarioDenunciador as denunciador, tbdenunciapublicacao.idPublicacao, innerDenunciado.loginUsuario as usuarioDenunciado,
        innerDenunciador.loginUsuario as usuarioDenunciador
        FROM tbDenunciaPublicacao
        INNER JOIN tbpublicacao pub ON pub.idPublicacao = tbdenunciapublicacao.idPublicacao
        INNER JOIN tbfotopublicacao fotopub ON fotopub.idpublicacao = tbdenunciapublicacao.idpublicacao
        INNER JOIN tbusuario innerDenunciado ON innerDenunciado.idUsuario = tbDenunciaPublicacao.idUsuarioDenunciado
        INNER JOIN tbusuario innerDenunciador ON innerDenunciador.idUsuario = tbDenunciaPublicacao.idUsuarioDenunciador
        WHERE statusDenunciaPublicacao = 0";

        $resultado = $con->query($query);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscaDenunciaPubicacaoEmAnalise()
    {
        $con = Conexao::conexao();
        $query = "SELECT idDenunciaPublicacao, textoDenunciaPublicacao, statusDenunciaPublicacao,
        DAY(dataDenunciaPublicacao) as dia, MONTHNAME(dataDenunciaPublicacao) as mes, YEAR(dataDenunciaPublicacao) as ano, caminhoFotoPublicacao, pub.textoPublicacao as texto,
        idUsuarioDenunciado as denunciado, idUsuarioDenunciador as denunciador, tbdenunciapublicacao.idPublicacao as idPub, innerDenunciado.loginUsuario as usuarioDenunciado,
        innerDenunciador.loginUsuario as usuarioDenunciador
        FROM tbDenunciaPublicacao
        INNER JOIN tbpublicacao pub ON pub.idPublicacao = tbdenunciapublicacao.idPublicacao
        INNER JOIN tbfotopublicacao fotopub ON fotopub.idpublicacao = tbdenunciapublicacao.idpublicacao
        INNER JOIN tbusuario innerDenunciado ON innerDenunciado.idUsuario = tbDenunciaPublicacao.idUsuarioDenunciado
        INNER JOIN tbusuario innerDenunciador ON innerDenunciador.idUsuario = tbDenunciaPublicacao.idUsuarioDenunciador
        WHERE statusDenunciaPublicacao = 1";

        $resultado = $con->query($query);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscaDenunciaPubicacaoResolvida()
    {
        $con = Conexao::conexao();
        $query = "SELECT idDenunciaPublicacao, textoDenunciaPublicacao, statusDenunciaPublicacao,
        DAY(dataDenunciaPublicacao) as dia, MONTHNAME(dataDenunciaPublicacao) as mes, YEAR(dataDenunciaPublicacao) as ano, caminhoFotoPublicacao, pub.textoPublicacao as texto,
        idUsuarioDenunciado as denunciado, idUsuarioDenunciador as denunciador, tbdenunciapublicacao.idPublicacao, innerDenunciado.loginUsuario as usuarioDenunciado,
        innerDenunciador.loginUsuario as usuarioDenunciador
        FROM tbDenunciaPublicacao
        INNER JOIN tbpublicacao pub ON pub.idPublicacao = tbdenunciapublicacao.idPublicacao
        INNER JOIN tbfotopublicacao fotopub ON fotopub.idpublicacao = tbdenunciapublicacao.idpublicacao
        INNER JOIN tbusuario innerDenunciado ON innerDenunciado.idUsuario = tbDenunciaPublicacao.idUsuarioDenunciado
        INNER JOIN tbusuario innerDenunciador ON innerDenunciador.idUsuario = tbDenunciaPublicacao.idUsuarioDenunciador
        WHERE statusDenunciaPublicacao = 2";

        $resultado = $con->query($query);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscaDenunciaPublicacaoApagada()
    {
        $con = Conexao::conexao();

        $query = "SELECT idDenunciaPublicacao, textoDenunciaPublicacao, statusDenunciaPublicacao,
        DAY(dataDenunciaPublicacao) as dia, MONTHNAME(dataDenunciaPublicacao) as mes, YEAR(dataDenunciaPublicacao) as ano,
        idUsuarioDenunciado as denunciado, idUsuarioDenunciador as denunciador, innerDenunciado.loginUsuario as usuarioDenunciado,
        innerDenunciador.loginUsuario as usuarioDenunciador
        FROM tbDenunciaPublicacao
        INNER JOIN tbusuario innerDenunciado ON innerDenunciado.idUsuario = tbDenunciaPublicacao.idUsuarioDenunciado
        INNER JOIN tbusuario innerDenunciador ON innerDenunciador.idUsuario = tbDenunciaPublicacao.idUsuarioDenunciador
        WHERE textoDenunciaPublicacao = 'Publicação excluída'";

        $resoltado = $con->query($query);
        return $resoltado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscaQtdDenunciaPublicacaoAtiva()
    {
        $con = Conexao::conexao();
        $query = "SELECT COUNT(idDenunciaPublicacao) as qtd FROM tbDenunciaPublicacao
        WHERE statusDenunciaPublicacao = 0";

        $resultado = $con->query($query);
        $listaQtdDenuncia = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($listaQtdDenuncia as $linha) {
            return $linha['qtd'];
        }
    }

    public function buscaQtdDenunciaPublicacaoEmAnalise()
    {
        $con = Conexao::conexao();
        $query = "SELECT COUNT(idDenunciaPublicacao) as qtd FROM tbDenunciaPublicacao
        WHERE statusDenunciaPublicacao = 1";

        $resultado = $con->query($query);
        $listaQtdDenuncia = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($listaQtdDenuncia as $linha) {
            return $linha['qtd'];
        }
    }

    public function buscaQtdDenunciaPublicacaoResolvida()
    {
        $con = Conexao::conexao();
        $query = "SELECT COUNT(idDenunciaPublicacao) as qtd FROM tbDenunciaPublicacao
        WHERE statusDenunciaPublicacao = 2";

        $resultado = $con->query($query);
        $listaQtdDenuncia = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($listaQtdDenuncia as $linha) {
            return $linha['qtd'];
        }
    }

    public function updateStatus($update)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("UPDATE tbDenunciaPublicacao SET statusDenunciapublicacao = ? WHERE idDenunciaPublicacao = ?");
        $stmt->bindValue(1, $update->getStatusDenunciaPublicacao());
        $stmt->bindValue(2, $update->getIdDenunciaPublicacao());

        $stmt->execute();
    }
}
