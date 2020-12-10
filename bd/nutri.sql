-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Dez-2020 às 18:35
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `nutri`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alimentos`
--

CREATE TABLE `alimentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `calorias` float NOT NULL,
  `proteinas` float NOT NULL,
  `carboidratos` float NOT NULL,
  `gorduras` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `alimentos`
--

INSERT INTO `alimentos` (`id`, `nome`, `calorias`, `proteinas`, `carboidratos`, `gorduras`) VALUES
(3, 'Maçã', 1, 1, 1, 1),
(4, 'Macarrão', 1, 1, 1, 1),
(6, 'Feijão', 2.3, 0.2, 3, 1),
(8, 'Filé de frango', 2.3, 0.2, 3, 1),
(11, 'Aveia', 3, 2, 4, 3),
(13, 'Beterraba', 1, 4, 3, 2),
(14, 'banana', 1, 1, 2, 0),
(15, 'laranja', 2, 3, 1, 2),
(16, 'batata doce', 4, 3, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `alimentos_consumidos`
--

CREATE TABLE `alimentos_consumidos` (
  `id` int(11) NOT NULL,
  `id_alimento` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `id_refeicao` int(11) DEFAULT NULL,
  `quantidade` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `alimentos_consumidos`
--

INSERT INTO `alimentos_consumidos` (`id`, `id_alimento`, `id_paciente`, `data`, `id_refeicao`, `quantidade`) VALUES
(2, 4, 2, '2020-11-20', 1, '33'),
(10, 2, 2, '2020-11-21', 1, '200'),
(16, 5, 2, '2020-11-21', 1, '72346'),
(17, 4, 2, '2020-11-21', 1, '1213'),
(18, 6, 2, '2020-11-23', 1, '201'),
(27, 4, 2, '2020-12-02', 1, '233'),
(29, 6, 2, '2020-12-02', 1, '1'),
(30, 3, 2, '2020-12-02', 1, '444'),
(31, 3, 2, '2020-12-02', 2, '432'),
(32, 8, 2, '2020-12-02', 2, '220'),
(35, 6, 2, '2020-12-02', 3, '223'),
(36, 3, 2, '2020-12-02', 3, '122'),
(40, 4, 2, '2020-12-03', 1, '233'),
(41, 6, 2, '2020-12-03', 1, '1'),
(42, 3, 2, '2020-12-03', 1, '444'),
(44, 6, 2, '2020-12-08', 4, '521');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `dataNascimento` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `peso` int(11) NOT NULL,
  `objetivo` varchar(50) NOT NULL,
  `anotacoes` text DEFAULT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `inicio_acompanhamento` date DEFAULT NULL,
  `id_plano` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pacientes`
--

INSERT INTO `pacientes` (`nome`, `cpf`, `dataNascimento`, `email`, `senha`, `telefone`, `peso`, `objetivo`, `anotacoes`, `id`, `inicio_acompanhamento`, `id_plano`) VALUES
('Vinícius', '399.399.399-40', '2003-03-27', 'vinicius@gmail.com', '123456', '951236458', 70, 'Ganho de massa muscular', 'intolerante a lactose', 2, '2001-02-20', 2),
('Maressa', '399.399.399-43', '2003-03-27', 'maressa123@yahoo.com', 'banana', '923459765', 75, 'Ganho de massa muscular', 'nada a declarar', 3, NULL, NULL),
('Mariana', '399.399.399-42', '2002-03-22', 'mari@yahoo.com', '123carol', '67993567741', 70, 'Ganhar massa magra', 'Alérgica a orégano', 4, '2016-09-01', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_dicas`
--

CREATE TABLE `tb_dicas` (
  `id` int(11) NOT NULL,
  `dica` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_dicas`
--

INSERT INTO `tb_dicas` (`id`, `dica`) VALUES
(5, 'Esta é uma nova dica'),
(7, 'Treino todos os dias até desmaiar na academia'),
(8, 'Esta é uma dica totalmentee nova'),
(12, 'Esta é uma dica com espaço adicional na esquerda.'),
(13, 'Ok, outra dicazinha');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_dicas_pacientes`
--

CREATE TABLE `tb_dicas_pacientes` (
  `id` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_dica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_dicas_pacientes`
--

INSERT INTO `tb_dicas_pacientes` (`id`, `id_paciente`, `id_dica`) VALUES
(35, 4, 5),
(45, 2, 5),
(46, 2, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_nutricionista`
--

CREATE TABLE `tb_nutricionista` (
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_nutricionista`
--

INSERT INTO `tb_nutricionista` (`nome`, `email`, `senha`) VALUES
('Paulinho Muzy', 'paulomuzyacessoria@gmail.com', 'a');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_planos`
--

CREATE TABLE `tb_planos` (
  `id` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_planos`
--

INSERT INTO `tb_planos` (`id`, `id_paciente`) VALUES
(2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_planos_refeicoes`
--

CREATE TABLE `tb_planos_refeicoes` (
  `id` int(11) NOT NULL,
  `id_plano` int(11) DEFAULT NULL,
  `id_refeicao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_planos_refeicoes`
--

INSERT INTO `tb_planos_refeicoes` (`id`, `id_plano`, `id_refeicao`) VALUES
(3, 2, 1),
(4, 2, 2),
(5, 2, 3),
(6, 2, 4),
(7, 2, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_refeicoes`
--

CREATE TABLE `tb_refeicoes` (
  `id` int(11) NOT NULL,
  `nome` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_refeicoes`
--

INSERT INTO `tb_refeicoes` (`id`, `nome`) VALUES
(1, 'Café da manhã'),
(2, 'Almoço'),
(3, 'Lanche da tarde'),
(4, 'Jantar'),
(5, 'Ceia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_refeicoes_alimentos`
--

CREATE TABLE `tb_refeicoes_alimentos` (
  `id` int(11) NOT NULL,
  `id_alimento` int(11) DEFAULT NULL,
  `id_refeicao` int(11) DEFAULT NULL,
  `id_plano` int(11) DEFAULT NULL,
  `qtd` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_refeicoes_alimentos`
--

INSERT INTO `tb_refeicoes_alimentos` (`id`, `id_alimento`, `id_refeicao`, `id_plano`, `qtd`) VALUES
(1, 1, 1, 1, '200'),
(2, 2, 1, 1, '130'),
(3, 5, 2, 1, '220'),
(4, 7, 2, 1, '178'),
(5, 4, 1, 2, '233'),
(6, 5, 1, 2, '111'),
(7, 1, 2, 2, '22'),
(8, 2, 4, 2, '134'),
(9, 6, 1, 2, '1'),
(10, 1, 1, 2, '5'),
(11, 3, 2, 2, '432'),
(12, 5, 4, 2, '2423'),
(13, 6, 3, 2, '222'),
(14, 1, 5, 2, '123'),
(15, 3, 3, 2, '122'),
(16, 5, 5, 2, '111'),
(19, 7, 5, 1, '54'),
(20, 1, 5, 2, '31'),
(21, 5, 3, 3, '25'),
(22, 7, 3, 3, '243'),
(23, 8, 3, 3, '235'),
(24, 3, 1, 2, '444'),
(25, 7, 4, 2, '222'),
(26, 9, 2, 2, '12'),
(27, 5, 1, 2, '1123'),
(28, 8, 2, 2, NULL),
(29, 10, 5, 2, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alimentos`
--
ALTER TABLE `alimentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `alimentos_consumidos`
--
ALTER TABLE `alimentos_consumidos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_dicas`
--
ALTER TABLE `tb_dicas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_dicas_pacientes`
--
ALTER TABLE `tb_dicas_pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_nutricionista`
--
ALTER TABLE `tb_nutricionista`
  ADD PRIMARY KEY (`senha`);

--
-- Índices para tabela `tb_planos`
--
ALTER TABLE `tb_planos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_planos_refeicoes`
--
ALTER TABLE `tb_planos_refeicoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_refeicoes`
--
ALTER TABLE `tb_refeicoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_refeicoes_alimentos`
--
ALTER TABLE `tb_refeicoes_alimentos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alimentos`
--
ALTER TABLE `alimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `alimentos_consumidos`
--
ALTER TABLE `alimentos_consumidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_dicas`
--
ALTER TABLE `tb_dicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `tb_dicas_pacientes`
--
ALTER TABLE `tb_dicas_pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de tabela `tb_planos`
--
ALTER TABLE `tb_planos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_planos_refeicoes`
--
ALTER TABLE `tb_planos_refeicoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tb_refeicoes`
--
ALTER TABLE `tb_refeicoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_refeicoes_alimentos`
--
ALTER TABLE `tb_refeicoes_alimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
