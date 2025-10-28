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
-- Estrutura da tabela `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
`idestado` int(11) NOT NULL,
  `codigo_ibge` varchar(255) DEFAULT NULL,
  `sigla` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
 ADD PRIMARY KEY (`idestado`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
MODIFY `idestado` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
