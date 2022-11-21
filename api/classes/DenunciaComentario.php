<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');
class denunciaComentario
{
    private $idDenunciaComentario;
    private $UsuarioDenunciado;
    private $UsuarioDenunciador;
    private $idComentario;
    private $textoDenunciaComentario;
    private $dataDenunciaComentario;
    private $statusDenunciaComentario;


    public function getDataDenunciaComentario()
    {
        return $this->dataDenunciaComentario;
    }


    public function setDataDenunciaComentario($dataDenunciaComentario)
    {
        $this->dataDenunciaComentario = $dataDenunciaComentario;

        return $this;
    }


    public function getTextoDenunciaComentario()
    {
        return $this->textoDenunciaComentario;
    }


    public function setTextoDenunciaComentario($textoDenunciaComentario)
    {
        $this->textoDenunciaComentario = $textoDenunciaComentario;

        return $this;
    }


    public function getIdComentario()
    {
        return $this->idComentario;
    }


    public function setIdComentario($idComentario)
    {
        $this->idComentario = $idComentario;

        return $this;
    }


    public function getUsuarioDenunciado()
    {
        return $this->UsuarioDenunciado;
    }

    public function setUsuario($UsuarioDenunciado)
    {
        $this->UsuarioDenunciado = $UsuarioDenunciado;

        return $this;
    }


    public function getIdDenunciaComentario()
    {
        return $this->idDenunciaComentario;
    }


    public function setIdDenunciaComentario($idDenunciaComentario)
    {
        $this->idDenunciaComentario = $idDenunciaComentario;

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

    public function getStatusDenunciaComentario()
    {
        return $this->statusDenunciaComentario;
    }

    public function setStatusDenunciaComentario($statusDenunciaComentario)
    {
        $this->statusDenunciaComentario = $statusDenunciaComentario;

        return $this;
    }

    public function cadastrar($denuncia)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare('INSERT INTO tbDenunciaComentario(idDenunciaComentario, textoDenunciaComentario, statusDenunciaComentario, idUsuarioDenunciador, idUsuarioDenunciado, idComentario)
        VALUES(default, ?, ?, ?, ?, ?) ');
        $stmt->bindValue(1, $denuncia->getTextoDenunciaComentario());
        $stmt->bindValue(2, $denuncia->getStatusDenunciaComentario());
        $stmt->bindValue(3, $denuncia->getUsuarioDenunciador());
        $stmt->bindValue(4, $denuncia->getUsuarioDenunciado());
        $stmt->bindValue(5, $denuncia->getIdComentario());

        $stmt->execute();

        header("location: /petiti/feed");
    }

    public function updateDecisao($id, $decisao)
    {
        $con = Conexao::conexao();

        $stmt = $con->prepare("UPDATE `tbdenunciacomentario`
        SET `textoDenunciacomentario` = '$decisao'
        WHERE idDenunciacomentario = $id");

        $stmt->execute();
    }

    public function delete($delete)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("DELETE FROM tbDenunciaComentario WHERE idDenunciaComentario = ?");
        $stmt->bindValue(1, $delete->getIdDenunciaComentario());

        $stmt->execute();
    }

    public function buscaDenunciaPubicacaoAtiva()
    {
        $con = Conexao::conexao();
        $query = "SELECT idDenunciaComentario, textoDenunciaComentario, DAY(dataDenunciaComentario) as dia, MONTHNAME(dataDenunciaComentario) as mes, YEAR(dataDenunciaComentario) as ano, statusDenunciaComentario,
        idUsuarioDenunciador, idUsuarioDenunciado, idComentario, innerDenunciado.loginUsuario as usuarioDenunciado, innerDenunciador.loginUsuario as usuarioDenunciador
        innerComentario.textoComentario, innerFotoUsuario.caminhoFoto
        INNER JOIN tbusuario innerDenunciado ON innerDenunciado.idUsuario = tbdenunciacomentario.idUsuarioDenunciado
        INNER JOIN tbusuario innerDenunciador ON innerDenunciador.idUsuario = tbdenunciacomentario.idUsuarioDenunciador
        INNER JOIN tbcomentario innerComentario ON innerComentario.idComentario = tbdenunciacomentario.idComentario
        INNER JOIN tbfotousuario innerFotoUsuario ON innerFotoUsuario.idUsuario = tbdenunciacomentario.idUsuarioDenunciado
        WHERE statusDenunciaComentario = 0";

        $resultado = $con->query($query);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscaDenunciaPubicacaoEmAnalise()
    {
        $con = Conexao::conexao();
        $query = "SELECT idDenunciaComentario, textoDenunciaComentario, DAY(dataDenunciaComentario) as dia, MONTHNAME(dataDenunciaComentario) as mes, YEAR(dataDenunciaComentario) as ano, statusDenunciaComentario,
        idUsuarioDenunciador, idUsuarioDenunciado, idComentario, innerDenunciado.loginUsuario as usuarioDenunciado, innerDenunciador.loginUsuario as usuarioDenunciador
        innerComentario.textoComentario, innerFotoUsuario.caminhoFoto
        INNER JOIN tbusuario innerDenunciado ON innerDenunciado.idUsuario = tbdenunciacomentario.idUsuarioDenunciado
        INNER JOIN tbusuario innerDenunciador ON innerDenunciador.idUsuario = tbdenunciacomentario.idUsuarioDenunciador
        INNER JOIN tbcomentario innerComentario ON innerComentario.idComentario = tbdenunciacomentario.idComentario
        INNER JOIN tbfotousuario innerFotoUsuario ON innerFotoUsuario.idUsuario = tbdenunciacomentario.idUsuarioDenunciado
        WHERE statusDenunciaComentario = 1";

        $resultado = $con->query($query);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscaDenunciaPubicacaoResolvida()
    {
        $con = Conexao::conexao();
        $query = "SELECT idDenunciaComentario, textoDenunciaComentario, DAY(dataDenunciaComentario) as dia, MONTHNAME(dataDenunciaComentario) as mes, YEAR(dataDenunciaComentario) as ano, statusDenunciaComentario,
        idUsuarioDenunciador, idUsuarioDenunciado, idComentario, innerDenunciado.loginUsuario as usuarioDenunciado, innerDenunciador.loginUsuario as usuarioDenunciador
        innerComentario.textoComentario, innerFotoUsuario.caminhoFoto
        INNER JOIN tbusuario innerDenunciado ON innerDenunciado.idUsuario = tbdenunciacomentario.idUsuarioDenunciado
        INNER JOIN tbusuario innerDenunciador ON innerDenunciador.idUsuario = tbdenunciacomentario.idUsuarioDenunciador
        INNER JOIN tbcomentario innerComentario ON innerComentario.idComentario = tbdenunciacomentario.idComentario
        INNER JOIN tbfotousuario innerFotoUsuario ON innerFotoUsuario.idUsuario = tbdenunciacomentario.idUsuarioDenunciado
        WHERE statusDenunciaComentario = 2";

        $resultado = $con->query($query);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscaQtdDenunciaPublicacaoAtiva()
    {
        $con = Conexao::conexao();
        $query = "SELECT COUNT(idDenunciaComentario) as qtd FROM tbdenunciacomentario
        WHERE statusDenunciaUsuario = 0";

        $resultado = $con->query($query);
        $listaQtdDenuncia = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($listaQtdDenuncia as $linha) {
            return $linha['qtd'];
        }
    }

    public function buscaQtdDenunciaPublicacaoEmAnalise()
    {
        $con = Conexao::conexao();
        $query = "SELECT COUNT(idDenunciaComentario) as qtd FROM tbdenunciacomentario
        WHERE statusDenunciaUsuario = 1";

        $resultado = $con->query($query);
        $listaQtdDenuncia = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($listaQtdDenuncia as $linha) {
            return $linha['qtd'];
        }
    }

    public function buscaQtdDenunciaPublicacaoResolvida()
    {
        $con = Conexao::conexao();
        $query = "SELECT COUNT(idDenunciaComentario) as qtd FROM tbdenunciacomentario
        WHERE statusDenunciaUsuario = 2";

        $resultado = $con->query($query);
        $listaQtdDenuncia = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($listaQtdDenuncia as $linha) {
            return $linha['qtd'];
        }
    }

    public function buscaDenunciaPubicacao($idDenunciaComentario)
    {
        $con = Conexao::conexao();
        $query = "SELECT idDenunciaComentario, textoDenunciaComentario, DAY(dataDenunciaComentario) as dia, MONTHNAME(dataDenunciaComentario) as mes, YEAR(dataDenunciaComentario) as ano, statusDenunciaComentario,
        idUsuarioDenunciador, idUsuarioDenunciado, idComentario, innerDenunciado.loginUsuario as usuarioDenunciado, innerDenunciador.loginUsuario as usuarioDenunciador
        innerComentario.textoComentario, innerFotoUsuario.caminhoFoto
        INNER JOIN tbusuario innerDenunciado ON innerDenunciado.idUsuario = tbdenunciacomentario.idUsuarioDenunciado
        INNER JOIN tbusuario innerDenunciador ON innerDenunciador.idUsuario = tbdenunciacomentario.idUsuarioDenunciador
        INNER JOIN tbcomentario innerComentario ON innerComentario.idComentario = tbdenunciacomentario.idComentario
        INNER JOIN tbfotousuario innerFotoUsuario ON innerFotoUsuario.idUsuario = tbdenunciacomentario.idUsuarioDenunciado
        WHERE idDenunciaComentario = $idDenunciaComentario";

        $resultado = $con->query($query);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ultimaDenuncia(){
        $con = Conexao::conexao();

        $query = "SELECT MAX(idDenunciaUsuario) as ultimaDenuncia FROM tbDenunciausuario";

        $resultado = $con->query($query);
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }

    public function updateStatus($update)
    {
        $con = Conexao::conexao();
        $stmt = $con->prepare("UPDATE tbDenunciaUsuario SET statusDenunciaUsuario = ? WHERE idDenunciaUsuario = ?");
        $stmt->bindValue(1, $update->getStatusDenunciaUsuario());
        $stmt->bindValue(2, $update->getIdDenunciaUsuario());

        $stmt->execute();
    }
}
