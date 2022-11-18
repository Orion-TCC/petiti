<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');
class DenunciaUsuario
{
    private $idDenunciaUsuario;
    private $Usuario;
    private $UsuarioDenunciado;
    private $textoDenunciaUsuario;
    private $dataDenunciaUsuario;


    public function getDataDenunciaUsuario()
    {
        return $this->dataDenunciaUsuario;
    }


    public function setDataDenunciaUsuario($dataDenunciaUsuario)
    {
        $this->dataDenunciaUsuario = $dataDenunciaUsuario;

        return $this;
    }


    public function gettextoDenunciaUsuario()
    {
        return $this->textoDenunciaUsuario;
    }


    public function settextoDenunciaUsuario($textoDenunciaUsuario)
    {
        $this->textoDenunciaUsuario = $textoDenunciaUsuario;

        return $this;
    }


    public function getUsuarioDenunciador()
    {
        return $this->UsuarioDenunciador;
    }


    public function setUsuarioDenunciador($UsuarioDenunciador)
    {
        $this->UsuarioDenunciador = $UsuarioDenunciador;

        return $this;
    }


    public function getUsuarioDenunciado()
    {
        return $this->UsuarioDenunciado;
    }

    public function setUsuarioDenunciado($UsuarioDenunciado)
    {
        $this->UsuarioDenunciado = $UsuarioDenunciado;

        return $this;
    }


    public function getIdDenunciaUsuario()
    {
        return $this->idDenunciaUsuario;
    }


    public function setIdDenunciaUsuario($idDenunciaUsuario)
    {
        $this->idDenunciaUsuario = $idDenunciaUsuario;

        return $this;
    }

    public function getStatusDenunciaUsuario()
    {
        return $this->statusDenunciaUsuario;
    }

    public function setStatusDenunciaUsuario($statusDenunciaUsuario)
    {
        $this->statusDenunciaUsuario = $statusDenunciaUsuario;

        return $this;
    }

    public function cadastrar($denuncia)
    {
        $con = Conexao::conexao();

        $stmt = $con->prepare('INSERT INTO tbDenunciaUsuario(idDenunciaUsuario, textoDenunciaUsuario, statusDenunciaUsuario, idUsuarioDenunciado, idUsuarioDenunciador)
        VALUES (default, ?, ?, ?, ?)
        ');

        $stmt->bindValue(1, $denuncia->gettextoDenunciaUsuario());
        $stmt->bindValue(2, $denuncia->getStatusDenunciaUsuario());
        $stmt->bindValue(3, $denuncia->getUsuarioDenunciado()->getIdUsuario());
        $stmt->bindValue(4, $denuncia->getUsuarioDenunciador());

        $stmt->execute();

        header('Location: /petiti/feed');
    }

    public function updateDecisao($id, $decisao)
    {
        $con = Conexao::conexao();

        $stmt = $con->prepare("UPDATE `tbDenunciaUsuario`
    SET `textoDenunciaUsuario` = '$decisao'
    WHERE idDenunciaUsuario = $id");

        $stmt->execute();
    }

    public function delete($delete)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("DELETE FROM tbDenunciaUsuario WHERE idDenunciaUsuario = ?");
        $stmt->bindValue(1, $delete->getIdDenunciaUsuario());

        $stmt->execute();
    }

    public function buscaDenunciaUsuarioAtiva()
    {
        $con = Conexao::conexao();
        $query = "SELECT idDenunciaUsuario, textoDenunciaUsuario, statusDenunciaUsuario,
        DAY(dataDenunciaUsuario) as dia, MONTHNAME(dataDenunciaUsuario) as mes, YEAR(dataDenunciaUsuario) as ano,
        fotouser.caminhoFoto, idUsuarioDenunciado as denunciado, idUsuarioDenunciador as denunciador, innerDenunciado.loginUsuario as usuarioDenunciado, 
        innerDenunciador.loginUsuario as usuarioDenunciador
        FROM tbDenunciaUsuario
        INNER JOIN tbfotousuario fotouser ON fotouser.idUsuario = tbDenunciaUsuario.idUsuarioDenunciado
        WHERE statusDenunciaUsuario = 0
        ";

        $resultado = $con->query($query);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscaDenunciaUsuarioEmAnalise()
    {
        $con = Conexao::conexao();
        $query = "SELECT idDenunciaUsuario, textoDenunciaUsuario, statusDenunciaUsuario,
        DAY(dataDenunciaUsuario) as dia, MONTHNAME(dataDenunciaUsuario) as mes, YEAR(dataDenunciaUsuario) as ano,
        fotouser.caminhoFoto, idUsuarioDenunciado as denunciado, idUsuarioDenunciador as denunciador, innerDenunciado.loginUsuario as usuarioDenunciado, 
        innerDenunciador.loginUsuario as usuarioDenunciador
        FROM tbDenunciaUsuario
        INNER JOIN tbfotousuario fotouser ON fotouser.idUsuario = tbDenunciaUsuario.idUsuarioDenunciado
        WHERE statusDenunciaUsuario = 1
        ";

        $resultado = $con->query($query);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscaDenunciaUsuarioResolvida()
    {
        $con = Conexao::conexao();
        $query = "SELECT idDenunciaUsuario, textoDenunciaUsuario, statusDenunciaUsuario,
        DAY(dataDenunciaUsuario) as dia, MONTHNAME(dataDenunciaUsuario) as mes, YEAR(dataDenunciaUsuario) as ano,
        fotouser.caminhoFoto, idUsuarioDenunciado as denunciado, idUsuarioDenunciador as denunciador, innerDenunciado.loginUsuario as usuarioDenunciado, 
        innerDenunciador.loginUsuario as usuarioDenunciador
        FROM tbDenunciaUsuario
        INNER JOIN tbfotousuario fotouser ON fotouser.idUsuario = tbDenunciaUsuario.idUsuarioDenunciado
        WHERE statusDenunciaUsuario = 2
        ";

        $resultado = $con->query($query);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscaQtdDenunciaUsuarioAtiva()
    {
        $con = Conexao::conexao();

        $query = "SELECT COUNT(idDenunciaUsuario) as qtd FROM tbDenunciaUsuario
        WHERE statusDenunciaUsuario = 0";

        $resultado = $con->query($query);
        $listaQtdDenuncia = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($listaQtdDenuncia as $linha) {
            return $linha['qtd'];
        }
    }

    public function buscaQtdDenunciaUsuarioEmAnalise()
    {
        $con = Conexao::conexao();

        $query = "SELECT COUNT(idDenunciaUsuario) as qtd FROM tbDenunciaUsuario
        WHERE statusDenunciaUsuario = 1";

        $resultado = $con->query($query);
        $listaQtdDenuncia = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($listaQtdDenuncia as $linha) {
            return $linha['qtd'];
        }
    }

    public function buscaQtdDenunciaUsuarioResolvida()
    {
        $con = Conexao::conexao();

        $query = "SELECT COUNT(idDenunciaUsuario) as qtd FROM tbDenunciaUsuario
        WHERE statusDenunciaUsuario = 2";

        $resultado = $con->query($query);
        $listaQtdDenuncia = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($listaQtdDenuncia as $linha) {
            return $linha['qtd'];
        }
    }

    public function updateStatus($update){
        $con = Conexao::conexao();
        $stmt = $con->prepare("UPDATE tbDenunciaUsuario SET statusDenunciausuario = ?
        WHERE idDenunciaUsuario = ?");
        $stmt->bindValue(1, $update->getStatusDenunciaUsuario());
        $stmt->bindValue(2, $update->getIdDenunciaUsuario());

        $stmt->execute();
    }
}
