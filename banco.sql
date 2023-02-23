CREATE TABLE `carrinho` (
  `CODIGOPRODUTO` int(11) NOT NULL,
  `NOME` varchar(100) NOT NULL,
  `VALOR` double NOT NULL,
  `QUANTCOMPRA` int(11) NOT NULL,
  `FOTO` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `ID_CATEGORIA` int(11) NOT NULL,
  `DESCRICAO` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`ID_CATEGORIA`, `DESCRICAO`) VALUES
(1, 'biquínis'),
(4, 'maiôs'),
(5, 'diversos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `ID_CLIENTE` int(11) NOT NULL,
  `NOME` varchar(60) NOT NULL,
  `DATANASC` date NOT NULL,
  `CPF` char(14) NOT NULL,
  `TELEFONE` varchar(15) NOT NULL,
  `EMAIL` varchar(20) DEFAULT NULL,
  `CEP` char(9) NOT NULL,
  `NUMEROCASA` smallint(6) NOT NULL,
  `COMPLEMENTO` varchar(30) DEFAULT NULL,
  `SENHA` varchar(255) NOT NULL,
  `FOTO` varchar(255) DEFAULT NULL,
  `STATUS` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`ID_CLIENTE`, `NOME`, `DATANASC`, `CPF`, `TELEFONE`, `EMAIL`, `CEP`, `NUMEROCASA`, `COMPLEMENTO`, `SENHA`, `FOTO`, `STATUS`) VALUES
(1, 'Maria', '2002-10-10', '123456893-10', '(21)99886-1055', 'maria@gmail.com', '12555', 31, 'ap 102', '', 'vazio', 'I'),
(2, 'Rafaela', '2002-10-10', '123456894-10', '(21)99886-8888', 'rafaela@gmail.com', '12556', 129, 'ap 9', '', 'vazio', 'I'),
(3, 'Carla', '2002-10-10', '123456895-10', '(21)99886-9999', 'carla@gmail.com', '12557', 128, 'ap 179', '', 'vazio', 'I'),
(4, 'Andreia', '2002-10-10', '123456896-10', '(21)99886-7777', 'andreia@gmail.com', '12558', 179, 'ap 12', '', 'vazio', 'A'),
(5, 'Núvia', '2002-10-10', '123456895-10', '(21)99886-8887', 'nuvia@gmail.com', '12559', 126, 'ap 19', '', 'vazio', 'A'),
(6, 'Yasmin Teste', '2023-02-18', '119555468745', '21983784343', 'yas@gmail.com', '23092631', 129, 'CASA', '$2y$10$fG0i1iuSm99C.cmd/imdp.gA5ElI9y/bLIJlI.kIwEsOvMMxaKjZu', 'foto/63ed2d3889268.png', 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `ID_FORNECEDOR` int(11) NOT NULL,
  `NOME` varchar(200) DEFAULT NULL,
  `TELEFONE` varchar(15) NOT NULL,
  `EMAIL` varchar(20) NOT NULL,
  `CEP` char(9) NOT NULL,
  `COMPLEMENTO` varchar(30) DEFAULT NULL,
  `CONTA_BANCARIA` int(11) DEFAULT NULL,
  `AGENCIA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`ID_FORNECEDOR`, `NOME`, `TELEFONE`, `EMAIL`, `CEP`, `COMPLEMENTO`, `CONTA_BANCARIA`, `AGENCIA`) VALUES
(1, 'FORNECEDORum', '(21)98378-4343', 'fornecedorum@gmail.c', '23092687', 'amarela', 4545, 6565),
(2, 'FORNECEDORdois', '(21)98378-4343', 'fornecedordois@gmail', '23092687', 'amarela', 4545, 6565),
(3, 'FORNECEDORtres', '(21)98378-4343', 'fornecedortres@gmail', '23092687', 'amarela', 4545, 6565),
(4, 'FORNECEDORquatro', '(21)983784343', 'fornecedorquatro@gma', '23092687', 'amarela', 4545, 6565);

-- --------------------------------------------------------

--
-- Estrutura da tabela `roupa`
--

CREATE TABLE `roupa` (
  `ID_PRODUTO` int(11) NOT NULL,
  `PRODUTO_NOME` varchar(60) NOT NULL,
  `QUANTIDADE` int(11) NOT NULL,
  `TAMANHO` char(2) NOT NULL,
  `COR` varchar(30) NOT NULL,
  `CUSTO` double DEFAULT NULL,
  `VALOR` double NOT NULL,
  `ID_FORNECEDOR` int(11) DEFAULT NULL,
  `FOTO` varchar(255) NOT NULL,
  `ID_CATEGORIA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `ID_VENDA` int(11) NOT NULL,
  `DATA` date NOT NULL,
  `VALOR` double NOT NULL,
  `FORMA_PAGAMENTO` varchar(200) DEFAULT NULL,
  `PARCELAS` int(11) DEFAULT NULL,
  `ID_VENDEDOR` int(11) NOT NULL,
  `ID_CLIENTE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda_roupa`
--

CREATE TABLE `venda_roupa` (
  `ID_VENDA_ROUPA` int(11) NOT NULL,
  `ID_ROUPA` int(11) NOT NULL,
  `ID_VENDA` int(11) NOT NULL,
  `QUANTIDADE` int(11) DEFAULT NULL,
  `VALOR` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendedor`
--

CREATE TABLE `vendedor` (
  `ID_VENDEDOR` int(11) NOT NULL,
  `NOME` varchar(60) NOT NULL,
  `PIS` int(11) DEFAULT NULL,
  `CPFFUNCIONARIO` char(14) DEFAULT NULL,
  `TELEFONE` varchar(15) NOT NULL,
  `EMAIL` varchar(20) DEFAULT NULL,
  `CEP` char(9) NOT NULL,
  `NUMEROCASA` smallint(6) NOT NULL,
  `COMPLEMENTO` varchar(30) DEFAULT NULL,
  `AGENCIA` int(11) DEFAULT NULL,
  `CONTA_BANCARIA` int(11) DEFAULT NULL,
  `FOTO` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `vendedor`
--

INSERT INTO `vendedor` (`ID_VENDEDOR`, `NOME`, `PIS`, `CPFFUNCIONARIO`, `TELEFONE`, `EMAIL`, `CEP`, `NUMEROCASA`, `COMPLEMENTO`, `AGENCIA`, `CONTA_BANCARIA`, `FOTO`) VALUES
(1, 'Mário Silva', 3232, '119554687-45', '(21)9999-8787', 'mario@gmail.com', '23092631', 20, 'ap 202', 8484, 5252, 'vazio'),
(2, 'Denize Rafaela', 3332, '119554687-45', '(21)9999-8787', 'denize@gmail.com', '23092631', 20, 'ap 202', 8484, 5252, 'vazio'),
(3, 'Pricilaalcantara', 3432, '119554687-45', '(21)9999-8787', 'pricila@gmail.com', '23092631', 20, 'ap 202', 8484, 5252, 'vazio'),
(4, 'Carlos Algusto', 3532, '119554687-45', '(21)9999-8787', 'Carlos@gmail.com', '23092631', 20, 'ap 202', 8484, 5252, 'vazio');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID_CATEGORIA`);

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID_CLIENTE`);

--
-- Índices para tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`ID_FORNECEDOR`);

--
-- Índices para tabela `roupa`
--
ALTER TABLE `roupa`
  ADD PRIMARY KEY (`ID_PRODUTO`),
  ADD KEY `FK_CATEGORIA` (`ID_CATEGORIA`),
  ADD KEY `Fk_FORNECEDOR` (`ID_FORNECEDOR`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID_CLIENTE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `roupa`
--
ALTER TABLE `roupa`
  MODIFY `ID_PRODUTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `roupa`
--
ALTER TABLE `roupa`
  ADD CONSTRAINT `FK_CATEGORIA` FOREIGN KEY (`ID_CATEGORIA`) REFERENCES `categoria` (`ID_CATEGORIA`),
  ADD CONSTRAINT `Fk_FORNECEDOR` FOREIGN KEY (`ID_FORNECEDOR`) REFERENCES `fornecedor` (`ID_FORNECEDOR`);