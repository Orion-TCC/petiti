-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Nov-2022 às 00:06
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
(66, 'branca', 1),
(67, 'pastor alemao', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcategoriapublicacao`
--

CREATE TABLE `tbcategoriapublicacao` (
  `idCategoriaPublicacao` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idPublicacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcategoriaseguida`
--

CREATE TABLE `tbcategoriaseguida` (
  `idCategoriaSeguida` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpetseguidor`
--

CREATE TABLE `tbpetseguidor` (
  `idPetSeguidor` int(11) NOT NULL,
  `idPetSeguido` int(11) NOT NULL,
  `idSeguidor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbservico`
--

INSERT INTO `tbservico` (`idServico`, `textoServico`, `descServico`, `valorServico`, `statusServico`, `idUsuario`) VALUES
(1, 'melissa', 'melissa', 132132131, 0, 14);

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
  `statusUsuario` int(11) NOT NULL DEFAULT 1,
  `idTipoUsuario` int(11) NOT NULL,
  `dataCriacaoConta` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD PRIMARY KEY (`idServico`);

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
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de tabela `tbcategoriapublicacao`
--
ALTER TABLE `tbcategoriapublicacao`
  MODIFY `idCategoriaPublicacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de tabela `tbcategoriaseguida`
--
ALTER TABLE `tbcategoriaseguida`
  MODIFY `idCategoriaSeguida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `tbcomentario`
--
ALTER TABLE `tbcomentario`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tbcurtidapublicacao`
--
ALTER TABLE `tbcurtidapublicacao`
  MODIFY `idCurtidaPublicacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `tbdenunciacomentario`
--
ALTER TABLE `tbdenunciacomentario`
  MODIFY `idDenunciaComentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbdenunciapublicacao`
--
ALTER TABLE `tbdenunciapublicacao`
  MODIFY `idDenunciapublicacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `tbdenunciausuario`
--
ALTER TABLE `tbdenunciausuario`
  MODIFY `idDenunciaUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbfotopet`
--
ALTER TABLE `tbfotopet`
  MODIFY `idFotoPet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `tbfotoproduto`
--
ALTER TABLE `tbfotoproduto`
  MODIFY `idFotoProduto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbfotopublicacao`
--
ALTER TABLE `tbfotopublicacao`
  MODIFY `idFotoPublicacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de tabela `tbfotoservico`
--
ALTER TABLE `tbfotoservico`
  MODIFY `idFotoServico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbfotousuario`
--
ALTER TABLE `tbfotousuario`
  MODIFY `idFotoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `tbmensagem`
--
ALTER TABLE `tbmensagem`
  MODIFY `idMensagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbnotificacao`
--
ALTER TABLE `tbnotificacao`
  MODIFY `idNotificacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `tbpet`
--
ALTER TABLE `tbpet`
  MODIFY `idPet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `tbpetseguidor`
--
ALTER TABLE `tbpetseguidor`
  MODIFY `idPetSeguidor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `tbproduto`
--
ALTER TABLE `tbproduto`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbpublicacao`
--
ALTER TABLE `tbpublicacao`
  MODIFY `idPublicacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

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
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `tbusuarioendereco`
--
ALTER TABLE `tbusuarioendereco`
  MODIFY `idUsuarioEndereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbusuarioseguidor`
--
ALTER TABLE `tbusuarioseguidor`
  MODIFY `idUsuarioSeguidor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
