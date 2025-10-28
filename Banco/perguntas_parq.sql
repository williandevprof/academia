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
-- Estrutura da tabela `perguntas_parq`
--

CREATE TABLE IF NOT EXISTS `perguntas_parq` (
`idperguntaParq` int(11) NOT NULL,
  `idparq` int(11) NOT NULL,
  `pergunta` text
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `perguntas_parq`
--

INSERT INTO `perguntas_parq` (`idperguntaParq`, `idparq`, `pergunta`) VALUES
(1, 1, 'O seu médico já lhe disse alguma vêz que você apresenta algum problema cardíaco?'),
(2, 1, 'Você apresenta dores no peito com frequência? '),
(3, 1, 'Você apresenta Episódios frequentes de tonteira ou sensação de desmaio?'),
(4, 1, 'Seu médico já lhe disse alguma vez que sua pressão Sanguínea era muito alta?');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `perguntas_parq`
--
ALTER TABLE `perguntas_parq`
 ADD PRIMARY KEY (`idperguntaParq`,`idparq`), ADD KEY `fk_perguntas_parq_parq1_idx` (`idparq`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `perguntas_parq`
--
ALTER TABLE `perguntas_parq`
MODIFY `idperguntaParq` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `perguntas_parq`
--
ALTER TABLE `perguntas_parq`
ADD CONSTRAINT `fk_perguntas_parq_parq1` FOREIGN KEY (`idparq`) REFERENCES `parq` (`idparq`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
