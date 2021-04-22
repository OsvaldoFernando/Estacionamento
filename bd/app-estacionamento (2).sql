-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Abr-2021 às 00:30
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `app-estacionamento`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `formas_pagamentos`
--

CREATE TABLE `formas_pagamentos` (
  `forma_pagamento_id` int(11) NOT NULL,
  `forma_pagamento_nome` varchar(45) DEFAULT NULL,
  `forma_pagamento_aceita_parc` tinyint(1) DEFAULT NULL,
  `forma_pagamento_ativa` tinyint(1) DEFAULT NULL,
  `forma_pagamento_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `formas_pagamentos`
--

INSERT INTO `formas_pagamentos` (`forma_pagamento_id`, `forma_pagamento_nome`, `forma_pagamento_aceita_parc`, `forma_pagamento_ativa`, `forma_pagamento_data_alteracao`) VALUES
(1, 'Cartão de crédito', 0, 1, '2021-02-07 05:40:58'),
(3, 'Boleto bancário', 1, 0, '2020-01-29 21:44:14'),
(4, 'Multicaixa Express', NULL, 0, '2021-02-07 05:53:58'),
(5, 'Dinheiro', NULL, 0, '2021-02-07 06:01:07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensalidades`
--

CREATE TABLE `mensalidades` (
  `mensalidade_id` int(11) NOT NULL,
  `mensalidade_mensalista_id` int(11) NOT NULL,
  `mensalidade_precificacao_id` int(11) NOT NULL,
  `mensalidade_valor_mensalidade` varchar(20) NOT NULL,
  `mensalidade_mensalista_dia_vencimento` int(11) NOT NULL,
  `mensalidade_data_vencimento` date NOT NULL,
  `mensalidade_data_pagamento` datetime DEFAULT NULL,
  `mensalidade_status` tinyint(1) NOT NULL,
  `mensalidade_data_alteracao` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `mensalidades`
--

INSERT INTO `mensalidades` (`mensalidade_id`, `mensalidade_mensalista_id`, `mensalidade_precificacao_id`, `mensalidade_valor_mensalidade`, `mensalidade_mensalista_dia_vencimento`, `mensalidade_data_vencimento`, `mensalidade_data_pagamento`, `mensalidade_status`, `mensalidade_data_alteracao`) VALUES
(1, 1, 1, '500', 5, '2021-02-05', '2021-03-22 13:36:20', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensalistas`
--

CREATE TABLE `mensalistas` (
  `mensalista_id` int(11) NOT NULL,
  `mensalista_data_cadastro` timestamp NULL DEFAULT current_timestamp(),
  `mensalista_nome` varchar(45) NOT NULL,
  `mensalista_sobrenome` varchar(150) NOT NULL,
  `mensalista_data_nascimento` date DEFAULT NULL,
  `mensalista_email` varchar(50) NOT NULL,
  `mensalista_telefone_movel` varchar(9) NOT NULL,
  `mensalista_endereco` varchar(155) NOT NULL,
  `mensalista_bairro` varchar(45) NOT NULL,
  `mensalista_cidade` varchar(105) NOT NULL,
  `mensalista_complemento` varchar(145) NOT NULL,
  `mensalista_ativo` tinyint(1) NOT NULL,
  `mensalista_dia_vencimento` int(11) NOT NULL,
  `mensalista_obs` tinytext DEFAULT NULL,
  `mensalista_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mensalistas`
--

INSERT INTO `mensalistas` (`mensalista_id`, `mensalista_data_cadastro`, `mensalista_nome`, `mensalista_sobrenome`, `mensalista_data_nascimento`, `mensalista_email`, `mensalista_telefone_movel`, `mensalista_endereco`, `mensalista_bairro`, `mensalista_cidade`, `mensalista_complemento`, `mensalista_ativo`, `mensalista_dia_vencimento`, `mensalista_obs`, `mensalista_data_alteracao`) VALUES
(1, '2020-03-13 22:00:02', 'Osvaldo', 'Queta', '2020-03-13', 'osvaldo@gmail.com', '926219731', 'Rua de Xirimbimbi', 'Centro', 'Malanje', '', 1, 5, '', '2021-02-20 07:47:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `precificacoes`
--

CREATE TABLE `precificacoes` (
  `precificacao_id` int(11) NOT NULL,
  `precificacao_categoria` varchar(50) NOT NULL,
  `precificacao_valor_hora` varchar(50) NOT NULL,
  `precificacao_valor_mensalidade` varchar(20) NOT NULL,
  `precificacao_numero_vagas` int(11) NOT NULL,
  `precificacao_ativa` tinyint(1) NOT NULL,
  `precificacao_data_alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `precificacoes`
--

INSERT INTO `precificacoes` (`precificacao_id`, `precificacao_categoria`, `precificacao_valor_hora`, `precificacao_valor_mensalidade`, `precificacao_numero_vagas`, `precificacao_ativa`, `precificacao_data_alteracao`) VALUES
(1, 'Veículo pequeno', '10', '500', 20, 1, '2021-03-22 05:43:07'),
(2, 'Veículo Médio', '1000', '1500', 30, 1, '2021-03-22 05:42:57'),
(3, 'Veículo grande', '50', '5000', 10, 1, '2021-03-22 06:31:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sistema`
--

CREATE TABLE `sistema` (
  `sistema_id` int(11) NOT NULL,
  `sistema_razao_social` varchar(145) DEFAULT NULL,
  `sistema_nome_fantasia` varchar(145) DEFAULT NULL,
  `sistema_cnpj` varchar(25) DEFAULT NULL,
  `sistema_ie` varchar(25) DEFAULT NULL,
  `sistema_telefone_fixo` varchar(25) DEFAULT NULL,
  `sistema_telefone_movel` varchar(25) NOT NULL,
  `sistema_email` varchar(100) DEFAULT NULL,
  `sistema_site_url` varchar(100) DEFAULT NULL,
  `sistema_cep` varchar(25) DEFAULT NULL,
  `sistema_endereco` varchar(145) DEFAULT NULL,
  `sistema_numero` varchar(25) DEFAULT NULL,
  `sistema_cidade` varchar(45) DEFAULT NULL,
  `sistema_estado` varchar(2) DEFAULT NULL,
  `sistema_texto_ticket` tinytext DEFAULT NULL,
  `sistema_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sistema`
--

INSERT INTO `sistema` (`sistema_id`, `sistema_razao_social`, `sistema_nome_fantasia`, `sistema_cnpj`, `sistema_ie`, `sistema_telefone_fixo`, `sistema_telefone_movel`, `sistema_email`, `sistema_site_url`, `sistema_cep`, `sistema_endereco`, `sistema_numero`, `sistema_cidade`, `sistema_estado`, `sistema_texto_ticket`, `sistema_data_alteracao`) VALUES
(1, 'Park Now System - teste', 'Park Now', NULL, NULL, '+244 926219731', '+244 926219731', 'osvaldoqueta8891de72@outlook.com', 'http://localhost/app-estacionamento/', NULL, 'Malanje', NULL, NULL, NULL, 'Novo conceito', '2021-01-30 04:53:07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `data_ultima_alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `data_ultima_alteracao`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$12$OSO6Rq95xD1CTg5Gf1JoD.VrNmtpmIlI4mIaSklpc2gitDinCAJNe', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1619109846, 1, 'Osvaldo', 'Queta', 'ADMIN', '926219731', '2021-04-22 16:44:06'),
(4, '::1', 'leliltangola', '$2y$10$to/j0bQ7lLT2fzLCgKKthOTIKh8qxKf8YizpL.9JtsLUX6Vf4FgYu', 'lelita@lelita.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1610878326, NULL, 0, 'Lelita', 'Ngola', NULL, NULL, '2021-01-17 10:12:06'),
(5, '::1', 'delfinachinawandela', '$2y$10$X/sDugjqHB0f55sNZqzGX.hdz66hCnX4uzi5Qy36ZCbM31vf5MT9O', 'delfina@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1610883982, NULL, 1, 'Delfina Chitula', 'Chinawandela', NULL, NULL, '2021-01-23 11:54:26'),
(6, '::1', 'Isabel Sengo', '$2y$10$2V1uwzmeFxAufqGVm6rQXeFK6iNfj9He3AM2fQ7GXfwlutUY29TXS', 'isabel@isabel.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1612311965, NULL, 1, 'Isabel', 'Sengo', NULL, NULL, '2021-02-03 00:26:05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(10, 1, 1),
(8, 4, 2),
(9, 5, 1),
(11, 6, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `formas_pagamentos`
--
ALTER TABLE `formas_pagamentos`
  ADD PRIMARY KEY (`forma_pagamento_id`);

--
-- Índices para tabela `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `mensalidades`
--
ALTER TABLE `mensalidades`
  ADD PRIMARY KEY (`mensalidade_id`);

--
-- Índices para tabela `mensalistas`
--
ALTER TABLE `mensalistas`
  ADD PRIMARY KEY (`mensalista_id`);

--
-- Índices para tabela `precificacoes`
--
ALTER TABLE `precificacoes`
  ADD PRIMARY KEY (`precificacao_id`);

--
-- Índices para tabela `sistema`
--
ALTER TABLE `sistema`
  ADD PRIMARY KEY (`sistema_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Índices para tabela `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `formas_pagamentos`
--
ALTER TABLE `formas_pagamentos`
  MODIFY `forma_pagamento_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `mensalidades`
--
ALTER TABLE `mensalidades`
  MODIFY `mensalidade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `mensalistas`
--
ALTER TABLE `mensalistas`
  MODIFY `mensalista_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `precificacoes`
--
ALTER TABLE `precificacoes`
  MODIFY `precificacao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `sistema`
--
ALTER TABLE `sistema`
  MODIFY `sistema_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
