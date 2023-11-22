-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/11/2023 às 22:51
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

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
-- Estrutura para tabela `atualizacoes`
--

CREATE TABLE `atualizacoes` (
  `idAtualizacao` int(10) UNSIGNED NOT NULL,
  `Usuarios_idUsuarios` int(10) UNSIGNED NOT NULL,
  `perguntas_idPerguntas` int(10) UNSIGNED NOT NULL,
  `DataAtualizacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `perguntas`
--

CREATE TABLE `perguntas` (
  `idPerguntas` int(10) UNSIGNED NOT NULL,
  `Usuarios_idUsuarios` int(10) UNSIGNED DEFAULT NULL,
  `temas_idTemas` int(10) UNSIGNED NOT NULL,
  `Autor` varchar(30) DEFAULT NULL,
  `ConteudoPergunta` text NOT NULL,
  `Resposta` text DEFAULT 'Aguardando Resposta',
  `Status` varchar(50) DEFAULT 'Pendente',
  `DataSubmissao` datetime NOT NULL DEFAULT current_timestamp(),
  `UltimaAtualizacao` datetime DEFAULT NULL,
  `Visivel` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `perguntas`
--

INSERT INTO `perguntas` (`idPerguntas`, `Usuarios_idUsuarios`, `temas_idTemas`, `Autor`, `ConteudoPergunta`, `Resposta`, `Status`, `DataSubmissao`, `UltimaAtualizacao`, `Visivel`) VALUES
(3, 1, 2, 'Master', 'Como fazer a rematrícula ?', 'Para obter o horário de aula atualizado da Fatec de Itapira, aconselho acessar o site oficial da instituição. Lá, você encontrará informações detalhadas sobre os horários de aula de cada curso oferecido, bem como outras informações relevantes sobre a instituição. \r\nÉ sempre recomendável verificar o site da Fatec de Itapira regularmente, pois o horário de aula pode ser atualizado a cada semestre ou período letivo.', 'Aprovado', '2023-11-10 04:02:50', NULL, 1),
(4, 1, 2, 'Master', 'Como faço para pedir um atestado?', 'Os atestados devem ser solicitados no sistema SIGA (Sistema Integrado de Gestão Acadêmica), na opção Solicitação de Documentos.\r\n\r\nApós 3 dias úteis o atestado ficará disponível na tela de Solicitação de Documentos e também será enviado para o aluno na plataforma Ms Teams.', 'Aprovado', '2023-11-11 01:28:39', '2023-11-11 01:30:05', 1),
(5, 1, 2, 'Master', 'Como faço para trancar minha matrícula?', 'De acordo com o artigo 35 do Regulamento Geral dos Cursos das Fatecs, o aluno veterano tem a opção de fazer até dois trancamentos de matrícula, seja de forma consecutiva ou não. Para solicitar o trancamento, o aluno deve comparecer à Secretaria Acadêmica da Unidade com a sua carteirinha e preencher um requerimento de solicitação de trancamento. É importante observar que o pedido de trancamento de matrícula só pode ser realizado dentro do prazo final estipulado no Calendário Acadêmico, disponível no site da Fatec de Itapira. Link abaixo:', 'Aprovado', '2023-11-14 17:12:57', NULL, 1),
(6, 2, 1, 'Tux Linux', 'Como faço para ver o meu horário de aula?', 'Aguardando Resposta', 'Pendente', '2023-11-14 17:17:44', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sugestoes`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `temas`
--

CREATE TABLE `temas` (
  `idTemas` int(10) UNSIGNED NOT NULL,
  `NomeTema` varchar(50) NOT NULL,
  `idTemaPai` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `temas`
--

INSERT INTO `temas` (`idTemas`, `NomeTema`, `idTemaPai`) VALUES
(1, 'Documentação', NULL),
(2, 'Matricula', NULL),
(3, 'Intercambio', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuarios`, `NomeUsuario`, `Email`, `Senha`, `Tel_Cel`, `Funcao`, `NivelAcesso`, `DataCadastro`, `DataUltimaAtualizacao`, `FotoPath`) VALUES
(1, 'Master', 'master@master.com', '$2y$10$9h6mcR.7yI7.vFsNfWx4vOVcpbuovwwIYnTI9jjxpn3QcGqnPaCOi', '(19) 9999-9999', 'Administrador', 0, '2023-11-11', '2023-11-11 02:14:09', NULL),
(2, 'Tux Linux', 'user@gmail.com', '$2y$10$4/ZVhacUkpM4Kdx.U5ykMOQmiWjTZXKBh.4r6U3SdTqkIlwzB4yrC', '', 'Coordenador', 1, '2023-11-11', '2023-11-14 09:26:35', 'C:\\xampp\\htdocs\\Teste\\Controllers/../uploads/c8541bcff461b1d589d67cc503570c4c.png'),
(3, 'User', 'user.01@gmail.com', '$2y$10$TQlLfiQ4TcyVXPzAU0W1cuTPvPCkjzW/PFwytaVenRrepyppfUKhi', '(19) 9999-9999', 'Administrador', 1, '2023-11-11', '2023-11-11 09:52:03', 'C:\\xampp\\htdocs\\Teste\\Controllers/../uploads/3bbb2337b185347c6827254600d741f5.jpg'),
(4, 'User 02', 'User.03@gmail.com', '$2y$10$lFVqX3hB.lNb9Dh2tedHzuaGgFl3E19f2x3Pw.pO74eX7jyKumIXK', '', 'Administrador', 1, '2023-11-11', '2023-11-11 03:45:23', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `atualizacoes`
--
ALTER TABLE `atualizacoes`
  ADD PRIMARY KEY (`idAtualizacao`),
  ADD KEY `idx_atualizacoes_perguntas` (`perguntas_idPerguntas`),
  ADD KEY `idx_atualizacoes_usuarios` (`Usuarios_idUsuarios`);

--
-- Índices de tabela `perguntas`
--
ALTER TABLE `perguntas`
  ADD PRIMARY KEY (`idPerguntas`),
  ADD KEY `idx_perguntas_temas` (`temas_idTemas`),
  ADD KEY `idx_perguntas_usuarios` (`Usuarios_idUsuarios`);

--
-- Índices de tabela `sugestoes`
--
ALTER TABLE `sugestoes`
  ADD PRIMARY KEY (`idSugestao`),
  ADD KEY `fk_Sugestoes_Temas` (`idTema`);

--
-- Índices de tabela `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`idTemas`),
  ADD KEY `temas_ibfk_1` (`idTemaPai`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuarios`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT para tabelas despejadas
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
  MODIFY `idPerguntas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `sugestoes`
--
ALTER TABLE `sugestoes`
  MODIFY `idSugestao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `temas`
--
ALTER TABLE `temas`
  MODIFY `idTemas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuarios` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `atualizacoes`
--
ALTER TABLE `atualizacoes`
  ADD CONSTRAINT `atualizacoes_ibfk_1` FOREIGN KEY (`perguntas_idPerguntas`) REFERENCES `perguntas` (`idPerguntas`) ON DELETE CASCADE,
  ADD CONSTRAINT `atualizacoes_ibfk_2` FOREIGN KEY (`Usuarios_idUsuarios`) REFERENCES `usuarios` (`idUsuarios`);

--
-- Restrições para tabelas `perguntas`
--
ALTER TABLE `perguntas`
  ADD CONSTRAINT `perguntas_ibfk_1` FOREIGN KEY (`temas_idTemas`) REFERENCES `temas` (`idTemas`),
  ADD CONSTRAINT `perguntas_ibfk_2` FOREIGN KEY (`Usuarios_idUsuarios`) REFERENCES `usuarios` (`idUsuarios`);

--
-- Restrições para tabelas `sugestoes`
--
ALTER TABLE `sugestoes`
  ADD CONSTRAINT `fk_Sugestoes_Temas` FOREIGN KEY (`idTema`) REFERENCES `temas` (`idTemas`);

--
-- Restrições para tabelas `temas`
--
ALTER TABLE `temas`
  ADD CONSTRAINT `temas_ibfk_1` FOREIGN KEY (`idTemaPai`) REFERENCES `temas` (`idTemas`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
