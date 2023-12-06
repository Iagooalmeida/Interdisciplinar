-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Dez-2023 às 04:40
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
(1, 1, 1, '2023-12-05 15:03:07'),
(2, 1, 1, '2023-12-05 15:53:09'),
(3, 1, 2, '2023-12-05 15:55:11'),
(4, 1, 3, '2023-12-05 16:39:13'),
(5, 2, 3, '2023-12-05 18:25:02'),
(6, 2, 3, '2023-12-05 18:25:36'),
(7, 2, 4, '2023-12-05 19:09:02'),
(8, 1, 9, '2023-12-05 19:48:16'),
(9, 1, 9, '2023-12-05 19:51:15'),
(10, 1, 9, '2023-12-05 19:56:36'),
(11, 1, 10, '2023-12-05 20:28:10'),
(12, 1, 10, '2023-12-05 20:28:54');

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
(1, 1, 1, 'Master', 'Como faço para trancar minha matrícula?', 'De acordo com o artigo 35 do Regulamento Geral dos Cursos das Fatecs, o aluno veterano tem a opção de fazer até dois trancamentos de matrícula, seja de forma consecutiva ou não. Para solicitar o trancamento, o aluno deve comparecer à Secretaria Acadêmica da Unidade com a sua carteirinha e preencher um requerimento de solicitação de trancamento. É importante observar que o pedido de trancamento de matrícula só pode ser realizado dentro do prazo final estipulado no Calendário Acadêmico, disponível no site da Fatec de Itapira. Link abaixo:', 'Aprovado', '2023-12-05 14:45:03', '2023-12-05 15:53:09', 'Interna'),
(2, 1, 1, 'Master', 'Como fazer minha rematrícula?', 'Para fazer a rematrícula o aluno deve acessar o sistema SIGA (Sistema Integrado de Gestão Acadêmica) dentro do prazo de rematrícula, conforme previsão do Calendário de Escolar e clicar em Rematrícula. Cabe lembrar que a rematrícula só estará liberada após a entrega de todos os documentos originais solicitados pela secretaria, e após a confirmação de recebimento do e-mail com as instruções para a rematrícula.\r\n\r\nO acesso ao SIGA e o Calendário Escolar poderá ser consultados nos links abaixo:', 'Aprovado', '2023-12-05 14:48:53', '2023-12-05 15:55:11', 'Interna'),
(3, 1, 3, 'Master', 'Quando abre o vestibular?', 'O Processo Seletivo Vestibular da Fatec de Itapira para ingresso de novos alunos acontece duas vezes por ano. Essas datas costumam ser nos últimos meses de cada semestre.\r\nAs aulas para o 1º semestre geralmente começam na primeira quinzena do mês de fevereiro. Esse é o período em que os alunos aprovados no vestibular iniciam suas atividades acadêmicas na instituição.\r\nJá as aulas para o 2º semestre normalmente têm início na primeira quinzena do mês de agosto. Nesse momento, novos alunos aprovados no processo seletivo têm a oportunidade de começar sua trajetória na Fatec de Itapira.\r\n\r\nÉ importante lembrar que essas informações são baseadas em padrões gerais e podem estar sujeitas a alterações. Recomenda-se que os interessados em ingressar na Fatec de Itapira consultem o site oficial da instituição ou entrem em contato com a Fatec de Itapira para obter informações atualizadas sobre o calendário do processo seletivo e o início das aulas em cada semestre.', 'Aprovado', '2023-12-05 16:37:21', '2023-12-05 18:25:36', 'Interna'),
(4, 2, 1, 'Bob', 'Como faço para pedir um atestado?', 'Os atestados devem ser solicitados no sistema SIGA (Sistema Integrado de Gestão Acadêmica), na opção Solicitação de Documentos.\r\nApós 3 dias úteis o atestado ficará disponível na tela de Solicitação de Documentos e também será enviado para o aluno na plataforma Ms Teams.\r\n\r\nO acesso ao SIGA pode ser feito pelo seguinte Link abaixo:', 'Aprovado', '2023-12-05 19:06:38', '2023-12-05 19:09:02', 'Interna'),
(5, 2, 2, 'Bob', 'Como faço para ver o meu horário de aula?', 'De acordo com o Regulamento dos Cursos de Graduação das Fatecs existe a opção de transferência intercursos dentro das Fatecs, porém como pré-requisito o aluno deve possuir pelo menos metade das disciplinas do 1º semestre do curso desejado eliminadas com aproveitamento de estudos. Em seguida o candidato deverá acessar o site da Fatec de Itapira https://fatecitapira.edu.br e fazer o download do Edital de Transferência Interna. A divulgação do edital ocorre um pouco antes período das inscrições para transferência cujas datas estão especificadas no Calendário Escolar também disponível no site https://fatecitapira.edu.br.', 'Aprovado', '2023-12-05 19:26:06', NULL, 'Interna'),
(6, 2, 2, 'Bob', 'Perdi minha senha do e-mail, como eu resolvo?', 'O aluno que perder a sua senha do e-mail deve procurar a Secretaria Acadêmica da Unidade para solicitar a redefinição de senha do e-mail.', 'Aprovado', '2023-12-05 19:29:05', NULL, 'Interna'),
(7, 2, 2, 'Bob', 'Não consigo acessar o SIGA, como eu faço?', 'O aluno que não conseguir acessar o sistema SIGA (Sistema Integrado de Gestão Acadêmica) deverá enviar uma mensagem eletrônica, DO SEU E-MAIL INSTITUCIONAL, para o endereço f278acad@cps.sp.gov.br solicitando uma nova senha ou o desbloqueio do seu acesso. Caso o problema de acesso seja o esquecimento da senha, a Secretaria Acadêmica irá responder este e-mail com a nova senha temporária.', 'Aprovado', '2023-12-05 19:32:36', NULL, 'Interna'),
(8, 2, 6, 'Bob', 'Posso usar a biblioteca/laboratório fora do horário de aula?', 'Sim, os alunos da Fatec de Itapira têm permissão para utilizar a biblioteca e as salas de estudos fora do horário de aula, desde que esses espaços estejam abertos e haja funcionários presentes. A Fatec de Itapira reconhece a importância do acesso a recursos educacionais e espaços adequados para estudo, e, portanto, permite que os alunos façam uso dessas instalações quando disponíveis.\r\nÉ importante ressaltar que o acesso à biblioteca e às salas de estudos fora do horário de aula pode variar de acordo com as políticas internas da instituição e as restrições aplicáveis em determinados períodos. Por isso, é recomendável verificar os horários de funcionamento e as regras específicas junto à administração da Fatec de Itapira ou com os responsáveis pela biblioteca e pelas salas de estudos.', 'Aprovado', '2023-12-05 19:40:52', NULL, 'Interna'),
(9, 1, 6, 'Master', 'Qual o horário de funcionamento da biblioteca?', 'O horário de funcionamento da biblioteca e da sala de estudos neste 1º semestre de 2023 ocorre:\r\n\r\nSegunda-feira – das 14h às 19h e das 21h às 22h\r\nTerça-feira – das 17h às 22h\r\nQuarta-feira – das 13h às 22h\r\nQuinta-feira – das 18h às 20h\r\nSexta-feira – das 13h às 18h\r\nSábado – das 10h às 14h', 'Aprovado', '2023-12-05 19:42:54', '2023-12-05 19:56:36', 'Interna'),
(10, 1, 7, 'Master', 'Quais os cursos?', 'Atualmente a Fatec de Itapira oferece um total de 120 vagas, distribuídas entre os seguintes Cursos Superiores Tecnológicos:\r\n\r\n- CST em Gestão da Produção Industrial – saiba mais em\r\nhttps://fatecitapira.edu.br/gpi.html\r\n- CST em Gestão Empresarial – saiba mais em\r\nhttps://fatecitapira.edu.br/ge.html\r\n- CST em Desenvolvimento de Software Multiplataforma – saiba mais em\r\nhttps://fatecitapira.edu.br/dsm.html', 'Aprovado', '2023-12-05 20:26:02', '2023-12-05 20:28:54', 'Interna'),
(11, 1, 7, 'Master', 'Quem é o coordenador? (alunos ingressantes)', 'Cada curso na Fatec de Itapira possui um coordenador responsável por auxiliar os alunos. O Coordenador é um docente eleito pelos docentes e designado pela Direção para desempenhar um papel importante na orientação dos estudantes, no acompanhamento do currículo do curso e na resolução de questões acadêmicas relacionadas ao programa de estudos. O Coordenador do curso está disponível para esclarecer dúvidas, fornece orientações sobre disciplinas, carga horária, estágios, projetos, entre outros assuntos relacionados ao curso. Além disso, o Coordenador pode ajudar a resolver questões administrativas e fornecer informações relevantes sobre a área de estudo do curso.\r\n\r\n- CST em Gestão da Produção Industrial – Prof. José Marcos Romão Júnior\r\n(jose.romao@fatec.sp.gov.br)\r\n\r\n- CST em Gestão Empresarial – Prof. Gilberto Brandão Marcon\r\n(gilberto.marcon@fatec.sp.gov.br)\r\n\r\n- CST em Desenvolvimento de Software Multiplataforma – Profa. Márcia Regina Reggiolli\r\n(marcia.reggiolli@fatec.sp.gov.br)\r\n\r\n- CST em Gestão da Tecnologia da Informação – Prof. Mateus Guilherme Fuini\r\n(mateus.fuini@fatec.sp.gov.br)', 'Aprovado', '2023-12-05 20:48:15', NULL, 'Interna'),
(12, 1, 3, 'Master', 'Qual a pontuação mínima necessária no vestibular para ser aprovado?', 'A pontuação mínima pode variar a cada vestibular. As informações específicas sobre a pontuação mínima necessária estão disponíveis no edital do processo seletivo, divulgado pela universidade.', 'Aprovado', '2023-12-05 21:11:12', NULL, 'Interna'),
(13, 1, 1, 'Master', 'Como posso solicitar uma revisão de nota?', 'Para solicitar a revisão de nota, entre em contato com o professor da disciplina ou o departamento acadêmico responsável. Eles fornecerão informações sobre o procedimento a ser seguido.', 'Aprovado', '2023-12-05 21:26:17', NULL, 'Interna'),
(14, 3, 6, 'Alice', 'Quais são os recursos disponíveis nos laboratórios para estudantes de ciências?', 'Os laboratórios oferecem uma variedade de recursos, incluindo equipamentos especializados e materiais. Informações detalhadas podem ser obtidas junto aos professores responsáveis pelos laboratórios.', 'Aprovado', '2023-12-06 00:24:24', NULL, 'Interna'),
(15, 3, 7, 'Alice', 'Há programas de intercâmbio específicos para o meu curso?', 'Sim, a universidade oferece programas de intercâmbio específicos para diversos cursos. Consulte o departamento internacional ou o coordenador do curso para obter informações sobre as oportunidades disponíveis.', 'Aprovado', '2023-12-06 00:30:24', NULL, 'Interna'),
(16, 3, 6, 'Alice', 'Como reservar salas de estudo para grupos?', 'A reserva de salas de estudo para grupos pode ser feita através do sistema de reserva online da universidade. Consulte o site ou a biblioteca para obter informações sobre como proceder.', 'Aprovado', '2023-12-06 00:34:39', NULL, 'Interna');

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
  `DataSubmissao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `sugestoes`
--

INSERT INTO `sugestoes` (`idSugestao`, `Nome`, `Email`, `Telefone`, `ConteudoSugestao`, `Status`, `DataSubmissao`) VALUES
(3, 'Daenerys', 'dany@mail.com', '(19) 96368-3433', 'Como fazer minha rematrícula?', 'Pendente', '2023-12-05 14:48:53'),
(4, 'Alicent', 'alice@gmail.com', '(95) 42962-9895', 'Quando abre o vestibular?', 'Pendente', '2023-12-05 16:37:21'),
(5, 'Sam', 'Sam88@outlook.com', '(98) 9548-4621', 'Como faço para pedir um atestado?', 'Pendente', '2023-12-05 19:06:38');

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
(1, 'Registro Acadêmico', 'Tema Principal Relacionado com temas secundário como matricula e documentação em geral', '2023-12-01'),
(2, 'Acesso e Tecnologia', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam ducimus, dicta commodi nihil et.', '2023-12-05'),
(3, 'Vestibular', 'Tema Principal relacionado a Vestibular', '2023-12-05'),
(4, 'Estágios', 'Lista de perguntas relacionado a Estágio.', '2023-12-05'),
(5, 'Intercâmbio', 'Lista de perguntas relacionado a estudo no Exterior e Intercâmbio', '2023-12-05'),
(6, 'Recursos Acadêmicos', 'Recursos da fatec Itapira utilizado pelos aluno fatec itapira ', '2023-12-05'),
(7, 'Cursos', 'Informações sobre Cursos FATEC-ITAPIRA', '2023-12-06'),
(8, 'Matrícula', 'Tema secundário Relacionado a tema Principal Registros Acadêmico', '2023-12-06');

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
(2, 'Bob', 'user@gmail.com', '$2y$10$Fke0gQqj2ECey2jVt4NeCeYOALAvMF.mf47wX6zwWfrNJwWn2Tk6O', '(98) 59564-4695', 'Administrador(a)', 1, '2023-12-05', '2023-12-06 05:04:29', ''),
(3, 'Alice', 'alice@gmail.com', '$2y$10$C78mPvC1FBPj/to/jx61n.v4GsIOvFx2uQZ4grESMzuMX8t5uvYMa', '(98) 42658-4984', 'Coordenador(a)', 1, '2023-12-06', '2023-12-06 05:04:21', 'C:\\xampp\\htdocs\\Interdisciplinar\\Controllers/../uploads/7fd464ebcda0cca6cd430402042dc8d3.jpg');

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
  ADD PRIMARY KEY (`idSugestao`);

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
  MODIFY `idAtualizacao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `perguntas`
--
ALTER TABLE `perguntas`
  MODIFY `idPerguntas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `sugestoes`
--
ALTER TABLE `sugestoes`
  MODIFY `idSugestao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `temas`
--
ALTER TABLE `temas`
  MODIFY `idTemas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuarios` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `perguntas_ibfk_2` FOREIGN KEY (`Usuarios_idUsuarios`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE SET NULL,
  ADD CONSTRAINT `perguntas_ibfk_3` FOREIGN KEY (`temas_idTemas`) REFERENCES `temas` (`idTemas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
