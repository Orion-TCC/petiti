<?php
require_once('/xampp/htdocs/petiti/api/database/conexao.php');
class FotoPet
{
        private $idFotoPet;
        private $nomeFotoPet;
        private $caminhoFotoPet;
        private $pet;


        public function getPet()
        {
                return $this->pet;
        }


        public function setPet($pet)
        {
                $this->pet = $pet;

                return $this;
        }


        public function getCaminhoFotoPet()
        {
                return $this->caminhoFotoPet;
        }

        public function setCaminhoFotoPet($caminhoFotoPet)
        {
                $this->caminhoFotoPet = $caminhoFotoPet;

                return $this;
        }


        public function getNomeFotoPet()
        {
                return $this->nomeFotoPet;
        }


        public function setNomeFotoPet($nomeFotoPet)
        {
                $this->nomeFotoPet = $nomeFotoPet;

                return $this;
        }


        public function getIdFotoPet()
        {
                return $this->idFotoPet;
        }


        public function setIdFotoPet($idFotoPet)
        {
                $this->idFotoPet = $idFotoPet;

                return $this;
        }

        public function cadastrar($fotoPet)
        {

                $con = Conexao::conexao();

                $stmt = $con->prepare("INSERT INTO tbfotopet VALUES(DEFAULT, ?, ?, ?)");

                $stmt->bindValue(1, $fotoPet->getNomeFotoPet());
                $stmt->bindValue(2, $fotoPet->getCaminhoFotoPet());
                $stmt->bindValue(3, $fotoPet->getPet()->getIdPet());
                $stmt->execute();
        }

        public function delete($delete)
        {

                $con = Conexao::conexao();

                $stmt = $con->prepare("DELETE FROM tbfotopet WHERE idFotoPet = ?");
                $stmt->bindValue(1, $delete->getIdFotoPet());
                $id = $delete->getIdFotoPet();
                $infos = $delete->listarInfoFoto($id);
                foreach ($infos as $linhas) {
                        $caminho = $linhas['caminhoFoto'];
                }
                $caminhoDelete = "/xampp/htdocs/petiti/" . $caminho;
                unlink($caminhoDelete);

                $stmt->execute();
        }

        public function update($update)
        {
                $con = Conexao::conexao();
                $stmt = $con->prepare("UPDATE `tbfotopet` 
                SET `nomeFotoPet`= ?,
                `caminhoFotoPet`= ?,
                WHERE idFotoPet = ?");

                $stmt->bindValue(1, $update->getNomeFotoPet());
                $stmt->bindValue(2, $update->getCaminhoFotoPet());
                $stmt->bindValue(3, $update->getIdFotoPet());


                $stmt->execute();
        }
        public function listarInfoFoto($id)
        {
                $con = Conexao::conexao();
                $query = "SELECT nomeFotoPet, caminhoFotoPet from tbfotopet WHERE idFotoPet = $id";
                $resultado = $con->query($query);

                $lista =  $resultado->fetchAll();

                return $lista;
        }
}
