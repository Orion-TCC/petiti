-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Dez-2022 às 04:49
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcategoria`
--

CREATE TABLE `tbcategoria` (
  `idCategoria` int(11) NOT NULL,
  `categoria` varchar(200) NOT NULL,
  `statusCategoria` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbcategoria`
--

INSERT INTO `tbcategoria` (`idCategoria`, `categoria`, `statusCategoria`) VALUES
(1, 'Perdido', 1),
(2, 'Animal Perdido', 1),
(3, 'Pet Perdido', 1),
(4, 'Desaparecido', 1),
(5, 'Adoção', 1),
(6, 'Adote um amigo', 1),
(7, 'Animal em adoção', 1),
(8, 'Adotar', 1),
(68, 'Calopsita', 1),
(69, 'SRD', 1),
(70, 'Salsicha', 1),
(71, 'Calico', 1),
(72, 'Yorkshire', 1),
(73, 'Pastor alemão', 1),
(74, 'gato', 1),
(75, 'gatinho', 1),
(76, 'fofura', 1),
(77, 'amor', 1),
(78, 'fofo', 1),
(79, 'lindo', 1),
(80, 'cachorro', 1),
(81, 'indefinida', 1),
(82, 'Rottweiler', 1),
(83, 'Golden', 1),
(84, 'Tartaruga ', 1),
(85, 'viralata', 1),
(86, '', 1),
(87, 'Branca', 1),
(88, 'Copa', 1),
(89, 'Husky', 1),
(90, 'Engraçado', 1),
(91, 'Pincher', 1),
(92, 'Pelo curto brasileiro', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcategoriapublicacao`
--

CREATE TABLE `tbcategoriapublicacao` (
  `idCategoriaPublicacao` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idPublicacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbcategoriapublicacao`
--

INSERT INTO `tbcategoriapublicacao` (`idCategoriaPublicacao`, `idCategoria`, `idPublicacao`) VALUES
(1, 71, 1),
(2, 74, 1),
(3, 75, 1),
(4, 76, 1),
(5, 77, 1),
(6, 73, 2),
(7, 78, 2),
(8, 79, 2),
(9, 80, 2),
(10, 74, 3),
(11, 75, 3),
(12, 76, 3),
(13, 79, 3),
(14, 78, 3),
(15, 77, 3),
(16, 77, 4),
(17, 78, 4),
(18, 79, 4),
(19, 76, 4),
(20, 74, 4),
(21, 82, 4),
(22, 83, 4),
(23, 80, 4),
(24, 76, 5),
(25, 78, 5),
(26, 77, 5),
(27, 79, 5),
(28, 80, 5),
(29, 8, 6),
(30, 6, 6),
(31, 5, 6),
(32, 78, 6),
(33, 77, 6),
(34, 74, 6),
(35, 75, 6),
(36, 79, 6),
(37, 76, 6),
(38, 85, 6),
(39, 86, 7),
(40, 86, 8),
(41, 1, 9),
(42, 2, 9),
(43, 4, 9),
(44, 3, 9),
(45, 86, 10),
(46, 78, 11),
(47, 79, 11),
(48, 85, 11),
(49, 75, 11),
(50, 74, 11),
(51, 76, 11),
(52, 72, 12),
(53, 76, 12),
(54, 88, 12),
(55, 80, 12),
(56, 86, 13),
(58, 68, 15),
(59, 76, 15),
(60, 90, 15),
(61, 1, 16),
(62, 3, 16),
(63, 4, 16),
(64, 2, 16),
(65, 74, 16),
(66, 79, 17),
(67, 90, 17),
(68, 79, 18),
(69, 90, 18);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcategoriaseguida`
--

CREATE TABLE `tbcategoriaseguida` (
  `idCategoriaSeguida` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbcategoriaseguida`
--

INSERT INTO `tbcategoriaseguida` (`idCategoriaSeguida`, `idUsuario`, `idCategoria`) VALUES
(1, 2, 73),
(2, 2, 78),
(3, 2, 79),
(4, 2, 77),
(5, 2, 74),
(37, 8, 78),
(38, 8, 76),
(43, 20, 76),
(44, 20, 80),
(45, 20, 88),
(46, 20, 72),
(47, 8, 68),
(49, 11, 79),
(51, 11, 75),
(52, 11, 85),
(55, 11, 1),
(56, 11, 2),
(57, 11, 4),
(58, 11, 78),
(59, 11, 77),
(60, 2, 80),
(61, 2, 76);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcomentario`
--

CREATE TABLE `tbcomentario` (
  `idComentario` int(11) NOT NULL,
  `textoComentario` varchar(200) NOT NULL,
  `qtdcurtidaComentario` int(11) DEFAULT 0,
  `dataComentario` datetime NOT NULL DEFAULT current_timestamp(),
  `idUsuario` int(11) NOT NULL,
  `idPublicacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbcomentario`
--

INSERT INTO `tbcomentario` (`idComentario`, `textoComentario`, `qtdcurtidaComentario`, `dataComentario`, `idUsuario`, `idPublicacao`) VALUES
(1, 'awntssss ', 0, '2022-11-30 21:14:20', 10, 1),
(2, 'patinha linda', 0, '2022-11-30 21:26:39', 7, 3),
(3, 'gracinha meu deus\n', 0, '2022-11-30 21:28:55', 6, 1),
(4, 'branquinha deusa', 0, '2022-11-30 21:34:08', 2, 3),
(5, 'Muito lindo, o que estraga é o dono :c', 0, '2022-11-30 21:50:30', 15, 2),
(6, 'LINDO LINDO LINDO \n', 0, '2022-11-30 21:50:59', 10, 2),
(7, 'sabe q eu sou adm ne', 0, '2022-11-30 21:52:45', 2, 2),
(8, 'eu adoto a de delineado', 0, '2022-11-30 21:55:06', 2, 6),
(9, 'ohhh que cara de bravo, lindo!', 0, '2022-11-30 21:55:50', 6, 4),
(10, 'as orelhinhas são um charme', 0, '2022-11-30 21:56:39', 6, 2),
(11, 'me da adm kauan\n', 0, '2022-11-30 21:57:07', 15, 6),
(12, 'o cachorro parece com o dono\n', 0, '2022-11-30 21:57:14', 6, 5),
(13, 'vou te falar oq q eu vou dar', 0, '2022-11-30 22:00:02', 2, 6),
(15, 'fofo\n', 0, '2022-11-30 22:16:33', 17, 1),
(16, 'e essas fotos do google em', 0, '2022-11-30 22:17:22', 10, 9),
(17, 'achei que ela tava de roupa', 0, '2022-11-30 22:26:07', 17, 11),
(18, 'fofinho 🥰\n', 0, '2022-11-30 22:36:03', 20, 10),
(19, 'lindinha 💚💛', 0, '2022-11-30 22:49:58', 20, 12),
(20, 'q feia', 0, '2022-11-30 22:55:13', 2, 12),
(21, 'lindaa', 0, '2022-11-30 23:13:32', 17, 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcurtidapublicacao`
--

CREATE TABLE `tbcurtidapublicacao` (
  `idCurtidaPublicacao` int(11) NOT NULL,
  `idUsuarioCurtida` int(11) NOT NULL,
  `idPublicacaoCurtida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbcurtidapublicacao`
--

INSERT INTO `tbcurtidapublicacao` (`idCurtidaPublicacao`, `idUsuarioCurtida`, `idPublicacaoCurtida`) VALUES
(1, 7, 1),
(2, 2, 2),
(3, 10, 1),
(4, 10, 3),
(5, 7, 3),
(6, 6, 1),
(7, 6, 3),
(8, 12, 3),
(9, 12, 1),
(10, 12, 4),
(11, 14, 4),
(12, 14, 3),
(13, 14, 2),
(14, 14, 1),
(15, 2, 3),
(16, 2, 1),
(17, 15, 2),
(18, 10, 2),
(19, 11, 3),
(20, 10, 6),
(21, 2, 5),
(22, 6, 6),
(23, 2, 6),
(24, 9, 5),
(25, 6, 4),
(26, 15, 6),
(27, 6, 5),
(28, 6, 2),
(29, 6, 7),
(30, 2, 7),
(31, 15, 7),
(32, 10, 7),
(33, 2, 8),
(34, 9, 8),
(35, 11, 7),
(36, 17, 1),
(37, 10, 8),
(38, 10, 9),
(39, 2, 9),
(40, 2, 10),
(41, 2, 11),
(42, 17, 11),
(43, 19, 11),
(44, 19, 9),
(45, 19, 8),
(46, 19, 7),
(47, 19, 6),
(48, 19, 5),
(49, 19, 4),
(50, 19, 3),
(51, 19, 2),
(52, 19, 1),
(53, 20, 10),
(54, 10, 11),
(55, 8, 11),
(56, 20, 12),
(57, 2, 12),
(58, 8, 2),
(60, 11, 11),
(61, 27, 13),
(62, 27, 11),
(63, 27, 7),
(64, 27, 6),
(65, 27, 4),
(66, 27, 3),
(67, 27, 2),
(68, 11, 2),
(69, 17, 13),
(70, 2, 16),
(71, 2, 15),
(72, 11, 13);

--
-- Acionadores `tbcurtidapublicacao`
--
DELIMITER $$
CREATE TRIGGER `tg_curtir` AFTER INSERT ON `tbcurtidapublicacao` FOR EACH ROW BEGIN
	UPDATE tbpublicacao SET itimalias = itimalias + 1 WHERE idPublicacao = NEW.idPublicacaoCurtida;
END
$$
DELIMITER ;
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

CREATE TABLE `tbdenunciacomentario` (
  `idDenunciaComentario` int(11) NOT NULL,
  `textoDenunciaComentario` varchar(200) NOT NULL,
  `dataDenunciaComentario` datetime NOT NULL DEFAULT current_timestamp(),
  `statusDenunciaComentario` int(11) NOT NULL,
  `idUsuarioDenunciador` int(11) NOT NULL,
  `idUsuarioDenunciado` int(11) NOT NULL,
  `idComentario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdenunciapublicacao`
--

CREATE TABLE `tbdenunciapublicacao` (
  `idDenunciapublicacao` int(11) NOT NULL,
  `textoDenunciapublicacao` varchar(200) NOT NULL,
  `statusDenunciapublicacao` int(11) NOT NULL,
  `dataDenunciaPublicacao` datetime DEFAULT current_timestamp(),
  `idUsuarioDenunciado` int(11) NOT NULL,
  `idUsuarioDenunciador` int(11) NOT NULL,
  `idPublicacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbdenunciapublicacao`
--

INSERT INTO `tbdenunciapublicacao` (`idDenunciapublicacao`, `textoDenunciapublicacao`, `statusDenunciapublicacao`, `dataDenunciaPublicacao`, `idUsuarioDenunciado`, `idUsuarioDenunciador`, `idPublicacao`) VALUES
(1, 'É spam. Não colocou nenhuma informação sobre adotar...', 1, '2022-11-30 23:53:45', 10, 8, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdenunciausuario`
--

CREATE TABLE `tbdenunciausuario` (
  `idDenunciaUsuario` int(11) NOT NULL,
  `textoDenunciaUsuario` varchar(200) NOT NULL,
  `statusDenunciaUsuario` int(11) NOT NULL,
  `dataDenunciaUsuario` datetime NOT NULL DEFAULT current_timestamp(),
  `idUsuarioDenunciador` int(11) NOT NULL,
  `idUsuarioDenunciado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbdenunciausuario`
--

INSERT INTO `tbdenunciausuario` (`idDenunciaUsuario`, `textoDenunciaUsuario`, `statusDenunciaUsuario`, `dataDenunciaUsuario`, `idUsuarioDenunciador`, `idUsuarioDenunciado`) VALUES
(1, 'Me seguiu sem permissão', 0, '2022-11-30 21:50:13', 15, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbfotopet`
--

CREATE TABLE `tbfotopet` (
  `idFotoPet` int(11) NOT NULL,
  `nomeFotoPet` varchar(200) NOT NULL,
  `caminhoFotoPet` varchar(200) NOT NULL,
  `idPet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbfotopet`
--

INSERT INTO `tbfotopet` (`idFotoPet`, `nomeFotoPet`, `caminhoFotoPet`, `idPet`) VALUES
(3, '1669852104.png', 'private-user/fotos-pet/1669852104.png', 2),
(4, '1669852478.png', 'private-user/fotos-pet/1669852478.png', 4),
(5, '1669852502.png', 'private-user/fotos-pet/1669852502.png', 5),
(6, '1669852595.png', 'private-user/fotos-pet/1669852595.png', 6),
(7, 'padrao.png', 'private-user/fotos-pet/padrao.png', 7),
(8, '1669852775.png', 'private-user/fotos-pet/1669852775.png', 7),
(9, '1669853535.png', 'private-user/fotos-pet/1669853535.png', 2),
(10, '1669853577.png', 'private-user/fotos-pet/1669853577.png', 8),
(11, '1669854928.png', 'private-user/fotos-pet/1669854928.png', 9),
(12, '1669855001.png', 'private-user/fotos-pet/1669855001.png', 10),
(13, '1669855061.png', 'private-user/fotos-pet/1669855061.png', 11),
(14, '1669855676.png', 'private-user/fotos-pet/1669855676.png', 12),
(15, 'padrao.png', 'private-user/fotos-pet/padrao.png', 13),
(16, '1669855978.png', 'private-user/fotos-pet/1669855978.png', 13),
(18, '1669856923.png', 'private-user/fotos-pet/1669856923.png', 15),
(19, '1669857688.png', 'private-user/fotos-pet/1669857688.png', 16),
(20, '1669858093.png', 'private-user/fotos-pet/1669858093.png', 17),
(21, '1669858426.png', 'private-user/fotos-pet/1669858426.png', 18),
(22, '1669858495.png', 'private-user/fotos-pet/1669858495.png', 19),
(23, '1669858774.png', 'private-user/fotos-pet/1669858774.png', 20),
(24, '1669859084.png', 'private-user/fotos-pet/1669859084.png', 21),
(25, '1669859508.png', 'private-user/fotos-pet/1669859508.png', 22),
(26, '1669860562.png', 'private-user/fotos-pet/1669860562.png', 24),
(27, 'padrao.png', 'private-user/fotos-pet/padrao.png', 25),
(28, '1669865782.png', 'private-user/fotos-pet/1669865782.png', 26),
(29, '1669866062.png', 'private-user/fotos-pet/1669866062.png', 27),
(30, '1669866116.png', 'private-user/fotos-pet/1669866116.png', 28);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbfotoproduto`
--

CREATE TABLE `tbfotoproduto` (
  `idFotoProduto` int(11) NOT NULL,
  `caminhoFotoProduto` varchar(500) NOT NULL,
  `nomeFotoProduto` varchar(200) NOT NULL,
  `idProduto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbfotoproduto`
--

INSERT INTO `tbfotoproduto` (`idFotoProduto`, `caminhoFotoProduto`, `nomeFotoProduto`, `idProduto`) VALUES
(1, 'private-user/fotos-produtos/1669863500.png', '1669863500.png', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbfotopublicacao`
--

CREATE TABLE `tbfotopublicacao` (
  `idFotoPublicacao` int(11) NOT NULL,
  `caminhoFotoPublicacao` varchar(500) DEFAULT NULL,
  `nomeFotoPublicacao` varchar(200) NOT NULL,
  `idPublicacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbfotopublicacao`
--

INSERT INTO `tbfotopublicacao` (`idFotoPublicacao`, `caminhoFotoPublicacao`, `nomeFotoPublicacao`, `idPublicacao`) VALUES
(1, 'private-user/fotos-publicacao/1669853089.png', '1669853089.png', 1),
(2, 'private-user/fotos-publicacao/1669853111.png', '1669853111.png', 2),
(3, 'private-user/fotos-publicacao/1669853975.png', '1669853975.png', 3),
(4, 'private-user/fotos-publicacao/1669855228.png', '1669855228.png', 4),
(5, 'private-user/fotos-publicacao/1669856028.png', '1669856028.png', 5),
(6, 'private-user/fotos-publicacao/1669856029.png', '1669856029.png', 6),
(7, 'private-user/fotos-publicacao/1669856395.png', '1669856395.png', 7),
(8, 'private-user/fotos-publicacao/1669856562.png', '1669856562.png', 8),
(9, 'private-user/fotos-publicacao/1669856840.png', '1669856840.png', 9),
(10, 'private-user/fotos-publicacao/1669857368.png', '1669857368.png', 10),
(11, 'private-user/fotos-publicacao/1669857924.png', '1669857924.png', 11),
(12, 'private-user/fotos-publicacao/1669858746.png', '1669858746.png', 12),
(13, 'private-user/fotos-publicacao/1669859797.png', '1669859797.png', 13),
(15, 'private-user/fotos-publicacao/1669860328.png', '1669860328.png', 15),
(16, 'private-user/fotos-publicacao/1669860813.png', '1669860813.png', 16),
(17, 'private-user/fotos-publicacao/1669863694.png', '1669863694.png', 17),
(18, 'private-user/fotos-publicacao/1669863702.png', '1669863702.png', 18);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbfotoservico`
--

CREATE TABLE `tbfotoservico` (
  `idFotoServico` int(11) NOT NULL,
  `caminhoFotoServico` varchar(500) NOT NULL,
  `nomeFotoServico` varchar(200) NOT NULL,
  `idServico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbfotoservico`
--

INSERT INTO `tbfotoservico` (`idFotoServico`, `caminhoFotoServico`, `nomeFotoServico`, `idServico`) VALUES
(1, 'private-user/fotos-servicos/1669863269.png', '1669863269.png', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbfotousuario`
--

CREATE TABLE `tbfotousuario` (
  `idFotoUsuario` int(11) NOT NULL,
  `nomeFoto` varchar(200) NOT NULL,
  `caminhoFoto` varchar(100) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbfotousuario`
--

INSERT INTO `tbfotousuario` (`idFotoUsuario`, `nomeFoto`, `caminhoFoto`, `idUsuario`) VALUES
(2, '1669851323.png', 'private-user/fotos-perfil/1669851323.png', 2),
(3, '1669851870.png', 'private-user/fotos-perfil/1669851870.png', 6),
(4, '1669852371.png', 'private-user/fotos-perfil/1669852371.png', 7),
(5, '1669852454.png', 'private-user/fotos-perfil/1669852454.png', 8),
(6, '1669852593.png', 'private-user/fotos-perfil/1669852593.png', 7),
(7, 'padrao.png', 'private-user/fotos-perfil/padrao.png', 9),
(8, '1669853501.png', 'private-user/fotos-perfil/1669853501.png', 9),
(9, '1669853522.png', 'private-user/fotos-perfil/1669853522.png', 10),
(10, '1669854555.png', 'private-user/fotos-perfil/1669854555.png', 11),
(11, '1669854746.png', 'private-user/fotos-perfil/1669854746.png', 12),
(12, 'padrao.png', 'private-user/fotos-perfil/padrao.png', 13),
(13, '1669855436.png', 'private-user/fotos-perfil/1669855436.png', 14),
(14, '1669855694.png', 'private-user/fotos-perfil/1669855694.png', 15),
(15, '1669856833.png', 'private-user/fotos-perfil/1669856833.png', 17),
(16, '1669857526.png', 'private-user/fotos-perfil/1669857526.png', 18),
(17, '1669858049.png', 'private-user/fotos-perfil/1669858049.png', 19),
(18, '1669858380.png', 'private-user/fotos-perfil/1669858380.png', 21),
(19, '1669858459.png', 'private-user/fotos-perfil/1669858459.png', 20),
(20, '1669858727.png', 'private-user/fotos-perfil/1669858727.png', 22),
(21, '1669859041.png', 'private-user/fotos-perfil/1669859041.png', 23),
(22, '1669859157.png', 'private-user/fotos-perfil/1669859157.png', 23),
(23, '1669859461.png', 'private-user/fotos-perfil/1669859461.png', 24),
(25, '1669860514.png', 'private-user/fotos-perfil/1669860514.png', 27),
(26, 'padrao.png', 'private-user/fotos-perfil/padrao.png', 28),
(27, '1669865679.png', 'private-user/fotos-perfil/1669865679.png', 29),
(28, '1669865946.png', 'private-user/fotos-perfil/1669865946.png', 30);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbmensagem`
--

CREATE TABLE `tbmensagem` (
  `idMensagem` int(11) NOT NULL,
  `idUsuarioOrigem` int(11) NOT NULL,
  `idUsuarioDestino` int(11) NOT NULL,
  `textoMensagem` varchar(2500) NOT NULL,
  `dataMensagem` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbnotificacao`
--

CREATE TABLE `tbnotificacao` (
  `idNotificacao` int(11) NOT NULL,
  `idCurtidaPublicacao` int(11) DEFAULT NULL,
  `idComentário` int(11) DEFAULT NULL,
  `idUsuarioSeguidor` int(11) DEFAULT NULL,
  `dataNotificacao` datetime DEFAULT current_timestamp(),
  `statusNotificacao` int(11) NOT NULL,
  `idUsuarioNotificado` int(11) NOT NULL,
  `tipoNotificacao` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbnotificacao`
--

INSERT INTO `tbnotificacao` (`idNotificacao`, `idCurtidaPublicacao`, `idComentário`, `idUsuarioSeguidor`, `dataNotificacao`, `statusNotificacao`, `idUsuarioNotificado`, `tipoNotificacao`) VALUES
(1, NULL, NULL, 1, '2022-11-30 21:05:05', 1, 6, 'Seguir'),
(2, NULL, NULL, 2, '2022-11-30 21:05:32', 1, 7, 'Seguir'),
(3, NULL, NULL, 3, '2022-11-30 21:13:47', 1, 6, 'Seguir'),
(4, NULL, NULL, 4, '2022-11-30 21:13:56', 1, 7, 'Seguir'),
(5, 3, NULL, NULL, '2022-11-30 21:14:13', 1, 7, 'Curtida'),
(6, NULL, NULL, 5, '2022-11-30 21:25:46', 1, 10, 'Seguir'),
(7, 5, NULL, NULL, '2022-11-30 21:26:24', 1, 10, 'Curtida'),
(8, 6, NULL, NULL, '2022-11-30 21:28:41', 0, 7, 'Curtida'),
(9, NULL, NULL, 6, '2022-11-30 21:29:53', 1, 6, 'Seguir'),
(10, NULL, NULL, 7, '2022-11-30 21:29:55', 1, 10, 'Seguir'),
(12, NULL, NULL, 9, '2022-11-30 21:30:06', 0, 7, 'Seguir'),
(13, NULL, NULL, 10, '2022-11-30 21:30:07', 1, 11, 'Seguir'),
(14, 7, NULL, NULL, '2022-11-30 21:30:29', 1, 10, 'Curtida'),
(15, NULL, NULL, 11, '2022-11-30 21:30:56', 1, 11, 'Seguir'),
(16, NULL, NULL, 12, '2022-11-30 21:35:00', 1, 10, 'Seguir'),
(17, NULL, NULL, 13, '2022-11-30 21:35:23', 1, 6, 'Seguir'),
(18, NULL, NULL, 14, '2022-11-30 21:35:24', 0, 7, 'Seguir'),
(19, NULL, NULL, 15, '2022-11-30 21:38:19', 0, 7, 'Seguir'),
(20, NULL, NULL, 16, '2022-11-30 21:38:30', 1, 10, 'Seguir'),
(21, NULL, NULL, 17, '2022-11-30 21:38:53', 1, 6, 'Seguir'),
(22, 8, NULL, NULL, '2022-11-30 21:39:07', 1, 10, 'Curtida'),
(23, 9, NULL, NULL, '2022-11-30 21:39:10', 0, 7, 'Curtida'),
(25, NULL, NULL, 19, '2022-11-30 21:48:19', 1, 10, 'Seguir'),
(26, NULL, NULL, 20, '2022-11-30 21:48:38', 0, 7, 'Seguir'),
(27, NULL, NULL, 21, '2022-11-30 21:48:48', 0, 12, 'Seguir'),
(28, NULL, NULL, 22, '2022-11-30 21:49:09', 1, 6, 'Seguir'),
(30, NULL, NULL, 24, '2022-11-30 21:49:19', 1, 2, 'Seguir'),
(32, NULL, NULL, 26, '2022-11-30 21:49:36', 0, 14, 'Seguir'),
(33, 11, NULL, NULL, '2022-11-30 21:49:41', 0, 12, 'Curtida'),
(34, 12, NULL, NULL, '2022-11-30 21:49:44', 1, 10, 'Curtida'),
(35, 13, NULL, NULL, '2022-11-30 21:49:48', 1, 2, 'Curtida'),
(36, NULL, NULL, 27, '2022-11-30 21:49:50', 1, 2, 'Seguir'),
(37, 14, NULL, NULL, '2022-11-30 21:49:50', 0, 7, 'Curtida'),
(38, 15, NULL, NULL, '2022-11-30 21:49:55', 1, 10, 'Curtida'),
(39, 16, NULL, NULL, '2022-11-30 21:49:57', 0, 7, 'Curtida'),
(40, NULL, NULL, 28, '2022-11-30 21:50:20', 1, 2, 'Seguir'),
(41, 17, NULL, NULL, '2022-11-30 21:50:20', 1, 2, 'Curtida'),
(42, NULL, NULL, 29, '2022-11-30 21:50:33', 1, 15, 'Seguir'),
(43, 18, NULL, NULL, '2022-11-30 21:50:48', 1, 2, 'Curtida'),
(44, NULL, NULL, 30, '2022-11-30 21:51:26', 1, 10, 'Seguir'),
(45, 19, NULL, NULL, '2022-11-30 21:53:28', 1, 10, 'Curtida'),
(46, NULL, NULL, 31, '2022-11-30 21:54:15', 0, 14, 'Seguir'),
(47, NULL, NULL, 32, '2022-11-30 21:54:16', 0, 12, 'Seguir'),
(50, 21, NULL, NULL, '2022-11-30 21:54:30', 1, 15, 'Curtida'),
(51, NULL, NULL, 35, '2022-11-30 21:54:31', 1, 9, 'Seguir'),
(52, NULL, NULL, 36, '2022-11-30 21:54:32', 1, 10, 'Seguir'),
(53, 22, NULL, NULL, '2022-11-30 21:54:36', 1, 10, 'Curtida'),
(54, NULL, NULL, 37, '2022-11-30 21:54:46', 0, 14, 'Seguir'),
(55, NULL, NULL, 38, '2022-11-30 21:54:55', 1, 2, 'Seguir'),
(56, 23, NULL, NULL, '2022-11-30 21:54:56', 1, 10, 'Curtida'),
(57, NULL, NULL, 39, '2022-11-30 21:55:11', 0, 12, 'Seguir'),
(58, 24, NULL, NULL, '2022-11-30 21:55:26', 1, 15, 'Curtida'),
(59, 25, NULL, NULL, '2022-11-30 21:55:32', 0, 12, 'Curtida'),
(60, 26, NULL, NULL, '2022-11-30 21:55:36', 1, 10, 'Curtida'),
(61, NULL, NULL, 40, '2022-11-30 21:56:40', 1, 15, 'Seguir'),
(62, NULL, NULL, 41, '2022-11-30 21:56:49', 1, 6, 'Seguir'),
(63, 27, NULL, NULL, '2022-11-30 21:56:56', 1, 15, 'Curtida'),
(64, 28, NULL, NULL, '2022-11-30 21:57:21', 1, 2, 'Curtida'),
(65, NULL, NULL, 42, '2022-11-30 21:57:43', 1, 11, 'Seguir'),
(66, NULL, NULL, 43, '2022-11-30 21:57:50', 1, 11, 'Seguir'),
(67, 30, NULL, NULL, '2022-11-30 22:00:22', 0, 6, 'Curtida'),
(68, 31, NULL, NULL, '2022-11-30 22:01:58', 0, 6, 'Curtida'),
(69, 32, NULL, NULL, '2022-11-30 22:02:21', 0, 6, 'Curtida'),
(70, 33, NULL, NULL, '2022-11-30 22:03:20', 1, 15, 'Curtida'),
(71, 34, NULL, NULL, '2022-11-30 22:05:18', 1, 15, 'Curtida'),
(72, NULL, NULL, 44, '2022-11-30 22:10:52', 1, 11, 'Seguir'),
(73, NULL, NULL, 45, '2022-11-30 22:11:06', 1, 9, 'Seguir'),
(75, NULL, NULL, 47, '2022-11-30 22:14:02', 0, 7, 'Seguir'),
(76, 35, NULL, NULL, '2022-11-30 22:14:24', 0, 6, 'Curtida'),
(77, 36, NULL, NULL, '2022-11-30 22:16:27', 0, 7, 'Curtida'),
(78, 37, NULL, NULL, '2022-11-30 22:17:05', 1, 15, 'Curtida'),
(79, 38, NULL, NULL, '2022-11-30 22:17:09', 1, 15, 'Curtida'),
(82, NULL, NULL, 50, '2022-11-30 22:17:37', 0, 6, 'Seguir'),
(83, 39, NULL, NULL, '2022-11-30 22:19:37', 1, 15, 'Curtida'),
(84, NULL, NULL, 51, '2022-11-30 22:20:02', 1, 17, 'Seguir'),
(85, 40, NULL, NULL, '2022-11-30 22:20:07', 1, 17, 'Curtida'),
(86, NULL, NULL, 52, '2022-11-30 22:21:46', 1, 10, 'Seguir'),
(87, NULL, NULL, 53, '2022-11-30 22:22:02', 0, 7, 'Seguir'),
(88, NULL, NULL, 54, '2022-11-30 22:22:11', 0, 6, 'Seguir'),
(89, NULL, NULL, 55, '2022-11-30 22:22:19', 0, 12, 'Seguir'),
(90, NULL, NULL, 56, '2022-11-30 22:22:43', 1, 2, 'Seguir'),
(91, NULL, NULL, 57, '2022-11-30 22:23:01', 1, 15, 'Seguir'),
(92, NULL, NULL, 58, '2022-11-30 22:23:11', 0, 18, 'Seguir'),
(93, NULL, NULL, 59, '2022-11-30 22:25:47', 1, 2, 'Seguir'),
(94, 42, NULL, NULL, '2022-11-30 22:26:09', 1, 2, 'Curtida'),
(96, NULL, NULL, 61, '2022-11-30 22:28:32', 0, 18, 'Seguir'),
(97, NULL, NULL, 62, '2022-11-30 22:28:42', 1, 10, 'Seguir'),
(98, NULL, NULL, 63, '2022-11-30 22:28:47', 1, 15, 'Seguir'),
(99, NULL, NULL, 64, '2022-11-30 22:28:54', 0, 7, 'Seguir'),
(100, NULL, NULL, 65, '2022-11-30 22:29:00', 0, 6, 'Seguir'),
(101, NULL, NULL, 66, '2022-11-30 22:29:11', 0, 12, 'Seguir'),
(102, NULL, NULL, 67, '2022-11-30 22:29:17', 1, 8, 'Seguir'),
(103, NULL, NULL, 68, '2022-11-30 22:29:31', 1, 2, 'Seguir'),
(104, 43, NULL, NULL, '2022-11-30 22:29:50', 1, 2, 'Curtida'),
(105, 44, NULL, NULL, '2022-11-30 22:29:56', 1, 15, 'Curtida'),
(106, 45, NULL, NULL, '2022-11-30 22:30:01', 1, 15, 'Curtida'),
(107, 46, NULL, NULL, '2022-11-30 22:30:04', 0, 6, 'Curtida'),
(108, 47, NULL, NULL, '2022-11-30 22:30:07', 1, 10, 'Curtida'),
(109, 48, NULL, NULL, '2022-11-30 22:30:13', 1, 15, 'Curtida'),
(110, 49, NULL, NULL, '2022-11-30 22:30:16', 0, 12, 'Curtida'),
(111, 50, NULL, NULL, '2022-11-30 22:30:18', 1, 10, 'Curtida'),
(112, 51, NULL, NULL, '2022-11-30 22:30:22', 1, 2, 'Curtida'),
(113, 52, NULL, NULL, '2022-11-30 22:30:25', 0, 7, 'Curtida'),
(114, NULL, NULL, 69, '2022-11-30 22:30:35', 0, 19, 'Seguir'),
(115, NULL, NULL, 70, '2022-11-30 22:34:03', 1, 10, 'Seguir'),
(116, NULL, NULL, 71, '2022-11-30 22:34:11', 1, 15, 'Seguir'),
(117, NULL, NULL, 72, '2022-11-30 22:34:16', 0, 6, 'Seguir'),
(118, NULL, NULL, 73, '2022-11-30 22:34:21', 0, 7, 'Seguir'),
(119, NULL, NULL, 74, '2022-11-30 22:34:26', 0, 12, 'Seguir'),
(120, NULL, NULL, 75, '2022-11-30 22:34:31', 1, 8, 'Seguir'),
(121, NULL, NULL, 76, '2022-11-30 22:34:45', 0, 14, 'Seguir'),
(122, NULL, NULL, 77, '2022-11-30 22:35:00', 0, 18, 'Seguir'),
(123, NULL, NULL, 78, '2022-11-30 22:35:06', 0, 19, 'Seguir'),
(124, NULL, NULL, 79, '2022-11-30 22:35:26', 1, 17, 'Seguir'),
(125, NULL, NULL, 80, '2022-11-30 22:35:32', 1, 9, 'Seguir'),
(126, 53, NULL, NULL, '2022-11-30 22:35:43', 1, 17, 'Curtida'),
(131, NULL, NULL, 85, '2022-11-30 22:40:02', 0, 19, 'Seguir'),
(132, NULL, NULL, 86, '2022-11-30 22:40:02', 0, 21, 'Seguir'),
(133, NULL, NULL, 87, '2022-11-30 22:40:03', 1, 2, 'Seguir'),
(134, NULL, NULL, 88, '2022-11-30 22:40:05', 1, 10, 'Seguir'),
(135, NULL, NULL, 89, '2022-11-30 22:40:11', 1, 8, 'Seguir'),
(136, NULL, NULL, 90, '2022-11-30 22:40:17', 0, 12, 'Seguir'),
(138, NULL, NULL, 92, '2022-11-30 22:40:26', 0, 6, 'Seguir'),
(139, NULL, NULL, 93, '2022-11-30 22:40:34', 1, 2, 'Seguir'),
(140, NULL, NULL, 94, '2022-11-30 22:40:34', 0, 7, 'Seguir'),
(141, NULL, NULL, 95, '2022-11-30 22:40:41', 0, 19, 'Seguir'),
(142, NULL, NULL, 96, '2022-11-30 22:40:46', 0, 18, 'Seguir'),
(143, NULL, NULL, 97, '2022-11-30 22:40:53', 0, 7, 'Seguir'),
(144, NULL, NULL, 98, '2022-11-30 22:40:58', 0, 14, 'Seguir'),
(145, NULL, NULL, 99, '2022-11-30 22:41:08', 0, 21, 'Seguir'),
(146, NULL, NULL, 100, '2022-11-30 22:41:13', 1, 17, 'Seguir'),
(147, NULL, NULL, 101, '2022-11-30 22:41:23', 1, 20, 'Seguir'),
(148, 54, NULL, NULL, '2022-11-30 22:41:44', 1, 2, 'Curtida'),
(149, NULL, NULL, 102, '2022-11-30 22:41:49', 1, 20, 'Seguir'),
(150, NULL, NULL, 103, '2022-11-30 22:41:56', 1, 8, 'Seguir'),
(151, NULL, NULL, 104, '2022-11-30 22:42:05', 0, 19, 'Seguir'),
(152, NULL, NULL, 105, '2022-11-30 22:42:12', 0, 18, 'Seguir'),
(153, NULL, NULL, 106, '2022-11-30 22:42:18', 0, 22, 'Seguir'),
(154, NULL, NULL, 107, '2022-11-30 22:42:22', 0, 21, 'Seguir'),
(155, NULL, NULL, 108, '2022-11-30 22:42:28', 1, 17, 'Seguir'),
(156, NULL, NULL, 109, '2022-11-30 22:44:19', 0, 22, 'Seguir'),
(157, NULL, NULL, 110, '2022-11-30 22:44:20', 1, 10, 'Seguir'),
(158, 55, NULL, NULL, '2022-11-30 22:44:55', 1, 2, 'Curtida'),
(159, NULL, NULL, 111, '2022-11-30 22:46:10', 1, 10, 'Seguir'),
(160, NULL, NULL, 112, '2022-11-30 22:46:25', 1, 10, 'Seguir'),
(161, NULL, NULL, 113, '2022-11-30 22:46:30', 0, 22, 'Seguir'),
(162, NULL, NULL, 114, '2022-11-30 22:46:31', 0, 7, 'Seguir'),
(163, NULL, NULL, 115, '2022-11-30 22:46:34', 1, 2, 'Seguir'),
(164, NULL, NULL, 116, '2022-11-30 22:46:40', 1, 20, 'Seguir'),
(165, NULL, NULL, 117, '2022-11-30 22:46:49', 0, 7, 'Seguir'),
(166, NULL, NULL, 118, '2022-11-30 22:46:58', 0, 12, 'Seguir'),
(167, NULL, NULL, 119, '2022-11-30 22:47:04', 1, 8, 'Seguir'),
(168, NULL, NULL, 120, '2022-11-30 22:47:10', 0, 19, 'Seguir'),
(169, NULL, NULL, 121, '2022-11-30 22:47:19', 0, 21, 'Seguir'),
(170, NULL, NULL, 122, '2022-11-30 22:47:20', 1, 8, 'Seguir'),
(171, NULL, NULL, 123, '2022-11-30 22:47:26', 1, 17, 'Seguir'),
(172, NULL, NULL, 124, '2022-11-30 22:47:37', 0, 23, 'Seguir'),
(173, NULL, NULL, 125, '2022-11-30 22:47:37', 1, 20, 'Seguir'),
(174, NULL, NULL, 126, '2022-11-30 22:48:09', 0, 6, 'Seguir'),
(175, NULL, NULL, 127, '2022-11-30 22:48:16', 1, 15, 'Seguir'),
(176, NULL, NULL, 128, '2022-11-30 22:48:20', 0, 23, 'Seguir'),
(177, NULL, NULL, 129, '2022-11-30 22:48:28', 0, 18, 'Seguir'),
(178, 56, NULL, NULL, '2022-11-30 22:49:38', 1, 8, 'Curtida'),
(180, NULL, NULL, 131, '2022-11-30 22:51:50', 0, 14, 'Seguir'),
(181, NULL, NULL, 132, '2022-11-30 22:51:55', 1, 15, 'Seguir'),
(182, NULL, NULL, 133, '2022-11-30 22:52:11', 1, 10, 'Seguir'),
(183, NULL, NULL, 134, '2022-11-30 22:52:16', 1, 2, 'Seguir'),
(184, NULL, NULL, 135, '2022-11-30 22:52:18', 0, 18, 'Seguir'),
(186, NULL, NULL, 137, '2022-11-30 22:52:51', 1, 2, 'Seguir'),
(187, NULL, NULL, 138, '2022-11-30 22:53:26', 0, 6, 'Seguir'),
(188, NULL, NULL, 139, '2022-11-30 22:53:33', 0, 7, 'Seguir'),
(189, NULL, NULL, 140, '2022-11-30 22:53:38', 0, 12, 'Seguir'),
(190, NULL, NULL, 141, '2022-11-30 22:53:44', 1, 8, 'Seguir'),
(191, NULL, NULL, 142, '2022-11-30 22:54:01', 0, 21, 'Seguir'),
(192, NULL, NULL, 143, '2022-11-30 22:54:06', 0, 18, 'Seguir'),
(193, NULL, NULL, 144, '2022-11-30 22:54:12', 0, 19, 'Seguir'),
(194, NULL, NULL, 145, '2022-11-30 22:54:16', 1, 15, 'Seguir'),
(195, NULL, NULL, 146, '2022-11-30 22:54:24', 0, 14, 'Seguir'),
(196, 57, NULL, NULL, '2022-11-30 22:55:09', 1, 8, 'Curtida'),
(197, NULL, NULL, 147, '2022-11-30 22:55:29', 0, 24, 'Seguir'),
(198, NULL, NULL, 148, '2022-11-30 22:55:29', 0, 23, 'Seguir'),
(199, NULL, NULL, 149, '2022-11-30 22:55:31', 0, 22, 'Seguir'),
(200, 58, NULL, NULL, '2022-11-30 22:57:50', 1, 2, 'Curtida'),
(203, NULL, NULL, 151, '2022-11-30 23:04:58', 0, 24, 'Seguir'),
(204, NULL, NULL, 152, '2022-11-30 23:05:03', 1, 11, 'Seguir'),
(205, NULL, NULL, 153, '2022-11-30 23:05:08', 0, 21, 'Seguir'),
(206, NULL, NULL, 154, '2022-11-30 23:08:05', 0, 14, 'Seguir'),
(207, NULL, NULL, 155, '2022-11-30 23:08:16', 0, 12, 'Seguir'),
(208, 60, NULL, NULL, '2022-11-30 23:09:24', 1, 2, 'Curtida'),
(210, NULL, NULL, 157, '2022-11-30 23:09:32', 0, 19, 'Seguir'),
(211, NULL, NULL, 158, '2022-11-30 23:09:46', 1, 10, 'Seguir'),
(212, NULL, NULL, 159, '2022-11-30 23:09:53', 0, 6, 'Seguir'),
(214, NULL, NULL, 161, '2022-11-30 23:10:01', 0, 7, 'Seguir'),
(215, NULL, NULL, 162, '2022-11-30 23:10:01', 1, 17, 'Seguir'),
(216, NULL, NULL, 163, '2022-11-30 23:10:06', 0, 19, 'Seguir'),
(217, NULL, NULL, 164, '2022-11-30 23:10:12', 0, 18, 'Seguir'),
(218, NULL, NULL, 165, '2022-11-30 23:10:17', 1, 2, 'Seguir'),
(219, NULL, NULL, 166, '2022-11-30 23:10:22', 0, 23, 'Seguir'),
(220, NULL, NULL, 167, '2022-11-30 23:10:30', 0, 12, 'Seguir'),
(221, NULL, NULL, 168, '2022-11-30 23:10:36', 1, 20, 'Seguir'),
(222, NULL, NULL, 169, '2022-11-30 23:10:50', 0, 14, 'Seguir'),
(223, 61, NULL, NULL, '2022-11-30 23:11:01', 1, 20, 'Curtida'),
(224, 62, NULL, NULL, '2022-11-30 23:11:04', 1, 2, 'Curtida'),
(225, 63, NULL, NULL, '2022-11-30 23:11:07', 0, 6, 'Curtida'),
(226, 64, NULL, NULL, '2022-11-30 23:11:10', 1, 10, 'Curtida'),
(227, 65, NULL, NULL, '2022-11-30 23:11:13', 0, 12, 'Curtida'),
(228, 66, NULL, NULL, '2022-11-30 23:11:16', 1, 10, 'Curtida'),
(229, 67, NULL, NULL, '2022-11-30 23:11:19', 1, 2, 'Curtida'),
(230, 68, NULL, NULL, '2022-11-30 23:11:31', 1, 2, 'Curtida'),
(231, NULL, NULL, 170, '2022-11-30 23:11:55', 1, 20, 'Seguir'),
(232, NULL, NULL, 171, '2022-11-30 23:11:56', 1, 9, 'Seguir'),
(233, NULL, NULL, 172, '2022-11-30 23:12:27', 0, 23, 'Seguir'),
(234, NULL, NULL, 173, '2022-11-30 23:12:27', 1, 10, 'Seguir'),
(235, NULL, NULL, 174, '2022-11-30 23:12:28', 0, 22, 'Seguir'),
(236, NULL, NULL, 175, '2022-11-30 23:12:30', 1, 20, 'Seguir'),
(237, 69, NULL, NULL, '2022-11-30 23:13:01', 1, 20, 'Curtida'),
(239, NULL, NULL, 177, '2022-11-30 23:13:56', 0, 24, 'Seguir'),
(241, NULL, NULL, 179, '2022-11-30 23:14:10', 0, 21, 'Seguir'),
(242, NULL, NULL, 180, '2022-11-30 23:15:24', 0, 27, 'Seguir'),
(257, NULL, NULL, 195, '2022-11-30 23:32:22', 0, 21, 'Seguir'),
(258, 70, NULL, NULL, '2022-11-30 23:32:26', 1, 8, 'Curtida'),
(259, 71, NULL, NULL, '2022-11-30 23:32:36', 1, 8, 'Curtida'),
(265, NULL, NULL, 201, '2022-11-30 23:36:47', 1, 15, 'Seguir'),
(288, NULL, NULL, 224, '2022-11-30 23:52:11', 1, 8, 'Seguir'),
(289, 72, NULL, NULL, '2022-11-30 23:57:42', 0, 20, 'Curtida'),
(290, NULL, NULL, 225, '2022-11-30 23:58:16', 0, 17, 'Seguir'),
(291, NULL, NULL, 226, '2022-11-30 23:58:16', 0, 20, 'Seguir'),
(292, NULL, NULL, 227, '2022-12-01 00:42:44', 0, 11, 'Seguir');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpet`
--

CREATE TABLE `tbpet` (
  `idPet` int(11) NOT NULL,
  `nomePet` varchar(200) NOT NULL,
  `racaPet` varchar(200) NOT NULL,
  `especiePet` varchar(200) NOT NULL,
  `statusPet` int(11) NOT NULL DEFAULT 1,
  `idadePet` varchar(30) NOT NULL,
  `dataCriacaoPet` datetime NOT NULL DEFAULT current_timestamp(),
  `idUsuario` int(11) NOT NULL,
  `usuarioPet` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbpet`
--

INSERT INTO `tbpet` (`idPet`, `nomePet`, `racaPet`, `especiePet`, `statusPet`, `idadePet`, `dataCriacaoPet`, `idUsuario`, `usuarioPet`) VALUES
(2, 'neguinha', 'SRD', 'Gato', 1, '5 anos', '2022-11-30 20:36:36', 2, 'neguinha'),
(4, 'Fofinha', 'Calopsita', 'Ave', 1, '12 anos', '2022-11-30 20:54:30', 8, 'fofinhar'),
(5, 'Clarinha', 'Calico', 'Gato', 1, '6 anos', '2022-11-30 20:54:42', 7, 'clarinha'),
(6, 'Lizzie', 'Yorkshire', 'Cachorro', 1, '11 anos', '2022-11-30 20:54:55', 8, 'lizzieyork'),
(7, 'Rakan', 'Pastor alemão', 'Cachorro', 0, '4 anos', '2022-11-30 20:59:17', 2, 'Rakan'),
(8, 'Branquinha', 'indefinida', 'Gato', 1, '7 anos', '2022-11-30 21:12:32', 10, 'branquinha01'),
(9, 'Bailey', 'Calico', 'Gato', 1, '4 anos', '2022-11-30 21:35:00', 12, 'bailey'),
(10, 'Thanos', 'Rottweiler', 'Cachorro', 1, '3 anos', '2022-11-30 21:36:16', 12, 'thanos'),
(11, 'Rocket', 'Golden', 'Cachorro', 1, '3 anos', '2022-11-30 21:37:16', 12, 'rocket'),
(12, 'Matheus', 'Tartaruga ', 'Exótico', 1, '12 anos', '2022-11-30 21:47:29', 14, 'matheus'),
(13, 'Felix', 'viralata', 'Gato', 1, '3 anos', '2022-11-30 21:52:08', 10, 'felix'),
(15, 'totó', 'SRD', 'Cachorro', 1, '5 anos', '2022-11-30 22:08:03', 17, 'toto'),
(16, 'Vênus', 'Viralata', 'Cachorro', 1, '5 anos', '2022-11-30 22:21:12', 18, 'venus'),
(17, 'Ana', 'Branca', 'Gato', 1, '2 anos', '2022-11-30 22:28:00', 19, 'anaa'),
(18, 'Bichento', 'Indefinida', 'Gato', 1, '3 anos', '2022-11-30 22:33:32', 21, 'bichento'),
(19, 'mya', 'SRD', 'Cachorro', 1, '6 anos', '2022-11-30 22:34:34', 20, 'myaa'),
(20, 'Tigrão', 'SRD', 'Gato', 1, '1 ano', '2022-11-30 22:39:16', 22, 'tigrao'),
(21, 'Ozzy', 'Husky', 'Cachorro', 1, '9 meses', '2022-11-30 22:44:24', 23, 'ozzy'),
(22, 'Jade', 'SRD', 'Cachorro', 1, '9 anos', '2022-11-30 22:51:28', 24, 'jade'),
(24, 'Mimoso', 'SRD', 'Gato', 1, '1 mês', '2022-11-30 23:08:56', 27, 'mimoso'),
(25, 'Tera', 'SRD', 'Gato', 1, '14 anos', '2022-11-30 23:53:46', 28, 'Tera'),
(26, 'Mel', 'Pincher', 'Cachorro', 1, '4 anos', '2022-12-01 00:35:16', 29, 'MelRaivinha'),
(27, 'Thais Pirajá', 'Pelo curto brasileiro', 'Gato', 1, '4 anos', '2022-12-01 00:40:25', 30, 'Thais'),
(28, 'Taz', 'SRD', 'Gato', 1, '6 anos', '2022-12-01 00:41:36', 30, 'GatoTaz');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpetseguidor`
--

CREATE TABLE `tbpetseguidor` (
  `idPetSeguidor` int(11) NOT NULL,
  `idPetSeguido` int(11) NOT NULL,
  `idSeguidor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbpetseguidor`
--

INSERT INTO `tbpetseguidor` (`idPetSeguidor`, `idPetSeguido`, `idSeguidor`) VALUES
(1, 5, 10),
(2, 8, 7),
(3, 8, 2),
(4, 8, 12),
(5, 5, 12),
(6, 8, 14),
(7, 5, 14),
(8, 9, 14),
(9, 10, 14),
(10, 11, 14),
(11, 2, 14),
(12, 7, 14),
(13, 12, 6),
(14, 2, 6),
(15, 7, 6),
(16, 5, 17),
(17, 8, 18),
(18, 13, 18),
(19, 5, 18),
(20, 9, 18),
(21, 10, 18),
(22, 11, 18),
(23, 2, 18),
(24, 7, 18),
(25, 15, 2),
(26, 16, 19),
(27, 21, 20),
(28, 13, 2),
(29, 22, 17),
(30, 18, 17);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbproduto`
--

CREATE TABLE `tbproduto` (
  `idProduto` int(11) NOT NULL,
  `textoProduto` varchar(100) NOT NULL,
  `descProduto` varchar(150) NOT NULL,
  `valorProduto` double NOT NULL,
  `statusProduto` int(1) NOT NULL,
  `dataProduto` datetime NOT NULL DEFAULT current_timestamp(),
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbproduto`
--

INSERT INTO `tbproduto` (`idProduto`, `textoProduto`, `descProduto`, `valorProduto`, `statusProduto`, `dataProduto`, `idUsuario`) VALUES
(1, 'Ração special', 'Sabor frango e carne para cães adultos', 120, 0, '2022-11-30 23:58:20', 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpublicacao`
--

CREATE TABLE `tbpublicacao` (
  `idPublicacao` int(11) NOT NULL,
  `textoPublicacao` varchar(200) NOT NULL,
  `dataPublicacao` datetime NOT NULL,
  `localPub` text DEFAULT NULL,
  `itimalias` int(11) DEFAULT 0,
  `pubImpulso` int(11) NOT NULL DEFAULT 0,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbpublicacao`
--

INSERT INTO `tbpublicacao` (`idPublicacao`, `textoPublicacao`, `dataPublicacao`, `localPub`, `itimalias`, `pubImpulso`, `idUsuario`) VALUES
(1, 'minha gata clarinha', '2022-11-30 21:04:49', '', 8, 0, 7),
(2, 'Olha o tamanho da pata do rakan que enorme!', '2022-11-30 21:05:11', '', 9, 0, 2),
(3, 'patinha com pintinha', '2022-11-30 21:19:35', 'São Paulo', 9, 0, 10),
(4, 'szz', '2022-11-30 21:40:28', '', 5, 0, 12),
(5, 'Meu cachorro muito feliz porque tem eu como cuidador', '2022-11-30 21:53:48', '', 4, 0, 15),
(6, 'eu e o dorminhoco', '2022-11-30 21:53:49', '', 6, 0, 10),
(7, 'olhinho lindo', '2022-11-30 21:59:55', '', 7, 0, 6),
(8, 'estou com a barriga doendo de tanto dar gargalhadas 😅 😂', '2022-11-30 22:02:42', '', 4, 0, 15),
(9, 'Deixei meu portão aberto e ele fugiu, próximo a ETEC de Guaianases. Atende pelo nome de \"Caramelo\" - Contato: (11) 94002-8922', '2022-11-30 22:07:20', 'Rua Feliciano de Mendonça 290, São Paulo', 3, 0, 15),
(10, 'meu bebe ', '2022-11-30 22:16:08', 'casa ', 2, 0, 17),
(11, 'neguinha nas minhas roupas dps fico todo cheio de pelo', '2022-11-30 22:25:24', '', 7, 0, 2),
(12, 'Lizzie saindo do banho! E em clima de copa com esse laço kkkk 💚💛', '2022-11-30 22:39:06', 'São Paulo - Guaianases', 2, 0, 8),
(13, 'pós tosa 💕', '2022-11-30 22:56:37', '', 3, 0, 20),
(15, 'Fofinha bocejando kKKKK 💙💙', '2022-11-30 23:05:28', 'São Paulo - Guaianases', 1, 0, 8),
(16, 'Alguém viu a gatinha do meu primo ? Ela é totalmente branca e responde pelo nome Morgana. Fugiu dia 29/11 e até agora nada. Se alguém tiver alguma informação, comenta! 💔', '2022-11-30 23:13:33', 'R. Pero Peres - Jardim Soares', 1, 0, 8),
(17, 'Depois de um dia duro no trabalho.', '2022-12-01 00:01:34', '', 0, 0, 28),
(18, 'Depois de um dia duro no trabalho.', '2022-12-01 00:01:42', 'São Paulo', 0, 0, 28);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbservico`
--

CREATE TABLE `tbservico` (
  `idServico` int(11) NOT NULL,
  `textoServico` varchar(50) NOT NULL,
  `descServico` varchar(150) NOT NULL,
  `valorServico` double NOT NULL,
  `statusServico` int(1) NOT NULL,
  `dataServico` datetime NOT NULL DEFAULT current_timestamp(),
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbservico`
--

INSERT INTO `tbservico` (`idServico`, `textoServico`, `descServico`, `valorServico`, `statusServico`, `dataServico`, `idUsuario`) VALUES
(1, 'Massagem para cachorros', 'Massagem feita por especialista', 84, 0, '2022-11-30 23:54:29', 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbtipousuario`
--

CREATE TABLE `tbtipousuario` (
  `idTipoUsuario` int(11) NOT NULL,
  `tipoUsuario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `tbusuario` (
  `idUsuario` int(11) NOT NULL,
  `nomeUsuario` varchar(200) NOT NULL,
  `senhaUsuario` varchar(200) NOT NULL,
  `loginUsuario` varchar(200) NOT NULL,
  `verificadoUsuario` tinyint(1) NOT NULL,
  `emailUsuario` varchar(100) NOT NULL,
  `bioUsuario` text DEFAULT NULL,
  `localizacaoUsuario` text DEFAULT NULL,
  `siteUsuario` text DEFAULT NULL,
  `statusUsuario` int(11) DEFAULT 1,
  `idTipoUsuario` int(11) NOT NULL,
  `dataCriacaoConta` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbusuario`
--

INSERT INTO `tbusuario` (`idUsuario`, `nomeUsuario`, `senhaUsuario`, `loginUsuario`, `verificadoUsuario`, `emailUsuario`, `bioUsuario`, `localizacaoUsuario`, `siteUsuario`, `statusUsuario`, `idTipoUsuario`, `dataCriacaoConta`) VALUES
(2, 'Kauan Oliveira', 'kauan00', 'Kauan', 0, 'kauaanmatheus@gmail.com', 'Tenho dois gatos e uma namorada', 'Guaianazes - São Paulo', 'github.com/KauanMO', 1, 1, '2022-11-30 23:34:10'),
(6, 'Yuri Oliveira', 'yuri123', 'yuri', 0, 'yuri@gmail.com', 'tenho um cachorro que se chama Nino.', 'São Paulo ', '', 1, 1, '2022-11-30 23:42:07'),
(7, 'Pedro Silva', 'pedro123', 'pedro', 0, 'pedro@gmail.com', 'tenho um gato que se chama Clarinha.', 'São Paulo ', '', 1, 1, '2022-11-30 23:50:13'),
(8, 'Marina Liz', 'marina', 'marinaliz', 0, 'marinaliz@gmail.com', '18, infj - entusiasta do studio ghibli e fã número um dos meus pets 💙', 'São Paulo - Guaianases', 'github.com/m-arina', 1, 1, '2022-11-30 23:52:39'),
(9, 'Pet Shop Legal', 'petlegal', 'petlegal', 0, 'petlegal@gmail.com', 'Um lugar com diversos produtos e serviços para os seus bichinhos', NULL, 'petshoplegal.com.br', 1, 2, '2022-11-30 23:57:09'),
(10, 'Melissa Rodrigues', 'mel123', 'meel', 0, 'melissa@gmail.com', 'tenho dois gatos e um namorado', 'São Paulo ', '', 1, 1, '2022-12-01 00:11:14'),
(11, 'Brinquedos pet', 'brinquedo', 'brinquedosPet', 0, 'brinquedo@gmail.com', 'Vendemos brinquedos para seus pets!', NULL, 'brinquedospet.com', 1, 2, '2022-12-01 00:26:54'),
(12, 'Maria Veroneze', 'maria123', 'maria', 0, 'maria@gmail.com', '', '', '', 1, 1, '2022-12-01 00:31:38'),
(13, 'Administrador', 'adm123', 'administrador', 0, 'adm@gmail.com', '', '', '', 1, 3, '2022-12-01 00:36:28'),
(14, 'Danielle Romano', 'dani123', 'dani', 0, 'dani@gmail.com', '', '', '', 1, 1, '2022-12-01 00:41:15'),
(15, 'Edu Sousa', 'adoroanimais123', 'dogMal', 0, 'eduardolindo@gmail.com', 'Eu gosto de cachorrinhos e de fazer gambiarras em códigos', 'São Paulo', '', 1, 1, '2022-12-01 00:47:04'),
(17, 'gis', '123456', 'gitlaine', 0, 'gislaine@gmail.com', 'sou petlover', 'São Paulo - SP', '', 1, 1, '2022-12-01 01:05:24'),
(18, 'Amadeus', 'amadeus123', 'amadeus', 0, 'amadeus@gmail.com', '', '', '', 1, 1, '2022-12-01 01:18:15'),
(19, 'Rogerio', 'rogerio123', 'rogerio', 0, 'rogerio@gmail.com', '', '', '', 1, 1, '2022-12-01 01:27:06'),
(20, 'camila', '123456', 'cams', 0, 'camila@gmail.com', 'amo animais 💕🐕', 'São Paulo - SP', '', 1, 1, '2022-12-01 01:31:51'),
(21, 'Giulia', 'giulia123', 'giulia', 0, 'giulia@gmail.com', '', '', '', 1, 1, '2022-12-01 01:32:36'),
(22, 'Ana', 'ana123', 'anaq', 0, 'ana@gmail.com', '', '', '', 1, 1, '2022-12-01 01:37:32'),
(23, 'Kauany', 'kauany123', 'kauany', 0, 'kauany@gmail.com', '', '', '', 1, 1, '2022-12-01 01:43:28'),
(24, 'Giovana', 'giovana123', 'gio01', 0, 'gi@gmail.com', '', '', '', 1, 1, '2022-12-01 01:49:46'),
(26, ' ', 'gabriel123', 'gabriel', 0, 'gabriel@gmail.com', NULL, NULL, NULL, 1, 1, '2022-12-01 02:04:27'),
(27, 'Gabriel', 'gabriel', 'gabb', 0, 'gab@gmail.com', '', '', '', 1, 1, '2022-12-01 02:07:59'),
(28, 'Elaine', 'Tera1234', 'Elaine', 0, 'elainekamada@gmail.com', 'Amo minha gata', 'São Paulo ', 'www.jw.org/pt/biblioteca/revistas/g20040222/Conceito-equilibrado-sobre-animais-de-estima%C3%A7%C3%A3o/', 1, 1, '2022-12-01 02:50:50'),
(29, 'amanda', 'amanda', 'amanda', 0, 'amanda@gmail.com', '', '', '', 1, 1, '2022-12-01 03:31:49'),
(30, 'joao', 'joao00', 'joao', 0, 'joao@gmail.com', '', '', '', 1, 1, '2022-12-01 03:37:46');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuarioendereco`
--

CREATE TABLE `tbusuarioendereco` (
  `idUsuarioEndereco` int(11) NOT NULL,
  `logradouroUsuario` varchar(200) NOT NULL,
  `numeroEnderecoUsuario` varchar(200) NOT NULL,
  `cepUsuario` char(8) NOT NULL,
  `bairroUsuario` varchar(200) NOT NULL,
  `complementoUsuario` varchar(100) NOT NULL,
  `cidadeUsuario` varchar(200) NOT NULL,
  `estadoUsuario` varchar(50) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbusuarioendereco`
--

INSERT INTO `tbusuarioendereco` (`idUsuarioEndereco`, `logradouroUsuario`, `numeroEnderecoUsuario`, `cepUsuario`, `bairroUsuario`, `complementoUsuario`, `cidadeUsuario`, `estadoUsuario`, `idUsuario`) VALUES
(1, 'Rua Cachoeira das Garças', '131', '08473010', 'Conjunto Habitacional Sitio Conceição', '', 'São Paulo', 'SP', 9),
(2, 'Rua Francisco Fernandes Frazão', '12', '08452-18', 'Lajeado', '', 'São Paulo', 'SP', 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuarioseguidor`
--

CREATE TABLE `tbusuarioseguidor` (
  `idUsuarioSeguidor` int(11) NOT NULL,
  `idSeguidor` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbusuarioseguidor`
--

INSERT INTO `tbusuarioseguidor` (`idUsuarioSeguidor`, `idSeguidor`, `idUsuario`) VALUES
(1, 7, 6),
(2, 6, 7),
(3, 10, 6),
(4, 10, 7),
(5, 7, 10),
(6, 11, 6),
(7, 6, 10),
(9, 11, 7),
(10, 6, 11),
(11, 10, 11),
(12, 2, 10),
(13, 2, 6),
(14, 2, 7),
(15, 12, 7),
(16, 12, 10),
(17, 12, 6),
(19, 14, 10),
(20, 14, 7),
(21, 14, 12),
(22, 14, 6),
(24, 14, 2),
(26, 2, 14),
(27, 15, 2),
(28, 10, 2),
(29, 10, 15),
(30, 11, 10),
(31, 10, 14),
(32, 10, 12),
(35, 15, 9),
(36, 15, 10),
(37, 6, 14),
(38, 6, 2),
(39, 6, 12),
(40, 6, 15),
(41, 15, 6),
(42, 2, 11),
(43, 9, 11),
(44, 17, 11),
(45, 17, 9),
(47, 17, 7),
(50, 17, 6),
(51, 2, 17),
(52, 18, 10),
(53, 18, 7),
(54, 18, 6),
(55, 18, 12),
(56, 18, 2),
(57, 18, 15),
(58, 2, 18),
(59, 17, 2),
(61, 19, 18),
(62, 19, 10),
(63, 19, 15),
(64, 19, 7),
(65, 19, 6),
(66, 19, 12),
(67, 19, 8),
(68, 19, 2),
(69, 2, 19),
(70, 21, 10),
(71, 21, 15),
(72, 21, 6),
(73, 21, 7),
(74, 21, 12),
(75, 21, 8),
(76, 21, 14),
(77, 21, 18),
(78, 21, 19),
(79, 20, 17),
(80, 20, 9),
(85, 8, 19),
(86, 8, 21),
(87, 8, 2),
(88, 22, 10),
(89, 22, 8),
(90, 22, 12),
(92, 22, 6),
(93, 22, 2),
(94, 9, 7),
(95, 22, 19),
(96, 22, 18),
(97, 22, 7),
(98, 22, 14),
(99, 22, 21),
(100, 22, 17),
(101, 22, 20),
(102, 10, 20),
(103, 10, 8),
(104, 10, 19),
(105, 10, 18),
(106, 10, 22),
(107, 10, 21),
(108, 10, 17),
(109, 8, 22),
(110, 8, 10),
(111, 23, 10),
(112, 20, 10),
(113, 20, 22),
(114, 20, 7),
(115, 23, 2),
(116, 23, 20),
(117, 23, 7),
(118, 23, 12),
(119, 23, 8),
(120, 23, 19),
(121, 23, 21),
(122, 20, 8),
(123, 23, 17),
(124, 8, 23),
(125, 8, 20),
(126, 23, 6),
(127, 9, 15),
(128, 20, 23),
(129, 23, 18),
(131, 11, 14),
(132, 11, 15),
(133, 24, 10),
(134, 24, 2),
(135, 11, 18),
(137, 11, 2),
(138, 24, 6),
(139, 24, 7),
(140, 24, 12),
(141, 24, 8),
(142, 24, 21),
(143, 24, 18),
(144, 24, 19),
(145, 24, 15),
(146, 24, 14),
(147, 2, 24),
(148, 2, 23),
(149, 2, 22),
(151, 20, 24),
(152, 20, 11),
(153, 20, 21),
(154, 20, 14),
(155, 20, 12),
(157, 20, 19),
(158, 27, 10),
(159, 27, 6),
(161, 27, 7),
(162, 11, 17),
(163, 27, 19),
(164, 27, 18),
(165, 27, 2),
(166, 27, 23),
(167, 27, 12),
(168, 27, 20),
(169, 27, 14),
(170, 11, 20),
(171, 11, 9),
(172, 17, 23),
(173, 17, 10),
(174, 17, 22),
(175, 17, 20),
(177, 17, 24),
(179, 17, 21),
(180, 20, 27),
(195, 2, 21),
(201, 2, 15),
(224, 2, 8),
(225, 9, 17),
(226, 9, 20),
(227, 15, 11);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tbcategoria`
--
ALTER TABLE `tbcategoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Índices para tabela `tbcategoriapublicacao`
--
ALTER TABLE `tbcategoriapublicacao`
  ADD PRIMARY KEY (`idCategoriaPublicacao`),
  ADD KEY `idCategoria` (`idCategoria`),
  ADD KEY `idPublicacao` (`idPublicacao`);

--
-- Índices para tabela `tbcategoriaseguida`
--
ALTER TABLE `tbcategoriaseguida`
  ADD PRIMARY KEY (`idCategoriaSeguida`),
  ADD KEY `foreignUsuario` (`idUsuario`),
  ADD KEY `foreignCategoria` (`idCategoria`);

--
-- Índices para tabela `tbcomentario`
--
ALTER TABLE `tbcomentario`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idPublicacao` (`idPublicacao`);

--
-- Índices para tabela `tbcurtidapublicacao`
--
ALTER TABLE `tbcurtidapublicacao`
  ADD PRIMARY KEY (`idCurtidaPublicacao`),
  ADD KEY `idUsuarioCurtida` (`idUsuarioCurtida`),
  ADD KEY `idPublicacaoCurtida` (`idPublicacaoCurtida`);

--
-- Índices para tabela `tbdenunciacomentario`
--
ALTER TABLE `tbdenunciacomentario`
  ADD PRIMARY KEY (`idDenunciaComentario`),
  ADD KEY `idUsuario` (`idUsuarioDenunciador`),
  ADD KEY `idComentario` (`idComentario`),
  ADD KEY `idUsuarioDenunciado` (`idUsuarioDenunciado`);

--
-- Índices para tabela `tbdenunciapublicacao`
--
ALTER TABLE `tbdenunciapublicacao`
  ADD PRIMARY KEY (`idDenunciapublicacao`),
  ADD KEY `idUsuarioDenunciado` (`idUsuarioDenunciado`),
  ADD KEY `idUsuarioDenunciador` (`idUsuarioDenunciador`);

--
-- Índices para tabela `tbdenunciausuario`
--
ALTER TABLE `tbdenunciausuario`
  ADD PRIMARY KEY (`idDenunciaUsuario`),
  ADD KEY `idUsuario` (`idUsuarioDenunciador`),
  ADD KEY `idUsuarioDenuncia` (`idUsuarioDenunciado`);

--
-- Índices para tabela `tbfotopet`
--
ALTER TABLE `tbfotopet`
  ADD PRIMARY KEY (`idFotoPet`),
  ADD KEY `idPet` (`idPet`);

--
-- Índices para tabela `tbfotoproduto`
--
ALTER TABLE `tbfotoproduto`
  ADD PRIMARY KEY (`idFotoProduto`),
  ADD KEY `idProduto` (`idProduto`);

--
-- Índices para tabela `tbfotopublicacao`
--
ALTER TABLE `tbfotopublicacao`
  ADD PRIMARY KEY (`idFotoPublicacao`),
  ADD KEY `idPublicacao` (`idPublicacao`);

--
-- Índices para tabela `tbfotoservico`
--
ALTER TABLE `tbfotoservico`
  ADD PRIMARY KEY (`idFotoServico`),
  ADD KEY `idServico` (`idServico`);

--
-- Índices para tabela `tbfotousuario`
--
ALTER TABLE `tbfotousuario`
  ADD PRIMARY KEY (`idFotoUsuario`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `tbmensagem`
--
ALTER TABLE `tbmensagem`
  ADD PRIMARY KEY (`idMensagem`),
  ADD KEY `idUsuarioDestino` (`idUsuarioDestino`),
  ADD KEY `idUsuarioOrigem` (`idUsuarioOrigem`);

--
-- Índices para tabela `tbnotificacao`
--
ALTER TABLE `tbnotificacao`
  ADD PRIMARY KEY (`idNotificacao`),
  ADD KEY `idCurtidaPublicacao` (`idCurtidaPublicacao`),
  ADD KEY `idComentário` (`idComentário`),
  ADD KEY `idUsuarioSeguidor` (`idUsuarioSeguidor`),
  ADD KEY `idUsuarioNotificado` (`idUsuarioNotificado`);

--
-- Índices para tabela `tbpet`
--
ALTER TABLE `tbpet`
  ADD PRIMARY KEY (`idPet`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `tbpetseguidor`
--
ALTER TABLE `tbpetseguidor`
  ADD PRIMARY KEY (`idPetSeguidor`),
  ADD KEY `idPetSeguido` (`idPetSeguido`),
  ADD KEY `idSeguidor` (`idSeguidor`);

--
-- Índices para tabela `tbproduto`
--
ALTER TABLE `tbproduto`
  ADD PRIMARY KEY (`idProduto`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `tbpublicacao`
--
ALTER TABLE `tbpublicacao`
  ADD PRIMARY KEY (`idPublicacao`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `tbservico`
--
ALTER TABLE `tbservico`
  ADD PRIMARY KEY (`idServico`),
  ADD KEY `tbservico_ibfk_1` (`idUsuario`);

--
-- Índices para tabela `tbtipousuario`
--
ALTER TABLE `tbtipousuario`
  ADD PRIMARY KEY (`idTipoUsuario`);

--
-- Índices para tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `tipoUsuario` (`idTipoUsuario`);

--
-- Índices para tabela `tbusuarioendereco`
--
ALTER TABLE `tbusuarioendereco`
  ADD PRIMARY KEY (`idUsuarioEndereco`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `tbusuarioseguidor`
--
ALTER TABLE `tbusuarioseguidor`
  ADD PRIMARY KEY (`idUsuarioSeguidor`),
  ADD KEY `idSeguidor` (`idSeguidor`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbcategoria`
--
ALTER TABLE `tbcategoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de tabela `tbcategoriapublicacao`
--
ALTER TABLE `tbcategoriapublicacao`
  MODIFY `idCategoriaPublicacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de tabela `tbcategoriaseguida`
--
ALTER TABLE `tbcategoriaseguida`
  MODIFY `idCategoriaSeguida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de tabela `tbcomentario`
--
ALTER TABLE `tbcomentario`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `tbcurtidapublicacao`
--
ALTER TABLE `tbcurtidapublicacao`
  MODIFY `idCurtidaPublicacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de tabela `tbdenunciacomentario`
--
ALTER TABLE `tbdenunciacomentario`
  MODIFY `idDenunciaComentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbdenunciapublicacao`
--
ALTER TABLE `tbdenunciapublicacao`
  MODIFY `idDenunciapublicacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbdenunciausuario`
--
ALTER TABLE `tbdenunciausuario`
  MODIFY `idDenunciaUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbfotopet`
--
ALTER TABLE `tbfotopet`
  MODIFY `idFotoPet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `tbfotoproduto`
--
ALTER TABLE `tbfotoproduto`
  MODIFY `idFotoProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbfotopublicacao`
--
ALTER TABLE `tbfotopublicacao`
  MODIFY `idFotoPublicacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `tbfotoservico`
--
ALTER TABLE `tbfotoservico`
  MODIFY `idFotoServico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbfotousuario`
--
ALTER TABLE `tbfotousuario`
  MODIFY `idFotoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `tbmensagem`
--
ALTER TABLE `tbmensagem`
  MODIFY `idMensagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbnotificacao`
--
ALTER TABLE `tbnotificacao`
  MODIFY `idNotificacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;

--
-- AUTO_INCREMENT de tabela `tbpet`
--
ALTER TABLE `tbpet`
  MODIFY `idPet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `tbpetseguidor`
--
ALTER TABLE `tbpetseguidor`
  MODIFY `idPetSeguidor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `tbproduto`
--
ALTER TABLE `tbproduto`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbpublicacao`
--
ALTER TABLE `tbpublicacao`
  MODIFY `idPublicacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `tbservico`
--
ALTER TABLE `tbservico`
  MODIFY `idServico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbtipousuario`
--
ALTER TABLE `tbtipousuario`
  MODIFY `idTipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `tbusuarioendereco`
--
ALTER TABLE `tbusuarioendereco`
  MODIFY `idUsuarioEndereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbusuarioseguidor`
--
ALTER TABLE `tbusuarioseguidor`
  MODIFY `idUsuarioSeguidor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

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
-- Limitadores para a tabela `tbcategoriaseguida`
--
ALTER TABLE `tbcategoriaseguida`
  ADD CONSTRAINT `tbcategoriaseguida_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `tbcategoria` (`idCategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbcategoriaseguida_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `tbdenunciacomentario_ibfk_1` FOREIGN KEY (`idUsuarioDenunciador`) REFERENCES `tbusuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `tbdenunciausuario_ibfk_1` FOREIGN KEY (`idUsuarioDenunciador`) REFERENCES `tbusuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbdenunciausuario_ibfk_2` FOREIGN KEY (`idUsuarioDenunciado`) REFERENCES `tbusuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbfotopet`
--
ALTER TABLE `tbfotopet`
  ADD CONSTRAINT `tbfotopet_ibfk_1` FOREIGN KEY (`idPet`) REFERENCES `tbpet` (`idPet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbfotoproduto`
--
ALTER TABLE `tbfotoproduto`
  ADD CONSTRAINT `idProduto` FOREIGN KEY (`idProduto`) REFERENCES `tbproduto` (`idProduto`);

--
-- Limitadores para a tabela `tbfotopublicacao`
--
ALTER TABLE `tbfotopublicacao`
  ADD CONSTRAINT `tbfotopublicacao_ibfk_1` FOREIGN KEY (`idPublicacao`) REFERENCES `tbpublicacao` (`idPublicacao`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbfotoservico`
--
ALTER TABLE `tbfotoservico`
  ADD CONSTRAINT `idServico` FOREIGN KEY (`idServico`) REFERENCES `tbservico` (`idServico`);

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
-- Limitadores para a tabela `tbservico`
--
ALTER TABLE `tbservico`
  ADD CONSTRAINT `tbservico_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

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
