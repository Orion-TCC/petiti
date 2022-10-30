<?php

@session_start();

if($_SESSION['tipo'] == "Tutor"){
    header('location: /petiti/tutor-perfil');
}else if($_SESSION['tipo'] == "Pet"){
    header('location: /petiti/pet-perfil');
}else{
    header('location: /petiti/empresa-perfil');
}

?>