<?php
Class Cookies{
    public function criarCookie($nome, $msg, $tempo,){
        return setcookie($nome, $msg, time()+$tempo, '/');
    }
    public function exibirCookie($nome){
        return $_COOKIE["$nome"];
    }
}