<?php
Class Cookies{
    public function criarCookie($nome, $msg, $tempo,){
        return setcookie($nome, $msg, time()+$tempo, '/');
    }    
}