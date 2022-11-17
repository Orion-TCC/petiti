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
            FROM tbnotificacao
            INNER JOIN tbcurtidapublicacao ON tbcurtidapublicacao.idCurtidaPublicacao = tbnotificacao.idCurtidaPublicacao
             WHERE idUsuarioNotificado = $id AND tbcurtidapublicacao.idUsuarioCurtida != $id";
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

        $query = ("
            INSERT INTO tbnotificacao (idCurtidaPublicacao, idUsuarioNotificado, tipoNotificacao, statusNotificacao)
            VALUES($idCurtidaPublicacao, $id, 'Curtida', 0)");
        $con->query($query);
    }
}
