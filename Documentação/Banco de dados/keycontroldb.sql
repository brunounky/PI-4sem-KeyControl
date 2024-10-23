-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/10/2024 às 23:15
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
-- Estrutura para tabela `cadastro_cliente`
--

CREATE TABLE `cadastro_cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf_cnpj` varchar(20) NOT NULL,
  `rg_ie` varchar(20) DEFAULT NULL,
  `data_nascimento_fundacao` date DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `estado_civil` varchar(20) DEFAULT NULL,
  `nacionalidade` varchar(50) DEFAULT NULL,
  `profissao` varchar(50) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `rua` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `locador` tinyint(1) DEFAULT 0,
  `locatario` tinyint(1) DEFAULT 0,
  `fiador` tinyint(1) DEFAULT 0,
  `complemento` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastro_cliente`
--

INSERT INTO `cadastro_cliente` (`id`, `nome`, `cpf_cnpj`, `rg_ie`, `data_nascimento_fundacao`, `telefone`, `email`, `estado_civil`, `nacionalidade`, `profissao`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `pais`, `locador`, `locatario`, `fiador`, `complemento`) VALUES
(1, 'João Silva', '123.456.789-00', '12.345.678-X', '1980-05-15', '11987654321', 'joao.silva@email.com', 'Solteiro', 'Brasileira', 'Engenheiro', '12345-678', 'Rua das Flores', '100', 'Centro', 'São Paulo', 'SP', 'Brasil', 1, 0, 0, ''),
(2, 'Maria Souza', '987.654.321-00', '98.765.432-Z', '1975-08-22', '21987654321', 'maria.souza@email.com', 'Casada', 'Brasileira', 'Advogada', '23456-789', 'Avenida Paulista', '2000', 'Bela Vista', 'São Paulo', 'SP', 'Brasil', 0, 1, 0, ''),
(3, 'Carlos Pereira', '111.222.333-44', '22.333.444-Y', '1990-12-10', '31987654321', 'carlos.pereira@email.com', 'Divorciado', 'Brasileira', 'Professor', '34567-890', 'Rua dos Pinheiros', '300', 'Jardim', 'Belo Horizonte', 'MG', 'Brasil', 1, 1, 0, ''),
(4, 'Ana Lima', '555.666.777-88', '55.666.777-W', '1985-03-30', '41987654321', 'ana.lima@email.com', 'Viúva', 'Brasileira', 'Médica', '45678-901', 'Rua da Paz', '400', 'Centro', 'Curitiba', 'PR', 'Brasil', 0, 1, 1, ''),
(5, 'Pedro Alves', '999.888.777-66', '99.888.777-V', '1995-07-05', '51987654321', 'pedro.alves@email.com', 'Solteiro', 'Brasileira', 'Estudante', '56789-012', 'Avenida Central', '500', 'Centro', 'Porto Alegre', 'RS', 'Brasil', 0, 0, 1, ''),
(6, 'Bruno Oliveira', '47169254808', '576950853', NULL, '19971595745', 'bruno_unky@hotmail.com', NULL, 'brasileiro', 'gerente', '13506180', 'Rua 10 MP', '376', 'Parque Mãe Preta', 'Rio Claro', 'SP', 'Brasil', 1, 1, 1, 'sobrado'),
(7, 'teste', '1', '1', '2001-05-01', '1', '111@gmail.com', 'w', 'q', 'w', '13506180', 'Rua 10 MP', '333', 'Parque Mãe Preta', 'Rio Claro', 'SP', 'Brasil', 0, 0, 0, 'www'),
(8, 'q', '1', '1', '2001-05-01', '1', '1@g.com', '1', '1', '1', '13506180', 'Rua 10 MP', '376', 'Parque Mãe Preta', 'Rio Claro', 'SP', 'Brasil', 0, 0, 0, 'd');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro_imovel`
--

CREATE TABLE `cadastro_imovel` (
  `id` int(11) NOT NULL,
  `cpf_cnpj_proprietario` varchar(20) NOT NULL,
  `tipo_imovel` varchar(50) NOT NULL,
  `quantidade_quartos` int(11) DEFAULT NULL,
  `quantidade_banheiros` int(11) DEFAULT NULL,
  `quantidade_vagas` int(11) DEFAULT NULL,
  `area_total` decimal(10,2) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `rua` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `registro_imovel` varchar(50) DEFAULT NULL,
  `registro_agua` varchar(50) DEFAULT NULL,
  `valor_aluguel` float DEFAULT NULL,
  `taxa_aluguel` float DEFAULT NULL,
  `valor_venda` float DEFAULT NULL,
  `taxa_venda` float DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastro_imovel`
--

INSERT INTO `cadastro_imovel` (`id`, `cpf_cnpj_proprietario`, `tipo_imovel`, `quantidade_quartos`, `quantidade_banheiros`, `quantidade_vagas`, `area_total`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `pais`, `registro_imovel`, `registro_agua`, `valor_aluguel`, `taxa_aluguel`, `valor_venda`, `taxa_venda`, `complemento`) VALUES
(1, '12.345.678/0001-00', 'Apartamento', 3, 2, 1, 85.00, '12345-678', 'Rua das Flores', '100', 'Centro', 'São Paulo', 'SP', 'Brasil', 'REG-IMOV-001', 'REG-AGUA-001', 2500, 5, 500000, 2.5, NULL),
(2, '98.765.432/0001-99', 'Casa', 4, 3, 2, 150.00, '23456-789', 'Avenida Paulista', '2000', 'Bela Vista', 'São Paulo', 'SP', 'Brasil', 'REG-IMOV-002', 'REG-AGUA-002', 3500, 4, 800000, 2, NULL),
(3, '11.222.333/0001-88', 'Cobertura', 5, 4, 3, 250.00, '34567-890', 'Rua dos Pinheiros', '300', 'Jardim', 'Belo Horizonte', 'MG', 'Brasil', 'REG-IMOV-003', 'REG-AGUA-003', 5000, 3.5, 1500000, 1.5, NULL),
(4, '55.666.777/0001-44', 'Apartamento', 2, 1, 1, 65.00, '45678-901', 'Rua da Paz', '400', 'Centro', 'Curitiba', 'PR', 'Brasil', 'REG-IMOV-004', 'REG-AGUA-004', 1800, 6, 300000, 3, NULL),
(5, '99.888.777/0001-33', 'Casa', 3, 2, 2, 120.00, '56789-012', 'Avenida Central', '500', 'Centro', 'Porto Alegre', 'RS', 'Brasil', 'REG-IMOV-005', 'REG-AGUA-005', 2800, 5.5, 600000, 2.75, NULL),
(6, '47169254808', 'apartamento', NULL, NULL, NULL, NULL, '13506180', NULL, '376', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1'),
(7, '47169254808', 'comercial', NULL, NULL, NULL, NULL, '13506180', NULL, '376', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'www'),
(8, '47169254808', 'comercial', NULL, NULL, NULL, NULL, '13506180', NULL, '376', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'www'),
(9, '47169254808', 'comercial', NULL, NULL, NULL, NULL, '13506180', NULL, '376', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'www'),
(10, '1', 'casa', 1, 1, 1, 1.00, '13506180', 'Rua 10 MP', '376', 'Parque Mãe Preta', 'Rio Claro', 'SP', 'Brasil', NULL, NULL, NULL, NULL, NULL, NULL, '1'),
(11, '1', 'casa', 1, 1, 1, 1.00, '13506180', 'Rua 10 MP', '376', 'Parque Mãe Preta', 'Rio Claro', 'SP', 'Brasil', NULL, NULL, NULL, NULL, NULL, NULL, '1'),
(12, '1', 'apartamento', 1, 1, 1, 1.00, '13506180', 'Rua 10 MP', '376', 'Parque Mãe Preta', 'Rio Claro', 'SP', 'Brasil', NULL, NULL, NULL, NULL, NULL, NULL, 'fdsfghj'),
(13, '1', 'apartamento', 1, 1, 1, 1.00, '13506180', 'Rua 10 MP', '376', 'Parque Mãe Preta', 'Rio Claro', 'SP', 'Brasil', NULL, NULL, NULL, NULL, NULL, NULL, 'fdsfghj'),
(14, '1', 'apartamento', 1, 1, 1, 1.00, '13506180', 'Rua 10 MP', '376', 'Parque Mãe Preta', 'Rio Claro', 'SP', 'Brasil', NULL, NULL, NULL, NULL, NULL, NULL, 'fdsfghj'),
(15, '47169254808', 'casa', 1, 1, 1, 1.00, '13506180', 'Rua 10 MP', '376', 'Parque Mãe Preta', 'Rio Claro', 'SP', 'Brasil', '111', '1111', NULL, NULL, NULL, NULL, 'teste'),
(16, '1', 'apartamento', 1, 1, 1, 1.00, '13506180', 'Rua 10 MP', '366', 'Parque Mãe Preta', 'Rio Claro', 'SP', 'Brasil', '1', '1', NULL, NULL, NULL, NULL, 'testewwwww');

-- --------------------------------------------------------

--
-- Estrutura para tabela `contrato_aluguel`
--

CREATE TABLE `contrato_aluguel` (
  `id` int(11) NOT NULL,
  `id_locatario` int(11) NOT NULL,
  `id_imovel` int(11) NOT NULL,
  `id_fiador` int(11) DEFAULT NULL,
  `quantidade_meses_antecipacao` int(11) DEFAULT NULL,
  `valor_total_caucao` decimal(15,2) DEFAULT NULL,
  `forma_pagamento_caucao` varchar(50) DEFAULT NULL,
  `data_vigencia` date DEFAULT NULL,
  `data_vencimento` date DEFAULT NULL,
  `dia_cobranca_mes` int(11) DEFAULT NULL,
  `forma_pagamento_mensal` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `contrato_venda`
--

CREATE TABLE `contrato_venda` (
  `id` int(11) NOT NULL,
  `id_locatario` int(11) NOT NULL,
  `id_imovel` int(11) NOT NULL,
  `data_vigencia` date NOT NULL,
  `data_pagamento_compra` date NOT NULL,
  `forma_pagamento` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `imobiliaria`
--

CREATE TABLE `imobiliaria` (
  `cnpj` varchar(14) NOT NULL,
  `nome_fantasia` varchar(255) DEFAULT NULL,
  `endereco` char(1) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `cep` int(11) DEFAULT NULL,
  `cidade` char(1) DEFAULT NULL,
  `telefone` char(1) DEFAULT NULL,
  `email` char(1) DEFAULT NULL,
  `logo_imobiliaria` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `imobiliaria`
--

INSERT INTO `imobiliaria` (`cnpj`, `nome_fantasia`, `endereco`, `numero`, `cep`, `cidade`, `telefone`, `email`, `logo_imobiliaria`) VALUES
('73943371000180', 'nome teste da imobiliaria', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `estado_civil` varchar(50) DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `nacionalidade` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `telefone_reserva` varchar(20) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `rua` varchar(255) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `cnpj` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `data_nascimento`, `estado_civil`, `cpf`, `rg`, `email`, `cargo`, `nacionalidade`, `telefone`, `telefone_reserva`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `pais`, `senha`, `cnpj`) VALUES
(11, 'Bruno Unky', NULL, NULL, NULL, NULL, 'bruno@unky.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$DTQ1Wl.15YfCJB0t7JE2yuZzKohESoyFdlBbHsrbtctK4VN.AAfFW', '73943371000180'),
(12, 'Jorge Lucianetti', NULL, NULL, NULL, NULL, 'jorginho@teste.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$WIPljcKbX0r6rjfcylbQtehtqVkJqZKwakoACEXpptO1l/.HzdSCK', '86779530000103');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadastro_cliente`
--
ALTER TABLE `cadastro_cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cadastro_imovel`
--
ALTER TABLE `cadastro_imovel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_registro_imovel` (`registro_imovel`),
  ADD UNIQUE KEY `numero_registro_agua` (`registro_agua`);

--
-- Índices de tabela `contrato_aluguel`
--
ALTER TABLE `contrato_aluguel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_locatario` (`id_locatario`),
  ADD KEY `id_imovel` (`id_imovel`),
  ADD KEY `id_fiador` (`id_fiador`);

--
-- Índices de tabela `contrato_venda`
--
ALTER TABLE `contrato_venda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_locatario` (`id_locatario`),
  ADD KEY `id_imovel` (`id_imovel`);

--
-- Índices de tabela `imobiliaria`
--
ALTER TABLE `imobiliaria`
  ADD PRIMARY KEY (`cnpj`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro_cliente`
--
ALTER TABLE `cadastro_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `cadastro_imovel`
--
ALTER TABLE `cadastro_imovel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `contrato_aluguel`
--
ALTER TABLE `contrato_aluguel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `contrato_venda`
--
ALTER TABLE `contrato_venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `contrato_aluguel`
--
ALTER TABLE `contrato_aluguel`
  ADD CONSTRAINT `contrato_aluguel_ibfk_1` FOREIGN KEY (`id_locatario`) REFERENCES `cadastro_cliente` (`id`),
  ADD CONSTRAINT `contrato_aluguel_ibfk_2` FOREIGN KEY (`id_imovel`) REFERENCES `cadastro_imovel` (`id`),
  ADD CONSTRAINT `contrato_aluguel_ibfk_3` FOREIGN KEY (`id_fiador`) REFERENCES `cadastro_cliente` (`id`);

--
-- Restrições para tabelas `contrato_venda`
--
ALTER TABLE `contrato_venda`
  ADD CONSTRAINT `contrato_venda_ibfk_1` FOREIGN KEY (`id_locatario`) REFERENCES `cadastro_cliente` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contrato_venda_ibfk_2` FOREIGN KEY (`id_imovel`) REFERENCES `cadastro_imovel` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
