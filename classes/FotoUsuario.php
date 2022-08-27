<?php
require_once('/xampp/htdocs/projeto-Petiti/database/conexao.php');

class FotoUsuario
{
        private $idFotoUsuario;
        private $nomeFoto;
        private $caminhoFoto;
        private $usuario;


        public function getIdFotoUsuario()
        {
                return $this->idFotoUsuario;
        }


        public function setIdFotoUsuario($idFotoUsuario)
        {
                $this->idFotoUsuario = $idFotoUsuario;
        }


        public function getNomeFoto()
        {
                return $this->nomeFoto;
        }


        public function setNomeFoto($nomeFoto)
        {
                $this->nomeFoto = $nomeFoto;
        }


        public function getUsuario()
        {
                return $this->usuario;
        }


        public function setUsuario($usuario)
        {
                $this->usuario = $usuario;
        }


        public function getCaminhoFoto()
        {
                return $this->caminhoFoto;
        }


        public function setCaminhoFoto($caminhoFoto)
        {
                $this->caminhoFoto = $caminhoFoto;
        }

        public function cadastrar($fotoUsuario)
        {
                $con = Conexao::conexao();
                $stmt = $con->prepare("INSERT INTO tbfotousuario VALUES(DEFAULT, ?, ?, ?)");
                $stmt->bindValue(1, $fotoUsuario->getNomeFoto());
                $stmt->bindValue(2, $fotoUsuario->getCaminhoFoto());
                $stmt->bindValue(3, $fotoUsuario->getUsuario()->getIdUsuario());



                $stmt->execute();
        }

        public function update($update)
        {
                $con = Conexao::conexao();
                $stmt = $con->prepare("UPDATE tbfotousuario 
                SET nomeFoto = ?, caminhoFoto = ?
                WHERE idfotousuario = ?");

                $stmt->bindValue(1, $update->getNomeFoto());
                $stmt->bindValue(2, $update->getCaminhoFoto());
                $stmt->bindValue(3, $update->getIdFotoUsuario());

                $stmt->execute();
        }



        public function delete($delete)
        {
                $con = Conexao::conexao();
                $stmt = $con->prepare("
                DELETE FROM tbFotoUsuario WHERE idFotoUsuario = ?");
                $stmt->bindValue(1, $delete->getIdFotoUsuario());

                $stmt->execute();
        }

        public function exibirFotoUsuario($id)
        {
                $con = Conexao::conexao();
                $query = "SELECT caminhoFoto FROM `tbfotousuario` 
                WHERE idUsuario = $id AND idFotoUsuario = (SELECT MAX(idFotoUsuario) FROM tbfotousuario WHERE idUsuario = $id)";
                
                $resultado = $con->query($query);
                $lista = $resultado->fetchAll();
                foreach ($lista as $linha) {
                        $caminhoFoto = $linha[0];
                }
                return $caminhoFoto;
        }
}
