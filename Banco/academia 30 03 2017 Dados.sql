-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 30-Mar-2017 às 16:12
-- Versão do servidor: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `academia`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alimento`
--

CREATE TABLE `alimento` (
  `idalimento` int(11) NOT NULL,
  `idrefeicao_plano_nutricao` int(11) NOT NULL,
  `alimento` varchar(255) DEFAULT NULL,
  `medida` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `alimento`
--

INSERT INTO `alimento` (`idalimento`, `idrefeicao_plano_nutricao`, `alimento`, `medida`) VALUES
(1, 2, 'Pão Integral ', '1 Fatia'),
(2, 3, 'Leite', '1 Copo'),
(3, 4, 'Banana', '1'),
(4, 5, 'Arroz', '1 Porção'),
(5, 6, 'Suco', '1 Copo'),
(6, 7, 'Maça', '1'),
(7, 8, 'Carne Magra', '2 Pedaços'),
(8, 9, 'Suco', '1 Copo'),
(9, 10, 'Whey', '1 Copo'),
(10, 11, 'Peito de Frango', '2 pedaços'),
(11, 12, 'Suco de laranja', '1 Copo'),
(12, 13, 'Bananas', '2'),
(13, 14, 'Arroz Integral', '2 Porções'),
(14, 15, 'Suco de Limão', '1 Copo'),
(15, 16, 'Maça', '1'),
(16, 17, 'Peito de Peru', '1 Pedaço'),
(17, 18, 'Feijão', '1 Concha'),
(18, 19, 'Suco de Uva', '2 Copo'),
(19, 20, 'Whey', '1 Copo'),
(20, 21, 'Pão Integral', '1'),
(21, 22, 'Suco de pessego', '1 Copo'),
(22, 23, 'Banana nanica', '2'),
(23, 24, 'Arroz Integral', '1 Porção'),
(24, 25, 'Lnetilha', '1 Porção'),
(25, 26, 'maça', '1'),
(26, 27, 'pessego', '3'),
(27, 28, 'Grão de Bico', '1 Porção'),
(28, 29, 'Leite', '1 Copo'),
(30, 33, 'Pão Frances', '1'),
(31, 34, 'Whay', '1 Copo'),
(32, 35, 'Presunto', '1 Fatia'),
(33, 36, 'Arroz Integral', '1 Porção'),
(34, 37, 'Suco', '1 Copo'),
(35, 38, 'Goiaba e Manga', '1 de cada'),
(36, 39, 'Suco de Uva', '1 Copo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `idaluno` int(11) NOT NULL,
  `idpessoa` int(11) NOT NULL,
  `consultor` int(11) DEFAULT NULL,
  `codigoCatraca` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`idaluno`, `idpessoa`, `consultor`, `codigoCatraca`) VALUES
(1, 2, 1, '4234234234'),
(2, 3, 1, '13231'),
(3, 7, 6, '78798798'),
(4, 9, 8, '789798'),
(5, 10, 1, '89798787'),
(6, 11, 8, '43242343');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_ciclo`
--

CREATE TABLE `aluno_ciclo` (
  `idaluno_ciclo` int(11) NOT NULL,
  `idaluno` int(11) NOT NULL,
  `ciclo` varchar(255) DEFAULT NULL,
  `nivel` varchar(255) DEFAULT NULL,
  `genero` varchar(255) DEFAULT NULL,
  `metaPrincipal` varchar(255) DEFAULT NULL,
  `modeloCiclo` varchar(255) DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_termino` date DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `idcadastrador` int(11) NOT NULL,
  `dataCadastro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno_ciclo`
--

INSERT INTO `aluno_ciclo` (`idaluno_ciclo`, `idaluno`, `ciclo`, `nivel`, `genero`, `metaPrincipal`, `modeloCiclo`, `data_inicio`, `data_termino`, `ativo`, `idcadastrador`, `dataCadastro`) VALUES
(1, 1, 'Treino Extremo', 'Avançado', 'Masculino', 'Hipertrofia', 'ABCDE', '2016-12-01', '2017-02-20', 1, 0, NULL),
(2, 1, 'Treino Moderado', 'Intermediario', 'Feminino', 'Hiperetrofia', 'ABC', '2017-01-02', '2017-02-22', 0, 0, NULL),
(3, 2, 'Combinado Extreme', 'Avançado', 'Masculino', 'Hipertrofia', 'ABCDE', '2016-11-08', '2017-01-02', 0, 0, NULL),
(4, 2, 'Treino Leve', 'Iniciante', 'Feminino', 'Perda de peso', 'AB', '2016-07-03', '2016-04-29', 0, 0, NULL),
(5, 2, 'Ciclo Feminino', 'Iniciante', 'Feminino', 'Ganho de massa magra', 'AB', '2016-09-04', '2016-10-27', 0, 0, NULL),
(7, 1, 'Extreme Ciclo', 'Avançado', 'Feminino', 'Ganho de Força', 'ABCDE', '2017-01-12', '2017-03-30', 0, 0, NULL),
(8, 1, 'Treino Leve', 'Iniciante', 'Feminino', 'Perda de peso', 'AB', '2016-11-03', '2016-12-02', 0, 0, NULL),
(9, 1, 'Ciclo de Teste', 'Iniciante', 'Feminino', 'ganhar força', 'AB', '2017-01-10', '2017-02-10', 0, 0, NULL),
(10, 1, 'Ciclo de Teste 2', 'Iniciante', 'Feminino', 'perder peso', 'AB', '2016-12-10', '2017-01-15', 0, 0, NULL),
(11, 1, 'Ciclo de Teste 3', 'Iniciante', 'Feminino', 'ganhar força', 'AB', '2016-01-10', '0000-00-00', 0, 0, NULL),
(12, 1, 'Ciclo de Teste 4', 'Iniciante', 'Feminino', 'Ganha de massa magra', 'AB', '2017-02-12', '2017-02-12', 0, 0, NULL),
(13, 1, 'Ciclo de teste 5', 'Iniciante', 'Feminino', 'ganhar força', 'AB', '2016-12-01', '2016-01-01', 0, 0, NULL),
(14, 1, 'Ciclo de Teste 6', 'Iniciante', 'Feminino', 'ganhar massa magra', 'AB', '2015-06-10', '0000-00-00', 0, 0, NULL),
(15, 1, 'Ciclo de Teste 7', 'Iniciante', 'Feminino', 'Ganho de massa magra', 'AB', '2015-01-01', '0000-00-00', 0, 0, NULL),
(16, 2, 'Treino Extremo', 'Avançado', 'Masculino', 'Hipertrofia', 'ABCDE', '2017-01-03', '2017-02-02', 0, 0, NULL),
(17, 2, 'Treino Avançado', 'Avançado', 'Feminino', 'Ganhar força e massa Magra', 'ABCDE', '2017-02-03', '2017-02-03', 1, 0, NULL),
(18, 2, 'Treino Básico', 'Iniciante', 'Feminino', 'Perder Peso', 'AB', '2017-01-20', '2017-02-20', 0, 0, NULL),
(19, 2, 'Ciclo novo', 'Intermediario', 'Feminino', 'Ganhar força e perder peso', 'ABC', '2017-02-22', '2017-03-30', 0, 1, '2017-02-20'),
(20, 2, 'Novo Ciclo de Treino', 'Iniciante', 'Feminino', 'Ganhar força', 'AB', '2017-01-05', '2017-02-02', 0, 1, '2017-02-20'),
(21, 2, 'Ciclo para testes', 'Intermediario', 'Feminino', 'ganhar força', 'ABC', '2017-01-10', '2017-02-13', 0, 1, '2017-03-06'),
(22, 2, 'dasdasd', 'Intermediario', 'Feminino', 'dasdsad', 'ABC', '0000-00-00', '0000-00-00', 0, 1, '2017-03-06'),
(23, 2, 'dasda', 'Intermediario', 'Feminino', 'dasdsa', 'ABC', '2012-01-01', '2012-03-31', 0, 1, '2017-03-06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_contrato`
--

CREATE TABLE `aluno_contrato` (
  `idaluno_contrato` int(11) NOT NULL,
  `idaluno` int(11) NOT NULL,
  `idcontrato` int(11) NOT NULL,
  `idtipoPlano` int(11) NOT NULL,
  `idmodalidade` int(11) NOT NULL,
  `idprazoPlano` int(11) NOT NULL,
  `idformaPagamento` int(11) NOT NULL,
  `numeroParcelas` int(11) NOT NULL,
  `valorParcela` float NOT NULL,
  `valorTotal` float NOT NULL,
  `dataPagamento` date DEFAULT NULL,
  `dataContratacao` date DEFAULT NULL,
  `dataTermino` date DEFAULT NULL,
  `dataRenovacao` date DEFAULT NULL,
  `dataCadastro` date NOT NULL,
  `idcadastrador` int(11) NOT NULL,
  `ativo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno_contrato`
--

INSERT INTO `aluno_contrato` (`idaluno_contrato`, `idaluno`, `idcontrato`, `idtipoPlano`, `idmodalidade`, `idprazoPlano`, `idformaPagamento`, `numeroParcelas`, `valorParcela`, `valorTotal`, `dataPagamento`, `dataContratacao`, `dataTermino`, `dataRenovacao`, `dataCadastro`, `idcadastrador`, `ativo`) VALUES
(1, 6, 1, 1, 1, 3, 3, 6, 125, 750, NULL, NULL, NULL, NULL, '2017-03-29', 1, 0),
(2, 5, 1, 1, 1, 3, 3, 6, 125, 750, NULL, NULL, NULL, NULL, '2017-03-29', 1, 0),
(3, 1, 1, 1, 1, 3, 1, 6, 125, 750, NULL, NULL, NULL, NULL, '2017-03-29', 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_contrato_modalidade`
--

CREATE TABLE `aluno_contrato_modalidade` (
  `idaluno_contrato_modalidade` int(11) NOT NULL,
  `idaluno_contrato` int(11) NOT NULL,
  `idmodalidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_exercicio`
--

CREATE TABLE `aluno_exercicio` (
  `idaluno_exercicio` int(11) NOT NULL,
  `idaluno_treino` int(11) NOT NULL,
  `exercicio` varchar(255) DEFAULT NULL,
  `regiaoTrabalhada` varchar(255) DEFAULT NULL,
  `tipoExercicio` varchar(255) DEFAULT NULL,
  `aparelho` varchar(255) DEFAULT NULL,
  `serie` varchar(255) DEFAULT NULL,
  `repeticao` varchar(255) DEFAULT NULL,
  `peso` varchar(255) DEFAULT NULL,
  `intervalo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno_exercicio`
--

INSERT INTO `aluno_exercicio` (`idaluno_exercicio`, `idaluno_treino`, `exercicio`, `regiaoTrabalhada`, `tipoExercicio`, `aparelho`, `serie`, `repeticao`, `peso`, `intervalo`) VALUES
(1, 1, 'Triceps Pulley', 'Triceps', 'Musculação', 'Triceps Pulley', '3', '15', '30', '30'),
(2, 2, 'Rosca Scoth', 'Biceps', 'Musculação', 'Rosca Scoth', '', '', '', ''),
(3, 3, 'Supino Reto', 'Peito', 'Musculação', 'Supino Reto', '', '', '', ''),
(4, 4, 'Leg Press 45 graus', 'Pernas', 'Musculação', 'Leg Press', '', '', '', ''),
(5, 5, 'Abdome Paralela', 'Abdome', 'Musculação', 'Abdome Paralela', '', '', '', ''),
(6, 6, 'Supino Reto', 'Peito', 'Musculação', 'Supino Reto', '3', '12', '60', '30'),
(7, 6, 'Supino Inclinado', 'Peito', 'Musculação', 'Supino Inclinado', '3', '12', '50', '30'),
(8, 6, 'Supino Declinado', 'Peito', 'Musculação', 'Supino Declinado', '3', '12', '60', '30'),
(9, 7, 'Triceps Pulley', 'Triceps', 'Musculação', 'Triceps Pulley', '3', '15', '30', '30'),
(10, 7, 'Rosca Scoth', 'Biceps', 'Musculação', 'Rosca Scoth', '3', '15', '40', '30'),
(11, 7, 'Abdome Paralela', 'Abdome', 'Musculação', 'Abdome Paralela', '4', '15', NULL, '90'),
(12, 8, 'Enxensor', 'Pernas', 'Musculação', 'Extensor', '3', '15', '40', '30'),
(13, 8, 'Flexora', 'Pernas', 'Musculação', 'Flexora', '3', '15', '40', '30'),
(14, 8, 'Leg Press 45 graus', 'Pernas', 'Musculação', 'Leg Press', '3', '15', '80', '60'),
(15, 9, 'Supino Reto + Crucifixo Reto + Cross Over', 'Peito', 'Musculação', 'Supino Reto', '', '', '', ''),
(16, 9, 'Supino Inclinado + Voador Peito', 'Peito', 'Musculação', 'Supino Inclinado', '', '', '', ''),
(17, 10, 'Supino Declinado + Voador Peito', 'Peito', 'Musculação', 'Supino Declinado', '', '', '', ''),
(18, 10, 'Enxensor + Flexora', 'Pernas', 'Musculação', 'Extensor', '', '', '', ''),
(19, 10, 'Leg Press 45 graus + Abdutora', 'Pernas', 'Musculação', 'Leg Press', '', '', '', ''),
(20, 11, NULL, NULL, NULL, NULL, '', '', '', ''),
(21, 11, 'Supino Reto', 'Peito', 'Musculação', 'Supino Reto', '', '', '', ''),
(22, 11, 'Voador Peito', 'Peito', 'Musculação', 'Voador Peito', '', '', '', ''),
(23, 12, 'Rosca Scoth', 'Biceps', 'Musculação', 'Rosca Scoth', '', '', '', ''),
(24, 12, 'Flexora', 'Pernas', 'Musculação', 'Flexora', '', '', '', ''),
(25, 12, 'Leg Press 45 graus', 'Pernas', 'Musculação', 'Leg Press', '', '', '', ''),
(26, 25, NULL, NULL, NULL, NULL, '', '', '', ''),
(27, 25, 'Supino Reto', 'Peito', 'Musculação', 'Supino Reto', '3', '15', '30', '30'),
(28, 25, 'Voador Peito', 'Peito', 'Musculação', 'Voador Peito', '3', '15', '30', '30'),
(29, 26, 'Rosca Scoth', 'Biceps', 'Musculação', 'Rosca Scoth', '3', '12', '20', '30'),
(30, 26, 'Flexora', 'Pernas', 'Musculação', 'Flexora', '', '', '', ''),
(31, 26, 'Leg Press 45 graus', 'Pernas', 'Musculação', 'Leg Press', '4', '20', '20', '30'),
(32, 27, 'Supino Reto', 'Peito', 'Musculação', 'Supino Reto', '3', '12', '30', '30'),
(33, 27, 'Voador Peito', 'Peito', 'Musculação', 'Voador Peito', '', '', '', ''),
(34, 27, 'Cross Over', 'Peito', 'Musculação', 'Halteres', '', '', '', ''),
(35, 28, 'Elevação Leteral', 'Ombros', 'Musculação', 'Halteres', '', '', '', ''),
(36, 28, 'Flexora', 'Pernas', 'Musculação', 'Flexora', '', '', '', ''),
(37, 28, 'Leg Press 45 graus', 'Pernas', 'Musculação', 'Leg Press', '', '', '', ''),
(38, 29, 'Crucifixo Reto', 'Peito', 'Musculação', 'Halteres', '', '', '', ''),
(39, 29, 'Rosca Scoth', 'Biceps', 'Musculação', 'Rosca Scoth', '', '', '', ''),
(40, 29, 'Desenvolvimento Com Halteres', 'Ombros', 'Musculação', 'Banco Sentado', '', '', '', ''),
(41, 30, 'Elevação Leteral', 'Ombros', 'Musculação', 'Halteres', '', '', '', ''),
(42, 30, 'Abdutora', 'Pernas', 'Musculação', 'Abdutora', '', '', '', ''),
(43, 30, 'Abdome Paralela', 'Abdome', 'Musculação', 'Abdome Paralela', '', '', '', ''),
(44, 30, 'Leg Press 45 graus', 'Pernas', 'Musculação', 'Leg Press', '', '', '', ''),
(45, 31, 'Flexora', 'Pernas', 'Musculação', 'Flexora', '', '', '', ''),
(46, 31, 'Abdome Paralela', 'Abdome', 'Musculação', 'Abdome Paralela', '', '', '', ''),
(47, 31, 'Supino Reto', 'Peito', 'Musculação', 'Supino Reto', '', '', '', ''),
(48, 32, 'Cross Over', 'Peito', 'Musculação', 'Halteres', '', '', '', ''),
(49, 32, 'Desenvolvimento Com Halteres', 'Ombros', 'Musculação', 'Banco Sentado', '', '', '', ''),
(50, 33, 'Supino Reto', 'Peito', 'Musculação', 'Supino Reto', '', '', '', ''),
(51, 33, 'Voador Peito', 'Peito', 'Musculação', 'Voador Peito', '', '', '', ''),
(52, 33, 'Cross Over', 'Peito', 'Musculação', 'Halteres', '', '', '', ''),
(53, 34, 'Rosca Scoth', 'Biceps', 'Musculação', 'Rosca Scoth', '', '', '', ''),
(54, 34, 'Desenvolvimento Com Halteres', 'Ombros', 'Musculação', 'Banco Sentado', '', '', '', ''),
(55, 34, 'Flexora', 'Pernas', 'Musculação', 'Flexora', '', '', '', ''),
(56, 37, 'Supino Inclinado', 'Peito', 'Musculação', 'Supino Inclinado', '', '', '', ''),
(57, 37, 'Cross Over', 'Peito', 'Musculação', 'Halteres', '', '', '', ''),
(58, 37, 'Elevação Leteral', 'Ombros', 'Musculação', 'Halteres', '', '', '', ''),
(59, 38, 'Flexora', 'Pernas', 'Musculação', 'Flexora', '', '', '', ''),
(60, 38, 'Leg Press 45 graus', 'Pernas', 'Musculação', 'Leg Press', '', '', '', ''),
(61, 38, 'Abdutora', 'Pernas', 'Musculação', 'Abdutora', '', '', '', ''),
(62, 38, 'Abdome Paralela', 'Abdome', 'Musculação', 'Abdome Paralela', '', '', '', ''),
(63, 39, 'Supino Inclinado', 'Peito', 'Musculação', 'Supino Inclinado', '', '', '', ''),
(64, 39, 'Triceps Pulley', 'Triceps', 'Musculação', 'Triceps Pulley', '', '', '', ''),
(65, 39, 'Elevação Leteral', 'Ombros', 'Musculação', 'Halteres', '', '', '', ''),
(66, 40, 'Abdome Paralela', 'Abdome', 'Musculação', 'Abdome Paralela', '', '', '', ''),
(67, 40, 'Flexora', 'Pernas', 'Musculação', 'Flexora', '', '', '', ''),
(68, 40, 'Leg Press 45 graus', 'Pernas', 'Musculação', 'Leg Press', '', '', '', ''),
(69, 41, NULL, NULL, NULL, NULL, '', '', '', ''),
(70, 42, 'Triceps Pulley', 'Triceps', 'Musculação', 'Triceps Pulley', '', '', '', ''),
(71, 43, 'Rosca Scoth', 'Biceps', 'Musculação', 'Rosca Scoth', '', '', '', ''),
(72, 44, 'Supino Reto', 'Peito', 'Musculação', 'Supino Reto', '', '', '', ''),
(73, 45, 'Leg Press 45 graus', 'Pernas', 'Musculação', 'Leg Press', '', '', '', ''),
(74, 45, 'Abdome Paralela', 'Abdome', 'Musculação', 'Abdome Paralela', '', '', '', ''),
(75, 46, NULL, NULL, NULL, NULL, '', '', '', ''),
(76, 46, 'Supino Reto', 'Peito', 'Musculação', 'Supino Reto', '', '', '', ''),
(77, 46, 'Supino Inclinado', 'Peito', 'Musculação', 'Supino Inclinado', '', '', '', ''),
(78, 46, 'Voador Peito', 'Peito', 'Musculação', 'Voador Peito', '', '', '', ''),
(79, 47, 'Crucifixo Reto', 'Peito', 'Musculação', 'Halteres', '', '', '', ''),
(80, 47, 'Elevação Leteral', 'Ombros', 'Musculação', 'Halteres', '', '', '', ''),
(81, 48, 'Desenvolvimento Com Halteres', 'Ombros', 'Musculação', 'Banco Sentado', '', '', '', ''),
(82, 49, 'Rosca Scoth', 'Biceps', 'Musculação', 'Rosca Scoth', '', '', '', ''),
(83, 49, 'Triceps Pulley', 'Triceps', 'Musculação', 'Triceps Pulley', '', '', '', ''),
(84, 50, 'Abdome Paralela', 'Abdome', 'Musculação', 'Abdome Paralela', '', '', '', ''),
(85, 50, 'Flexora', 'Pernas', 'Musculação', 'Flexora', '', '', '', ''),
(86, 50, 'Leg Press 45 graus', 'Pernas', 'Musculação', 'Leg Press', '', '', '', ''),
(87, 50, 'Abdutora', 'Pernas', 'Musculação', 'Abdutora', '', '', '', ''),
(88, 51, NULL, NULL, NULL, NULL, '', '', '', ''),
(89, 51, 'Supino Reto', 'Peito', 'Musculação', 'Supino Reto', '4', '15', '20', '60'),
(90, 51, 'Voador Peito', 'Peito', 'Musculação', 'Voador Peito', '', '', '', ''),
(91, 51, 'Cross Over', 'Peito', 'Musculação', 'Halteres', '', '', '', ''),
(92, 51, 'Triceps Pulley', 'Triceps', 'Musculação', 'Triceps Pulley', '', '', '', ''),
(93, 52, 'Rosca Scoth', 'Biceps', 'Musculação', 'Rosca Scoth', '', '', '', ''),
(94, 52, 'Desenvolvimento Com Halteres', 'Ombros', 'Musculação', 'Banco Sentado', '', '', '', ''),
(95, 52, 'Elevação Leteral', 'Ombros', 'Musculação', 'Halteres', '', '', '', ''),
(96, 52, 'Flexora', 'Pernas', 'Musculação', 'Flexora', '', '', '', ''),
(97, 52, 'Leg Press 45 graus', 'Pernas', 'Musculação', 'Leg Press', '', '', '', ''),
(98, 53, NULL, NULL, NULL, NULL, '', '', '', ''),
(99, 53, 'Supino Reto', 'Peito', 'Musculação', 'Supino Reto', '', '', '', ''),
(100, 53, 'Voador Peito', 'Peito', 'Musculação', 'Voador Peito', '', '', '', ''),
(101, 53, 'Crucifixo Reto', 'Peito', 'Musculação', 'Halteres', '', '', '', ''),
(102, 54, 'Triceps Pulley', 'Triceps', 'Musculação', 'Triceps Pulley', '', '', '', ''),
(103, 54, 'Puxador Costas', 'Costas', 'Musculação', 'Puxador Costas', '', '', '', ''),
(104, 54, 'Abdome Paralela', 'Abdome', 'Musculação', 'Abdome Paralela', '', '', '', ''),
(105, 55, 'Rosca Scoth', 'Biceps', 'Musculação', 'Rosca Scoth', '', '', '', ''),
(106, 55, 'Enxensor', 'Pernas', 'Musculação', 'Extensor', '', '', '', ''),
(107, 55, 'Flexora', 'Pernas', 'Musculação', 'Flexora', '', '', '', ''),
(108, 55, 'Leg Press 45 graus', 'Pernas', 'Musculação', 'Leg Press', '', '', '', ''),
(109, 56, 'Voador Peito', 'Peito', 'Musculação', 'Voador Peito', '', '', '', ''),
(110, 56, 'Cross Over', 'Peito', 'Musculação', 'Halteres', '', '', '', ''),
(112, 56, 'Rosca Scoth', 'Biceps', 'Musculação', 'Rosca Scoth', '', '', '', ''),
(113, 56, 'Triceps Pulley', 'Triceps', 'Musculação', 'Triceps Pulley', '', '', '', ''),
(114, 57, 'Flexora', 'Pernas', 'Musculação', 'Flexora', '', '', '', ''),
(115, 57, 'Leg Press 45 graus', 'Pernas', 'Musculação', 'Leg Press', '', '', '', ''),
(116, 57, 'Abdutora', 'Pernas', 'Musculação', 'Abdutora', '', '', '', ''),
(117, 57, 'Puxador Costas', 'Costas', 'Musculação', 'Puxador Costas', '', '', '', ''),
(118, 58, NULL, NULL, NULL, NULL, '', '', '', ''),
(119, 58, 'Supino Reto', 'Peito', 'Musculação', 'Supino Reto', '3', '15', '40', NULL),
(120, 58, 'Supino Declinado', 'Peito', 'Musculação', 'Supino Declinado', '2', '20', '25', '30'),
(121, 58, 'Crucifixo Reto', 'Peito', 'Musculação', 'Halteres', '3', '15', '45', NULL),
(122, 59, 'Triceps Pulley', 'Triceps', 'Musculação', 'Triceps Pulley', '', '', '', ''),
(123, 59, 'Desenvolvimento Com Halteres', 'Ombros', 'Musculação', 'Banco Sentado', '', '', '', ''),
(124, 59, 'Elevação Leteral', 'Ombros', 'Musculação', 'Halteres', '', '', '', ''),
(125, 60, 'Rosca Scoth', 'Biceps', 'Musculação', 'Rosca Scoth', '', '', '', ''),
(126, 60, 'Enxensor', 'Pernas', 'Musculação', 'Extensor', '', '', '', ''),
(127, 60, 'Flexora', 'Pernas', 'Musculação', 'Flexora', '', '', '', ''),
(128, 60, 'Leg Press 45 graus', 'Pernas', 'Musculação', 'Leg Press', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_treino`
--

CREATE TABLE `aluno_treino` (
  `idaluno_treino` int(11) NOT NULL,
  `idaluno_ciclo` int(11) NOT NULL,
  `treino` varchar(255) DEFAULT NULL,
  `regioesTrabalhadas` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno_treino`
--

INSERT INTO `aluno_treino` (`idaluno_treino`, `idaluno_ciclo`, `treino`, `regioesTrabalhadas`) VALUES
(1, 1, 'A', NULL),
(2, 1, 'B', NULL),
(3, 1, 'C', NULL),
(4, 1, 'D', NULL),
(5, 1, 'E', NULL),
(6, 2, 'A', NULL),
(7, 2, 'B', NULL),
(8, 2, 'C', NULL),
(9, 3, 'A', NULL),
(10, 3, 'B', NULL),
(11, 4, 'A', NULL),
(12, 4, 'B', NULL),
(13, 5, 'A', NULL),
(14, 5, 'B', NULL),
(20, 7, 'A', NULL),
(21, 7, 'B', NULL),
(22, 7, 'C', NULL),
(23, 7, 'D', NULL),
(24, 7, 'E', NULL),
(25, 8, 'A', NULL),
(26, 8, 'B', NULL),
(27, 9, 'A', NULL),
(28, 9, 'B', NULL),
(29, 10, 'A', NULL),
(30, 10, 'B', NULL),
(31, 11, 'A', NULL),
(32, 11, 'B', NULL),
(33, 12, 'A', NULL),
(34, 12, 'B', NULL),
(35, 13, 'A', NULL),
(36, 13, 'B', NULL),
(37, 14, 'A', NULL),
(38, 14, 'B', NULL),
(39, 15, 'A', NULL),
(40, 15, 'B', NULL),
(41, 16, 'A', NULL),
(42, 16, 'B', NULL),
(43, 16, 'C', NULL),
(44, 16, 'D', NULL),
(45, 16, 'E', NULL),
(46, 17, 'A', NULL),
(47, 17, 'B', NULL),
(48, 17, 'C', NULL),
(49, 17, 'D', NULL),
(50, 17, 'E', NULL),
(51, 18, 'A', NULL),
(52, 18, 'B', NULL),
(53, 19, 'A', NULL),
(54, 19, 'B', NULL),
(55, 19, 'C', NULL),
(56, 20, 'A', NULL),
(57, 20, 'B', NULL),
(58, 21, 'A', NULL),
(59, 21, 'B', NULL),
(60, 21, 'C', NULL),
(61, 22, 'A', NULL),
(62, 22, 'B', NULL),
(63, 22, 'C', NULL),
(64, 23, 'A', NULL),
(65, 23, 'B', NULL),
(66, 23, 'C', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aparelho`
--

CREATE TABLE `aparelho` (
  `idaparelho` int(11) NOT NULL,
  `aparelho` varchar(255) DEFAULT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `idcadastrador` int(11) NOT NULL,
  `dataCadastro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aparelho`
--

INSERT INTO `aparelho` (`idaparelho`, `aparelho`, `numero`, `idcadastrador`, `dataCadastro`) VALUES
(1, 'Supino Reto', '1', 0, NULL),
(2, 'Supino Inclinado', '2', 0, NULL),
(3, 'Supino Declinado', '3', 0, NULL),
(4, 'Triceps Pulley', '4', 0, NULL),
(5, 'Rosca Scoth', '5', 0, NULL),
(6, 'Flexora', '6', 0, NULL),
(7, 'Extensor', '7', 0, NULL),
(8, 'Leg Press', '8', 0, NULL),
(9, 'Abdome Paralela', '9', 0, NULL),
(10, 'Esteira', '10', 0, NULL),
(11, 'Banco Sentado', '11', 0, NULL),
(12, 'Voador Peito', '12', 0, NULL),
(13, 'Halteres', '13', 0, NULL),
(14, 'Abdutora', '14', 0, NULL),
(15, 'Puxador Costas', '15', 1, '2017-02-20'),
(16, 'Barra Guia', '16', 1, '2017-03-17'),
(17, 'Adutor', '17', 1, '2017-03-17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao_fisica`
--

CREATE TABLE `avaliacao_fisica` (
  `idavaliacao_fisica` int(11) NOT NULL,
  `idaluno` int(11) NOT NULL,
  `data_avaliacao` date DEFAULT NULL,
  `peso` float DEFAULT NULL,
  `altura` float DEFAULT NULL,
  `triceps` float DEFAULT NULL,
  `subescapular` float DEFAULT NULL,
  `supralliaca` float DEFAULT NULL,
  `abdomen` float DEFAULT NULL,
  `braco_esquerdo` float DEFAULT NULL,
  `braco_direito` float DEFAULT NULL,
  `antibraco_esquerdo` float DEFAULT NULL,
  `antibraco_direito` float DEFAULT NULL,
  `quadril` float DEFAULT NULL,
  `cintura` float DEFAULT NULL,
  `pescoco` float DEFAULT NULL,
  `coxa_esquerda` float DEFAULT NULL,
  `coxa_direita` float DEFAULT NULL,
  `perna_esquerda` float DEFAULT NULL,
  `perna_direita` float DEFAULT NULL,
  `radio` float DEFAULT NULL,
  `femur` float DEFAULT NULL,
  `imc` float DEFAULT NULL,
  `percentual_gordura` float DEFAULT NULL,
  `massa_magra` float DEFAULT NULL,
  `massa_gorda` float DEFAULT NULL,
  `idcadastrador` int(11) NOT NULL,
  `dataCadastro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `avaliacao_fisica`
--

INSERT INTO `avaliacao_fisica` (`idavaliacao_fisica`, `idaluno`, `data_avaliacao`, `peso`, `altura`, `triceps`, `subescapular`, `supralliaca`, `abdomen`, `braco_esquerdo`, `braco_direito`, `antibraco_esquerdo`, `antibraco_direito`, `quadril`, `cintura`, `pescoco`, `coxa_esquerda`, `coxa_direita`, `perna_esquerda`, `perna_direita`, `radio`, `femur`, `imc`, `percentual_gordura`, `massa_magra`, `massa_gorda`, `idcadastrador`, `dataCadastro`) VALUES
(1, 1, '2017-02-22', 90, 1.75, 35, 32, 40, 45, 33, 32, 23, 22, 40, 42, 36, 62, 63, 52, 53, 25, 27, 29.39, 35.39, 58.15, 31.85, 1, '2017-02-22'),
(2, 2, '2017-02-20', 65, 1.69, 32, 36, 43, 40, 25, 25, 18, 19, 44, 52, 36, 47, 48, 41, 40, 36, 25, 22.76, 27.43, 47.17, 17.83, 1, '2017-02-22'),
(3, 1, '2016-01-10', 65, 1.78, 26, 36, 47, 39, 31, 30, 20, 19, 38, 50, 35, 42, 43, 36, 37, 26, 28, 20.52, 24.74, 48.92, 16.08, 1, '2017-03-23'),
(8, 2, '2016-03-23', 62, 1.69, 25, 26, 31, 42, 32, 31, 21, 22, 43, 52, 30, 47, 48, 34, 36, 28, 26, 21.71, 26.17, 45.77, 16.23, 1, '2017-02-22'),
(9, 3, '2017-03-15', 70, 1.75, 30, 40, 25, 20, 32, 31, 21, 20, 30, 40, 20, 40, 41, 32, 31, 10, 20, 22.86, 18.36, 57.15, 12.85, 1, '2017-03-15'),
(10, 1, '2017-03-15', 75, 1.76, 25, 30, 32, 28, 27, 26, 18, 19, 31, 29, 18, 36, 35, 40, 41, 28, 20, 24.21, 29.17, 53.12, 21.88, 1, '2017-03-15'),
(11, 1, '2016-01-10', 80, 1.8, 27, 32, 42, 35, 31, 30, 20, 19, 38, 45, 32, 40, 41, 32, 33, 26, 28, 24.69, 29.75, 56.2, 23.8, 1, '2017-03-23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairro`
--

CREATE TABLE `bairro` (
  `idbairro` int(11) NOT NULL,
  `idcidade` int(11) NOT NULL,
  `bairro` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bairro`
--

INSERT INTO `bairro` (`idbairro`, `idcidade`, `bairro`) VALUES
(1, 1, 'Santa Efigênia'),
(2, 2, 'Parque Tarumã'),
(3, 3, 'Parque Industrial Cidade de Maringá'),
(4, 4, 'Jardim São Paulo'),
(5, 5, 'Sao Pedro'),
(6, 6, 'Jardim São Paulo'),
(7, 7, 'Cidade Jardim'),
(8, 8, 'Moradias Atenas'),
(9, 9, 'Jardim Paulista IV'),
(10, 10, 'Vila Santo Antônio'),
(11, 11, 'Barreirinha');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_treino`
--

CREATE TABLE `categoria_treino` (
  `idcategoriaTreino` int(11) NOT NULL,
  `categoria` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ciclo`
--

CREATE TABLE `ciclo` (
  `idciclo` int(11) NOT NULL,
  `ciclo` varchar(255) DEFAULT NULL,
  `nivel` varchar(255) DEFAULT NULL,
  `genero` varchar(255) DEFAULT NULL,
  `metaPrincipal` varchar(255) DEFAULT NULL,
  `modeloCiclo` varchar(255) DEFAULT NULL,
  `idcadastrador` int(11) NOT NULL,
  `dataCadastro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ciclo`
--

INSERT INTO `ciclo` (`idciclo`, `ciclo`, `nivel`, `genero`, `metaPrincipal`, `modeloCiclo`, `idcadastrador`, `dataCadastro`) VALUES
(1, 'Treino Moderado', 'Intermediario', 'Feminino', 'Hiperetrofia', 'ABC', 0, NULL),
(2, 'Treino Extremo', 'Avançado', 'Masculino', 'Hipertrofia', 'ABCDE', 0, NULL),
(3, 'Combinado Extreme', 'Avançado', 'Masculino', 'Hipertrofia', 'ABCDE', 0, NULL),
(4, 'Treino Leve', 'Iniciante', 'Feminino', 'Perda de peso', 'AB', 0, NULL),
(5, 'Treino Avançado', 'Avançado', 'Feminino', 'Ganhar força e massa Magra', 'ABCDE', 0, NULL),
(6, 'Treino Básico', 'Iniciante', 'Feminino', 'Perder Peso', 'AB', 0, NULL),
(7, 'Ciclo novo', 'Intermediario', 'Feminino', 'Ganhar força e perder peso', 'ABC', 1, '2017-02-20'),
(8, 'Ciclo para testes', 'Intermediario', 'Feminino', 'ganhar força', 'ABC', 1, '2017-03-06'),
(10, 'Treino Profissional', 'Avançado', 'Masculino', 'Ganhar Músculos e perder Peso', 'ABC', 1, '2017-03-17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ciclo_treino`
--

CREATE TABLE `ciclo_treino` (
  `idCiclo_treino` int(11) NOT NULL,
  `Ciclo_idciclo` int(11) NOT NULL,
  `treino_idtreino` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ciclo_treino`
--

INSERT INTO `ciclo_treino` (`idCiclo_treino`, `Ciclo_idciclo`, `treino_idtreino`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 4),
(5, 2, 5),
(6, 2, 6),
(7, 2, 7),
(8, 2, 8),
(9, 3, 9),
(10, 3, 10),
(11, 3, 11),
(12, 3, 12),
(13, 3, 13),
(14, 4, 14),
(15, 4, 15),
(16, 5, 16),
(17, 5, 17),
(18, 5, 18),
(19, 5, 19),
(20, 5, 20),
(21, 6, 21),
(22, 6, 22),
(23, 7, 23),
(24, 7, 24),
(25, 7, 25),
(26, 8, 26),
(27, 8, 27),
(28, 8, 28),
(29, 10, 31),
(30, 10, 32),
(31, 10, 33);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

CREATE TABLE `cidade` (
  `idcidade` int(11) NOT NULL,
  `idestado` int(11) NOT NULL,
  `cidade` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cidade`
--

INSERT INTO `cidade` (`idcidade`, `idestado`, `cidade`) VALUES
(1, 18, 'Paiçandu'),
(2, 18, 'Maringá'),
(3, 18, 'Maringá'),
(4, 18, 'Maringá'),
(5, 8, 'Maringá'),
(6, 18, 'Maringá'),
(7, 18, 'Maringá'),
(8, 18, 'Maringá'),
(9, 18, 'Maringá'),
(10, 18, 'Maringá'),
(11, 18, 'Curitiba');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contrato`
--

CREATE TABLE `contrato` (
  `idcontrato` int(11) NOT NULL,
  `texto` text,
  `nome` varchar(255) DEFAULT NULL,
  `idcadastrador` int(11) NOT NULL,
  `dataCadastro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `contrato`
--

INSERT INTO `contrato` (`idcontrato`, `texto`, `nome`, `idcadastrador`, `dataCadastro`) VALUES
(1, 'As partes acima identificadas têm, entre si, justo e acertado o presenteContrato de Prestação de Serviços\nde Academia de Ginástica, que se regerá  pelas cláusulas seguintes e pelas condições descritas no presente.\nDO OBJETO DO CONTRATO\n \nCláusula 1ª.\nEste contrato tem como OBJETO o uso de academia, de propriedade da\nCONTRATADA, pelo CONTRATANTE\npara fazer a atividade física ____________________________________________________.\nDO FUNCIONAMENTO\n \nCláusula 2ª.\n A academia de ginástica funcionará de segunda a sexta feira das07h00 as 22h00 e aos sábados das 09h00 as 13h00. \nCláusula 3ª.\nEstes horários poderão sofrer alterações, de acordo com as necessidades da\nCONTRATADA\n\nCláusula 4ª.\nO CONTRATANTE\npoderá frequentar as instalações da\nCONTRATADA\nnos dias e horários estipulados no contrato, respeitando os horários e as turmas nas atividades em grupo oferecidas pela\nCONTRATADA\n\nDAS ATIVIDADES\n \nCláusula 5ª.\nO CONTRATANTE\npoderá realizar as seguintes atividades no estabelecimento da\nCONTRATADA\n: musculação, ginástica, lutas, alongamento, postural, dança, desde que esteja coberto por este contrato. \n\nCláusula 6ª.\nA CONTRATADA\nterá técnicos qualificados para orientação do\nCONTRATANTE\n. \nCláusula 7ª.\nCaso a\nCONTRATADA\ndisponibilize novas atividades, o\nCONTRATANTE\nseguirá as mesmas normas que regem este contrato para delas participar.', 'Musculação', 1, '2017-03-30'),
(2, 'Cláusula 8ª.\n A matrícula deverá ser feita na secretaria da\nCONTRATADA\n,devendo o\nCONTRATANTE\napresentar os documentos solicitados na realização da matrícula, bem como preencher a ficha cadastral e amaminese', 'Contrato Novo Musculação', 1, '2017-03-27'),
(3, 'Cláusula 9ª.\nQuando o\nCONTRATANTE\nfor menor de idade, o pai ou responsável deverá assinar o contrato, apresentando os documentos na Cláusula8ª relacionados.', 'Contrato de Zumba', 1, '2017-03-27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `deletar`
--

CREATE TABLE `deletar` (
  `idaluno_contrato` int(11) NOT NULL,
  `idaluno` int(11) DEFAULT NULL,
  `idcontrato` int(11) DEFAULT NULL,
  `idformaPagamento` int(11) NOT NULL,
  `idtipoPlano` int(11) NOT NULL,
  `idprazoPlano` int(11) NOT NULL,
  `numeroParcelas` int(11) NOT NULL,
  `valorParcela` float NOT NULL,
  `valorTotal` float NOT NULL,
  `dataPagamento` date NOT NULL,
  `dataContratacao` date NOT NULL,
  `dataTermino` date NOT NULL,
  `dataRenovacao` int(11) NOT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `idmodalidade` int(11) DEFAULT NULL,
  `dataCadastro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `email`
--

CREATE TABLE `email` (
  `idemail` int(11) NOT NULL,
  `idpessoa` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `email`
--

INSERT INTO `email` (`idemail`, `idpessoa`, `email`) VALUES
(1, 1, 'willrock1968@hotmail.com'),
(2, 2, 'naty@gmail.com'),
(3, 3, 'aline@gmail.com'),
(9, 7, 'dionatas@gmail.com'),
(10, 8, 'sandrobrito@hotmail.com'),
(11, 8, 'sandrobrito@gmail.com'),
(12, 9, 'lorena@gmail.com'),
(13, 9, 'lorena@hotmail.com'),
(14, 10, 'helena@hotmail.com'),
(15, 10, 'helena@gmail.com'),
(16, 11, 'isabelareis@hotmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `idempresa` int(11) NOT NULL,
  `empresa` varchar(255) NOT NULL,
  `cnpj` varchar(255) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `inscricao_estadual` varchar(255) DEFAULT NULL,
  `razao_social` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`idempresa`, `empresa`, `cnpj`, `rua`, `numero`, `bairro`, `cep`, `cidade`, `estado`, `inscricao_estadual`, `razao_social`) VALUES
(1, 'Performance Academia', '43.584.751/0001-05', 'Humberto Moreschi', '288', 'Chacara Manella', '86186-010', 'Cambe', 'Parana', '560.22843-03', 'Performance Academia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `idendereco` int(11) NOT NULL,
  `idpessoa` int(11) NOT NULL,
  `idbairro` int(11) NOT NULL,
  `rua` varchar(255) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `referencia` varchar(255) DEFAULT NULL,
  `cep` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`idendereco`, `idpessoa`, `idbairro`, `rua`, `numero`, `complemento`, `referencia`, `cep`) VALUES
(1, 1, 1, 'Cabo Antonio Jose Alves', 38, 'casa', 'perto do vercindes', '87140-000'),
(2, 2, 2, 'Rua Antônia Capoti Fernandes', 1200, 'casa', 'perto do campo de futebol', '87053-610'),
(3, 3, 3, 'Avenida Anderson José Mainardes', 250, 'casa', 'perto do horti fruti', '87069-000'),
(7, 7, 7, 'Rua Alfredo Rubim', 250, 'casa', 'perto da padaria', '87020-516'),
(8, 8, 8, 'Rua Anisio Gonçalves de Oliveira', 696, 'Casa', 'perto da empresa dele', '87075-742'),
(9, 9, 9, 'Rua Antenor Fernandes', 560, 'casa', 'peto da padaria', '87047-675'),
(10, 10, 10, 'Rua Aristides Lobo', 255, 'casa', 'perto da refinaria', '87030-240'),
(11, 11, 11, 'Avenida Anita Garibaldi', 250, 'casa', 'perto do estadio', '82220-000');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

CREATE TABLE `estado` (
  `idestado` int(11) NOT NULL,
  `codigo_ibge` varchar(255) DEFAULT NULL,
  `sigla` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estado`
--

INSERT INTO `estado` (`idestado`, `codigo_ibge`, `sigla`, `estado`) VALUES
(1, '12', 'AC', 'Acre'),
(2, '27', 'AL', 'Alagoas'),
(3, '13', 'AM', 'Amazonas'),
(4, '16', 'AP', 'Amapá'),
(5, '29', 'BA', 'Bahia'),
(6, '23', 'CE', 'Ceará'),
(7, '53', 'DF', 'Distrito Federal'),
(8, '32', 'ES', 'Espírito Santo'),
(9, '52', 'GO', 'Goiás'),
(10, '21', 'MA', 'Maranhão'),
(11, '31', 'MG', 'Minas Gerais'),
(12, '50', 'MS', 'Mato Grosso do Sul'),
(13, '51', 'MT', 'Mato Grosso'),
(14, '15', 'PA', 'Pará'),
(15, '25', 'PB', 'Paraíba'),
(16, '26', 'PE', 'Pernambuco'),
(17, '22', 'PI', 'Piauí'),
(18, '41', 'PR', 'Paraná'),
(19, '33', 'RJ', 'Rio de Janeiro'),
(20, '24', 'RN', 'Rio Grande do Norte'),
(21, '11', 'RO', 'Rondônia'),
(22, '14', 'RR', 'Roraima'),
(23, '43', 'RS', 'Rio Grande do Sul'),
(24, '42', 'SC', 'Santa Catarina'),
(25, '28', 'SE', 'Sergipe'),
(26, '35', 'SP', 'São Paulo'),
(27, '17', 'TO', 'Tocantins');

-- --------------------------------------------------------

--
-- Estrutura da tabela `exercicio`
--

CREATE TABLE `exercicio` (
  `idexercicio` int(11) NOT NULL,
  `idtipoExercicio` int(11) NOT NULL,
  `idregiaoTrabalhada` int(11) NOT NULL,
  `idaparelho` int(11) NOT NULL,
  `exercicio` varchar(255) DEFAULT NULL,
  `idcadastrador` int(11) NOT NULL,
  `dataCadastro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `exercicio`
--

INSERT INTO `exercicio` (`idexercicio`, `idtipoExercicio`, `idregiaoTrabalhada`, `idaparelho`, `exercicio`, `idcadastrador`, `dataCadastro`) VALUES
(1, 1, 1, 1, 'Supino Reto', 0, NULL),
(2, 1, 1, 2, 'Supino Inclinado', 0, NULL),
(3, 1, 1, 3, 'Supino Declinado', 0, NULL),
(4, 1, 2, 4, 'Triceps Pulley', 0, NULL),
(5, 1, 3, 5, 'Rosca Scoth', 0, NULL),
(6, 1, 5, 7, 'Extensor', 1, '2017-03-17'),
(7, 1, 5, 6, 'Flexora', 0, NULL),
(8, 1, 5, 8, 'Leg Press 45 graus', 0, NULL),
(9, 1, 6, 9, 'Abdome Paralela', 0, NULL),
(10, 1, 4, 11, 'Desenvolvimento Com Halteres', 0, NULL),
(11, 1, 1, 12, 'Voador Peito', 0, NULL),
(12, 1, 4, 13, 'Elevação Leteral', 0, NULL),
(13, 1, 1, 13, 'Crucifixo Reto', 0, NULL),
(14, 1, 1, 13, 'Cross Over', 0, NULL),
(15, 1, 5, 14, 'Abdutora', 0, NULL),
(16, 1, 8, 15, 'Puxador Costas', 1, '2017-02-20'),
(17, 1, 8, 15, 'Remada Alta', 5, '2017-02-20'),
(18, 1, 8, 15, 'Puxador Frontal', 1, '2017-03-16'),
(19, 1, 3, 13, 'Rosca Alternada', 1, '2017-03-16'),
(20, 1, 6, 2, 'Abdome Inclinado', 7, '2017-03-16'),
(21, 1, 2, 13, 'Triceps Francês', 1, '2017-03-16'),
(22, 1, 5, 16, 'Agachamento Barra Guia', 1, '2017-03-17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `exercicio_combinado`
--

CREATE TABLE `exercicio_combinado` (
  `idexercicio_combinado` int(11) NOT NULL,
  `idexercicio_treino` int(11) NOT NULL,
  `idexercicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `exercicio_combinado`
--

INSERT INTO `exercicio_combinado` (`idexercicio_combinado`, `idexercicio_treino`, `idexercicio`) VALUES
(1, 15, 13),
(2, 16, 11),
(3, 17, 11),
(4, 18, 7),
(5, 19, 15),
(6, 15, 14),
(7, 71, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `exercicio_realizado`
--

CREATE TABLE `exercicio_realizado` (
  `idexercicio_realizado` int(11) NOT NULL,
  `idtreino_realizado` int(11) NOT NULL,
  `idaluno_exercicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `exercicio_realizado`
--

INSERT INTO `exercicio_realizado` (`idexercicio_realizado`, `idtreino_realizado`, `idaluno_exercicio`) VALUES
(1, 12, 6),
(2, 12, 8),
(3, 12, 7),
(4, 13, 9),
(5, 13, 10),
(6, 13, 11),
(7, 14, 12),
(8, 14, 13),
(9, 14, 14),
(10, 15, 15),
(11, 15, 16),
(12, 17, 6),
(13, 17, 7),
(14, 17, 8),
(15, 18, 1),
(16, 19, 2),
(18, 29, 1),
(19, 30, 2),
(20, 31, 3),
(21, 32, 76),
(22, 32, 77),
(23, 32, 78),
(24, 33, 79),
(25, 33, 80);

-- --------------------------------------------------------

--
-- Estrutura da tabela `exercicio_treino`
--

CREATE TABLE `exercicio_treino` (
  `idexercicio_treino` int(11) NOT NULL,
  `exercicio_idexercicio` int(11) NOT NULL,
  `treino_idtreino` int(11) NOT NULL,
  `idcadastrador` int(11) NOT NULL,
  `dataCadastro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `exercicio_treino`
--

INSERT INTO `exercicio_treino` (`idexercicio_treino`, `exercicio_idexercicio`, `treino_idtreino`, `idcadastrador`, `dataCadastro`) VALUES
(1, 1, 1, 0, NULL),
(2, 2, 1, 0, NULL),
(3, 3, 1, 0, NULL),
(4, 4, 2, 0, NULL),
(5, 5, 2, 0, NULL),
(6, 9, 2, 0, NULL),
(7, 6, 3, 0, NULL),
(8, 7, 3, 0, NULL),
(9, 8, 3, 0, NULL),
(10, 4, 4, 0, NULL),
(11, 5, 5, 0, NULL),
(12, 1, 6, 0, NULL),
(13, 8, 7, 0, NULL),
(14, 9, 8, 0, NULL),
(15, 1, 9, 0, NULL),
(16, 2, 9, 0, NULL),
(17, 3, 9, 0, NULL),
(18, 6, 10, 0, NULL),
(19, 8, 10, 0, NULL),
(20, 1, 14, 0, NULL),
(21, 11, 14, 0, NULL),
(22, 5, 14, 0, NULL),
(23, 7, 15, 0, NULL),
(24, 8, 15, 0, NULL),
(25, 1, 16, 0, NULL),
(26, 2, 16, 0, NULL),
(27, 11, 16, 0, NULL),
(28, 13, 16, 0, NULL),
(29, 12, 17, 0, NULL),
(30, 10, 17, 0, NULL),
(31, 5, 18, 0, NULL),
(32, 4, 19, 0, NULL),
(33, 7, 20, 0, NULL),
(34, 8, 20, 0, NULL),
(35, 15, 20, 0, NULL),
(36, 9, 19, 0, NULL),
(37, 1, 21, 0, NULL),
(38, 11, 21, 0, NULL),
(39, 14, 21, 0, NULL),
(40, 4, 21, 0, NULL),
(41, 5, 21, 0, NULL),
(42, 10, 22, 0, NULL),
(43, 12, 22, 0, NULL),
(44, 7, 22, 0, NULL),
(45, 8, 22, 0, NULL),
(46, 1, 23, 0, NULL),
(47, 11, 23, 1, '2017-02-20'),
(48, 16, 24, 1, '2017-02-20'),
(49, 9, 24, 1, '2017-02-20'),
(52, 13, 23, 1, '2017-02-20'),
(53, 4, 23, 1, '2017-02-20'),
(54, 5, 24, 1, '2017-02-20'),
(55, 6, 25, 1, '2017-02-20'),
(56, 7, 25, 1, '2017-02-20'),
(57, 8, 25, 1, '2017-02-20'),
(58, 1, 26, 1, '2017-03-06'),
(59, 3, 26, 1, '2017-03-06'),
(60, 13, 26, 1, '2017-03-06'),
(61, 4, 26, 1, '2017-03-06'),
(62, 10, 27, 1, '2017-03-06'),
(63, 12, 27, 1, '2017-03-06'),
(64, 5, 27, 1, '2017-03-06'),
(65, 6, 28, 1, '2017-03-06'),
(66, 7, 28, 1, '2017-03-06'),
(67, 8, 28, 1, '2017-03-06'),
(68, 7, 6, 1, '2017-03-13'),
(69, 11, 7, 1, '2017-03-13'),
(70, 12, 8, 1, '2017-03-13'),
(71, 12, 11, 1, '2017-03-13'),
(73, 4, 11, 1, '2017-03-13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `forma_pagamento`
--

CREATE TABLE `forma_pagamento` (
  `idformaPagamento` int(11) NOT NULL,
  `formaPagamento` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `forma_pagamento`
--

INSERT INTO `forma_pagamento` (`idformaPagamento`, `formaPagamento`) VALUES
(1, 'Dinheiro'),
(2, 'Cheque'),
(3, 'Cartão'),
(4, 'Boleto'),
(5, 'Duplicata');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `idFornecedor` int(11) NOT NULL,
  `idpessoa` int(11) NOT NULL,
  `razaoSocial` varchar(255) DEFAULT NULL,
  `cnpj` varchar(255) DEFAULT NULL,
  `inscricaoEstadual` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `idfuncionario` int(11) NOT NULL,
  `idpessoa` int(11) NOT NULL,
  `funcao` varchar(255) DEFAULT NULL,
  `setor` varchar(255) DEFAULT NULL,
  `dataAdmissao` date DEFAULT NULL,
  `ctps` varchar(255) DEFAULT NULL,
  `serie` varchar(255) DEFAULT NULL,
  `pis` varchar(255) DEFAULT NULL,
  `salarioBase` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`idfuncionario`, `idpessoa`, `funcao`, `setor`, `dataAdmissao`, `ctps`, `serie`, `pis`, `salarioBase`) VALUES
(1, 1, 'Professor', 'Musculação', '0000-00-00', '89798798', '8978978', '8978', 2500),
(4, 8, 'professor', 'Musculação', '2012-01-10', '5464654', '564654', '879878', 2500);

-- --------------------------------------------------------

--
-- Estrutura da tabela `log`
--

CREATE TABLE `log` (
  `idlog` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idtipo_log` int(11) NOT NULL,
  `descricao` text,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `log`
--

INSERT INTO `log` (`idlog`, `idusuario`, `idtipo_log`, `descricao`, `data`, `hora`) VALUES
(1, 1, 1, 'Cadastrou o Exercicio: Rosca Alternada, Tipo: 1, Região 3, Aparelho 13', '2017-01-16', '12:30:30'),
(2, 7, 1, 'Cadastrou o Exercicio: Abdome Inclinado, Tipo: 1, Região 6, Aparelho 2', '2017-02-16', '13:30:30'),
(3, 1, 1, 'Cadastrou o Exercicio: Triceps Francês, Tipo: 1, Região 2, Aparelho 13', '2017-03-16', '14:54:57'),
(4, 1, 2, 'Alterou o Exercicio: Enxensorr para Extensor, Tipo: 1, Região 5, Aparelho 7', '2017-03-17', '09:01:53'),
(5, 1, 1, 'Cadastrou o Exercicio: Agachamento, Tipo: 1, Região 1, Aparelho 16', '2017-03-17', '09:32:03'),
(6, 1, 2, 'Alterou o Exercicio: Agachamento para Agachamento Barra Guia, Tipo: 1, Região 5, Aparelho 16', '2017-03-17', '09:48:50'),
(8, 1, 1, 'Cadastrou a Região Trabalhada: Bum ', '2017-03-17', '10:58:07'),
(9, 1, 2, 'Alterou a Região Trabalhada: Bum  para Bum Bum', '2017-03-17', '11:03:03'),
(10, 1, 1, 'Cadastrou o Tipo de Exercício: Zum', '2017-03-17', '11:06:45'),
(11, 1, 2, 'Alterou o Tipo de Exercício: Zum para Zumba', '2017-03-17', '11:10:50'),
(12, 1, 1, 'Cadastrou o Aparelho: Adut Número 20', '2017-03-17', '11:25:43'),
(13, 1, 2, 'Alterou o Aparelho: Adut para Adutor Número 20 para 17', '2017-03-17', '11:30:57'),
(15, 1, 1, 'Cadastrou o Ciclo: Treino Intermediario, Nível: Intermediario, genero: Masculino, Meta: Ganhar Músculos, Modelo: ABC', '2017-03-17', '14:57:14'),
(17, 1, 2, 'Alterou o Ciclo: Treino Intermediário para Treino Profissional, Nível: Intermediario para Avançado, genero: Masculino para Masculino, Meta: Ganhar Músculos para Ganhar Músculos e perder Peso', '2017-03-17', '15:37:23'),
(18, 1, 1, '19898Celular, Operadora:: Tim, Telefone: (45)6897-9878, Contato: lorena', '2017-03-20', '10:00:11'),
(19, 1, 1, 'Cadastrou a pessoa: Helena Heloisa, Data de Nascimento: 1990-10-10, Cpf: 879.789.798-78, Rg: 9.879.879 8 Genero: F, Estado Civil: Solteiro, Profissão: Programadora, Usuário: , Consultor: 1, Código da Catraca:: 89798787, Cidade: Maringá, Bairro: Vila Santo', '2017-03-20', '10:17:33'),
(20, 1, 1, 'Cadastrou a pessoa: Isabela dos Reis, Data de Nascimento: 10/10/1991, Cpf: 987.897.987-88, Rg: 8.789.446 8 Genero: Feminino, Estado Civil: Solteiro, Profissão: Administradora, Usuário: , Consultor: 8, Código da Catraca: 897978998, Cidade: Paiçandu, Bairro', '2017-03-20', '10:40:11'),
(21, 1, 2, 'Alterou o nome: Isabela dos Reis Freitas para Isabela dos Reis Freitas Alterou a Data de Nascimento: 1995-10-10 para 10/10/1995 Alterou o CPF: 987.987.897-88 para 987.987.897-88 Alterou o RG: 8.897.987 8 para 8.897.987 8 Alterou o Gênero: F para Feminino ', '2017-03-20', '13:46:23'),
(46, 1, 2, 'Alterou a Avaliação Física com a data de: 2016-01-10 para 2016-01-10, Peso: 60 para 65, Altura: 1.75 para 1.78, Triceps: 25 para 26, Subescapular: 35 para 36, Supralliaca: 45 para 47, Abdomen: 38 para 39, Braço Esqurdo: 32 para 31, Braço Direito: 31 para 30, Anti-Braço Esquerdo: 21 para 20, Anti-Braço Direito: 22 para 19, Quadril: 40 para 38, Cintura: 51 para 50, Pescoço: 36 para 35, Coxa Esquerda: 45 para 42, Coxa Direita: 44 para 43, Perna Esquerda: 33 para 36, Perna Direita: 32 para 37, Radio: 25 para 26, Fermur: 27 para 28, IMC: 19.59 para 20.52, Percentual de Gordura: 23.63 para 24.74, Massa Magra: 45.82 para 48.92, Massa Gorda: 14.18 para 16.08', '2017-03-23', '16:30:41'),
(47, 1, 1, 'Cadastrou o Exercicio: Crucifixo Reto, No Treino: A, No Ciclo Treino Moderado', '2017-03-24', '14:15:52'),
(48, 1, 3, 'Excluiu o Exercicio: Crucifixo Reto, Do Treino: A, Do Ciclo: Treino Moderado', '2017-03-24', '15:23:09'),
(49, 1, 2, 'Alterou o Contrato: Contratação do Plano Aqua para Contrato do Plano Aqua, Texto: DEVOLUÇÃO DOS VALORES CONTRATADOS\nEm caso de cancelamentos por motivos parte dos clientes sejam eles quais forem, todo o período já frequentado será calculado ao preço bruto de R$ ______________ por mês, sem descontos, vigente na data da assinatura deste contrato, descontada taxas de juros ( em caso de pagamentos feto com cartão de crédito ), taxa de matricula e quaisquer outros descontos,  concedidos na compra dos planos, tais como avaliação física etc. Os valores serão devolvidos nas datas de vencimentos dos respectivos pagamentos, conforme sldo credor a ser calculado na empresa. para DEVOLUÇÃO DOS VALORES CONTRATADOS Em caso de cancelamentos por motivos parte dos clientes sejam eles quais forem, todo o período já frequentado será calculado ao preço bruto de R$ ______________ por mês, sem descontos, vigente na data da assinatura deste contrato, descontada taxas de juros ( em caso de pagamentos feto com cartão de crédito ), taxa de matricula e quaisquer outros descontos, concedidos na compra dos planos, tais como avaliação física etc. Os valores serão devolvidos nas datas de vencimentos dos respectivos pagamentos, conforme saldo credor a ser calculado na empresa. \n\nO pedido de devolução só será acatado, no mês seguinte ao que for pedido o cancelamento.', '2017-03-27', '11:29:31'),
(52, 1, 2, 'Alterou o Contrato: Contrato Musculação para Contrato Novo Musculação, Texto: Cláusula 4ª.\n para Cláusula 8ª.\n A matrícula deverá ser feita na secretaria da\nCONTRATADA\n,devendo o\nCONTRATANTE\napresentar os documentos solicitados na realização da matrícula, bem como preencher a ficha cadastral e amaminese', '2017-03-27', '11:58:55'),
(53, 1, 1, 'Cadastrou o Contrato: Contrato de Zumba, Texto: Cláusula 9ª.\nQuando o\nCONTRATANTE\nfor menor de idade, o pai ou responsável deverá assinar o contrato, apresentando os documentos na Cláusula8ª relacionados.', '2017-03-27', '12:00:21'),
(56, 1, 1, 'Cadastrou o tipo de Plano: Passaporte, Modalidade: Musculação, Prazo do Plano: Semestral, Valor: 750', '2017-03-28', '14:33:18'),
(57, 1, 2, 'Alterou o Contrato: Contrato do Plano Aqua para Contrato do de Musculação, Texto: DEVOLUÇÃO DOS VALORES CONTRATADOS Em caso de cancelamentos por motivos parte dos clientes sejam eles quais forem, todo o período já frequentado será calculado ao preço bruto de R$ ______________ por mês, sem descontos, vigente na data da assinatura deste contrato, descontada taxas de juros ( em caso de pagamentos feto com cartão de crédito ), taxa de matricula e quaisquer outros descontos, concedidos na compra dos planos, tais como avaliação física etc. Os valores serão devolvidos nas datas de vencimentos dos respectivos pagamentos, conforme saldo credor a ser calculado na empresa. \n\nO pedido de devolução só será acatado, no mês seguinte ao que for pedido o cancelamento. para DEVOLUÇÃO DOS VALORES CONTRATADOS Em caso de cancelamentos por motivos parte dos clientes sejam eles quais forem, todo o período já frequentado será calculado ao preço bruto de R$ ______________ por mês, sem descontos, vigente na data da assinatura deste contrato, descontada taxas de juros ( em caso de pagamentos feto com cartão de crédito ), taxa de matricula e quaisquer outros descontos, concedidos na compra dos planos, tais como avaliação física etc. Os valores serão devolvidos nas datas de vencimentos dos respectivos pagamentos, conforme saldo credor a ser calculado na empresa. \n\nO pedido de devolução só será acatado, no mês seguinte ao que for pedido o cancelamento.', '2017-03-29', '11:06:31'),
(58, 1, 2, 'Alterou o Contrato: Contrato do de Musculação para Contrato Plano de Musculação, Texto: DEVOLUÇÃO DOS VALORES CONTRATADOS Em caso de cancelamentos por motivos parte dos clientes sejam eles quais forem, todo o período já frequentado será calculado ao preço bruto de R$ ______________ por mês, sem descontos, vigente na data da assinatura deste contrato, descontada taxas de juros ( em caso de pagamentos feto com cartão de crédito ), taxa de matricula e quaisquer outros descontos, concedidos na compra dos planos, tais como avaliação física etc. Os valores serão devolvidos nas datas de vencimentos dos respectivos pagamentos, conforme saldo credor a ser calculado na empresa. \n\nO pedido de devolução só será acatado, no mês seguinte ao que for pedido o cancelamento. para DEVOLUÇÃO DOS VALORES CONTRATADOS Em caso de cancelamentos por motivos parte dos clientes sejam eles quais forem, todo o período já frequentado será calculado ao preço bruto de R$ ______________ por mês, sem descontos, vigente na data da assinatura deste contrato, descontada taxas de juros ( em caso de pagamentos feto com cartão de crédito ), taxa de matricula e quaisquer outros descontos, concedidos na compra dos planos, tais como avaliação física etc. Os valores serão devolvidos nas datas de vencimentos dos respectivos pagamentos, conforme saldo credor a ser calculado na empresa. \n\nO pedido de devolução só será acatado, no mês seguinte ao que for pedido o cancelamento.', '2017-03-29', '11:06:57'),
(59, 1, 2, 'Alterou o Contrato: Contrato Plano de Musculação para Musculação, Texto: DEVOLUÇÃO DOS VALORES CONTRATADOS Em caso de cancelamentos por motivos parte dos clientes sejam eles quais forem, todo o período já frequentado será calculado ao preço bruto de R$ ______________ por mês, sem descontos, vigente na data da assinatura deste contrato, descontada taxas de juros ( em caso de pagamentos feto com cartão de crédito ), taxa de matricula e quaisquer outros descontos, concedidos na compra dos planos, tais como avaliação física etc. Os valores serão devolvidos nas datas de vencimentos dos respectivos pagamentos, conforme saldo credor a ser calculado na empresa. \n\nO pedido de devolução só será acatado, no mês seguinte ao que for pedido o cancelamento. para DEVOLUÇÃO DOS VALORES CONTRATADOS Em caso de cancelamentos por motivos parte dos clientes sejam eles quais forem, todo o período já frequentado será calculado ao preço bruto de R$ ______________ por mês, sem descontos, vigente na data da assinatura deste contrato, descontada taxas de juros ( em caso de pagamentos feto com cartão de crédito ), taxa de matricula e quaisquer outros descontos, concedidos na compra dos planos, tais como avaliação física etc. Os valores serão devolvidos nas datas de vencimentos dos respectivos pagamentos, conforme saldo credor a ser calculado na empresa. \n\nO pedido de devolução só será acatado, no mês seguinte ao que for pedido o cancelamento.', '2017-03-29', '11:08:41'),
(60, 1, 1, 'Cadastrou o Contrato: , Tipo de Plano: , Modalidade: , Prazo do Plano: , Forma de Pagamento: , Número de Parcelas: 6, Valor das Parcelas: 125.00, Valor Total: 750', '2017-03-29', '11:12:53'),
(61, 1, 1, 'Cadastrou o Contrato: Musculação, Tipo de Plano: Passaporte, Modalidade: Musculação, Prazo do Plano: Semestral, Forma de Pagamento: Cartão, Número de Parcelas: 6, Valor das Parcelas: 125.00, Valor Total: 750', '2017-03-29', '11:21:00'),
(62, 1, 1, 'Cadastrou o Contrato: Musculação, Tipo de Plano: Passaporte, Modalidade: Musculação, Prazo do Plano: Semestral, Forma de Pagamento: Dinheiro, Número de Parcelas: 6, Valor das Parcelas: 125.00, Valor Total: 750, Para o aluno: Natalia Karine', '2017-03-29', '11:27:53'),
(63, 1, 2, 'Alterou o Contrato: Musculação para Musculação, Texto: DEVOLUÇÃO DOS VALORES CONTRATADOS Em caso de cancelamentos por motivos parte dos clientes sejam eles quais forem, todo o período já frequentado será calculado ao preço bruto de R$ ______________ por mês, sem descontos, vigente na data da assinatura deste contrato, descontada taxas de juros ( em caso de pagamentos feto com cartão de crédito ), taxa de matricula e quaisquer outros descontos, concedidos na compra dos planos, tais como avaliação física etc. Os valores serão devolvidos nas datas de vencimentos dos respectivos pagamentos, conforme saldo credor a ser calculado na empresa. \n\nO pedido de devolução só será acatado, no mês seguinte ao que for pedido o cancelamento. para As partes acima identificadas têm, entre si, justo e acertado o presenteContrato de Prestação de Serviços\nde Academia de Ginástica, que se regerá  pelas cláusulas seguintes e pelas condições descritas no presente.\nDO OBJETO DO CONTRATO\n \nCláusula 1ª.\nEste contrato tem como OBJETO o uso de academia, de propriedade da\nCONTRATADA\n, pelo\nCONTRATANTE\npara fazer a atividade física ____________________________________________________.\nDO FUNCIONAMENTO\n \nCláusula 2ª.\n A academia de ginástica funcionará de segunda a sexta feira das07h00 as 22h00 e aos sábados das 09h00 as 13h00. \nCláusula 3ª.\nEstes horários poderão sofrer alterações, de acordo com as necessidades da\nCONTRATADA\n\nCláusula 4ª.\nO\nCONTRATANTE\npoderá frequentar as instalações da\nCONTRATADA\nnos dias e horários estipulados no contrato, respeitando os horários e as turmas nas atividades em grupo oferecidas pela\nCONTRATADA\n.\nDAS ATIVIDADES\n \nCláusula 5ª.\nO\nCONTRATANTE\npoderá realizar as seguintes atividades no estabelecimento da\nCONTRATADA\n: musculação, ginástica, lutas, alongamento, postural, dança, desde que esteja coberto por este contrato. \nCláusula 6ª.\nA\nCONTRATADA\nterá técnicos qualificados para orientação do\nCONTRATANTE\n. \nCláusula 7ª.\nCaso a\nCONTRATADA\ndisponibilize novas atividades, o\nCONTRATANTE\nseguirá as mesmas normas que regem este contrato para delas participar.', '2017-03-30', '08:59:53'),
(64, 1, 2, 'Alterou o Contrato: Musculação para Musculação, Texto: As partes acima identificadas têm, entre si, justo e acertado o presenteContrato de Prestação de Serviços\nde Academia de Ginástica, que se regerá  pelas cláusulas seguintes e pelas condições descritas no presente.\nDO OBJETO DO CONTRATO\n \nCláusula 1ª.\nEste contrato tem como OBJETO o uso de academia, de propriedade da\nCONTRATADA\n, pelo\nCONTRATANTE\npara fazer a atividade física ____________________________________________________.\nDO FUNCIONAMENTO\n \nCláusula 2ª.\n A academia de ginástica funcionará de segunda a sexta feira das07h00 as 22h00 e aos sábados das 09h00 as 13h00. \nCláusula 3ª.\nEstes horários poderão sofrer alterações, de acordo com as necessidades da\nCONTRATADA\n\nCláusula 4ª.\nO\nCONTRATANTE\npoderá frequentar as instalações da\nCONTRATADA\nnos dias e horários estipulados no contrato, respeitando os horários e as turmas nas atividades em grupo oferecidas pela\nCONTRATADA\n.\nDAS ATIVIDADES\n \nCláusula 5ª.\nO\nCONTRATANTE\npoderá realizar as seguintes atividades no estabelecimento da\nCONTRATADA\n: musculação, ginástica, lutas, alongamento, postural, dança, desde que esteja coberto por este contrato. \nCláusula 6ª.\nA\nCONTRATADA\nterá técnicos qualificados para orientação do\nCONTRATANTE\n. \nCláusula 7ª.\nCaso a\nCONTRATADA\ndisponibilize novas atividades, o\nCONTRATANTE\nseguirá as mesmas normas que regem este contrato para delas participar. para As partes acima identificadas têm, entre si, justo e acertado o presenteContrato de Prestação de Serviços\nde Academia de Ginástica, que se regerá  pelas cláusulas seguintes e pelas condições descritas no presente.\nDO OBJETO DO CONTRATO\n \nCláusula 1ª.\nEste contrato tem como OBJETO o uso de academia, de propriedade da\nCONTRATADA, pelo CONTRATANTE\npara fazer a atividade física ____________________________________________________.\nDO FUNCIONAMENTO\n \nCláusula 2ª.\n A academia de ginástica funcionará de segunda a sexta feira das07h00 as 22h00 e aos sábados das 09h00 as 13h00. \nCláusula 3ª.\nEstes horários poderão sofrer alterações, de acordo com as necessidades da\nCONTRATADA\n\nCláusula 4ª.\nO CONTRATANTE\npoderá frequentar as instalações da\nCONTRATADA\nnos dias e horários estipulados no contrato, respeitando os horários e as turmas nas atividades em grupo oferecidas pela\nCONTRATADA\n\nDAS ATIVIDADES\n \nCláusula 5ª.\nO CONTRATANTE\npoderá realizar as seguintes atividades no estabelecimento da\nCONTRATADA\n: musculação, ginástica, lutas, alongamento, postural, dança, desde que esteja coberto por este contrato. \n\nCláusula 6ª.\nA CONTRATADA\nterá técnicos qualificados para orientação do\nCONTRATANTE\n. \nCláusula 7ª.\nCaso a\nCONTRATADA\ndisponibilize novas atividades, o\nCONTRATANTE\nseguirá as mesmas normas que regem este contrato para delas participar.', '2017-03-30', '09:52:32');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modalidade`
--

CREATE TABLE `modalidade` (
  `idmodalidade` int(11) NOT NULL,
  `modalidade` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `modalidade`
--

INSERT INTO `modalidade` (`idmodalidade`, `modalidade`) VALUES
(1, 'Musculação'),
(2, 'Ginastica'),
(3, 'Natação'),
(4, 'Aqua'),
(5, 'Hidro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `parq`
--

CREATE TABLE `parq` (
  `idparq` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `textoParq` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `parq`
--

INSERT INTO `parq` (`idparq`, `titulo`, `textoParq`) VALUES
(1, 'PAR Q E VOCÊ', 'O PAR Q foi elaborado para auxiliar você a se auto-ajudar. Os Exercícios praticados regularmente estão associados a muitos benefícios de saúde. Completar o PAR Q representa em primeiro passo racional a ser tomado, caso você esteja interessado a aumentar a quantidade de atividades físicas em sua vida. Para maioria dos indivíduos, a atividade física não deve trazer qualquer problema ou prejuízo. O PAR Q foi elaborado para ajudar a identificar o pequeno número de adultos, para quem a prática de exercícios físicos pode ser inadequada, ou aqueles que devem procurar aconselhamento médico acerca do tipo de atividade que seria mais apropriado para eles. O bom senso é a melhor tática a ser adotada para responder a essas perguntas.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `parq_aluno`
--

CREATE TABLE `parq_aluno` (
  `idparqAluno` int(11) NOT NULL,
  `idaluno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `parq_aluno`
--

INSERT INTO `parq_aluno` (`idparqAluno`, `idaluno`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `parq_aluno_perguntas_parq`
--

CREATE TABLE `parq_aluno_perguntas_parq` (
  `idparq_aluno_perguntas_parq` int(11) NOT NULL,
  `idparqAluno` int(11) NOT NULL,
  `idperguntaParq` int(11) NOT NULL,
  `resposta` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `parq_aluno_perguntas_parq`
--

INSERT INTO `parq_aluno_perguntas_parq` (`idparq_aluno_perguntas_parq`, `idparqAluno`, `idperguntaParq`, `resposta`) VALUES
(1, 1, 1, NULL),
(2, 1, 2, NULL),
(3, 1, 3, NULL),
(4, 1, 4, NULL),
(5, 2, 1, 1),
(6, 2, 2, 1),
(7, 2, 3, NULL),
(8, 2, 4, 1),
(9, 3, 1, NULL),
(10, 3, 2, NULL),
(11, 3, 3, NULL),
(12, 3, 4, 1),
(13, 4, 1, NULL),
(14, 4, 2, NULL),
(15, 4, 3, NULL),
(16, 4, 4, NULL),
(17, 4, 7, 1),
(18, 5, 1, NULL),
(19, 5, 2, NULL),
(20, 5, 3, NULL),
(21, 5, 4, NULL),
(22, 5, 7, NULL),
(23, 6, 1, NULL),
(24, 6, 2, NULL),
(25, 6, 3, NULL),
(26, 6, 4, 1),
(27, 6, 7, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perguntas_parq`
--

CREATE TABLE `perguntas_parq` (
  `idperguntaParq` int(11) NOT NULL,
  `idparq` int(11) NOT NULL,
  `pergunta` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `perguntas_parq`
--

INSERT INTO `perguntas_parq` (`idperguntaParq`, `idparq`, `pergunta`) VALUES
(1, 1, 'O seu médico já lhe disse alguma vêz que você apresenta algum problema cardíaco?'),
(2, 1, 'Você apresenta dores no Peito com frequência?'),
(3, 1, 'Você apresenta Episódios frequentes de tonteira ou sensação de desmaio responda?'),
(4, 1, 'Seu médico já lhe disse alguma vez que sua pressão Sanguínea era muito alta?'),
(7, 1, 'Você tem mais de 65 anos e não está acostumado a exercitar-se vigorosamente?');

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissao`
--

CREATE TABLE `permissao` (
  `idpermissao` int(11) NOT NULL,
  `permissao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `permissao`
--

INSERT INTO `permissao` (`idpermissao`, `permissao`) VALUES
(1, 'pessoa'),
(2, 'parq'),
(3, 'avaliacao fisica'),
(4, 'plano de nutricao'),
(5, 'plano de treino'),
(6, 'exercicio'),
(7, 'regiao trabalhada'),
(8, 'tipo de exercicio'),
(9, 'aparelho'),
(10, 'alunos treinos'),
(11, 'contrato'),
(12, 'contrato aluno'),
(13, 'valores plano');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `idpessoa` int(11) NOT NULL,
  `foto` tinyblob,
  `nome` varchar(255) DEFAULT NULL,
  `observacao` varchar(255) DEFAULT NULL,
  `dataCadastro` date DEFAULT NULL,
  `idcadastrador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`idpessoa`, `foto`, `nome`, `observacao`, `dataCadastro`, `idcadastrador`) VALUES
(1, 0x77696c6c2e6a7067, 'Willian dos Reis de Souza', NULL, '2016-12-17', 0),
(2, 0x616d6f722e6a7067, 'Natalia Karine', NULL, '2017-03-22', 1),
(3, 0x616c696e652e6a7067, 'Aline Amenencia Souza', NULL, '2017-03-23', 1),
(7, 0x64696f6e617461732e6a7067, 'Dionatas Brito', NULL, '2017-03-06', 1),
(8, 0x616c657373616e64726f2e6a7067, 'Alessandro Britto', NULL, '2017-03-08', 1),
(9, 0x4c6f72656e612e6a7067, 'Lorena Fiorotto', NULL, '2017-03-22', 1),
(10, 0x48656c656e612048656c6f6973612e6a7067, 'Helena Heloisa', NULL, '2017-03-22', 1),
(11, 0x69736162656c612e6a7067, 'Isabela dos Reis Freitas', NULL, '2017-03-22', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoafisica`
--

CREATE TABLE `pessoafisica` (
  `idpessoaFisica` int(11) NOT NULL,
  `idpessoa` int(11) NOT NULL,
  `dataNascimento` date DEFAULT NULL,
  `cpf` varchar(255) DEFAULT NULL,
  `rg` varchar(255) DEFAULT NULL,
  `genero` varchar(255) DEFAULT NULL,
  `estadoCivil` varchar(255) DEFAULT NULL,
  `profissao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoafisica`
--

INSERT INTO `pessoafisica` (`idpessoaFisica`, `idpessoa`, `dataNascimento`, `cpf`, `rg`, `genero`, `estadoCivil`, `profissao`) VALUES
(1, 1, '1987-02-12', '456.465.456-45', '8.798.798 7', 'M', 'Solteiro', 'Programador'),
(2, 2, '1993-10-10', '789.798.798-87', '8.797.889 8', 'F', 'Solteiro', 'Engenheira Civil'),
(3, 3, '1993-01-10', '789.878.987-87', '8.978.788 7', 'F', 'Solteiro', 'Biologa'),
(7, 7, '1986-01-10', '897.987.987-87', '8.979.879 8', 'M', 'Divorciado', 'Aux Administrativo'),
(8, 8, '1984-10-10', '879.879.879-88', '8.798.798 8', 'M', 'Solteiro', 'programador'),
(9, 9, '1989-10-10', '456.465.456-45', '5.465.456 4', 'F', 'Solteiro', 'Esteticista'),
(10, 10, '1990-10-10', '879.789.798-78', '9.879.879 8', 'F', 'Solteiro', 'Programadora'),
(11, 11, '1992-10-10', '897.897.898-78', '7.867.867 8', 'F', 'Solteiro', 'Administradora de Empresas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoajuridica`
--

CREATE TABLE `pessoajuridica` (
  `idpessoaJuridica` int(11) NOT NULL,
  `idpessoa` int(11) NOT NULL,
  `razaoSocial` varchar(255) DEFAULT NULL,
  `cnpj` varchar(255) DEFAULT NULL,
  `inscricaoEstadual` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `plano_nutricao`
--

CREATE TABLE `plano_nutricao` (
  `idplano_nutricao` int(11) NOT NULL,
  `idaluno` int(11) NOT NULL,
  `plano` varchar(255) DEFAULT NULL,
  `idcadastrador` int(11) DEFAULT NULL,
  `dataCadastro` date DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_termino` date DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `plano_nutricao`
--

INSERT INTO `plano_nutricao` (`idplano_nutricao`, `idaluno`, `plano`, `idcadastrador`, `dataCadastro`, `data_inicio`, `data_termino`, `ativo`) VALUES
(1, 1, 'Plano para emagrecer', 1, '2017-03-02', '2016-11-03', '2016-12-30', 0),
(2, 2, 'Plano Fitness', 1, '2017-03-03', '2017-01-01', '2017-02-02', 0),
(3, 1, 'Plano para manter', 1, '2017-03-03', '2017-02-10', '2017-03-31', 0),
(5, 2, 'Plano Sob Medida Novo', 1, '2017-03-03', '2017-03-12', '2017-04-06', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `prazo_plano`
--

CREATE TABLE `prazo_plano` (
  `idprazoPlano` int(11) NOT NULL,
  `prazoPlano` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `prazo_plano`
--

INSERT INTO `prazo_plano` (`idprazoPlano`, `prazoPlano`) VALUES
(1, 'Mensal'),
(2, 'Trimestral'),
(3, 'Semestral'),
(4, 'Anual');

-- --------------------------------------------------------

--
-- Estrutura da tabela `refeicao`
--

CREATE TABLE `refeicao` (
  `idrefeicao` int(11) NOT NULL,
  `refeicao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `refeicao`
--

INSERT INTO `refeicao` (`idrefeicao`, `refeicao`) VALUES
(1, 'Café da manhã'),
(2, 'Lanche manhã'),
(3, 'Almoço'),
(4, 'Lanche da Tarde 1'),
(5, 'Lanche das Tarde 2'),
(6, 'Lanche da Noite'),
(7, 'Jantar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `refeicao_plano_nutricao`
--

CREATE TABLE `refeicao_plano_nutricao` (
  `idrefeicao_plano_nutricao` int(11) NOT NULL,
  `idplano_nutricao` int(11) NOT NULL,
  `idrefeicao` int(11) NOT NULL,
  `horario` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `refeicao_plano_nutricao`
--

INSERT INTO `refeicao_plano_nutricao` (`idrefeicao_plano_nutricao`, `idplano_nutricao`, `idrefeicao`, `horario`) VALUES
(2, 1, 1, '08:00:00'),
(3, 1, 1, '08:00:00'),
(4, 1, 2, '10:30:00'),
(5, 1, 3, '13:00:00'),
(6, 1, 3, '13:00:00'),
(7, 1, 4, '16:00:00'),
(8, 1, 7, '19:00:00'),
(9, 1, 7, '19:00:00'),
(10, 1, 6, '22:00:00'),
(11, 2, 1, '07:30:00'),
(12, 2, 1, '07:30:00'),
(13, 2, 2, '10:00:00'),
(14, 2, 3, '13:00:00'),
(15, 2, 3, '13:00:00'),
(16, 2, 4, '15:00:00'),
(17, 2, 5, '18:00:00'),
(18, 2, 7, '21:00:00'),
(19, 2, 7, '21:00:00'),
(20, 2, 6, '23:00:00'),
(21, 3, 1, '07:40:00'),
(22, 3, 1, '07:40:00'),
(23, 3, 2, '09:40:00'),
(24, 3, 3, '12:30:00'),
(25, 3, 3, '12:30:00'),
(26, 3, 4, '15:30:00'),
(27, 3, 5, '18:30:00'),
(28, 3, 7, '21:30:00'),
(29, 3, 6, '23:30:00'),
(33, 5, 1, '08:10:00'),
(34, 5, 1, '08:10:00'),
(35, 5, 2, '08:10:00'),
(36, 5, 3, '12:00:00'),
(37, 5, 3, '12:00:00'),
(38, 5, 4, '16:00:00'),
(39, 5, 5, '17:30:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `regiao_trabalhada`
--

CREATE TABLE `regiao_trabalhada` (
  `idregiaoTrabalhada` int(11) NOT NULL,
  `regiaoTrabalhada` varchar(255) DEFAULT NULL,
  `idcadastrador` int(11) NOT NULL,
  `dataCadastro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `regiao_trabalhada`
--

INSERT INTO `regiao_trabalhada` (`idregiaoTrabalhada`, `regiaoTrabalhada`, `idcadastrador`, `dataCadastro`) VALUES
(1, 'Peito', 0, NULL),
(2, 'Triceps', 0, NULL),
(3, 'Biceps', 0, NULL),
(4, 'Ombros', 0, NULL),
(5, 'Pernas', 0, NULL),
(6, 'Abdome', 0, NULL),
(7, 'Panturrilha', 1, '2017-02-20'),
(8, 'Costas', 1, '2017-02-20'),
(9, 'Bum Bum', 1, '2017-03-17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefone`
--

CREATE TABLE `telefone` (
  `idtelefone` int(11) NOT NULL,
  `idpessoa` int(11) NOT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `operadora` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `contato` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `telefone`
--

INSERT INTO `telefone` (`idtelefone`, `idpessoa`, `tipo`, `operadora`, `telefone`, `contato`) VALUES
(1, 1, 'Celular', 'Tim', '(45)6489-7898', 'will'),
(2, 2, 'Celular', 'Tim', '(54)6748-9798', 'naty'),
(3, 3, NULL, 'Oi', '(44)9988-5858', 'aline'),
(7, 7, 'Celular', 'Tim', '(54)5646-5455', 'Dionatas'),
(8, 8, 'Celular', 'Tim', '(45)5465-4654', 'sandro'),
(9, 9, NULL, 'Tim', '(45)6897-9878', 'lorena'),
(10, 10, NULL, 'Oi', '(45)6478-9798', 'Helena'),
(11, 11, NULL, 'Oi', '(54)6548-9788', 'Isabela reis');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_exercicio`
--

CREATE TABLE `tipo_exercicio` (
  `idtipoExercicio` int(11) NOT NULL,
  `tipoExercicio` varchar(255) DEFAULT NULL,
  `idcadastrador` int(11) NOT NULL,
  `dataCadastro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_exercicio`
--

INSERT INTO `tipo_exercicio` (`idtipoExercicio`, `tipoExercicio`, `idcadastrador`, `dataCadastro`) VALUES
(1, 'Musculação', 0, NULL),
(2, 'Aeróbico', 0, NULL),
(3, 'Aqua', 1, '2017-02-20'),
(4, 'Zumba', 1, '2017-03-17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_log`
--

CREATE TABLE `tipo_log` (
  `idtipo_log` int(11) NOT NULL,
  `tipo_log` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_log`
--

INSERT INTO `tipo_log` (`idtipo_log`, `tipo_log`) VALUES
(1, 'cadastrar'),
(2, 'alterar'),
(3, 'excluir');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_plano`
--

CREATE TABLE `tipo_plano` (
  `idtipoPlano` int(11) NOT NULL,
  `tipoPlano` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_plano`
--

INSERT INTO `tipo_plano` (`idtipoPlano`, `tipoPlano`) VALUES
(1, 'Passaporte'),
(2, 'Familia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `treino`
--

CREATE TABLE `treino` (
  `idtreino` int(11) NOT NULL,
  `treino` varchar(255) DEFAULT NULL,
  `regioesTrabalhadas` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `treino`
--

INSERT INTO `treino` (`idtreino`, `treino`, `regioesTrabalhadas`) VALUES
(1, 'A', NULL),
(2, 'B', NULL),
(3, 'C', NULL),
(4, 'A', NULL),
(5, 'B', NULL),
(6, 'C', NULL),
(7, 'D', NULL),
(8, 'E', NULL),
(9, 'A', NULL),
(10, 'B', NULL),
(11, 'C', NULL),
(12, 'D', NULL),
(13, 'E', NULL),
(14, 'A', NULL),
(15, 'B', NULL),
(16, 'A', NULL),
(17, 'B', NULL),
(18, 'C', NULL),
(19, 'D', NULL),
(20, 'E', NULL),
(21, 'A', NULL),
(22, 'B', NULL),
(23, 'A', NULL),
(24, 'B', NULL),
(25, 'C', NULL),
(26, 'A', NULL),
(27, 'B', NULL),
(28, 'C', NULL),
(31, 'A', NULL),
(32, 'B', NULL),
(33, 'C', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `treino_realizado`
--

CREATE TABLE `treino_realizado` (
  `idtreino_realizado` int(11) NOT NULL,
  `idaluno_treino` int(11) NOT NULL,
  `data_treino` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `treino_realizado`
--

INSERT INTO `treino_realizado` (`idtreino_realizado`, `idaluno_treino`, `data_treino`) VALUES
(12, 6, '2017-01-05'),
(13, 7, '2017-01-07'),
(14, 8, '2017-01-09'),
(15, 9, '2016-11-09'),
(16, 10, '2016-11-11'),
(17, 6, '2017-01-11'),
(18, 1, '2017-02-12'),
(19, 2, '2017-02-13'),
(29, 1, '2017-03-10'),
(30, 2, '2017-03-11'),
(31, 3, '2017-03-12'),
(32, 46, '2017-03-12'),
(33, 47, '2017-03-13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `idpessoa` int(11) NOT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `idusuario_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `idpessoa`, `usuario`, `senha`, `ativo`, `idusuario_grupo`) VALUES
(1, 1, 'willrock', 'willrock1968', 1, 1),
(2, 2, 'natykarine', 'natykarine123456', 1, 2),
(3, 3, 'alinesouza', 'alinesouza123456', 1, 2),
(6, 7, 'dioanatasbrito', 'dioanatasbrito123456', 1, 2),
(7, 8, 'sandrobrito', 'sandrobrito123456', 1, 2),
(8, 9, 'lorenafiorotto', 'lorenafiorotto123456', 1, 2),
(9, 10, 'helenaheloisa', 'helenaheloisa123456', 1, 2),
(10, 11, 'isabelareis', 'isabelareis123456', 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_grupo`
--

CREATE TABLE `usuario_grupo` (
  `idusuario_grupo` int(11) NOT NULL,
  `tipo_usuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario_grupo`
--

INSERT INTO `usuario_grupo` (`idusuario_grupo`, `tipo_usuario`) VALUES
(1, 'Administrador'),
(2, 'Comum');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_permissao`
--

CREATE TABLE `usuario_permissao` (
  `idusuario_permissao` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpermissao` int(11) NOT NULL,
  `visualizar` tinyint(1) DEFAULT NULL,
  `cadastrar` tinyint(1) DEFAULT NULL,
  `alterar` tinyint(1) DEFAULT NULL,
  `excluir` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario_permissao`
--

INSERT INTO `usuario_permissao` (`idusuario_permissao`, `idusuario`, `idpermissao`, `visualizar`, `cadastrar`, `alterar`, `excluir`) VALUES
(50, 1, 1, 1, 1, 1, 1),
(51, 1, 2, 1, 1, 1, 1),
(52, 1, 3, 1, 1, 1, 1),
(53, 1, 4, 1, 1, 1, 1),
(54, 1, 5, 1, 1, 1, 1),
(55, 1, 6, 1, 1, 1, 1),
(56, 1, 7, 1, 1, 1, 1),
(57, 1, 8, 1, 1, 1, 1),
(58, 1, 9, 1, 1, 1, 1),
(59, 1, 10, 1, 1, 1, 1),
(70, 1, 11, 1, 1, 1, 1),
(71, 1, 12, 1, 1, NULL, NULL),
(72, 1, 13, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `valores_plano`
--

CREATE TABLE `valores_plano` (
  `idvalores_plano` int(11) NOT NULL,
  `idmodalidade` int(11) NOT NULL,
  `idprazoPlano` int(11) NOT NULL,
  `valor` float NOT NULL,
  `idtipoPlano` int(11) DEFAULT NULL,
  `idcadastrador` int(11) DEFAULT NULL,
  `dataCadastro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `valores_plano`
--

INSERT INTO `valores_plano` (`idvalores_plano`, `idmodalidade`, `idprazoPlano`, `valor`, `idtipoPlano`, `idcadastrador`, `dataCadastro`) VALUES
(2, 1, 3, 750, 1, 1, '2017-03-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alimento`
--
ALTER TABLE `alimento`
  ADD PRIMARY KEY (`idalimento`,`idrefeicao_plano_nutricao`),
  ADD KEY `fk_alimento_refeicao_plano_nutricao1_idx` (`idrefeicao_plano_nutricao`);

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`idaluno`,`idpessoa`),
  ADD KEY `fk_aluno_pessoa1_idx` (`idpessoa`);

--
-- Indexes for table `aluno_ciclo`
--
ALTER TABLE `aluno_ciclo`
  ADD PRIMARY KEY (`idaluno_ciclo`,`idaluno`),
  ADD KEY `fk_aluno_ciclo_aluno1_idx` (`idaluno`);

--
-- Indexes for table `aluno_contrato`
--
ALTER TABLE `aluno_contrato`
  ADD PRIMARY KEY (`idaluno_contrato`),
  ADD KEY `aluno_contrato_ibfk_1` (`idaluno`),
  ADD KEY `aluno_contrato_ibfk_2` (`idcontrato`),
  ADD KEY `aluno_contrato_ibfk_3` (`idformaPagamento`),
  ADD KEY `aluno_contrato_ibfk_4` (`idtipoPlano`),
  ADD KEY `aluno_contrato_ibfk_5` (`idprazoPlano`),
  ADD KEY `aluno_contrato_ibfk_6` (`idmodalidade`);

--
-- Indexes for table `aluno_contrato_modalidade`
--
ALTER TABLE `aluno_contrato_modalidade`
  ADD PRIMARY KEY (`idaluno_contrato_modalidade`),
  ADD KEY `idaluno_contrato` (`idaluno_contrato`),
  ADD KEY `idmodalidade` (`idmodalidade`);

--
-- Indexes for table `aluno_exercicio`
--
ALTER TABLE `aluno_exercicio`
  ADD PRIMARY KEY (`idaluno_exercicio`,`idaluno_treino`),
  ADD KEY `fk_aluno_exercicio_aluno_treino1_idx` (`idaluno_treino`);

--
-- Indexes for table `aluno_treino`
--
ALTER TABLE `aluno_treino`
  ADD PRIMARY KEY (`idaluno_treino`,`idaluno_ciclo`),
  ADD KEY `fk_aluno_treino_aluno_ciclo1_idx` (`idaluno_ciclo`);

--
-- Indexes for table `aparelho`
--
ALTER TABLE `aparelho`
  ADD PRIMARY KEY (`idaparelho`);

--
-- Indexes for table `avaliacao_fisica`
--
ALTER TABLE `avaliacao_fisica`
  ADD PRIMARY KEY (`idavaliacao_fisica`,`idaluno`),
  ADD KEY `fk_avaliacao_fisica_aluno1_idx` (`idaluno`);

--
-- Indexes for table `bairro`
--
ALTER TABLE `bairro`
  ADD PRIMARY KEY (`idbairro`,`idcidade`),
  ADD KEY `fk_bairro_cidade1_idx` (`idcidade`);

--
-- Indexes for table `categoria_treino`
--
ALTER TABLE `categoria_treino`
  ADD PRIMARY KEY (`idcategoriaTreino`);

--
-- Indexes for table `ciclo`
--
ALTER TABLE `ciclo`
  ADD PRIMARY KEY (`idciclo`);

--
-- Indexes for table `ciclo_treino`
--
ALTER TABLE `ciclo_treino`
  ADD PRIMARY KEY (`idCiclo_treino`,`Ciclo_idciclo`,`treino_idtreino`),
  ADD KEY `fk_Ciclo_has_treino_treino1_idx` (`treino_idtreino`),
  ADD KEY `fk_Ciclo_has_treino_Ciclo1_idx` (`Ciclo_idciclo`);

--
-- Indexes for table `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`idcidade`,`idestado`),
  ADD KEY `fk_cidade_estado1_idx` (`idestado`);

--
-- Indexes for table `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`idcontrato`);

--
-- Indexes for table `deletar`
--
ALTER TABLE `deletar`
  ADD PRIMARY KEY (`idaluno_contrato`),
  ADD KEY `aluno_idaluno` (`idaluno`),
  ADD KEY `idcontrato` (`idcontrato`),
  ADD KEY `idformaPagamento` (`idformaPagamento`),
  ADD KEY `idtipoPlano` (`idtipoPlano`),
  ADD KEY `idprazoPlano` (`idprazoPlano`),
  ADD KEY `idmodalidade` (`idmodalidade`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`idemail`,`idpessoa`),
  ADD KEY `fk_email_pessoa1_idx` (`idpessoa`);

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`idempresa`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`idendereco`,`idpessoa`,`idbairro`),
  ADD KEY `fk_endereco_pessoa1_idx` (`idpessoa`),
  ADD KEY `fk_endereco_bairro1_idx` (`idbairro`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`idestado`);

--
-- Indexes for table `exercicio`
--
ALTER TABLE `exercicio`
  ADD PRIMARY KEY (`idexercicio`,`idtipoExercicio`,`idregiaoTrabalhada`,`idaparelho`),
  ADD KEY `fk_exercicio_regiao_trabalhada1_idx` (`idregiaoTrabalhada`),
  ADD KEY `fk_exercicio_tipo_exercicio1_idx` (`idtipoExercicio`),
  ADD KEY `fk_exercicio_aparelho1_idx` (`idaparelho`);

--
-- Indexes for table `exercicio_combinado`
--
ALTER TABLE `exercicio_combinado`
  ADD PRIMARY KEY (`idexercicio_combinado`,`idexercicio_treino`,`idexercicio`),
  ADD KEY `fk_exercicio_combinado_exercicio_treino1_idx` (`idexercicio_treino`);

--
-- Indexes for table `exercicio_realizado`
--
ALTER TABLE `exercicio_realizado`
  ADD PRIMARY KEY (`idexercicio_realizado`),
  ADD KEY `idtreino_realizado` (`idtreino_realizado`),
  ADD KEY `idaluno_exercicio` (`idaluno_exercicio`);

--
-- Indexes for table `exercicio_treino`
--
ALTER TABLE `exercicio_treino`
  ADD PRIMARY KEY (`idexercicio_treino`,`exercicio_idexercicio`,`treino_idtreino`),
  ADD KEY `fk_exercicio_has_treino_treino1_idx` (`treino_idtreino`),
  ADD KEY `fk_exercicio_has_treino_exercicio1_idx` (`exercicio_idexercicio`);

--
-- Indexes for table `forma_pagamento`
--
ALTER TABLE `forma_pagamento`
  ADD PRIMARY KEY (`idformaPagamento`);

--
-- Indexes for table `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`idFornecedor`,`idpessoa`),
  ADD KEY `fk_Fornecedor_pessoa1_idx` (`idpessoa`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`idfuncionario`,`idpessoa`),
  ADD KEY `fk_funcionario_pessoa1_idx` (`idpessoa`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`idlog`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idtipo_log` (`idtipo_log`);

--
-- Indexes for table `modalidade`
--
ALTER TABLE `modalidade`
  ADD PRIMARY KEY (`idmodalidade`);

--
-- Indexes for table `parq`
--
ALTER TABLE `parq`
  ADD PRIMARY KEY (`idparq`);

--
-- Indexes for table `parq_aluno`
--
ALTER TABLE `parq_aluno`
  ADD PRIMARY KEY (`idparqAluno`,`idaluno`),
  ADD KEY `fk_parq_aluno_aluno1_idx` (`idaluno`);

--
-- Indexes for table `parq_aluno_perguntas_parq`
--
ALTER TABLE `parq_aluno_perguntas_parq`
  ADD PRIMARY KEY (`idparq_aluno_perguntas_parq`,`idparqAluno`,`idperguntaParq`),
  ADD KEY `fk_parq_aluno_has_perguntas_parq_perguntas_parq1_idx` (`idperguntaParq`),
  ADD KEY `fk_parq_aluno_has_perguntas_parq_parq_aluno1_idx` (`idparqAluno`);

--
-- Indexes for table `perguntas_parq`
--
ALTER TABLE `perguntas_parq`
  ADD PRIMARY KEY (`idperguntaParq`,`idparq`),
  ADD KEY `fk_perguntas_parq_parq1_idx` (`idparq`);

--
-- Indexes for table `permissao`
--
ALTER TABLE `permissao`
  ADD PRIMARY KEY (`idpermissao`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`idpessoa`);

--
-- Indexes for table `pessoafisica`
--
ALTER TABLE `pessoafisica`
  ADD PRIMARY KEY (`idpessoaFisica`,`idpessoa`),
  ADD KEY `fk_pessoaFisica_pessoa1_idx` (`idpessoa`);

--
-- Indexes for table `pessoajuridica`
--
ALTER TABLE `pessoajuridica`
  ADD PRIMARY KEY (`idpessoaJuridica`,`idpessoa`),
  ADD KEY `fk_pessoaJuridica_pessoa1_idx` (`idpessoa`);

--
-- Indexes for table `plano_nutricao`
--
ALTER TABLE `plano_nutricao`
  ADD PRIMARY KEY (`idplano_nutricao`,`idaluno`),
  ADD KEY `fk_plano_nutricao_aluno1_idx` (`idaluno`);

--
-- Indexes for table `prazo_plano`
--
ALTER TABLE `prazo_plano`
  ADD PRIMARY KEY (`idprazoPlano`);

--
-- Indexes for table `refeicao`
--
ALTER TABLE `refeicao`
  ADD PRIMARY KEY (`idrefeicao`);

--
-- Indexes for table `refeicao_plano_nutricao`
--
ALTER TABLE `refeicao_plano_nutricao`
  ADD PRIMARY KEY (`idrefeicao_plano_nutricao`,`idplano_nutricao`,`idrefeicao`),
  ADD KEY `fk_refeicao_plano_nutricao_plano_nutricao1_idx` (`idplano_nutricao`),
  ADD KEY `fk_refeicao_plano_nutricao_refeicao1_idx` (`idrefeicao`);

--
-- Indexes for table `regiao_trabalhada`
--
ALTER TABLE `regiao_trabalhada`
  ADD PRIMARY KEY (`idregiaoTrabalhada`);

--
-- Indexes for table `telefone`
--
ALTER TABLE `telefone`
  ADD PRIMARY KEY (`idtelefone`,`idpessoa`),
  ADD KEY `fk_telefone_pessoa1_idx` (`idpessoa`);

--
-- Indexes for table `tipo_exercicio`
--
ALTER TABLE `tipo_exercicio`
  ADD PRIMARY KEY (`idtipoExercicio`);

--
-- Indexes for table `tipo_log`
--
ALTER TABLE `tipo_log`
  ADD PRIMARY KEY (`idtipo_log`);

--
-- Indexes for table `tipo_plano`
--
ALTER TABLE `tipo_plano`
  ADD PRIMARY KEY (`idtipoPlano`);

--
-- Indexes for table `treino`
--
ALTER TABLE `treino`
  ADD PRIMARY KEY (`idtreino`);

--
-- Indexes for table `treino_realizado`
--
ALTER TABLE `treino_realizado`
  ADD PRIMARY KEY (`idtreino_realizado`),
  ADD KEY `idaluno_treino` (`idaluno_treino`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`,`idpessoa`),
  ADD KEY `fk_usuario_pessoa1_idx` (`idpessoa`);

--
-- Indexes for table `usuario_grupo`
--
ALTER TABLE `usuario_grupo`
  ADD PRIMARY KEY (`idusuario_grupo`);

--
-- Indexes for table `usuario_permissao`
--
ALTER TABLE `usuario_permissao`
  ADD PRIMARY KEY (`idusuario_permissao`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idpermissao` (`idpermissao`);

--
-- Indexes for table `valores_plano`
--
ALTER TABLE `valores_plano`
  ADD PRIMARY KEY (`idvalores_plano`),
  ADD KEY `idmodalidade` (`idmodalidade`),
  ADD KEY `idprazoPlano` (`idprazoPlano`),
  ADD KEY `idtipoPlano` (`idtipoPlano`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alimento`
--
ALTER TABLE `alimento`
  MODIFY `idalimento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `idaluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `aluno_ciclo`
--
ALTER TABLE `aluno_ciclo`
  MODIFY `idaluno_ciclo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `aluno_contrato`
--
ALTER TABLE `aluno_contrato`
  MODIFY `idaluno_contrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `aluno_contrato_modalidade`
--
ALTER TABLE `aluno_contrato_modalidade`
  MODIFY `idaluno_contrato_modalidade` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `aluno_exercicio`
--
ALTER TABLE `aluno_exercicio`
  MODIFY `idaluno_exercicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT for table `aluno_treino`
--
ALTER TABLE `aluno_treino`
  MODIFY `idaluno_treino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `aparelho`
--
ALTER TABLE `aparelho`
  MODIFY `idaparelho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `avaliacao_fisica`
--
ALTER TABLE `avaliacao_fisica`
  MODIFY `idavaliacao_fisica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `bairro`
--
ALTER TABLE `bairro`
  MODIFY `idbairro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `categoria_treino`
--
ALTER TABLE `categoria_treino`
  MODIFY `idcategoriaTreino` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ciclo`
--
ALTER TABLE `ciclo`
  MODIFY `idciclo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `ciclo_treino`
--
ALTER TABLE `ciclo_treino`
  MODIFY `idCiclo_treino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `cidade`
--
ALTER TABLE `cidade`
  MODIFY `idcidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `contrato`
--
ALTER TABLE `contrato`
  MODIFY `idcontrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `deletar`
--
ALTER TABLE `deletar`
  MODIFY `idaluno_contrato` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `idemail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `idempresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `idendereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `idestado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `exercicio`
--
ALTER TABLE `exercicio`
  MODIFY `idexercicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `exercicio_combinado`
--
ALTER TABLE `exercicio_combinado`
  MODIFY `idexercicio_combinado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `exercicio_realizado`
--
ALTER TABLE `exercicio_realizado`
  MODIFY `idexercicio_realizado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `exercicio_treino`
--
ALTER TABLE `exercicio_treino`
  MODIFY `idexercicio_treino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `forma_pagamento`
--
ALTER TABLE `forma_pagamento`
  MODIFY `idformaPagamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `idFornecedor` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `idfuncionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `idlog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `modalidade`
--
ALTER TABLE `modalidade`
  MODIFY `idmodalidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `parq`
--
ALTER TABLE `parq`
  MODIFY `idparq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `parq_aluno`
--
ALTER TABLE `parq_aluno`
  MODIFY `idparqAluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `parq_aluno_perguntas_parq`
--
ALTER TABLE `parq_aluno_perguntas_parq`
  MODIFY `idparq_aluno_perguntas_parq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `perguntas_parq`
--
ALTER TABLE `perguntas_parq`
  MODIFY `idperguntaParq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `permissao`
--
ALTER TABLE `permissao`
  MODIFY `idpermissao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `idpessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pessoafisica`
--
ALTER TABLE `pessoafisica`
  MODIFY `idpessoaFisica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pessoajuridica`
--
ALTER TABLE `pessoajuridica`
  MODIFY `idpessoaJuridica` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `plano_nutricao`
--
ALTER TABLE `plano_nutricao`
  MODIFY `idplano_nutricao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `prazo_plano`
--
ALTER TABLE `prazo_plano`
  MODIFY `idprazoPlano` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `refeicao`
--
ALTER TABLE `refeicao`
  MODIFY `idrefeicao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `refeicao_plano_nutricao`
--
ALTER TABLE `refeicao_plano_nutricao`
  MODIFY `idrefeicao_plano_nutricao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `regiao_trabalhada`
--
ALTER TABLE `regiao_trabalhada`
  MODIFY `idregiaoTrabalhada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `telefone`
--
ALTER TABLE `telefone`
  MODIFY `idtelefone` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tipo_exercicio`
--
ALTER TABLE `tipo_exercicio`
  MODIFY `idtipoExercicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tipo_log`
--
ALTER TABLE `tipo_log`
  MODIFY `idtipo_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tipo_plano`
--
ALTER TABLE `tipo_plano`
  MODIFY `idtipoPlano` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `treino`
--
ALTER TABLE `treino`
  MODIFY `idtreino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `treino_realizado`
--
ALTER TABLE `treino_realizado`
  MODIFY `idtreino_realizado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `usuario_permissao`
--
ALTER TABLE `usuario_permissao`
  MODIFY `idusuario_permissao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `valores_plano`
--
ALTER TABLE `valores_plano`
  MODIFY `idvalores_plano` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `alimento`
--
ALTER TABLE `alimento`
  ADD CONSTRAINT `fk_alimento_refeicao_plano_nutricao1` FOREIGN KEY (`idrefeicao_plano_nutricao`) REFERENCES `refeicao_plano_nutricao` (`idrefeicao_plano_nutricao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `fk_aluno_pessoa1` FOREIGN KEY (`idpessoa`) REFERENCES `pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `aluno_ciclo`
--
ALTER TABLE `aluno_ciclo`
  ADD CONSTRAINT `fk_aluno_ciclo_aluno1` FOREIGN KEY (`idaluno`) REFERENCES `aluno` (`idaluno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `aluno_contrato`
--
ALTER TABLE `aluno_contrato`
  ADD CONSTRAINT `aluno_contrato_ibfk_1` FOREIGN KEY (`idaluno`) REFERENCES `aluno` (`idaluno`),
  ADD CONSTRAINT `aluno_contrato_ibfk_2` FOREIGN KEY (`idcontrato`) REFERENCES `contrato` (`idcontrato`),
  ADD CONSTRAINT `aluno_contrato_ibfk_3` FOREIGN KEY (`idformaPagamento`) REFERENCES `forma_pagamento` (`idformaPagamento`),
  ADD CONSTRAINT `aluno_contrato_ibfk_4` FOREIGN KEY (`idtipoPlano`) REFERENCES `tipo_plano` (`idtipoPlano`),
  ADD CONSTRAINT `aluno_contrato_ibfk_5` FOREIGN KEY (`idprazoPlano`) REFERENCES `prazo_plano` (`idprazoPlano`),
  ADD CONSTRAINT `aluno_contrato_ibfk_6` FOREIGN KEY (`idmodalidade`) REFERENCES `modalidade` (`idmodalidade`);

--
-- Limitadores para a tabela `aluno_contrato_modalidade`
--
ALTER TABLE `aluno_contrato_modalidade`
  ADD CONSTRAINT `aluno_contrato_modalidade_ibfk_1` FOREIGN KEY (`idaluno_contrato`) REFERENCES `deletar` (`idaluno_contrato`),
  ADD CONSTRAINT `aluno_contrato_modalidade_ibfk_2` FOREIGN KEY (`idmodalidade`) REFERENCES `modalidade` (`idmodalidade`);

--
-- Limitadores para a tabela `aluno_exercicio`
--
ALTER TABLE `aluno_exercicio`
  ADD CONSTRAINT `fk_aluno_exercicio_aluno_treino1` FOREIGN KEY (`idaluno_treino`) REFERENCES `aluno_treino` (`idaluno_treino`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `aluno_treino`
--
ALTER TABLE `aluno_treino`
  ADD CONSTRAINT `fk_aluno_treino_aluno_ciclo1` FOREIGN KEY (`idaluno_ciclo`) REFERENCES `aluno_ciclo` (`idaluno_ciclo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `avaliacao_fisica`
--
ALTER TABLE `avaliacao_fisica`
  ADD CONSTRAINT `fk_avaliacao_fisica_aluno1` FOREIGN KEY (`idaluno`) REFERENCES `aluno` (`idaluno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `bairro`
--
ALTER TABLE `bairro`
  ADD CONSTRAINT `fk_bairro_cidade1` FOREIGN KEY (`idcidade`) REFERENCES `cidade` (`idcidade`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ciclo_treino`
--
ALTER TABLE `ciclo_treino`
  ADD CONSTRAINT `fk_Ciclo_has_treino_Ciclo1` FOREIGN KEY (`Ciclo_idciclo`) REFERENCES `ciclo` (`idciclo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Ciclo_has_treino_treino1` FOREIGN KEY (`treino_idtreino`) REFERENCES `treino` (`idtreino`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `cidade`
--
ALTER TABLE `cidade`
  ADD CONSTRAINT `fk_cidade_estado1` FOREIGN KEY (`idestado`) REFERENCES `estado` (`idestado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `deletar`
--
ALTER TABLE `deletar`
  ADD CONSTRAINT `deletar_ibfk_1` FOREIGN KEY (`idaluno`) REFERENCES `aluno` (`idaluno`),
  ADD CONSTRAINT `deletar_ibfk_2` FOREIGN KEY (`idcontrato`) REFERENCES `contrato` (`idcontrato`),
  ADD CONSTRAINT `deletar_ibfk_3` FOREIGN KEY (`idformaPagamento`) REFERENCES `forma_pagamento` (`idformaPagamento`),
  ADD CONSTRAINT `deletar_ibfk_4` FOREIGN KEY (`idtipoPlano`) REFERENCES `tipo_plano` (`idtipoPlano`),
  ADD CONSTRAINT `deletar_ibfk_5` FOREIGN KEY (`idprazoPlano`) REFERENCES `prazo_plano` (`idprazoPlano`),
  ADD CONSTRAINT `deletar_ibfk_6` FOREIGN KEY (`idmodalidade`) REFERENCES `modalidade` (`idmodalidade`);

--
-- Limitadores para a tabela `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `fk_email_pessoa1` FOREIGN KEY (`idpessoa`) REFERENCES `pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `fk_endereco_bairro1` FOREIGN KEY (`idbairro`) REFERENCES `bairro` (`idbairro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_endereco_pessoa1` FOREIGN KEY (`idpessoa`) REFERENCES `pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `exercicio`
--
ALTER TABLE `exercicio`
  ADD CONSTRAINT `fk_exercicio_aparelho1` FOREIGN KEY (`idaparelho`) REFERENCES `aparelho` (`idaparelho`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_exercicio_regiao_trabalhada1` FOREIGN KEY (`idregiaoTrabalhada`) REFERENCES `regiao_trabalhada` (`idregiaoTrabalhada`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_exercicio_tipo_exercicio1` FOREIGN KEY (`idtipoExercicio`) REFERENCES `tipo_exercicio` (`idtipoExercicio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `exercicio_combinado`
--
ALTER TABLE `exercicio_combinado`
  ADD CONSTRAINT `fk_exercicio_combinado_exercicio_treino1` FOREIGN KEY (`idexercicio_treino`) REFERENCES `exercicio_treino` (`idexercicio_treino`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `exercicio_realizado`
--
ALTER TABLE `exercicio_realizado`
  ADD CONSTRAINT `exercicio_realizado_ibfk_1` FOREIGN KEY (`idtreino_realizado`) REFERENCES `treino_realizado` (`idtreino_realizado`),
  ADD CONSTRAINT `exercicio_realizado_ibfk_2` FOREIGN KEY (`idaluno_exercicio`) REFERENCES `aluno_exercicio` (`idaluno_exercicio`);

--
-- Limitadores para a tabela `exercicio_treino`
--
ALTER TABLE `exercicio_treino`
  ADD CONSTRAINT `fk_exercicio_has_treino_exercicio1` FOREIGN KEY (`exercicio_idexercicio`) REFERENCES `exercicio` (`idexercicio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_exercicio_has_treino_treino1` FOREIGN KEY (`treino_idtreino`) REFERENCES `treino` (`idtreino`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD CONSTRAINT `fk_Fornecedor_pessoa1` FOREIGN KEY (`idpessoa`) REFERENCES `pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_funcionario_pessoa1` FOREIGN KEY (`idpessoa`) REFERENCES `pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `log_ibfk_2` FOREIGN KEY (`idtipo_log`) REFERENCES `tipo_log` (`idtipo_log`);

--
-- Limitadores para a tabela `parq_aluno`
--
ALTER TABLE `parq_aluno`
  ADD CONSTRAINT `fk_parq_aluno_aluno1` FOREIGN KEY (`idaluno`) REFERENCES `aluno` (`idaluno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `parq_aluno_perguntas_parq`
--
ALTER TABLE `parq_aluno_perguntas_parq`
  ADD CONSTRAINT `fk_parq_aluno_has_perguntas_parq_parq_aluno1` FOREIGN KEY (`idparqAluno`) REFERENCES `parq_aluno` (`idparqAluno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_parq_aluno_has_perguntas_parq_perguntas_parq1` FOREIGN KEY (`idperguntaParq`) REFERENCES `perguntas_parq` (`idperguntaParq`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `perguntas_parq`
--
ALTER TABLE `perguntas_parq`
  ADD CONSTRAINT `fk_perguntas_parq_parq1` FOREIGN KEY (`idparq`) REFERENCES `parq` (`idparq`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pessoafisica`
--
ALTER TABLE `pessoafisica`
  ADD CONSTRAINT `fk_pessoaFisica_pessoa1` FOREIGN KEY (`idpessoa`) REFERENCES `pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pessoajuridica`
--
ALTER TABLE `pessoajuridica`
  ADD CONSTRAINT `fk_pessoaJuridica_pessoa1` FOREIGN KEY (`idpessoa`) REFERENCES `pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `plano_nutricao`
--
ALTER TABLE `plano_nutricao`
  ADD CONSTRAINT `fk_plano_nutricao_aluno1` FOREIGN KEY (`idaluno`) REFERENCES `aluno` (`idaluno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `refeicao_plano_nutricao`
--
ALTER TABLE `refeicao_plano_nutricao`
  ADD CONSTRAINT `fk_refeicao_plano_nutricao_plano_nutricao1` FOREIGN KEY (`idplano_nutricao`) REFERENCES `plano_nutricao` (`idplano_nutricao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_refeicao_plano_nutricao_refeicao1` FOREIGN KEY (`idrefeicao`) REFERENCES `refeicao` (`idrefeicao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `telefone`
--
ALTER TABLE `telefone`
  ADD CONSTRAINT `fk_telefone_pessoa1` FOREIGN KEY (`idpessoa`) REFERENCES `pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `treino_realizado`
--
ALTER TABLE `treino_realizado`
  ADD CONSTRAINT `treino_realizado_ibfk_1` FOREIGN KEY (`idaluno_treino`) REFERENCES `aluno_treino` (`idaluno_treino`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_pessoa1` FOREIGN KEY (`idpessoa`) REFERENCES `pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario_permissao`
--
ALTER TABLE `usuario_permissao`
  ADD CONSTRAINT `usuario_permissao_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `usuario_permissao_ibfk_2` FOREIGN KEY (`idpermissao`) REFERENCES `permissao` (`idpermissao`);

--
-- Limitadores para a tabela `valores_plano`
--
ALTER TABLE `valores_plano`
  ADD CONSTRAINT `valores_plano_ibfk_1` FOREIGN KEY (`idmodalidade`) REFERENCES `modalidade` (`idmodalidade`),
  ADD CONSTRAINT `valores_plano_ibfk_2` FOREIGN KEY (`idprazoPlano`) REFERENCES `prazo_plano` (`idprazoPlano`),
  ADD CONSTRAINT `valores_plano_ibfk_3` FOREIGN KEY (`idtipoPlano`) REFERENCES `tipo_plano` (`idtipoPlano`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
