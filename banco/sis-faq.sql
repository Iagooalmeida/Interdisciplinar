-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Dez-2023 às 23:28
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.0.30

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
  `atualizar_fk_idUsuarios` int(10) UNSIGNED NOT NULL,
  `atualizar_fk_idPerguntas` int(10) UNSIGNED NOT NULL,
  `DataAtualizacao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `atualizacoes`
--

INSERT INTO `atualizacoes` (`idAtualizacao`, `atualizar_fk_idUsuarios`, `atualizar_fk_idPerguntas`, `DataAtualizacao`) VALUES
(9, 1, 9, '2023-11-26 04:02:45'),
(10, 1, 9, '2023-11-27 20:10:17'),
(11, 1, 9, '2023-11-27 20:16:13'),
(12, 1, 9, '2023-11-27 20:16:20'),
(13, 1, 9, '2023-11-27 21:09:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perguntas`
--

CREATE TABLE `perguntas` (
  `idPerguntas` int(10) UNSIGNED NOT NULL,
  `Usuarios_idUsuarios` int(10) UNSIGNED DEFAULT NULL,
  `temas_idTemas` int(10) UNSIGNED NOT NULL,
  `Autor` varchar(30) DEFAULT NULL,
  `ConteudoPergunta` text NOT NULL,
  `Resposta` text DEFAULT NULL,
  `Status` varchar(50) DEFAULT 'Pendente',
  `DataSubmissao` datetime NOT NULL DEFAULT current_timestamp(),
  `UltimaAtualizacao` datetime DEFAULT NULL,
  `Origem` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `perguntas`
--

INSERT INTO `perguntas` (`idPerguntas`, `Usuarios_idUsuarios`, `temas_idTemas`, `Autor`, `ConteudoPergunta`, `Resposta`, `Status`, `DataSubmissao`, `UltimaAtualizacao`, `Origem`) VALUES
(1, 1, 2, 'Master', 'Como faço para fazer a rematricula ?', 'Aguardando respostas', 'Pendente', '2023-11-26 03:35:42', NULL, 'Interna'),
(4, 1, 2, 'Master', 'Como faço para pedir um atestado?', 'Os atestados devem ser solicitados no sistema SIGA (Sistema Integrado de Gestão Acadêmica), na opção Solicitação de Documentos.\r\n\r\nApós 3 dias úteis o atestado ficará disponível na tela de Solicitação de Documentos e também será enviado para o aluno na plataforma Ms Teams.', 'Aprovado', '2023-11-11 01:28:39', '2023-11-11 01:30:05', 'Interna'),
(5, 1, 2, 'Master', 'Como faço para trancar minha matrícula?', 'De acordo com o artigo 35 do Regulamento Geral dos Cursos das Fatecs, o aluno veterano tem a opção de fazer até dois trancamentos de matrícula, seja de forma consecutiva ou não. Para solicitar o trancamento, o aluno deve comparecer à Secretaria Acadêmica da Unidade com a sua carteirinha e preencher um requerimento de solicitação de trancamento. É importante observar que o pedido de trancamento de matrícula só pode ser realizado dentro do prazo final estipulado no Calendário Acadêmico, disponível no site da Fatec de Itapira. Link abaixo:', 'Aprovado', '2023-11-14 17:12:57', NULL, 'Interna'),
(9, 1, 3, 'Master', 'Como eu faço para me escrever no intercambio ?', 'Pelo site https://fatecItapira.com', 'Aprovado', '2023-11-23 17:52:55', '2023-11-27 21:09:14', 'Interna');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `sugestoes`
--

INSERT INTO `sugestoes` (`idSugestao`, `Nome`, `Email`, `Telefone`, `ConteudoSugestao`, `Status`, `DataSubmissao`, `idTema`) VALUES
(2, 'Teste', 'teste@teste.com.br', '(19) 78965-9824', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt, eligendi aliquam. Molestiae minima nostrum aspernatur error ipsam harum laudantium debitis adipisci accusantium nesciunt ratione quibusdam maxime, temporibus nobis ad possimus!', 'Pendente', '2023-11-27 01:20:30', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `temas`
--

CREATE TABLE `temas` (
  `idTemas` int(10) UNSIGNED NOT NULL,
  `NomeTema` varchar(50) NOT NULL,
  `descricaoTema` text DEFAULT NULL,
  `dataCadastro` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `temas`
--

INSERT INTO `temas` (`idTemas`, `NomeTema`, `descricaoTema`, `dataCadastro`) VALUES
(2, 'Matricula', 'Matricula Refere a um tema principal que será exibido na página faq.', '2023-12-01'),
(3, 'Intercambio', NULL, '2023-12-01'),
(4, 'Documentação', 'Teste', '2023-12-01');

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
  `DataCadastro` date NOT NULL,
  `DataUltimaAtualizacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `FotoPath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuarios`, `NomeUsuario`, `Email`, `Senha`, `Tel_Cel`, `Funcao`, `NivelAcesso`, `DataCadastro`, `DataUltimaAtualizacao`, `FotoPath`) VALUES
(1, 'Master', 'master@master.com', '$2y$10$9h6mcR.7yI7.vFsNfWx4vOVcpbuovwwIYnTI9jjxpn3QcGqnPaCOi', '(19) 9999-9999', 'Administrador', 0, '2023-11-11', '2023-11-11 02:14:09', NULL),
(3, 'User', 'user.01@gmail.com', '$2y$10$TQlLfiQ4TcyVXPzAU0W1cuTPvPCkjzW/PFwytaVenRrepyppfUKhi', '(19) 9999-9999', 'Administrador', 1, '2023-11-11', '2023-11-11 09:52:03', 'C:\\xampp\\htdocs\\Teste\\Controllers/../uploads/3bbb2337b185347c6827254600d741f5.jpg'),
(4, 'User 02', 'User.03@gmail.com', '$2y$10$lFVqX3hB.lNb9Dh2tedHzuaGgFl3E19f2x3Pw.pO74eX7jyKumIXK', '(78) 96416-5368', 'Administrador', 1, '2023-11-11', '2023-11-24 10:15:43', ''),
(5, 'Teste', 'teste2023@gmail.com', '$2y$10$CTboux/Omxb/E8naNGQ5G.toEoeqhdd62zYh6wV3//DhREZLdodTa', '(78) 99989-8989', 'Administrador', 1, '2023-11-26', '2023-11-26 07:06:34', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `atualizacoes`
--
ALTER TABLE `atualizacoes`
  ADD PRIMARY KEY (`idAtualizacao`),
  ADD KEY `idx_atualizacoes_perguntas` (`atualizar_fk_idPerguntas`),
  ADD KEY `idx_atualizacoes_usuarios` (`atualizar_fk_idUsuarios`);

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
  ADD PRIMARY KEY (`idTemas`);

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
  MODIFY `idAtualizacao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `perguntas`
--
ALTER TABLE `perguntas`
  MODIFY `idPerguntas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `sugestoes`
--
ALTER TABLE `sugestoes`
  MODIFY `idSugestao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `temas`
--
ALTER TABLE `temas`
  MODIFY `idTemas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuarios` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `atualizacoes`
--
ALTER TABLE `atualizacoes`
  ADD CONSTRAINT `atualizacoes_ibfk_1` FOREIGN KEY (`atualizar_fk_idPerguntas`) REFERENCES `perguntas` (`idPerguntas`) ON DELETE CASCADE,
  ADD CONSTRAINT `atualizacoes_ibfk_2` FOREIGN KEY (`atualizar_fk_idUsuarios`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `perguntas`
--
ALTER TABLE `perguntas`
  ADD CONSTRAINT `perguntas_ibfk_1` FOREIGN KEY (`temas_idTemas`) REFERENCES `temas` (`idTemas`),
  ADD CONSTRAINT `perguntas_ibfk_2` FOREIGN KEY (`Usuarios_idUsuarios`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE SET NULL;

--
-- Limitadores para a tabela `sugestoes`
--
ALTER TABLE `sugestoes`
  ADD CONSTRAINT `fk_Sugestoes_Temas` FOREIGN KEY (`idTema`) REFERENCES `temas` (`idTemas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
