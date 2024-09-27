-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/09/2024 às 00:47
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
-- Banco de dados: `keycontroldb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cad_pessoas`
--

CREATE TABLE `cad_pessoas` (
  `id_pessoas` int(11) NOT NULL,
  `nome` char(1) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `endereco` char(1) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `cep` int(11) DEFAULT NULL,
  `bairro` char(1) DEFAULT NULL,
  `telefone` int(11) DEFAULT NULL,
  `email` char(1) DEFAULT NULL,
  `rg` int(11) DEFAULT NULL,
  `cpf` int(11) DEFAULT NULL,
  `locador` tinyint(1) DEFAULT NULL,
  `id_imobiliaria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `imobiliaria`
--

CREATE TABLE `imobiliaria` (
  `id_imobiliaria` int(11) DEFAULT NULL,
  `nome` char(1) DEFAULT NULL,
  `cnpj` int(11) DEFAULT NULL,
  `endereco` char(1) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `cep` int(11) DEFAULT NULL,
  `cidade` char(1) DEFAULT NULL,
  `telefone` char(1) DEFAULT NULL,
  `email` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `imovel`
--

CREATE TABLE `imovel` (
  `id_pessoas` int(11) DEFAULT NULL,
  `id_imovel` int(11) NOT NULL,
  `data_cadastro` date DEFAULT NULL,
  `descricao` char(1) DEFAULT NULL,
  `tipo` tinyint(1) DEFAULT NULL,
  `tamanho` double DEFAULT NULL,
  `id_imobiliaria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nivel` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `cnpj`, `nome`, `email`, `senha`, `nivel`) VALUES
(16, '18471895000108', 'Bruno Unky', 'bruno@unky.com', '$2y$10$oEZcuBLsmJNIPB6RGyM1RO6VhaTDZDZw8wSr24DSoWgd2SsGwoLMK', NULL),
(17, '29987124000194', 'teste', 'teste@teste.com', '$2y$10$9mIfO8ScNwUd6y4r2nzToOqubFXfejsx.SAYaPvvBIkMHxanTr/Mm', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cad_pessoas`
--
ALTER TABLE `cad_pessoas`
  ADD PRIMARY KEY (`id_pessoas`);

--
-- Índices de tabela `imovel`
--
ALTER TABLE `imovel`
  ADD PRIMARY KEY (`id_imovel`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
