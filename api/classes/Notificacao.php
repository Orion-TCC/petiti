<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');

class Notificacao
{

    public function listarNotif($id)
    {
        @session_start();

        $con = Conexao::conexao();
        $query = "SELECT
    *
        FROM
            tbnotificacao
        INNER JOIN tbcurtidapublicacao ON tbcurtidapublicacao.idCurtidaPublicacao = tbnotificacao.idCurtidaPublicacao
        WHERE
            idUsuarioNotificado = $id AND tbcurtidapublicacao.idUsuarioCurtida != $id
        UNION
        SELECT
            *
        FROM
            tbnotificacao
        INNER JOIN tbusuarioseguidor ON tbusuarioseguidor.idUsuarioSeguidor = tbnotificacao.idUsuarioSeguidor
        WHERE idUsuarioNotificado = $id AND tbusuarioseguidor.idSeguidor != $id
        ORDER BY dataNotificacao desc;
        ";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }
    public function notificarCurtida($idCurtidaPublicacao){
        $con = Conexao::conexao();
        $query = "SELECT idUsuario as id
        FROM tbcurtidapublicacao 
        INNER JOIN tbpublicacao ON tbcurtidapublicacao.idPublicacaoCurtida = tbpublicacao.idPublicacao
        WHERE tbcurtidapublicacao.idcurtidapublicacao = $idCurtidaPublicacao";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll();
        foreach ($lista as $linha) {
            $id = $linha['id'];
        }
        @session_start();
        $idUsuarioSession = $_SESSION['id'];
        if($id != $idUsuarioSession){
            $query = ("
            INSERT INTO tbnotificacao (idCurtidaPublicacao, idUsuarioNotificado, tipoNotificacao, statusNotificacao)
            VALUES($idCurtidaPublicacao, $id, 'Curtida', 0)");
            $con->query($query);
        }
    }
    public function notificarSeguidor($idUsuarioSeguidor){
        $con = Conexao::conexao();
        $query = "SELECT idUsuario as id
        FROM tbusuarioseguidor 
        WHERE idUsuarioSeguidor = $idUsuarioSeguidor";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll();
        foreach ($lista as $linha) {
            $id = $linha['id'];
        }
        $query = ("
            INSERT INTO tbnotificacao (idUsuarioSeguidor, idUsuarioNotificado, tipoNotificacao, statusNotificacao)
            VALUES($idUsuarioSeguidor, $id, 'Seguir', 0)");
        $con->query($query);
    }

    public function limparNotificacoesNaoVistas($id){
        $con = Conexao::conexao();
        $query = "UPDATE tbnotificacao SET statusNotificacao = 1 WHERE idUsuarioNotificado = $id";
        $con->query($query);
    }
    public function qtdNotificacoesNaoVistas($id){
        $con = Conexao::conexao();
        $query = "SELECT COUNT(idNotificacao) as qtd FROM tbnotificacao WHERE statusNotificacao = 0 and idUsuarioNotificado = $id";
        $con->query($query);
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }
}
