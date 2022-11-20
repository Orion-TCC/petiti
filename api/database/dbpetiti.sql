-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Nov-2022 às 21:22
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dbpetiti`
--
CREATE DATABASE IF NOT EXISTS `dbpetiti` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dbpetiti`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcategoria`
--

DROP TABLE IF EXISTS `tbcategoria`;
CREATE TABLE IF NOT EXISTS `tbcategoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(200) NOT NULL,
  `statusCategoria` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbcategoria`
--

INSERT INTO `tbcategoria` (`idCategoria`, `categoria`, `statusCategoria`) VALUES
(1, 'Perdido', 1),
(2, 'Animal Perdido', 1),
(3, 'Pet Perdido', 1),
(4, 'Desaparecido', 1),
(53, 'Adoção', 1),
(54, 'Adote um amigo', 1),
(55, 'Animal em adoção', 1),
(56, 'Adotar', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcategoriapublicacao`
--

DROP TABLE IF EXISTS `tbcategoriapublicacao`;
CREATE TABLE IF NOT EXISTS `tbcategoriapublicacao` (
  `idCategoriaPublicacao` int(11) NOT NULL AUTO_INCREMENT,
  `idCategoria` int(11) NOT NULL,
  `idPublicacao` int(11) NOT NULL,
  PRIMARY KEY (`idCategoriaPublicacao`),
  KEY `idCategoria` (`idCategoria`),
  KEY `idPublicacao` (`idPublicacao`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcomentario`
--

DROP TABLE IF EXISTS `tbcomentario`;
CREATE TABLE IF NOT EXISTS `tbcomentario` (
  `idComentario` int(11) NOT NULL AUTO_INCREMENT,
  `textoComentario` varchar(200) NOT NULL,
  `qtdcurtidaComentario` int(11) DEFAULT 0,
  `dataComentario` datetime DEFAULT current_timestamp(),
  `idUsuario` int(11) NOT NULL,
  `idPublicacao` int(11) NOT NULL,
  PRIMARY KEY (`idComentario`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idPublicacao` (`idPublicacao`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcurtidapublicacao`
--

DROP TABLE IF EXISTS `tbcurtidapublicacao`;
CREATE TABLE IF NOT EXISTS `tbcurtidapublicacao` (
  `idCurtidaPublicacao` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuarioCurtida` int(11) NOT NULL,
  `idPublicacaoCurtida` int(11) NOT NULL,
  PRIMARY KEY (`idCurtidaPublicacao`),
  KEY `idUsuarioCurtida` (`idUsuarioCurtida`),
  KEY `idPublicacaoCurtida` (`idPublicacaoCurtida`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

--
-- Acionadores `tbcurtidapublicacao`
--
DROP TRIGGER IF EXISTS `tg_curtir`;
DELIMITER $$
CREATE TRIGGER `tg_curtir` AFTER INSERT ON `tbcurtidapublicacao` FOR EACH ROW BEGIN
	UPDATE tbpublicacao SET itimalias = itimalias + 1 WHERE idPublicacao = NEW.idPublicacaoCurtida;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `tg_descurtir`;
DELIMITER $$
CREATE TRIGGER `tg_descurtir` AFTER DELETE ON `tbcurtidapublicacao` FOR EACH ROW BEGIN
	UPDATE tbpublicacao SET itimalias  = itimalias  - 1
WHERE idPublicacao = OLD.idPublicacaoCurtida;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdenunciacomentario`
--

DROP TABLE IF EXISTS `tbdenunciacomentario`;
CREATE TABLE IF NOT EXISTS `tbdenunciacomentario` (
  `idDenunciaComentario` int(11) NOT NULL AUTO_INCREMENT,
  `textoDenunciaComentario` varchar(200) NOT NULL,
  `dataDenunciaComentario` date NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idComentario` int(11) NOT NULL,
  PRIMARY KEY (`idDenunciaComentario`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idComentario` (`idComentario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdenunciapublicacao`
--

DROP TABLE IF EXISTS `tbdenunciapublicacao`;
CREATE TABLE IF NOT EXISTS `tbdenunciapublicacao` (
  `idDenunciapublicacao` int(11) NOT NULL AUTO_INCREMENT,
  `textoDenunciapublicacao` varchar(200) NOT NULL,
  `statusDenunciapublicacao` int(11) NOT NULL,
  `dataDenunciaPublicacao` datetime DEFAULT current_timestamp(),
  `idUsuarioDenunciado` int(11) NOT NULL,
  `idUsuarioDenunciador` int(11) NOT NULL,
  `idPublicacao` int(11) NOT NULL,
  PRIMARY KEY (`idDenunciapublicacao`),
  KEY `idUsuarioDenunciado` (`idUsuarioDenunciado`),
  KEY `idUsuarioDenunciador` (`idUsuarioDenunciador`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdenunciausuario`
--

DROP TABLE IF EXISTS `tbdenunciausuario`;
CREATE TABLE IF NOT EXISTS `tbdenunciausuario` (
  `idUsuarioPublicacao` int(11) NOT NULL AUTO_INCREMENT,
  `textoDenunciaUsuario` varchar(200) NOT NULL,
  `dataDenunciaPublicacao` date NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idUsuarioDenuncia` int(11) NOT NULL,
  PRIMARY KEY (`idUsuarioPublicacao`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idUsuarioDenuncia` (`idUsuarioDenuncia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbfotopet`
--

DROP TABLE IF EXISTS `tbfotopet`;
CREATE TABLE IF NOT EXISTS `tbfotopet` (
  `idFotoPet` int(11) NOT NULL AUTO_INCREMENT,
  `nomeFotoPet` varchar(200) NOT NULL,
  `caminhoFotoPet` varchar(200) NOT NULL,
  `idPet` int(11) NOT NULL,
  PRIMARY KEY (`idFotoPet`),
  KEY `idPet` (`idPet`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbfotopublicacao`
--

DROP TABLE IF EXISTS `tbfotopublicacao`;
CREATE TABLE IF NOT EXISTS `tbfotopublicacao` (
  `idFotoPublicacao` int(11) NOT NULL AUTO_INCREMENT,
  `caminhoFotoPublicacao` varchar(500) DEFAULT NULL,
  `nomeFotoPublicacao` varchar(200) NOT NULL,
  `idPublicacao` int(11) NOT NULL,
  PRIMARY KEY (`idFotoPublicacao`),
  KEY `idPublicacao` (`idPublicacao`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbfotousuario`
--

DROP TABLE IF EXISTS `tbfotousuario`;
CREATE TABLE IF NOT EXISTS `tbfotousuario` (
  `idFotoUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nomeFoto` varchar(200) NOT NULL,
  `caminhoFoto` varchar(100) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idFotoUsuario`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbmensagem`
--

DROP TABLE IF EXISTS `tbmensagem`;
CREATE TABLE IF NOT EXISTS `tbmensagem` (
  `idMensagem` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuarioOrigem` int(11) NOT NULL,
  `idUsuarioDestino` int(11) NOT NULL,
  `textoMensagem` varchar(2500) NOT NULL,
  `dataMensagem` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idMensagem`),
  KEY `idUsuarioDestino` (`idUsuarioDestino`),
  KEY `idUsuarioOrigem` (`idUsuarioOrigem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbnotificacao`
--

DROP TABLE IF EXISTS `tbnotificacao`;
CREATE TABLE IF NOT EXISTS `tbnotificacao` (
  `idNotificacao` int(11) NOT NULL AUTO_INCREMENT,
  `idCurtidaPublicacao` int(11) DEFAULT NULL,
  `idComentário` int(11) DEFAULT NULL,
  `idUsuarioSeguidor` int(11) DEFAULT NULL,
  `dataNotificacao` datetime DEFAULT current_timestamp(),
  `statusNotificacao` int(11) NOT NULL,
  `idUsuarioNotificado` int(11) NOT NULL,
  `tipoNotificacao` varchar(20) NOT NULL,
  PRIMARY KEY (`idNotificacao`),
  KEY `idCurtidaPublicacao` (`idCurtidaPublicacao`),
  KEY `idComentário` (`idComentário`),
  KEY `idUsuarioSeguidor` (`idUsuarioSeguidor`),
  KEY `idUsuarioNotificado` (`idUsuarioNotificado`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpet`
--

DROP TABLE IF EXISTS `tbpet`;
CREATE TABLE IF NOT EXISTS `tbpet` (
  `idPet` int(11) NOT NULL AUTO_INCREMENT,
  `nomePet` varchar(200) NOT NULL,
  `racaPet` varchar(200) NOT NULL,
  `especiePet` varchar(200) NOT NULL,
  `statusPet` int(11) NOT NULL DEFAULT 1,
  `idadePet` varchar(30) NOT NULL,
  `dataCriacaoPet` datetime NOT NULL DEFAULT current_timestamp(),
  `idUsuario` int(11) NOT NULL,
  `usuarioPet` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idPet`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpetseguidor`
--

DROP TABLE IF EXISTS `tbpetseguidor`;
CREATE TABLE IF NOT EXISTS `tbpetseguidor` (
  `idPetSeguidor` int(11) NOT NULL AUTO_INCREMENT,
  `idPetSeguido` int(11) NOT NULL,
  `idSeguidor` int(11) NOT NULL,
  PRIMARY KEY (`idPetSeguidor`),
  KEY `idPetSeguido` (`idPetSeguido`),
  KEY `idSeguidor` (`idSeguidor`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbproduto`
--

DROP TABLE IF EXISTS `tbproduto`;
CREATE TABLE IF NOT EXISTS `tbproduto` (
  `idProduto` int(11) NOT NULL AUTO_INCREMENT,
  `textoProduto` varchar(100) NOT NULL,
  `descProduto` varchar(150) NOT NULL,
  `valorProduto` double NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idProduto`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpublicacao`
--

DROP TABLE IF EXISTS `tbpublicacao`;
CREATE TABLE IF NOT EXISTS `tbpublicacao` (
  `idPublicacao` int(11) NOT NULL AUTO_INCREMENT,
  `textoPublicacao` varchar(200) NOT NULL,
  `dataPublicacao` datetime NOT NULL,
  `localPub` text DEFAULT NULL,
  `itimalias` int(11) DEFAULT 0,
  `pubImpulso` int(11) NOT NULL DEFAULT 0,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idPublicacao`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbservico`
--

DROP TABLE IF EXISTS `tbservico`;
CREATE TABLE IF NOT EXISTS `tbservico` (
  `idServico` int(11) NOT NULL AUTO_INCREMENT,
  `textoServico` varchar(50) NOT NULL,
  `descServico` varchar(150) NOT NULL,
  `valorServico` double NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idServico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbtipousuario`
--

DROP TABLE IF EXISTS `tbtipousuario`;
CREATE TABLE IF NOT EXISTS `tbtipousuario` (
  `idTipoUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipoUsuario` varchar(100) NOT NULL,
  PRIMARY KEY (`idTipoUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbtipousuario`
--

INSERT INTO `tbtipousuario` (`idTipoUsuario`, `tipoUsuario`) VALUES
(1, 'Tutor'),
(2, 'Pet Shop'),
(3, 'Adm');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuario`
--

DROP TABLE IF EXISTS `tbusuario`;
CREATE TABLE IF NOT EXISTS `tbusuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nomeUsuario` varchar(200) NOT NULL,
  `senhaUsuario` varchar(200) NOT NULL,
  `loginUsuario` varchar(200) NOT NULL,
  `verificadoUsuario` tinyint(1) NOT NULL,
  `emailUsuario` varchar(100) NOT NULL,
  `bioUsuario` text DEFAULT NULL,
  `localizacaoUsuario` text DEFAULT NULL,
  `siteUsuario` text DEFAULT NULL,
  `statusUsuario` int(11) NOT NULL DEFAULT 1,
  `idTipoUsuario` int(11) NOT NULL,
  `dataCriacaoConta` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idUsuario`),
  KEY `tipoUsuario` (`idTipoUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuarioendereco`
--

DROP TABLE IF EXISTS `tbusuarioendereco`;
CREATE TABLE IF NOT EXISTS `tbusuarioendereco` (
  `idUsuarioEndereco` int(11) NOT NULL AUTO_INCREMENT,
  `logradouroUsuario` varchar(200) NOT NULL,
  `numeroEnderecoUsuario` varchar(200) NOT NULL,
  `cepUsuario` char(8) NOT NULL,
  `bairroUsuario` varchar(200) NOT NULL,
  `complementoUsuario` varchar(100) NOT NULL,
  `cidadeUsuario` varchar(200) NOT NULL,
  `estadoUsuario` varchar(50) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idUsuarioEndereco`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuarioseguidor`
--

DROP TABLE IF EXISTS `tbusuarioseguidor`;
CREATE TABLE IF NOT EXISTS `tbusuarioseguidor` (
  `idUsuarioSeguidor` int(11) NOT NULL AUTO_INCREMENT,
  `idSeguidor` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idUsuarioSeguidor`),
  KEY `idSeguidor` (`idSeguidor`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tbcategoriapublicacao`
--
ALTER TABLE `tbcategoriapublicacao`
  ADD CONSTRAINT `tbcategoriapublicacao_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `tbcategoria` (`idCategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbcategoriapublicacao_ibfk_2` FOREIGN KEY (`idPublicacao`) REFERENCES `tbpublicacao` (`idPublicacao`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbcomentario`
--
ALTER TABLE `tbcomentario`
  ADD CONSTRAINT `tbcomentario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbcomentario_ibfk_2` FOREIGN KEY (`idPublicacao`) REFERENCES `tbpublicacao` (`idPublicacao`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbcurtidapublicacao`
--
ALTER TABLE `tbcurtidapublicacao`
  ADD CONSTRAINT `tbcurtidapublicacao_ibfk_1` FOREIGN KEY (`idPublicacaoCurtida`) REFERENCES `tbpublicacao` (`idPublicacao`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbcurtidapublicacao_ibfk_2` FOREIGN KEY (`idUsuarioCurtida`) REFERENCES `tbusuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbdenunciacomentario`
--
ALTER TABLE `tbdenunciacomentario`
  ADD CONSTRAINT `tbdenunciacomentario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbdenunciacomentario_ibfk_2` FOREIGN KEY (`idComentario`) REFERENCES `tbcomentario` (`idComentario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbdenunciapublicacao`
--
ALTER TABLE `tbdenunciapublicacao`
  ADD CONSTRAINT `idUsuarioDenunciado` FOREIGN KEY (`idUsuarioDenunciado`) REFERENCES `tbusuario` (`idUsuario`),
  ADD CONSTRAINT `idUsuarioDenunciador` FOREIGN KEY (`idUsuarioDenunciador`) REFERENCES `tbusuario` (`idUsuario`);

--
-- Limitadores para a tabela `tbdenunciausuario`
--
ALTER TABLE `tbdenunciausuario`
  ADD CONSTRAINT `tbdenunciausuario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbdenunciausuario_ibfk_2` FOREIGN KEY (`idUsuarioDenuncia`) REFERENCES `tbusuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbfotopet`
--
ALTER TABLE `tbfotopet`
  ADD CONSTRAINT `tbfotopet_ibfk_1` FOREIGN KEY (`idPet`) REFERENCES `tbpet` (`idPet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbfotopublicacao`
--
ALTER TABLE `tbfotopublicacao`
  ADD CONSTRAINT `tbfotopublicacao_ibfk_1` FOREIGN KEY (`idPublicacao`) REFERENCES `tbpublicacao` (`idPublicacao`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbfotousuario`
--
ALTER TABLE `tbfotousuario`
  ADD CONSTRAINT `tbfotousuario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbmensagem`
--
ALTER TABLE `tbmensagem`
  ADD CONSTRAINT `tbmensagem_ibfk_1` FOREIGN KEY (`idUsuarioOrigem`) REFERENCES `tbusuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbmensagem_ibfk_2` FOREIGN KEY (`idUsuarioDestino`) REFERENCES `tbusuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbnotificacao`
--
ALTER TABLE `tbnotificacao`
  ADD CONSTRAINT `tbnotificacao_ibfk_1` FOREIGN KEY (`idUsuarioSeguidor`) REFERENCES `tbusuarioseguidor` (`idUsuarioSeguidor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbnotificacao_ibfk_2` FOREIGN KEY (`idComentário`) REFERENCES `tbcomentario` (`idComentario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbnotificacao_ibfk_3` FOREIGN KEY (`idCurtidaPublicacao`) REFERENCES `tbcurtidapublicacao` (`idCurtidaPublicacao`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbnotificacao_ibfk_4` FOREIGN KEY (`idUsuarioNotificado`) REFERENCES `tbusuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbpet`
--
ALTER TABLE `tbpet`
  ADD CONSTRAINT `tbpet_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbpetseguidor`
--
ALTER TABLE `tbpetseguidor`
  ADD CONSTRAINT `tbpetseguidor_ibfk_1` FOREIGN KEY (`idPetSeguido`) REFERENCES `tbpet` (`idPet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbpetseguidor_ibfk_2` FOREIGN KEY (`idSeguidor`) REFERENCES `tbusuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbproduto`
--
ALTER TABLE `tbproduto`
  ADD CONSTRAINT `tbproduto_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbpublicacao`
--
ALTER TABLE `tbpublicacao`
  ADD CONSTRAINT `tbpublicacao_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  ADD CONSTRAINT `tbusuario_ibfk_1` FOREIGN KEY (`idTipoUsuario`) REFERENCES `tbtipousuario` (`idTipoUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbusuarioendereco`
--
ALTER TABLE `tbusuarioendereco`
  ADD CONSTRAINT `tbusuarioendereco_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbusuarioseguidor`
--
ALTER TABLE `tbusuarioseguidor`
  ADD CONSTRAINT `tbusuarioseguidor_ibfk_1` FOREIGN KEY (`idSeguidor`) REFERENCES `tbusuario` (`idUsuario`),
  ADD CONSTRAINT `tbusuarioseguidor_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
