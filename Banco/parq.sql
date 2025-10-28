-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 20-Jun-2016 às 16:05
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `academia`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `parq`
--

CREATE TABLE IF NOT EXISTS `parq` (
`idparq` int(11) NOT NULL,
  `textoParq` text,
  `titulo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `parq`
--

INSERT INTO `parq` (`idparq`, `textoParq`, `titulo`) VALUES
(1, 'O PAR Q foi elaborado para auxiliar você a se auto-ajudar. Os Exercícios praticados regularmente estão associados a muitos benefícios de saúde. Completar o PAR Q representa em primeiro passo racional a ser tomado, caso você esteja interessado a aumentar a quantidade de atividades físicas em sua vida. Para maioria dos indivíduos, a atividade física não deve trazer qualquer problema ou prejuízo. O PAR Q foi elaborado para ajudar a identificar o pequeno número de adultos, para quem a prática de exercícios físicos pode ser inadequada, ou aqueles que devem procurar aconselhamento médico acerca do tipo de atividade que seria mais apropriado para eles. O bom senso é a melhor tática a ser adotada para responder a essas perguntas. ', 'PAR Q E VOCÊ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parq`
--
ALTER TABLE `parq`
 ADD PRIMARY KEY (`idparq`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parq`
--
ALTER TABLE `parq`
MODIFY `idparq` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
