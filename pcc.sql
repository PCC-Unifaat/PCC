-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/03/2025 às 23:43
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
-- Banco de dados: `pcc`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.agente`
--

DROP TABLE IF EXISTS `tb_admin.agente`;
CREATE TABLE `tb_admin.agente` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `matricula` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `area_micro` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cnes` int(11) NOT NULL,
  `email_verificado` varchar(255) NOT NULL,
  `token_autenticacao` varchar(255) NOT NULL,
  `token_senha` varchar(255) NOT NULL,
  `expiry_token` datetime DEFAULT NULL,
  `master` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.agente`
--

INSERT INTO `tb_admin.agente` (`id`, `nome`, `matricula`, `email`, `area_micro`, `senha`, `cnes`, `email_verificado`, `token_autenticacao`, `token_senha`, `expiry_token`, `master`, `status`) VALUES
(10, 'Kevin Gustavo Freire Silva', 0, 'kevingustavo14@gmail.com', '008.06', '$2a$12$PPUcHy5kUADWc4.1W9Fxqe1eevWCTiSAmK3rjGdig9O2YIhlbeOcK', 3251519, 'verificado', 'de987078e39180a3ee3aea096f68a16ff299e7e47ddc350044c63165e9ceccb6eb5d383f01a5a1a75aac1e97d0df16587767', '7c395f4b60965f948eb03218d585aa55931f6324c3dd83dbb3386e153bedae120ca49d706077b5aa2bb95e0c176e7e6dd277', '2024-12-17 23:58:07', 1, 'ativo'),
(15, 'Kevin', 0, 'kevingfreire@gmail.com', '008.57', '$2a$08$MTg4NTYyMjIzODY2ZjZjM.zylrPBl3Ik8DEYg74Q.cqlG1QEaoz1q', 3251519, '', '', '', NULL, 0, 'ativo'),
(16, 'Kevin', 0, 'kevi@gmail.com', '008.07', '$2a$08$MjEzNDM4Mzk2NmZhYTNjNOZiKZ4YQzblqMmlvEMxOmQl5InywyTGC', 3251519, '', '', '', NULL, 0, 'ativo'),
(17, 'GISLAINE FREIRE', 0, 'gislaineacs.imperial@gmail.com', '008.06', '$2a$08$MTAxMzc5OTg1NTY3MWE5ZewXCrmXd1GIXAo9ASF0ojTIouF/WJoj6', 3251519, '', '', '', NULL, 0, 'ativo'),
(19, 'Kevin', 123456, 'kevin.silva@atibaia.sp.gov.br', '123', '$2a$08$MjA5MDU3ODA4OTY3NWMzZeWBBzbRUDtVYmQHuhmyPgTuPS15jYBnO', 3251519, 'verificado', '37a683de0f22797224f24aba13f0ef6f79ca3e3655ea74a7c55bc976c98260e5d7228644779f018d1c227a19e9af7bc11e16', '', NULL, 0, 'ativo'),
(20, 'Kevin', 123456, 'teste@exemplo.us', '566.56', '$2a$08$NzM2Njc5MTA5NjdiYzYzNu4uF0fNB3uzcq8H7uJU7urNUaF5rtZyG', 3251519, '', '14ff2c80feb02baaf262924f5a58471ca015c48270f6b36e505ba269efb10aad7ce9f1a6a3e48d53b6c1b9cc06822881600c', '', '0000-00-00 00:00:00', 0, 'ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.estabelecimento`
--

DROP TABLE IF EXISTS `tb_admin.estabelecimento`;
CREATE TABLE `tb_admin.estabelecimento` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cnes` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.estabelecimento`
--

INSERT INTO `tb_admin.estabelecimento` (`id`, `nome`, `cnes`, `status`) VALUES
(1, 'USF Ana Nery Atibaia', 3251519, 'ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.remedio`
--

DROP TABLE IF EXISTS `tb_admin.remedio`;
CREATE TABLE `tb_admin.remedio` (
  `id` int(11) NOT NULL,
  `principio_ativo` varchar(255) NOT NULL,
  `unidade_medida` varchar(255) NOT NULL,
  `dosagem` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `estabelecimento_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.remedio`
--

INSERT INTO `tb_admin.remedio` (`id`, `principio_ativo`, `unidade_medida`, `dosagem`, `tipo`, `estabelecimento_id`, `status`) VALUES
(18, 'Dipirona', 'mg', 500, 'comprimido', 1, 'ativo'),
(19, 'losartana', 'mg', 100, 'comprimido', 1, 'ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuario.paciente`
--

DROP TABLE IF EXISTS `tb_usuario.paciente`;
CREATE TABLE `tb_usuario.paciente` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(255) NOT NULL,
  `familia` varchar(255) NOT NULL,
  `agente_id` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_usuario.paciente`
--

INSERT INTO `tb_usuario.paciente` (`id`, `nome`, `rua`, `bairro`, `numero`, `complemento`, `familia`, `agente_id`, `foto`, `status`) VALUES
(8, 'Kevin Gustavo Freire Silva', 'Rua Tamandaré', 'Jardim Imperial', 2, 'FUNDOS', '008.06.003', 17, '', 'ativo'),
(10, 'Maria Serafina de Oliveira', 'Avenida Imperial', 'Jardim Imperial', 12, '', '008.06.122', 10, '672bf07b4e0fe.png', 'inativo'),
(11, 'Kevin Gustavo Freire Silva', 'Rua Brasil', 'Jardim Imperial', 560, '', '008.06.157', 10, '675b0ad046e2d.jpeg', 'inativo'),
(13, 'GISLAINE FREIRE', 'Rua Tamandaré', 'Jardim Imperial', 1010, '', '008.06.111', 10, '', 'ativo'),
(14, 'Maria José dos Santos', 'Rua Tamandaré', 'Jardim Imperial', 103, '', '123.15.615', 19, '676174fa7e5e5.jpg', 'ativo'),
(15, 'Alex', 'Rua Minerva', 'Jardim Imperial', 123, '', '008.06.564', 10, '67b516badc40f.jpeg', 'ativo'),
(16, 'Kevin', 'Rua Maracanã', 'Jardim Imperial', 580, '', '008.06.007', 10, '67b5164368f4d.png', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuario.receita`
--

DROP TABLE IF EXISTS `tb_usuario.receita`;
CREATE TABLE `tb_usuario.receita` (
  `id` int(11) NOT NULL,
  `paciente_id` int(11) NOT NULL,
  `foto_frente` varchar(255) NOT NULL,
  `foto_verso` varchar(255) NOT NULL,
  `remedio_id` int(11) NOT NULL,
  `horario` time NOT NULL,
  `dosagem_receita` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_usuario.receita`
--

INSERT INTO `tb_usuario.receita` (`id`, `paciente_id`, `foto_frente`, `foto_verso`, `remedio_id`, `horario`, `dosagem_receita`, `status`) VALUES
(54, 13, '67b3613846ad3.jpeg', '', 19, '12:00:00', 1, 'ativo');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_admin.agente`
--
ALTER TABLE `tb_admin.agente`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_admin.estabelecimento`
--
ALTER TABLE `tb_admin.estabelecimento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_admin.remedio`
--
ALTER TABLE `tb_admin.remedio`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_usuario.paciente`
--
ALTER TABLE `tb_usuario.paciente`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_usuario.receita`
--
ALTER TABLE `tb_usuario.receita`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_admin.agente`
--
ALTER TABLE `tb_admin.agente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `tb_admin.estabelecimento`
--
ALTER TABLE `tb_admin.estabelecimento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_admin.remedio`
--
ALTER TABLE `tb_admin.remedio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `tb_usuario.paciente`
--
ALTER TABLE `tb_usuario.paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `tb_usuario.receita`
--
ALTER TABLE `tb_usuario.receita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
