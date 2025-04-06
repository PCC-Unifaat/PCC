-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/04/2025 às 03:14
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto_conclusao`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agente`
--

DROP TABLE IF EXISTS `agente`;
CREATE TABLE `agente` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `matricula` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `agente`
--

INSERT INTO `agente` (`id`, `nome`, `matricula`, `email`, `senha`, `ativo`) VALUES
(1, 'Kevin Gustavo Freire Silva', 1234, 'kevingustavo14@gmail.com', '$2a$12$QewR63.oFY8hXBX83d1Lrug6V5jKQYfk9umNAbO9aTfP2SvF4iuY2', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `comorbidade`
--

DROP TABLE IF EXISTS `comorbidade`;
CREATE TABLE `comorbidade` (
  `id` int(11) NOT NULL,
  `comorbidade` varchar(255) NOT NULL,
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comorbidade`
--

INSERT INTO `comorbidade` (`id`, `comorbidade`, `ativo`) VALUES
(1, 'diabete', 1),
(2, 'hipertensão', 1),
(3, 'teste', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `consulta`
--

DROP TABLE IF EXISTS `consulta`;
CREATE TABLE `consulta` (
  `id` int(11) NOT NULL,
  `paciente_id` int(11) DEFAULT NULL,
  `ult_consulta` date NOT NULL,
  `prox_consulta` date NOT NULL,
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `gestante`
--

DROP TABLE IF EXISTS `gestante`;
CREATE TABLE `gestante` (
  `id` int(11) NOT NULL,
  `paciente_id` int(11) DEFAULT NULL,
  `dum` date NOT NULL,
  `dpp` date NOT NULL,
  `conduta` text DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `paciente`
--

DROP TABLE IF EXISTS `paciente`;
CREATE TABLE `paciente` (
  `id` int(11) NOT NULL,
  `agente_id` int(11) DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `prontuario` varchar(10) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `nascimento` date NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `sexo` varchar(9) NOT NULL,
  `comorbidade` text DEFAULT NULL,
  `legenda` varchar(255) DEFAULT NULL,
  `vacina_dengue` tinyint(1) DEFAULT 0,
  `vacina_febre_amarela` tinyint(1) DEFAULT 0,
  `insulina` tinyint(1) DEFAULT 0,
  `gestante` tinyint(1) DEFAULT 0,
  `conduta` varchar(255) DEFAULT NULL,
  `ppn` date DEFAULT NULL,
  `observacao` text DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `paciente`
--

INSERT INTO `paciente` (`id`, `agente_id`, `nome`, `prontuario`, `cpf`, `nascimento`, `telefone`, `sexo`, `comorbidade`, `legenda`, `vacina_dengue`, `vacina_febre_amarela`, `insulina`, `gestante`, `conduta`, `ppn`, `observacao`, `ativo`) VALUES
(1, 1, 'Kevin', '', '132.456.465-78', '2001-10-23', NULL, '', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, 1),
(3, 1, 'puericultura 1', '', '000.000.000-00', '2025-04-01', NULL, '', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, 1),
(4, 1, 'puericultura 2', '', '325.421.341-23', '2025-03-30', NULL, '', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, 1),
(5, 1, 'puericultura 3', '', '345.342.234-32', '2025-01-05', NULL, '', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, 1),
(6, 1, 'Criança 1', '', '432.424.532-54', '2015-01-04', NULL, '', NULL, NULL, 1, 0, 0, 0, NULL, NULL, NULL, 1),
(7, 1, 'Criança 2', '', '543.543.6', '2011-01-13', NULL, '', NULL, NULL, 0, 1, 0, 0, NULL, NULL, NULL, 1),
(10, 1, 'idoso 1', '', '356.765.435', '1960-01-01', NULL, '', '1,2', NULL, 0, 0, 0, 0, NULL, NULL, NULL, 1),
(14, 1, 'Idoso 2', '', '654.543.532-42', '1955-05-01', NULL, '', '2', NULL, 0, 0, 0, 0, NULL, NULL, NULL, 1),
(15, 1, 'idoso 3', '', '654.543.532-41', '1920-02-02', NULL, '', '1,2,3', NULL, 0, 0, 0, 0, NULL, NULL, NULL, 1),
(16, 1, 'Kevin', '', '424.581.868-90', '2025-04-01', '', 'masculino', '1,2', NULL, 0, 0, 0, 0, NULL, NULL, NULL, 1),
(17, 1, 'hipertenso', '', '165.465.321-65', '2025-02-02', '', 'feminino', '1,3', NULL, 0, 0, 0, 0, NULL, NULL, NULL, 1),
(19, 1, 'Mulher 1', '', '424.581.868-00', '2000-01-05', '', 'feminino', '1', NULL, 0, 0, 0, 0, NULL, NULL, NULL, 1),
(20, 1, 'mulher 2', '010.16.546', '454.864.644-54', '1995-01-05', '', 'feminino', '2', NULL, 0, 0, 0, 0, NULL, NULL, NULL, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agente`
--
ALTER TABLE `agente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matricula` (`matricula`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `comorbidade`
--
ALTER TABLE `comorbidade`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paciente_id` (`paciente_id`);

--
-- Índices de tabela `gestante`
--
ALTER TABLE `gestante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paciente_id` (`paciente_id`);

--
-- Índices de tabela `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD KEY `agente_id` (`agente_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agente`
--
ALTER TABLE `agente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `comorbidade`
--
ALTER TABLE `comorbidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `consulta`
--
ALTER TABLE `consulta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `gestante`
--
ALTER TABLE `gestante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `consulta`
--
ALTER TABLE `consulta`
  ADD CONSTRAINT `consulta_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`);

--
-- Restrições para tabelas `gestante`
--
ALTER TABLE `gestante`
  ADD CONSTRAINT `gestante_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`);

--
-- Restrições para tabelas `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `paciente_ibfk_1` FOREIGN KEY (`agente_id`) REFERENCES `agente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
