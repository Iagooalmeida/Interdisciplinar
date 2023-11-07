-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Nov-2023 às 22:30
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sis-faq`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `atualizacoes`
--

CREATE TABLE `atualizacoes` (
  `idAtualizacao` int(10) UNSIGNED NOT NULL,
  `Usuarios_idUsuarios` int(10) UNSIGNED NOT NULL,
  `perguntas_idPerguntas` int(10) UNSIGNED NOT NULL,
  `DataAtualizacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `perguntas`
--

CREATE TABLE `perguntas` (
  `idPerguntas` int(10) UNSIGNED NOT NULL,
  `Usuarios_idUsuarios` int(10) UNSIGNED NOT NULL,
  `temas_idTemas` int(10) UNSIGNED NOT NULL,
  `Autor` varchar(30) DEFAULT NULL,
  `ConteudoPergunta` text NOT NULL,
  `Resposta` text DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `DataSubmissao` datetime NOT NULL,
  `UltimaAtualizacao` datetime DEFAULT NULL,
  `Visivel` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sugestoes`
--

CREATE TABLE `sugestoes` (
  `idSugestao` int(10) UNSIGNED NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Telefone` varchar(20) NOT NULL,
  `ConteudoSugestao` text NOT NULL,
  `Status` varchar(50) NOT NULL DEFAULT 'Pendente',
  `DataSubmissao` datetime NOT NULL DEFAULT current_timestamp(),
  `idTema` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sugestoes`
--

INSERT INTO `sugestoes` (`idSugestao`, `Nome`, `Email`, `Telefone`, `ConteudoSugestao`, `Status`, `DataSubmissao`, `idTema`) VALUES
(1, 'Iago de Oliveira Almeida', 'iago732@gmail.com', '(19) 99668-3933', 'Como eu faço matricula ?', 'Pendente', '2023-11-05 04:22:29', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `temas`
--

CREATE TABLE `temas` (
  `idTemas` int(10) UNSIGNED NOT NULL,
  `NomeTema` varchar(50) NOT NULL,
  `idTemaPai` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `temas`
--

INSERT INTO `temas` (`idTemas`, `NomeTema`, `idTemaPai`) VALUES
(1, 'Documentação', NULL),
(2, 'Matricula', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuarios` int(10) UNSIGNED NOT NULL,
  `NomeUsuario` varchar(255) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Senha` varchar(255) NOT NULL,
  `Tel_Cel` varchar(15) DEFAULT NULL,
  `Funcao` varchar(30) DEFAULT NULL,
  `NivelAcesso` int(11) NOT NULL DEFAULT 1,
  `DataCadastro` date NOT NULL DEFAULT curdate(),
  `DataUltimaAtualizacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `FotoPath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuarios`, `NomeUsuario`, `Email`, `Senha`, `Tel_Cel`, `Funcao`, `NivelAcesso`, `DataCadastro`, `DataUltimaAtualizacao`, `FotoPath`) VALUES
(1, 'Master', 'master@hotmail.com', '$2y$10$0IntQVhK4NG.h9b5rixIEunZaiuLL.bOBvvUbZ5/vsu90UXK3.vKu', '(19) 9999-99999', 'Administrador', 0, '2023-11-04', '2023-11-06 11:38:57', 'uploads/miguel.png'),
(2, 'Sogeking', 'iago732@gmail.com', '$2y$10$mK1GeggMB1vvRnUFhhrwVef16TBxl5IZ6xNy.Fz8y/WGY1hlBBVo.', '(19) 9895-47956', 'Administrador', 1, '2023-11-05', '2023-11-07 01:24:21', NULL),
(3, 'Sogeking', 'iayo732@gmail.com', '$2y$10$grMimdVYGd4WPVh0NUjdMOhTCYeWuWkpTEZSlpMMbh4e1EDWM9mwa', '1989547956', 'Administrador', 1, '2023-11-05', '2023-11-06 10:00:30', NULL),
(4, 'teste', 'teste23teste@gaymail.com', '$2y$10$VpQwx6/YJsPgQjOTVqYM4.bq2LngrCO5hK9NrCre6X7QEQxt7YA1q', '187849561548', 'Administrador', 1, '2023-11-05', '2023-11-07 00:50:52', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `atualizacoes`
--
ALTER TABLE `atualizacoes`
  ADD PRIMARY KEY (`idAtualizacao`),
  ADD KEY `idx_atualizacoes_perguntas` (`perguntas_idPerguntas`),
  ADD KEY `idx_atualizacoes_usuarios` (`Usuarios_idUsuarios`);

--
-- Índices para tabela `perguntas`
--
ALTER TABLE `perguntas`
  ADD PRIMARY KEY (`idPerguntas`),
  ADD KEY `idx_perguntas_temas` (`temas_idTemas`),
  ADD KEY `idx_perguntas_usuarios` (`Usuarios_idUsuarios`);

--
-- Índices para tabela `sugestoes`
--
ALTER TABLE `sugestoes`
  ADD PRIMARY KEY (`idSugestao`),
  ADD KEY `fk_Sugestoes_Temas` (`idTema`);

--
-- Índices para tabela `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`idTemas`),
  ADD KEY `fk_Temas_Temas` (`idTemaPai`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuarios`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atualizacoes`
--
ALTER TABLE `atualizacoes`
  MODIFY `idAtualizacao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `perguntas`
--
ALTER TABLE `perguntas`
  MODIFY `idPerguntas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sugestoes`
--
ALTER TABLE `sugestoes`
  MODIFY `idSugestao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `temas`
--
ALTER TABLE `temas`
  MODIFY `idTemas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuarios` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `atualizacoes`
--
ALTER TABLE `atualizacoes`
  ADD CONSTRAINT `atualizacoes_ibfk_1` FOREIGN KEY (`perguntas_idPerguntas`) REFERENCES `perguntas` (`idPerguntas`) ON DELETE CASCADE,
  ADD CONSTRAINT `atualizacoes_ibfk_2` FOREIGN KEY (`Usuarios_idUsuarios`) REFERENCES `usuarios` (`idUsuarios`);

--
-- Limitadores para a tabela `perguntas`
--
ALTER TABLE `perguntas`
  ADD CONSTRAINT `perguntas_ibfk_1` FOREIGN KEY (`temas_idTemas`) REFERENCES `temas` (`idTemas`),
  ADD CONSTRAINT `perguntas_ibfk_2` FOREIGN KEY (`Usuarios_idUsuarios`) REFERENCES `usuarios` (`idUsuarios`);

--
-- Limitadores para a tabela `sugestoes`
--
ALTER TABLE `sugestoes`
  ADD CONSTRAINT `fk_Sugestoes_Temas` FOREIGN KEY (`idTema`) REFERENCES `temas` (`idTemas`);

--
-- Limitadores para a tabela `temas`
--
ALTER TABLE `temas`
  ADD CONSTRAINT `fk_Temas_Temas` FOREIGN KEY (`idTemaPai`) REFERENCES `temas` (`idTemas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
