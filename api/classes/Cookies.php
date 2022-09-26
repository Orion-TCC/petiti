<?php
Class Cookies{
    public function criarCookie($nome, $msg, $tempo,){
        return setcookie($nome, $msg, time()+$tempo, '/');
    }
    public function deletarCookie($nome){
        return setcookie($nome);
        setcookie($nome, null, -1, '/');
    }
    public function exibirCookie($nome){
        return $_COOKIE["$nome"];
    }
    
}