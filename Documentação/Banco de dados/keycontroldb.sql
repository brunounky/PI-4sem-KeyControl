-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/11/2024 às 01:45
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.1.25

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
  `comprador` tinyint(1) DEFAULT 0,
  `complemento` varchar(255) DEFAULT NULL,
  `cpf_cnpj` varchar(20) NOT NULL,
  `id_imobiliaria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastro_cliente`
--

INSERT INTO `cadastro_cliente` (`id`, `nome`, `rg_ie`, `data_nascimento_fundacao`, `telefone`, `email`, `estado_civil`, `nacionalidade`, `profissao`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `pais`, `locador`, `locatario`, `fiador`, `comprador`, `complemento`, `cpf_cnpj`, `id_imobiliaria`) VALUES
(16, 'vitoria lucianetti dos santos', '44234432', '2024-12-07', '19996886205', '627sp@al.educacao.sp.gov.bd', 'SP', '4', '4', '13506-560', 'Rua 16 A', '16', 'Vila Nova', 'Rio Claro', 'SP', 'Brasil', 1, 0, 0, 0, '4', '54234346578', '73943371000180'),
(17, 'Guilherme Ribeiro Bonatti', '640022947', '2005-03-26', '19996236443', 'guilhermeribeirobonatti@gmail.com', 'Solteiro', 'Brasileiro', 'Operador de caixa', '13505493', 'Avenida M 49', '2430', 'Jardim Residencial São José', 'Rio Claro', 'SP', 'Brasil', 1, 1, 0, 0, 'Portao cinza', '39911823865', '73943371000180'),
(20, 'João Silva', '123456789', '1980-03-15', '1234567890', 'joao@email.com', 'Solteiro', 'Brasileiro', 'Engenheiro', '12345-678', 'Rua A', '10', 'Centro', 'Araras', 'SP', 'Brasil', 1, 0, 0, 1, 'Apartamento no centro', '123.456.789-00', '1'),
(21, 'Maria Oliveira', '987654321', '1992-06-10', '0987654321', 'maria@email.com', 'Casada', 'Brasileira', 'Professor', '23456-789', 'Rua B', '15', 'Jardim', 'Araras', 'SP', 'Brasil', 1, 1, 0, 0, 'Casa no jardim', '234.567.890/0011', '2'),
(22, 'Carlos Pereira', '456123789', '1975-11-22', '1122334455', 'carlos@email.com', 'Divorciado', 'Brasileiro', 'Advogado', '34567-890', 'Rua C', '20', 'Vila Nova', 'Araras', 'SP', 'Brasil', 0, 1, 1, 0, 'Sobrado na vila', '345.678.901-00', '3'),
(23, 'Ana Costa', '321654987', '1985-01-05', '2233445566', 'ana@email.com', 'Casada', 'Brasileira', 'Médica', '45678-901', 'Rua D', '30', 'São João', 'Araras', 'SP', 'Brasil', 1, 0, 1, 1, 'Apartamento próximo ao hospital', '456.789.012/0011', '1'),
(24, 'Lucas Rocha', '789321654', '2000-12-30', '3344556677', 'lucas@email.com', 'Solteiro', 'Brasileiro', 'Estudante', '56789-012', 'Rua E', '40', 'Vila Santa Maria', 'Araras', 'SP', 'Brasil', 0, 0, 0, 1, 'Apartamento novo', '567.890.123-00', '2'),
(25, 'Fernando', '591985780', '2024-11-27', '19996595529', 'teste@teste.com', 'solteira', 'brasileira', 'aaa', '13605060', 'Rua Doutor Fábio Fachini', '123', 'Vila Candinha', 'Araras', 'SP', 'Brasil', 0, 1, 1, 1, 'teste', '47169254808', '73943371000180');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro_imovel`
--

CREATE TABLE `cadastro_imovel` (
  `id` int(11) NOT NULL,
  `id_imobiliaria` varchar(20) NOT NULL,
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
  `valor_aluguel` float DEFAULT NULL,
  `taxa_aluguel` float DEFAULT NULL,
  `valor_venda` float DEFAULT NULL,
  `taxa_venda` float DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `registro_agua` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastro_imovel`
--

INSERT INTO `cadastro_imovel` (`id`, `id_imobiliaria`, `cpf_cnpj_proprietario`, `tipo_imovel`, `quantidade_quartos`, `quantidade_banheiros`, `quantidade_vagas`, `area_total`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `pais`, `registro_imovel`, `valor_aluguel`, `taxa_aluguel`, `valor_venda`, `taxa_venda`, `complemento`, `registro_agua`) VALUES
(24, '73943371000180', '54234346578', 'apartamento', 2, 2, 2, 22.00, '13506180', 'Rua 10 MP', '1', 'Parque Mãe Preta', 'Rio Claro', 'SP', 'Brasil', '22', 11, 11, 12, 111, '1', '22'),
(26, '1', '123.456.789-00', 'Apartamento', 2, 1, 1, 50.00, '12345-678', 'Rua A', '10', 'Centro', 'Araras', 'SP', 'Brasil', 'RG12345', 1200, 5, 250000, 3, 'Apartamento no centro com vista', 'A123456789'),
(27, '2', '234.567.890/0011', 'Casa', 3, 2, 2, 120.00, '23456-789', 'Rua B', '15', 'Jardim', 'Araras', 'SP', 'Brasil', 'RG23456', 2500, 7, 450000, 2, 'Casa ampla com quintal', 'B234567890'),
(28, '3', '345.678.901-00', 'Sobrado', 4, 3, 2, 150.00, '34567-890', 'Rua C', '20', 'Vila Nova', 'Araras', 'SP', 'Brasil', 'RG34567', 3500, 6, 550000, 4, 'Sobrado com garagem e varanda', 'C345678901'),
(29, '1', '456.789.012/0011', 'Apartamento', 1, 1, 1, 45.00, '45678-901', 'Rua D', '30', 'São João', 'Araras', 'SP', 'Brasil', 'RG45678', 1000, 4, 200000, 5, 'Apartamento com excelente localização', 'D456789012'),
(30, '2', '567.890.123-00', 'Apartamento', 2, 1, 1, 60.00, '56789-012', 'Rua E', '40', 'Vila Santa Maria', 'Araras', 'SP', 'Brasil', 'RG56789', 1300, 5, 270000, 3, 'Apartamento novo, pronto para morar', 'E567890123');

-- --------------------------------------------------------

--
-- Estrutura para tabela `contrato_aluguel`
--

CREATE TABLE `contrato_aluguel` (
  `id` int(11) NOT NULL,
  `locatario_nome` varchar(255) NOT NULL,
  `locatario_data_nascimento` date NOT NULL,
  `locatario_nacionalidade` varchar(100) NOT NULL,
  `locatario_cep` varchar(10) NOT NULL,
  `locatario_bairro` varchar(100) NOT NULL,
  `locatario_estado` varchar(100) NOT NULL,
  `locatario_cpf_cnpj` varchar(14) NOT NULL,
  `locatario_telefone` varchar(15) NOT NULL,
  `locatario_estado_civil` varchar(50) NOT NULL,
  `locatario_rua` varchar(255) NOT NULL,
  `locatario_complemento` varchar(255) DEFAULT NULL,
  `locatario_pais` varchar(100) NOT NULL,
  `locatario_rg_ie` varchar(15) NOT NULL,
  `locatario_email` varchar(255) NOT NULL,
  `locatario_profissao` varchar(100) NOT NULL,
  `locatario_numero` int(11) NOT NULL,
  `locatario_cidade` varchar(100) NOT NULL,
  `imovel_proprietario_cpf_cnpj` varchar(14) NOT NULL,
  `imovel_tipo` varchar(50) NOT NULL,
  `imovel_numero` int(11) NOT NULL,
  `imovel_cidade` varchar(100) NOT NULL,
  `imovel_taxa_venda` decimal(5,2) NOT NULL,
  `imovel_cep` varchar(10) NOT NULL,
  `imovel_bairro` varchar(100) NOT NULL,
  `imovel_estado` varchar(100) NOT NULL,
  `imovel_valor` decimal(15,2) NOT NULL,
  `imovel_registro` varchar(50) NOT NULL,
  `imovel_rua` varchar(255) NOT NULL,
  `imovel_complemento` varchar(255) DEFAULT NULL,
  `imovel_pais` varchar(100) NOT NULL,
  `fiador_nome` varchar(255) NOT NULL,
  `fiador_data_nascimento` date NOT NULL,
  `fiador_nacionalidade` varchar(100) NOT NULL,
  `fiador_cep` varchar(10) NOT NULL,
  `fiador_bairro` varchar(100) NOT NULL,
  `fiador_estado` varchar(100) NOT NULL,
  `fiador_cpf_cnpj` varchar(14) NOT NULL,
  `fiador_telefone` varchar(15) NOT NULL,
  `fiador_estado_civil` varchar(50) NOT NULL,
  `fiador_rua` varchar(255) NOT NULL,
  `fiador_complemento` varchar(255) DEFAULT NULL,
  `fiador_pais` varchar(100) NOT NULL,
  `fiador_rg_ie` varchar(15) NOT NULL,
  `fiador_email` varchar(255) NOT NULL,
  `fiador_profissao` varchar(100) NOT NULL,
  `fiador_numero` int(11) NOT NULL,
  `fiador_cidade` varchar(100) NOT NULL,
  `contrato_vigencia` date NOT NULL,
  `contrato_forma_pagamento` varchar(50) NOT NULL,
  `contrato_data_vencimento` date NOT NULL,
  `id_imobiliaria` varchar(20) NOT NULL,
  `meses_caucao` int(11) DEFAULT NULL,
  `vencimento_caucao` date DEFAULT NULL,
  `total_caucao` decimal(15,2) DEFAULT NULL,
  `forma_pagamento_caucao` varchar(50) DEFAULT NULL,
  `id_lancamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `contrato_aluguel`
--

INSERT INTO `contrato_aluguel` (`id`, `locatario_nome`, `locatario_data_nascimento`, `locatario_nacionalidade`, `locatario_cep`, `locatario_bairro`, `locatario_estado`, `locatario_cpf_cnpj`, `locatario_telefone`, `locatario_estado_civil`, `locatario_rua`, `locatario_complemento`, `locatario_pais`, `locatario_rg_ie`, `locatario_email`, `locatario_profissao`, `locatario_numero`, `locatario_cidade`, `imovel_proprietario_cpf_cnpj`, `imovel_tipo`, `imovel_numero`, `imovel_cidade`, `imovel_taxa_venda`, `imovel_cep`, `imovel_bairro`, `imovel_estado`, `imovel_valor`, `imovel_registro`, `imovel_rua`, `imovel_complemento`, `imovel_pais`, `fiador_nome`, `fiador_data_nascimento`, `fiador_nacionalidade`, `fiador_cep`, `fiador_bairro`, `fiador_estado`, `fiador_cpf_cnpj`, `fiador_telefone`, `fiador_estado_civil`, `fiador_rua`, `fiador_complemento`, `fiador_pais`, `fiador_rg_ie`, `fiador_email`, `fiador_profissao`, `fiador_numero`, `fiador_cidade`, `contrato_vigencia`, `contrato_forma_pagamento`, `contrato_data_vencimento`, `id_imobiliaria`, `meses_caucao`, `vencimento_caucao`, `total_caucao`, `forma_pagamento_caucao`, `id_lancamento`) VALUES
(8, 'Guilherme Ribeiro Bonatti', '2005-03-26', 'Brasileiro', '13505493', 'Jardim Residencial São José', 'SP', '39911823865', '19996236443', 'Solteiro', 'Avenida M 49', 'Portao cinza', 'Brasil', '640022947', 'guilhermeribeirobonatti@gmail.com', 'Operador de caixa', 2430, 'Rio Claro', '54234346578', 'apartamento', 1, 'Rio Claro', 111.00, '13506180', 'Parque Mãe Preta', 'SP', 12.00, '22', 'Rua 10 MP', '1', 'Brasil', 'Guilherme Ribeiro Bonatti', '2005-03-26', 'Brasileiro', '13505493', 'Jardim Residencial São José', 'SP', '39911823865', '19996236443', 'Solteiro', 'Avenida M 49', 'Portao cinza', 'Brasil', '640022947', 'guilhermeribeirobonatti@gmail.com', 'Operador de caixa', 2430, 'Rio Claro', '2024-12-06', 'Boleto', '2024-11-08', '73943371000180', NULL, NULL, NULL, NULL, 0),
(9, 'Guilherme Ribeiro Bonatti', '2005-03-26', 'Brasileiro', '13505493', 'Jardim Residencial São José', 'SP', '39911823865', '19996236443', 'Solteiro', 'Avenida M 49', 'Portao cinza', 'Brasil', '640022947', 'guilhermeribeirobonatti@gmail.com', 'Operador de caixa', 2430, 'Rio Claro', '54234346578', 'apartamento', 1, 'Rio Claro', 111.00, '13506180', 'Parque Mãe Preta', 'SP', 500001.00, '22', 'Rua 10 MP', '1', 'Brasil', 'Guilherme Ribeiro Bonatti', '2005-03-26', 'Brasileiro', '13505493', 'Jardim Residencial São José', 'SP', '39911823865', '19996236443', 'Solteiro', 'Avenida M 49', 'Portao cinza', 'Brasil', '640022947', 'guilhermeribeirobonatti@gmail.com', 'Operador de caixa', 2430, 'Rio Claro', '2024-12-04', 'Cartão de débito', '2024-11-22', '73943371000180', NULL, NULL, NULL, NULL, 0),
(10, 'Guilherme Ribeiro Bonatti', '2005-03-26', 'Brasileiro', '13505493', 'Jardim Residencial São José', 'SP', '39911823865', '19996236443', 'Solteiro', 'Avenida M 49', 'Portao cinza', 'Brasil', '640022947', 'guilhermeribeirobonatti@gmail.com', 'Operador de caixa', 2430, 'Rio Claro', '54234346578', 'apartamento', 1, 'Rio Claro', 111.00, '13506180', 'Parque Mãe Preta', 'SP', 12.00, '22', 'Rua 10 MP', '1', 'Brasil', 'Guilherme Ribeiro Bonatti', '2005-03-26', 'Brasileiro', '13505493', 'Jardim Residencial São José', 'SP', '39911823865', '19996236443', 'Solteiro', 'Avenida M 49', 'Portao cinza', 'Brasil', '640022947', 'guilhermeribeirobonatti@gmail.com', 'Operador de caixa', 2430, 'Rio Claro', '2024-11-27', 'PIX', '2024-12-06', '73943371000180', NULL, NULL, NULL, NULL, 18),
(16, 'vitoria lucianetti dos santos', '2024-12-07', '4', '13506-560', 'Vila Nova', 'SP', '54234346578', '19996886205', 'SP', 'Rua 16 A', '4', 'Brasil', '44234432', '627sp@al.educacao.sp.gov.bd', '4', 16, 'Rio Claro', '54234346578', 'apartamento', 1, 'Rio Claro', 11.00, '13506180', 'Parque Mãe Preta', 'SP', 11.00, '22', 'Rua 10 MP', '1', 'Brasil', '', '0000-00-00', '', '', '', '', '', '', '', '', NULL, '', '', '', '', 0, '', '2024-11-29', 'Cartão de crédito', '2024-11-28', '73943371000180', 11, '2024-12-06', 2222222.00, 'Boleto', 35),
(17, 'vitoria lucianetti dos santos', '2024-12-07', '4', '13506-560', 'Vila Nova', 'SP', '54234346578', '19996886205', 'SP', 'Rua 16 A', '4', 'Brasil', '44234432', '627sp@al.educacao.sp.gov.bd', '4', 16, 'Rio Claro', '54234346578', 'apartamento', 1, 'Rio Claro', 11.00, '13506180', 'Parque Mãe Preta', 'SP', 11.00, '22', 'Rua 10 MP', '1', 'Brasil', '', '0000-00-00', '', '', '', '', '', '', '', '', NULL, '', '', '', '', 0, '', '2024-11-29', 'Cartão de crédito', '2024-12-06', '73943371000180', 1, '2024-11-07', 11.00, 'PIX', 37),
(18, 'vitoria lucianetti dos santos', '2024-12-07', '4', '13506-560', 'Vila Nova', 'SP', '54234346578', '19996886205', 'SP', 'Rua 16 A', '4', 'Brasil', '44234432', '627sp@al.educacao.sp.gov.bd', '4', 16, 'Rio Claro', '54234346578', 'apartamento', 1, 'Rio Claro', 11.00, '13506180', 'Parque Mãe Preta', 'SP', 11.00, '22', 'Rua 10 MP', '1', 'Brasil', '', '0000-00-00', '', '', '', '', '', '', '', '', NULL, '', '', '', '', 0, '', '2024-12-06', 'Cartão de crédito', '2024-11-29', '73943371000180', 10, '2024-12-06', 110.00, 'PIX', 40);

-- --------------------------------------------------------

--
-- Estrutura para tabela `contrato_venda`
--

CREATE TABLE `contrato_venda` (
  `id` int(11) NOT NULL,
  `comprador_nome` varchar(255) NOT NULL,
  `comprador_data_nascimento` date NOT NULL,
  `comprador_nacionalidade` varchar(100) NOT NULL,
  `comprador_cep` varchar(10) NOT NULL,
  `comprador_bairro` varchar(100) NOT NULL,
  `comprador_estado` varchar(100) NOT NULL,
  `comprador_cpf_cnpj` varchar(14) NOT NULL,
  `comprador_telefone` varchar(15) NOT NULL,
  `comprador_estado_civil` varchar(50) NOT NULL,
  `comprador_rua` varchar(255) NOT NULL,
  `comprador_complemento` varchar(255) DEFAULT NULL,
  `comprador_pais` varchar(100) NOT NULL,
  `comprador_rg_ie` varchar(15) NOT NULL,
  `comprador_email` varchar(255) NOT NULL,
  `comprador_profissao` varchar(100) NOT NULL,
  `comprador_numero` int(11) NOT NULL,
  `comprador_cidade` varchar(100) NOT NULL,
  `imovel_proprietario_cpf_cnpj` varchar(14) NOT NULL,
  `imovel_tipo` varchar(50) NOT NULL,
  `imovel_numero` int(11) NOT NULL,
  `imovel_cidade` varchar(100) NOT NULL,
  `imovel_taxa_venda` decimal(5,2) NOT NULL,
  `imovel_cep` varchar(10) NOT NULL,
  `imovel_bairro` varchar(100) NOT NULL,
  `imovel_estado` varchar(100) NOT NULL,
  `imovel_valor` decimal(15,2) NOT NULL,
  `imovel_registro` varchar(50) NOT NULL,
  `imovel_rua` varchar(255) NOT NULL,
  `imovel_complemento` varchar(255) DEFAULT NULL,
  `imovel_pais` varchar(100) NOT NULL,
  `data_emissao` date DEFAULT NULL,
  `data_vencimento` date DEFAULT NULL,
  `forma_pagamento` varchar(20) DEFAULT NULL,
  `id_imobiliaria` varchar(20) NOT NULL,
  `id_lancamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `contrato_venda`
--

INSERT INTO `contrato_venda` (`id`, `comprador_nome`, `comprador_data_nascimento`, `comprador_nacionalidade`, `comprador_cep`, `comprador_bairro`, `comprador_estado`, `comprador_cpf_cnpj`, `comprador_telefone`, `comprador_estado_civil`, `comprador_rua`, `comprador_complemento`, `comprador_pais`, `comprador_rg_ie`, `comprador_email`, `comprador_profissao`, `comprador_numero`, `comprador_cidade`, `imovel_proprietario_cpf_cnpj`, `imovel_tipo`, `imovel_numero`, `imovel_cidade`, `imovel_taxa_venda`, `imovel_cep`, `imovel_bairro`, `imovel_estado`, `imovel_valor`, `imovel_registro`, `imovel_rua`, `imovel_complemento`, `imovel_pais`, `data_emissao`, `data_vencimento`, `forma_pagamento`, `id_imobiliaria`, `id_lancamento`) VALUES
(12, 'vitoria lucianetti dos santos', '2024-12-07', '4', '13506-560', 'Vila Nova', 'SP', '54234346578', '19996886205', 'SP', 'Rua 16 A', '4', 'Brasil', '44234432', '627sp@al.educacao.sp.gov.bd', '4', 16, 'Rio Claro', '54234346578', '', 1, 'Rio Claro', 111.00, '13506180', 'Parque Mãe Preta', 'SP', 12.00, '22', 'Rua 10 MP', '1', '', '2024-11-25', '2024-11-27', 'Cartão de crédito', '73943371000180', 12),
(13, 'Guilherme Ribeiro Bonatti', '2005-03-26', 'Brasileiro', '13505493', 'Jardim Residencial São José', 'SP', '39911823865', '19996236443', 'Solteiro', 'Avenida M 49', 'Portao cinza', 'Brasil', '640022947', 'guilhermeribeirobonatti@gmail.com', 'Operador de caixa', 2430, 'Rio Claro', '54234346578', '', 1, 'Rio Claro', 111.00, '13506180', 'Parque Mãe Preta', 'SP', 12.00, '22', 'Rua 10 MP', '1', '', '2024-11-25', '2024-11-29', 'PIX', '73943371000180', 14),
(14, 'Lucas Rocha', '2000-12-30', 'Brasileiro', '56789-012', 'Vila Santa Maria', 'SP', '567.890.123-00', '3344556677', 'Solteiro', 'Rua E', 'Apartamento novo, pronto para morar', 'Brasil', '789321654', 'lucas@email.com', 'Estudante', 40, 'Araras', '123.456.789-00', 'Apartamento', 40, 'Araras', 3.00, '56789-012', 'Vila Santa Maria', 'SP', 270000.00, 'RG56789', 'Rua E', 'Apartamento novo', 'Brasil', '2024-11-27', '2025-11-27', 'Financiamento', '2', 1),
(15, 'Ana Costa', '1985-01-05', 'Brasileira', '45678-901', 'São João', 'SP', '456.789.012/00', '2233445566', 'Casada', 'Rua D', 'Apartamento com excelente localização', 'Brasil', '321654987', 'ana@email.com', 'Médica', 30, 'Araras', '234.567.890/00', 'Casa', 15, 'Araras', 5.00, '45678-901', 'São João', 'SP', 450000.00, 'RG45678', 'Rua D', 'Casa ampla com quintal', 'Brasil', '2024-11-27', '2025-11-27', 'À vista', '1', 2),
(16, 'Carlos Pereira', '1975-11-22', 'Brasileiro', '34567-890', 'Vila Nova', 'SP', '345.678.901-00', '1122334455', 'Divorciado', 'Rua C', 'Sobrado com garagem e varanda', 'Brasil', '456123789', 'carlos@email.com', 'Advogado', 20, 'Araras', '234.567.890/00', 'Sobrado', 20, 'Araras', 4.00, '34567-890', 'Vila Nova', 'SP', 550000.00, 'RG34567', 'Rua C', 'Sobrado com garagem e varanda', 'Brasil', '2024-11-27', '2025-11-27', 'Parcelado', '3', 3),
(17, 'Maria Oliveira', '1992-06-10', 'Brasileira', '23456-789', 'Jardim', 'SP', '234.567.890/00', '0987654321', 'Casada', 'Rua B', 'Casa ampla com quintal', 'Brasil', '987654321', 'maria@email.com', 'Professor', 15, 'Araras', '123.456.789-00', 'Apartamento', 10, 'Araras', 3.00, '23456-789', 'Jardim', 'SP', 250000.00, 'RG23456', 'Rua B', 'Casa no jardim', 'Brasil', '2024-11-27', '2025-11-27', 'Financiamento', '2', 4),
(18, 'João Silva', '1980-03-15', 'Brasileiro', '12345-678', 'Centro', 'SP', '123.456.789-00', '1234567890', 'Solteiro', 'Rua A', 'Apartamento no centro com vista', 'Brasil', '123456789', 'joao@email.com', 'Engenheiro', 10, 'Araras', '345.678.901-00', 'Apartamento', 10, 'Araras', 5.00, '12345-678', 'Centro', 'SP', 120000.00, 'RG12345', 'Rua A', 'Apartamento no centro', 'Brasil', '2024-11-27', '2025-11-27', 'À vista', '1', 5),
(24, 'Lucas Rocha', '2000-12-30', 'Brasileiro', '56789-012', 'Vila Santa Maria', 'SP', '567.890.123-00', '3344556677', 'Solteiro', 'Rua E', 'Apartamento novo, pronto para morar', 'Brasil', '789321654', 'lucas@email.com', 'Estudante', 40, 'Araras', '123.456.789-00', 'Apartamento', 40, 'Araras', 3.00, '56789-012', 'Vila Santa Maria', 'SP', 270000.00, 'RG56789', 'Rua E', 'Apartamento novo', 'Brasil', '2024-11-27', '2025-11-27', 'Financiamento', '2', 1),
(25, 'Ana Costa', '1985-01-05', 'Brasileira', '45678-901', 'São João', 'SP', '456.789.012/00', '2233445566', 'Casada', 'Rua D', 'Apartamento com excelente localização', 'Brasil', '321654987', 'ana@email.com', 'Médica', 30, 'Araras', '234.567.890/00', 'Casa', 15, 'Araras', 5.00, '45678-901', 'São João', 'SP', 450000.00, 'RG45678', 'Rua D', 'Casa ampla com quintal', 'Brasil', '2024-11-27', '2025-11-27', 'À vista', '1', 2),
(26, 'Carlos Pereira', '1975-11-22', 'Brasileiro', '34567-890', 'Vila Nova', 'SP', '345.678.901-00', '1122334455', 'Divorciado', 'Rua C', 'Sobrado com garagem e varanda', 'Brasil', '456123789', 'carlos@email.com', 'Advogado', 20, 'Araras', '234.567.890/00', 'Sobrado', 20, 'Araras', 4.00, '34567-890', 'Vila Nova', 'SP', 550000.00, 'RG34567', 'Rua C', 'Sobrado com garagem e varanda', 'Brasil', '2024-11-27', '2025-11-27', 'Parcelado', '3', 3),
(27, 'Maria Oliveira', '1992-06-10', 'Brasileira', '23456-789', 'Jardim', 'SP', '234.567.890/00', '0987654321', 'Casada', 'Rua B', 'Casa ampla com quintal', 'Brasil', '987654321', 'maria@email.com', 'Professor', 15, 'Araras', '123.456.789-00', 'Apartamento', 10, 'Araras', 3.00, '23456-789', 'Jardim', 'SP', 250000.00, 'RG23456', 'Rua B', 'Casa no jardim', 'Brasil', '2024-11-27', '2025-11-27', 'Financiamento', '2', 4),
(28, 'João Silva', '1980-03-15', 'Brasileiro', '12345-678', 'Centro', 'SP', '123.456.789-00', '1234567890', 'Solteiro', 'Rua A', 'Apartamento no centro com vista', 'Brasil', '123456789', 'joao@email.com', 'Engenheiro', 10, 'Araras', '345.678.901-00', 'Apartamento', 10, 'Araras', 5.00, '12345-678', 'Centro', 'SP', 120000.00, 'RG12345', 'Rua A', 'Apartamento no centro', 'Brasil', '2024-11-27', '2025-11-27', 'À vista', '1', 5),
(29, 'Fernando', '2024-11-27', 'brasileira', '13605060', 'Vila Candinha', 'SP', '47169254808', '19996595529', 'solteira', 'Rua Doutor Fábio Fachini', 'teste', 'Brasil', '591985780', 'teste@teste.com', 'aaa', 123, 'Araras', '54234346578', 'apartamento', 1, 'Rio Claro', 10.00, '13506180', 'Parque Mãe Preta', 'SP', 12.00, '22', 'Rua 10 MP', '1', 'Brasil', '2024-11-27', '2024-11-29', 'Boleto', '73943371000180', 49);

-- --------------------------------------------------------

--
-- Estrutura para tabela `imobiliaria`
--

CREATE TABLE `imobiliaria` (
  `cnpj` varchar(14) NOT NULL,
  `nome_fantasia` varchar(255) DEFAULT NULL,
  `endereco` varchar(50) DEFAULT NULL,
  `numeroimobiliaria` int(11) DEFAULT NULL,
  `cepimobiliaria` int(11) DEFAULT NULL,
  `cidadeimobiliaria` varchar(50) DEFAULT NULL,
  `telefoneimobiliaria` varchar(9) DEFAULT NULL,
  `emailimobiliaria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `imobiliaria`
--

INSERT INTO `imobiliaria` (`cnpj`, `nome_fantasia`, `endereco`, `numeroimobiliaria`, `cepimobiliaria`, `cidadeimobiliaria`, `telefoneimobiliaria`, `emailimobiliaria`) VALUES
('73943371000180', 'ImobiliaraTeste', 'Rua 1', 22, 13555555, 'Araras', '199989898', 'imobiliariaficticia@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `lancamento_financeiro`
--

CREATE TABLE `lancamento_financeiro` (
  `id_lancamento` int(11) NOT NULL,
  `id_imobiliaria` varchar(20) DEFAULT NULL,
  `tipo_lancamento` varchar(20) DEFAULT NULL,
  `registro_imovel` varchar(50) DEFAULT NULL,
  `data_emissao` date DEFAULT NULL,
  `data_vencimento` date DEFAULT NULL,
  `valor_total` int(11) DEFAULT NULL,
  `forma_pagamento` varchar(20) DEFAULT NULL,
  `observacoes` varchar(255) DEFAULT NULL,
  `data_vigencia` date DEFAULT NULL,
  `meses_caucao` int(11) DEFAULT NULL,
  `liquidado` varchar(15) DEFAULT 'Não liquidado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `lancamento_financeiro`
--

INSERT INTO `lancamento_financeiro` (`id_lancamento`, `id_imobiliaria`, `tipo_lancamento`, `registro_imovel`, `data_emissao`, `data_vencimento`, `valor_total`, `forma_pagamento`, `observacoes`, `data_vigencia`, `meses_caucao`, `liquidado`) VALUES
(8, '73943371000180', 'venda imovel', '22', '2024-11-25', '2024-12-04', 12, 'Cartão de crédito', NULL, NULL, NULL, 'Não liquidado'),
(10, '73943371000180', 'venda imovel', '22', '2024-11-20', '2024-12-05', 12, 'Cartão de débito', NULL, NULL, NULL, 'Não liquidado'),
(12, '73943371000180', 'venda imovel', '22', '2024-11-25', '2024-11-27', 12, 'Cartão de crédito', NULL, NULL, NULL, 'Não liquidado'),
(13, '73943371000180', 'Aluguel', '22', '2024-11-06', '2024-10-30', 33, 'Dinheiro', '3', NULL, NULL, 'Não liquidado'),
(14, '73943371000180', 'venda imovel', '22', '2024-11-25', '2024-11-29', 12, 'PIX', NULL, NULL, NULL, 'Não liquidado'),
(15, '73943371000180', 'aluguel fiador', '22', '2024-11-26', '2024-11-22', 12, 'Boleto', NULL, '2024-11-06', NULL, 'Não liquidado'),
(16, '73943371000180', 'aluguel fiador', '22', '2024-11-26', '2024-11-08', 12, 'Boleto', NULL, '2024-12-06', NULL, 'Não liquidado'),
(17, '73943371000180', 'aluguel fiador', '22', '2024-11-26', '2024-11-22', 500001, 'Cartão de débito', NULL, '2024-12-04', NULL, 'Não liquidado'),
(18, '73943371000180', 'aluguel fiador', '22', '2024-11-26', '2024-12-06', 12, 'PIX', NULL, '2024-11-27', NULL, 'Não liquidado'),
(19, '73943371000180', 'aluguel fiador', '22', '2024-11-26', '2024-11-20', 12, 'PIX', NULL, '2024-11-27', NULL, 'Não liquidado'),
(20, '73943371000180', 'aluguel fiador', '22', '2024-11-26', '2024-11-20', 12, 'PIX', NULL, '2024-11-27', NULL, 'Não liquidado'),
(21, '73943371000180', 'aluguel fiador', '22', '2024-11-26', '2024-11-20', 12, 'PIX', NULL, '2024-11-27', NULL, 'Não liquidado'),
(34, '73943371000180', 'aluguel caucao', '22', '2024-11-26', '2024-11-28', 11, 'Cartão de crédito', NULL, '2024-11-29', NULL, 'Não liquidado'),
(35, '73943371000180', 'aluguel caucao', '22', '2024-11-26', '2024-12-06', 2222222, 'Boleto', NULL, NULL, 11, 'Não liquidado'),
(36, '73943371000180', 'aluguel caucao', '22', '2024-11-26', '2024-12-06', 11, 'Cartão de crédito', NULL, '2024-11-29', NULL, 'Não liquidado'),
(37, '73943371000180', 'aluguel caucao', '22', '2024-11-26', '2024-11-07', 11, 'PIX', NULL, NULL, 1, 'Não liquidado'),
(38, '73943371000180', 'Reparos', '22', '2024-11-29', '2024-11-26', 22, 'Cartão de crédito', '22', NULL, NULL, 'Liquidado'),
(39, '73943371000180', 'aluguel caucao', '22', '2024-11-26', '2024-11-29', 11, 'Cartão de crédito', NULL, '2024-12-06', NULL, 'Não liquidado'),
(40, '73943371000180', 'aluguel caucao', '22', '2024-11-26', '2024-12-06', 110, 'PIX', NULL, NULL, 10, 'Não liquidado'),
(41, '73943371000180', 'Reparos', '22', '2024-11-27', '2024-11-21', -33, 'Cartão de crédito', 'teste de negativo', NULL, NULL, 'Liquidado'),
(42, '73943371000180', 'IPTU', '22', '2024-11-06', '2024-11-07', -1, 'Cartão de crédito', 'oi', NULL, NULL, 'Não liquidado'),
(43, '73943371000180', 'IPTU', '22', '2024-11-07', '2024-11-14', -1, 'Cartão de débito', 'descontinho', NULL, NULL, 'Não liquidado'),
(44, '73943371000180', 'Reparos', '22', '2024-11-07', '2024-11-14', 324, 'Transferência', 'agua vencida', NULL, NULL, 'Não liquidado'),
(45, '73943371000180', 'Reparos', '22', '2024-11-27', '2024-11-29', 66, 'Boleto', 'lampada', NULL, NULL, 'Liquidado'),
(46, '73943371000180', 'IPTU', 'RG23456', '2024-11-27', '2024-11-30', -100, 'Boleto', '', NULL, NULL, 'Não liquidado'),
(47, '73943371000180', 'Água', 'RG23456', '2024-11-27', '2024-12-12', -148, 'Boleto', '', NULL, NULL, 'Não liquidado'),
(48, '73943371000180', 'Reparos', 'RG23456', '2024-11-27', '2024-12-30', -2500, 'Transferência', '', NULL, NULL, 'Não liquidado'),
(49, '73943371000180', 'venda imovel', '22', '2024-11-27', '2024-11-29', 12, 'Boleto', NULL, NULL, NULL, 'Liquidado'),
(50, '73943371000180', 'Aluguel', '22', '2024-11-27', '2024-11-27', -100, 'Boleto', '', NULL, NULL, 'Liquidado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `superior`
--

CREATE TABLE `superior` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `superior`
--

INSERT INTO `superior` (`id`, `nome`, `email`, `senha`) VALUES
(11, 'Bruno Unky de oliveira campagnol', 'bruno@unky.com', '$2y$10$DTQ1Wl.15YfCJB0t7JE2yuZzKohESoyFdlBbHsrbtctK4VN.AAfFW'),
(12, 'Jorge Lucianetti', 'jorginho@teste.com', '$2y$10$WIPljcKbX0r6rjfcylbQtehtqVkJqZKwakoACEXpptO1l/.HzdSCK'),
(13, 'bruno', 'bruno@bruno.com', '$2y$10$OcxZm.ltsJwX.MvQOaEtWe.sDFSr3JkK3p315b2xRxTgFho18EBHe'),
(14, 'bruno teste', 'teste@teste.com', '$2y$10$tYNeQ9x5E4oOKwsWljI9nu5VM6QnB5buo5mN8saJsTHps0bkXre5K'),
(15, 'q', 'teste@teste.com', '$2y$10$1iQ0ov85X2L203uKyUkiMu2E.bD/Rr011uuuoG1k9iR59ji3qK/M6');

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
  `cnpj` varchar(14) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `data_nascimento`, `estado_civil`, `cpf`, `rg`, `email`, `cargo`, `nacionalidade`, `telefone`, `telefone_reserva`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `pais`, `senha`, `cnpj`, `reset_token`, `token_expiry`) VALUES
(11, 'Bruno Campagnol de Oliveira', NULL, 'solteiro', '47169254808', '576950853', 'bruno_unky@hotmail.com', 'teste', 'BRASILEIRO', '19971595745', '111423423', '13506189', 'qqqq', '2', 'Parque Mãe Preta', 'Rio Claro', 'SP', 'brasilll', '$2y$10$bViT6od6SGQPWrAgjgQy3.ZnBQtCOWyoasEWwezLbuzlkX77TRhWK', '73943371000180', '3e604d82dfa9aceb76708d3dcdbf9a3e', '2024-11-06 05:48:17'),
(12, 'Jorge Lucianetti', NULL, NULL, NULL, NULL, 'jorginho@teste.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$WIPljcKbX0r6rjfcylbQtehtqVkJqZKwakoACEXpptO1l/.HzdSCK', '86779530000103', NULL, NULL),
(13, 'Maria Suzarth', NULL, NULL, NULL, NULL, 'maria@teste.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$zlM5YvZBm5HWRDqOghalF.Ovjeaz3PlTgeZKrwQRUnOnH5UW1Yfcu', '30009388000152', NULL, NULL),
(14, '123456', NULL, '1', '1', '1', '1@1.com', '1', '1', '1', '', '13506180', 'Rua 10 MP', '1', 'Parque Mãe Preta', 'Rio Claro', 'SP', '1', '$2y$10$vJVd9ZKyoRGnsLbOffmM3esQRSOJGXeBqAc7H.Lr8cMwxMU06a7Ai', '73943371000180', NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadastro_cliente`
--
ALTER TABLE `cadastro_cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf_cnpj` (`cpf_cnpj`);

--
-- Índices de tabela `cadastro_imovel`
--
ALTER TABLE `cadastro_imovel`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `contrato_aluguel`
--
ALTER TABLE `contrato_aluguel`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `contrato_venda`
--
ALTER TABLE `contrato_venda`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `imobiliaria`
--
ALTER TABLE `imobiliaria`
  ADD PRIMARY KEY (`cnpj`);

--
-- Índices de tabela `lancamento_financeiro`
--
ALTER TABLE `lancamento_financeiro`
  ADD PRIMARY KEY (`id_lancamento`);

--
-- Índices de tabela `superior`
--
ALTER TABLE `superior`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `cadastro_imovel`
--
ALTER TABLE `cadastro_imovel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `contrato_aluguel`
--
ALTER TABLE `contrato_aluguel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `contrato_venda`
--
ALTER TABLE `contrato_venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `lancamento_financeiro`
--
ALTER TABLE `lancamento_financeiro`
  MODIFY `id_lancamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `superior`
--
ALTER TABLE `superior`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
