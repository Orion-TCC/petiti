-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Ago-2022 às 21:34
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
-- Banco de dados: `bdpetiti`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcategoria`
--

CREATE TABLE `tbcategoria` (
  `idCategoria` int(11) NOT NULL,
  `categoria` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Estrutura da tabela `tbcomentario`
--

CREATE TABLE `tbcomentario` (
  `idComentario` int(11) NOT NULL,
  `textoComentario` varchar(200) NOT NULL,
  `qtdcurtidaComentario` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcomentariopublicacao`
--

CREATE TABLE `tbcomentariopublicacao` (
  `idComentarioPublicacao` int(11) NOT NULL,
  `dataComentarioPublicacao` date NOT NULL,
  `idComentario` int(11) NOT NULL,
  `idPublicacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdenunciacomentario`
--

CREATE TABLE `tbdenunciacomentario` (
  `idDenunciaComentario` int(11) NOT NULL,
  `textoDenunciaComentario` varchar(200) NOT NULL,
  `dataDenunciaComentario` date NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idComentario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdenunciapublicacao`
--

CREATE TABLE `tbdenunciapublicacao` (
  `idDenunciaPublicacao` int(11) NOT NULL,
  `textoDenunciaPublicacao` varchar(200) NOT NULL,
  `dataDenunciaPublicacao` date NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idPublicacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdenunciausuario`
--

CREATE TABLE `tbdenunciausuario` (
  `idUsuarioPublicacao` int(11) NOT NULL,
  `textoDenunciaUsuario` varchar(200) NOT NULL,
  `dataDenunciaPublicacao` date NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idUsuarioDenuncia` int(11) NOT NULL
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
  `textoMensagem` varchar(200) NOT NULL,
  `dataMensagem` date NOT NULL,
  `idUsuarioOrigem` int(11) NOT NULL,
  `idUsuarioDestino` int(11) NOT NULL
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
  `idadePet` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpublicacao`
--

CREATE TABLE `tbpublicacao` (
  `idPublicacao` int(11) NOT NULL,
  `textoPublicacao` varchar(200) NOT NULL,
  `dataPublicacao` date NOT NULL,
  `qtdCurtidaPublicacao` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(5, 'Pet Shop'),
(6, 'Banho e tosa'),
(7, 'Tutor de Pet'),
(8, 'Casa de Ração');

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
  `idTipoUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbusuario`
--

INSERT INTO `tbusuario` (`idUsuario`, `nomeUsuario`, `senhaUsuario`, `loginUsuario`, `verificadoUsuario`, `emailUsuario`, `idTipoUsuario`) VALUES
(1, 'Cauã', '123', 'cwai', 0, 'cwai@gmail.com', 7),
(2, 'Pet Family', '123', 'petfamily', 0, 'petfamily@petfamily.com', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuariodenuncia`
--

CREATE TABLE `tbusuariodenuncia` (
  `idUsuarioDenuncia` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuariodestino`
--

CREATE TABLE `tbusuariodestino` (
  `idUsuarioDestino` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
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
-- Estrutura da tabela `tbusuarioorigem`
--

CREATE TABLE `tbusuarioorigem` (
  `idUsuarioOrigem` int(11) NOT NULL,
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
-- Índices para tabela `tbcomentario`
--
ALTER TABLE `tbcomentario`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `tbcomentariopublicacao`
--
ALTER TABLE `tbcomentariopublicacao`
  ADD PRIMARY KEY (`idComentarioPublicacao`),
  ADD KEY `idComentario` (`idComentario`),
  ADD KEY `idPublicacao` (`idPublicacao`);

--
-- Índices para tabela `tbdenunciacomentario`
--
ALTER TABLE `tbdenunciacomentario`
  ADD PRIMARY KEY (`idDenunciaComentario`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idComentario` (`idComentario`);

--
-- Índices para tabela `tbdenunciapublicacao`
--
ALTER TABLE `tbdenunciapublicacao`
  ADD PRIMARY KEY (`idDenunciaPublicacao`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idPublicacao` (`idPublicacao`);

--
-- Índices para tabela `tbdenunciausuario`
--
ALTER TABLE `tbdenunciausuario`
  ADD PRIMARY KEY (`idUsuarioPublicacao`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idUsuarioDenuncia` (`idUsuarioDenuncia`);

--
-- Índices para tabela `tbfotopet`
--
ALTER TABLE `tbfotopet`
  ADD PRIMARY KEY (`idFotoPet`),
  ADD KEY `idPet` (`idPet`);

--
-- Índices para tabela `tbfotopublicacao`
--
ALTER TABLE `tbfotopublicacao`
  ADD PRIMARY KEY (`idFotoPublicacao`),
  ADD KEY `idPublicacao` (`idPublicacao`);

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
  ADD KEY `idUsuarioOrigem` (`idUsuarioOrigem`),
  ADD KEY `idUsuarioDestino` (`idUsuarioDestino`);

--
-- Índices para tabela `tbpet`
--
ALTER TABLE `tbpet`
  ADD PRIMARY KEY (`idPet`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `tbpublicacao`
--
ALTER TABLE `tbpublicacao`
  ADD PRIMARY KEY (`idPublicacao`),
  ADD KEY `idUsuario` (`idUsuario`);

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
-- Índices para tabela `tbusuariodenuncia`
--
ALTER TABLE `tbusuariodenuncia`
  ADD PRIMARY KEY (`idUsuarioDenuncia`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `tbusuariodestino`
--
ALTER TABLE `tbusuariodestino`
  ADD PRIMARY KEY (`idUsuarioDestino`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `tbusuarioendereco`
--
ALTER TABLE `tbusuarioendereco`
  ADD PRIMARY KEY (`idUsuarioEndereco`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `tbusuarioorigem`
--
ALTER TABLE `tbusuarioorigem`
  ADD PRIMARY KEY (`idUsuarioOrigem`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbcategoria`
--
ALTER TABLE `tbcategoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbcategoriapublicacao`
--
ALTER TABLE `tbcategoriapublicacao`
  MODIFY `idCategoriaPublicacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbcomentario`
--
ALTER TABLE `tbcomentario`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbcomentariopublicacao`
--
ALTER TABLE `tbcomentariopublicacao`
  MODIFY `idComentarioPublicacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbdenunciacomentario`
--
ALTER TABLE `tbdenunciacomentario`
  MODIFY `idDenunciaComentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbdenunciapublicacao`
--
ALTER TABLE `tbdenunciapublicacao`
  MODIFY `idDenunciaPublicacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbdenunciausuario`
--
ALTER TABLE `tbdenunciausuario`
  MODIFY `idUsuarioPublicacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbfotopet`
--
ALTER TABLE `tbfotopet`
  MODIFY `idFotoPet` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbfotopublicacao`
--
ALTER TABLE `tbfotopublicacao`
  MODIFY `idFotoPublicacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbfotousuario`
--
ALTER TABLE `tbfotousuario`
  MODIFY `idFotoUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbmensagem`
--
ALTER TABLE `tbmensagem`
  MODIFY `idMensagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbpet`
--
ALTER TABLE `tbpet`
  MODIFY `idPet` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbpublicacao`
--
ALTER TABLE `tbpublicacao`
  MODIFY `idPublicacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbtipousuario`
--
ALTER TABLE `tbtipousuario`
  MODIFY `idTipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbusuariodenuncia`
--
ALTER TABLE `tbusuariodenuncia`
  MODIFY `idUsuarioDenuncia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbusuariodestino`
--
ALTER TABLE `tbusuariodestino`
  MODIFY `idUsuarioDestino` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbusuarioendereco`
--
ALTER TABLE `tbusuarioendereco`
  MODIFY `idUsuarioEndereco` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbusuarioorigem`
--
ALTER TABLE `tbusuarioorigem`
  MODIFY `idUsuarioOrigem` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tbcategoriapublicacao`
--
ALTER TABLE `tbcategoriapublicacao`
  ADD CONSTRAINT `tbcategoriapublicacao_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `tbcategoria` (`idCategoria`),
  ADD CONSTRAINT `tbcategoriapublicacao_ibfk_2` FOREIGN KEY (`idPublicacao`) REFERENCES `tbpublicacao` (`idPublicacao`);

--
-- Limitadores para a tabela `tbcomentario`
--
ALTER TABLE `tbcomentario`
  ADD CONSTRAINT `tbcomentario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`);

--
-- Limitadores para a tabela `tbcomentariopublicacao`
--
ALTER TABLE `tbcomentariopublicacao`
  ADD CONSTRAINT `tbcomentariopublicacao_ibfk_1` FOREIGN KEY (`idComentario`) REFERENCES `tbcomentario` (`idComentario`),
  ADD CONSTRAINT `tbcomentariopublicacao_ibfk_2` FOREIGN KEY (`idPublicacao`) REFERENCES `tbpublicacao` (`idPublicacao`);

--
-- Limitadores para a tabela `tbdenunciacomentario`
--
ALTER TABLE `tbdenunciacomentario`
  ADD CONSTRAINT `tbdenunciacomentario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`),
  ADD CONSTRAINT `tbdenunciacomentario_ibfk_2` FOREIGN KEY (`idComentario`) REFERENCES `tbcomentario` (`idComentario`);

--
-- Limitadores para a tabela `tbdenunciapublicacao`
--
ALTER TABLE `tbdenunciapublicacao`
  ADD CONSTRAINT `tbdenunciapublicacao_ibfk_1` FOREIGN KEY (`idPublicacao`) REFERENCES `tbpublicacao` (`idPublicacao`),
  ADD CONSTRAINT `tbdenunciapublicacao_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`);

--
-- Limitadores para a tabela `tbdenunciausuario`
--
ALTER TABLE `tbdenunciausuario`
  ADD CONSTRAINT `tbdenunciausuario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`),
  ADD CONSTRAINT `tbdenunciausuario_ibfk_2` FOREIGN KEY (`idUsuarioDenuncia`) REFERENCES `tbusuariodenuncia` (`idUsuarioDenuncia`);

--
-- Limitadores para a tabela `tbfotopet`
--
ALTER TABLE `tbfotopet`
  ADD CONSTRAINT `tbfotopet_ibfk_1` FOREIGN KEY (`idPet`) REFERENCES `tbpet` (`idPet`);

--
-- Limitadores para a tabela `tbfotopublicacao`
--
ALTER TABLE `tbfotopublicacao`
  ADD CONSTRAINT `tbfotopublicacao_ibfk_1` FOREIGN KEY (`idPublicacao`) REFERENCES `tbpublicacao` (`idPublicacao`);

--
-- Limitadores para a tabela `tbfotousuario`
--
ALTER TABLE `tbfotousuario`
  ADD CONSTRAINT `tbfotousuario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`);

--
-- Limitadores para a tabela `tbmensagem`
--
ALTER TABLE `tbmensagem`
  ADD CONSTRAINT `tbmensagem_ibfk_1` FOREIGN KEY (`idUsuarioDestino`) REFERENCES `tbusuariodestino` (`idUsuarioDestino`),
  ADD CONSTRAINT `tbmensagem_ibfk_2` FOREIGN KEY (`idUsuarioOrigem`) REFERENCES `tbusuarioorigem` (`idUsuarioOrigem`);

--
-- Limitadores para a tabela `tbpet`
--
ALTER TABLE `tbpet`
  ADD CONSTRAINT `tbpet_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`);

--
-- Limitadores para a tabela `tbpublicacao`
--
ALTER TABLE `tbpublicacao`
  ADD CONSTRAINT `tbpublicacao_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`);

--
-- Limitadores para a tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  ADD CONSTRAINT `tbusuario_ibfk_1` FOREIGN KEY (`idTipoUsuario`) REFERENCES `tbtipousuario` (`idTipoUsuario`);

--
-- Limitadores para a tabela `tbusuariodenuncia`
--
ALTER TABLE `tbusuariodenuncia`
  ADD CONSTRAINT `tbusuariodenuncia_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`);

--
-- Limitadores para a tabela `tbusuariodestino`
--
ALTER TABLE `tbusuariodestino`
  ADD CONSTRAINT `tbusuariodestino_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`);

--
-- Limitadores para a tabela `tbusuarioendereco`
--
ALTER TABLE `tbusuarioendereco`
  ADD CONSTRAINT `tbusuarioendereco_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`);

--
-- Limitadores para a tabela `tbusuarioorigem`
--
ALTER TABLE `tbusuarioorigem`
  ADD CONSTRAINT `tbusuarioorigem_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
