
SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

INSERT INTO `caixa` (`caixa_id`, `caixa_identificacao`, `caixa_localizacao`, `caixa_tecnologia`, `caixa_versao_aplicacao`, `caixa_data_inicio_movimentacao`, `caixa_valor_inicio_movimentacao`, `caixa_observacao`, `caixa_emissao_razao_social`, `caixa_emissao_cnpj`, `caixa_emissao_inscricao_estadual`, `caixa_emissao_inscricao_municipal`, `caixa_contato_suporte`, `caixa_telefone_suporte`, `caixa_email_suporte`) VALUES
(10,	'SpeedTecnoShop Caixa 01',	'Loja Shopping Palladium',	'',	'1.00',	'2020-12-02',	0.00,	'Observação de Teste',	'Speed Tecno Shop S/A',	'08.187.168/0001-60',	'',	'',	'',	'',	''),
(22,	'SpeedTecnoShop Caixa 02',	'Loja Shopping Palladium',	NULL,	'1.00',	'2020-12-04',	0.00,	'Criado caixa Preferencial/Gestantes/Idosos',	'Speed Tecno Shop S/A',	'08.187.168/0001-60',	NULL,	NULL,	NULL,	NULL,	NULL);

INSERT INTO `categoria` (`categoria_id`, `categoria_movimentacao`, `categoria_flag_entrada_saida`, `categoria_flag_atualiza_saldo`, `categoria_flag_ativo`) VALUES
(10,	'COMPRA DE BRINDE',	'S',	'S',	'S'),
(11,	'COMPRA DE COMBUSTIVEL',	'S',	'S',	'S'),
(12,	'COMPRA DE EMBALAGEM',	'S',	'S',	'S'),
(13,	'COMPRA DE MERCADORIAS',	'S',	'S',	'S'),
(14,	'ESTORNO A CLIENTE',	'S',	'S',	'S'),
(16,	'OUTRAS SAIDAS',	'S',	'S',	'S'),
(17,	'PAGAMENTO A FORNECEDOR',	'S',	'S',	'S'),
(18,	'PAGAMENTO DE SERVICOS',	'S',	'S',	'S'),
(19,	'DESPESAS INTERNAS',	'S',	'S',	'S'),
(20,	'DESPESAS DE MATERIAL DE USO E LIMPEZA',	'S',	'S',	'S'),
(21,	'VENDA DE MERCADORIA',	'E',	'S',	'S'),
(22,	'OUTRAS ENTRADAS',	'E',	'S',	'S'),
(23,	'REFORCO NO CAIXA',	'E',	'S',	'S'),
(24,	'DEVOLUCAO PARA CAIXA',	'E',	'S',	'S'),
(25,	'COMPRA DE MATERIA PRIMA',	'S',	'S',	'S'),
(26,	'COMPRA DE MATERIAL DE LIMPEZA',	'S',	'S',	'S'),
(27,	'SANGRIA DO CAIXA',	'S',	'S',	'S'),
(29,	'CATEGORIA TESTE',	'S',	'S',	'S');

INSERT INTO `conta` (`conta_id`, `conta_caixa_id`, `conta_numero_banco`, `conta_nome_banco`, `conta_numero_agencia`, `conta_digito_verificador_agencia`, `conta_numero_conta`, `conta_digito_verificador_conta`, `conta_valor_saldo_atual`, `conta_data_atual`, `conta_valor_saldo_data_anterior`, `conta_data_anterior`, `conta_valor_aplicado`) VALUES
(10,	10,	'260',	'NUBANK',	'0001',	0,	'123456',	7,	74400.00,	'2020-12-14',	71500.00,	'2020-12-13',	200000.00);

INSERT INTO `contapagar` (`contapagar_id`, `contapagar_formapgto_id`, `contapagar_conta_id`, `contapagar_categoria_id`, `contapagar_caixa_id`, `contapagar_nome_credor`, `contapagar_descricao`, `contapagar_numero_duplicata`, `contapagar_numero_documento`, `contapagar_data_emissao`, `contapagar_data_vencimento`, `contapagar_data_pagamento`, `contapagar_valor_duplicata`, `contapagar_valor_juros`, `contapagar_valor_desconto`, `contapagar_valor_total`, `contapagar_observacao`, `contapagar_nome_banco`, `contapagar_numero_agencia`, `contapagar_numero_conta`, `contapagar_data_lancamento`, `contapagar_numero_nota_fiscal`, `contapagar_numero_parcela`, `contapagar_nosso_numero`, `contapagar_obs_mudanca_vencimento`, `contapagar_flag_cancelada`, `contapagar_flag_estorno_devolucao`) VALUES
(10,	10,	10,	18,	10,	'COPEL',	'Pagamento da Fatura Copel',	'45842',	'78458',	'2020-12-01',	'2020-12-20',	'2020-12-06',	12345.00,	0.00,	0.00,	12345.00,	NULL,	NULL,	NULL,	NULL,	'2020-12-06',	NULL,	'0',	NULL,	NULL,	'N',	'N'),
(16,	10,	10,	18,	10,	'SANEPAR',	'Pagamento da Fatura de Agua',	'47854',	'578441',	'2020-12-02',	'2020-12-15',	'2020-12-06',	1650.00,	0.00,	0.00,	1650.00,	'',	'',	'',	'',	'2020-12-06',	'',	'0',	'',	NULL,	'N',	'N'),
(17,	10,	10,	18,	10,	'VIVO FIBRA',	'Pagamento da Fatura de Internet',	'112451',	'4543251',	'2020-12-02',	'2020-12-15',	'2020-12-06',	250.00,	0.00,	0.00,	250.00,	'',	'',	'',	'',	'2020-12-06',	'',	'0',	'',	NULL,	'N',	'N'),
(18,	10,	10,	18,	10,	'CONDOMINIO',	'Pagamento do Condominio do Escritorio Matriz',	'11234',	'124/4578',	'2020-12-02',	'2020-12-15',	'2020-12-07',	350.00,	0.00,	0.00,	350.00,	'',	'',	'',	'',	'2020-12-07',	'',	'0',	'',	NULL,	'N',	'N'),
(19,	10,	10,	18,	10,	'CONDOMINIO',	'Pagamento do Condominio do Escritorio Filial Londrina',	'A74884',	'224/4578B',	'2020-12-02',	'2020-12-15',	'2020-12-07',	250.00,	0.00,	0.00,	250.00,	NULL,	'',	'',	'',	'2020-12-08',	'',	'0',	'',	NULL,	'N',	'N'),
(20,	10,	10,	18,	10,	'CHAVEIRO',	'Pagamento do Serviço de Chaveiro no Escritorio Filial Foz do Iguaçu',	'C457',	'148',	'2020-12-08',	'2020-12-15',	'2020-12-08',	100.00,	0.00,	0.00,	100.00,	NULL,	'',	'',	'',	'2020-12-08',	'',	'0',	'',	NULL,	'N',	'N'),
(21,	10,	10,	13,	10,	'DELL COMPUTADORES',	'Pagamento de Compra de Notebook DELL Vostro 9000 para o Escritorio Matriz',	'NBDELL545456',	'745465',	'2020-12-09',	'2020-12-09',	'2020-12-09',	3000.00,	0.00,	0.00,	3000.00,	NULL,	'',	'',	'',	'2020-12-09',	'',	'0',	'',	NULL,	'N',	'N');

INSERT INTO `contareceber` (`contareceber_id`, `contareceber_formarecebimento_id`, `contareceber_conta_id`, `contareceber_categoria_id`, `contareceber_caixa_id`, `contareceber_nome_cliente`, `contareceber_descricao`, `contareceber_numero_duplicata`, `contareceber_numero_documento`, `contareceber_data_emissao`, `contareceber_data_vencimento`, `contareceber_data_recebimento`, `contareceber_valor_duplicata`, `contareceber_valor_juros`, `contareceber_valor_desconto`, `contareceber_valor_total`, `contareceber_observacao`, `contareceber_data_lancamento`, `contareceber_numero_nota_fiscal`, `contareceber_numero_parcela`, `contareceber_nosso_numero`, `contareceber_data_mudanca_vencimento`, `contareceber_obs_mudanca_vencimento`, `contareceber_flag_cancelada`, `contareceber_flag_estorno_devolucao`) VALUES
(10,	10,	10,	21,	10,	'MARIA DA SILVA',	'Venda de Curso ABC',	'',	'',	'2020-12-06',	'2020-12-06',	'2020-12-06',	1000.00,	0.00,	0.00,	1000.00,	'PAGO A VISTA',	'2020-12-06',	NULL,	0,	NULL,	NULL,	NULL,	'N',	'N'),
(13,	10,	10,	21,	10,	'SERGIO MORO',	'Venda de Livros',	'11223',	'',	'2020-12-06',	'2020-12-06',	'2020-12-06',	2300.00,	0.00,	0.00,	2300.00,	'',	'2020-12-06',	'',	0,	'',	NULL,	NULL,	'N',	'N'),
(16,	10,	10,	21,	10,	'JOAO DE ALMEIDA',	'Venda da Promocao de Black Friday',	'11223',	'',	'2020-12-06',	'2020-12-06',	'2020-12-07',	1500.00,	0.00,	0.00,	1500.00,	'',	'2020-12-08',	'',	0,	'',	NULL,	NULL,	'N',	'N'),
(17,	10,	10,	21,	10,	'JOSE SOUZA FILHO',	'Venda de Curso de Cafe Delivery',	'11223',	'',	'2020-12-06',	'2020-12-06',	'2020-12-07',	14500.00,	0.00,	0.00,	1400.00,	NULL,	'2020-12-08',	'',	0,	'',	NULL,	NULL,	'N',	'N'),
(18,	10,	10,	21,	10,	'LUIZA SOUZA GOMES',	'Venda de Curso de Cafe Delivery 2021',	'11224',	'',	'2020-12-08',	'2020-12-08',	'2020-12-08',	1100.00,	0.00,	0.00,	1100.00,	NULL,	'2020-12-08',	'',	0,	'',	NULL,	NULL,	'N',	'N'),
(19,	10,	10,	21,	10,	'JAQUELINE LIMA SILVEIRA',	'Venda de Curso de Cafe Delivery 2021',	'11225',	'',	'2020-12-08',	'2020-12-08',	'2020-12-08',	1045.00,	0.00,	0.00,	1045.00,	NULL,	'2020-12-08',	'',	0,	'',	NULL,	NULL,	'N',	'N'),
(20,	10,	10,	21,	10,	'KELLY GRACE SALLES',	'Venda de Curso de Cafe Delivery 2021',	'11226',	'',	'2020-12-08',	'2020-12-08',	'2020-12-08',	1000.00,	0.00,	0.00,	1000.00,	NULL,	'2020-12-08',	'',	0,	'',	NULL,	NULL,	'N',	'N'),
(21,	10,	10,	21,	10,	'PAULA ALMEIDA SALLES',	'Venda de Curso de Cafe Delivery 2021',	'11227',	'',	'2020-12-09',	'2020-12-09',	'2020-12-09',	1000.00,	0.00,	0.00,	1000.00,	NULL,	'2020-12-09',	'',	0,	'',	NULL,	NULL,	'N',	'N'),
(22,	10,	10,	21,	10,	'JOANA DARC ALBUQUERQUE',	'Venda de Curso de Cafe Delivery 2021',	'11229',	'',	'2020-12-09',	'2020-12-10',	'2020-12-10',	1000.00,	0.00,	0.00,	1000.00,	NULL,	'2020-12-11',	'',	0,	'',	NULL,	NULL,	'N',	'N'),
(23,	10,	10,	21,	10,	'ANA MARIA ANTUNES',	'Franquia de Curso de Cafe Delivery 2021',	'11230',	'',	'2020-12-09',	'2020-12-10',	'2020-12-10',	1500.00,	0.00,	0.00,	1500.00,	NULL,	'2020-12-12',	'',	0,	'',	NULL,	NULL,	'N',	'N'),
(26,	10,	10,	21,	10,	'CLAUUDIA MARIA AMELIA ANTUNES',	'Venda de Curso de Cafe Delivery 2021',	'11240',	'',	'2020-12-13',	'2020-12-14',	'2020-12-13',	1100.00,	0.00,	0.00,	1100.00,	NULL,	'2020-12-14',	'',	0,	'',	NULL,	NULL,	'N',	'N'),
(27,	10,	10,	21,	10,	'JOANA DARC ANTUNES',	'Venda de Curso de Cafe Delivery 2021',	'11245',	'',	'2020-12-13',	'2020-12-14',	'2020-12-13',	1200.00,	0.00,	0.00,	1200.00,	NULL,	'2020-12-14',	'',	0,	'',	NULL,	NULL,	'N',	'N'),
(28,	10,	10,	21,	10,	'VANIA DOS SANTOS ALBUQUERQUE',	'Venda de Curso de Cafe Delivery 2021',	'11246',	'',	'2020-12-13',	'2020-12-14',	'2020-12-13',	1300.00,	0.00,	0.00,	1300.00,	NULL,	'2020-12-14',	'',	0,	'',	NULL,	NULL,	'N',	'N'),
(29,	10,	10,	21,	10,	'LUIZA SANTOS ALBUQUERQUE',	'Venda de Curso de Cafe Delivery 2021',	'11247',	'',	'2020-12-13',	'2020-12-14',	'2020-12-13',	1400.00,	0.00,	0.00,	1400.00,	NULL,	'2020-12-14',	'',	0,	'',	NULL,	NULL,	'N',	'N'),
(30,	10,	10,	21,	10,	'ANA LUIZA SANTOS ALBUQUERQUE',	'Venda de Curso de Cafe Delivery 2021',	'11248',	'',	'2020-12-13',	'2020-12-14',	'2020-12-13',	1400.00,	0.00,	0.00,	1400.00,	NULL,	'2020-12-14',	'',	0,	'',	NULL,	NULL,	'N',	'N'),
(31,	10,	10,	21,	10,	'CATARINA SANTOS ALBUQUERQUE',	'Venda de Curso de Cafe Delivery 2021',	'11249',	'',	'2020-12-13',	'2020-12-14',	'2020-12-13',	1500.00,	0.00,	0.00,	1500.00,	NULL,	'2020-12-14',	'',	0,	'',	NULL,	NULL,	'N',	'N');

INSERT INTO `formapgto` (`formapgto_id`, `formapgto_descricao`) VALUES
(11,	'Boleto'),
(12,	'Cartao de Credito'),
(13,	'Cartao de Debito'),
(16,	'Cheque'),
(18,	'DARF'),
(15,	'Deposito'),
(10,	'Dinheiro'),
(19,	'GNRE'),
(17,	'GPS'),
(14,	'Pix'),
(22,	'TED');

INSERT INTO `formarecebimento` (`formarecebimento_id`, `formarecebimento_descricao`) VALUES
(17,	'Alelo'),
(11,	'Boleto'),
(12,	'Cartao de Credito'),
(13,	'Cartao de Debito'),
(15,	'Cheque'),
(14,	'Deposito'),
(10,	'Dinheiro'),
(16,	'Pix'),
(20,	'Ticket Alimentação'),
(18,	'Ticket Refeicao');

INSERT INTO `movimentacao` (`movimentacao_id`, `movimentacao_contareceber_id`, `movimentacao_contapagar_id`, `movimentacao_conta_id`, `movimentacao_caixa_id`, `movimentacao_data_lancamento`, `movimentacao_valor_lancamento`, `movimentacao_referente`, `movimentacao_flag_estorno`, `movimentacao_observacao`, `movimentacao_obs_estorno`) VALUES
(13,	10,	0,	10,	10,	'2020-12-06',	1000.00,	'MARIA DA SILVA',	'N',	NULL,	NULL),
(14,	0,	10,	10,	10,	'2020-12-06',	-12345.00,	'COPEL',	'N',	NULL,	NULL),
(15,	13,	0,	10,	10,	'2020-12-07',	2300.00,	'SERGIO MORO',	'N',	NULL,	NULL),
(17,	0,	16,	10,	10,	'2020-12-06',	-1650.00,	'SANEPAR',	'N',	NULL,	NULL),
(18,	0,	17,	10,	10,	'2020-12-06',	-350.00,	'VIVO FIBRA',	'N',	NULL,	NULL),
(19,	0,	18,	10,	10,	'2020-12-07',	-350.00,	'CONDOMINIO',	'N',	NULL,	NULL),
(20,	16,	0,	10,	10,	'2020-12-08',	1500.00,	'JOAO DE ALMEIDA',	'N',	NULL,	NULL),
(21,	17,	0,	10,	10,	'2020-12-08',	1400.00,	'JOSE SOUZA FILHO',	'N',	NULL,	NULL),
(22,	0,	19,	10,	10,	'2020-12-08',	-250.00,	'CONDOMINIO',	'N',	NULL,	NULL),
(23,	18,	0,	10,	10,	'2020-12-08',	1100.00,	'LUIZA SOUZA GOMES',	'N',	NULL,	NULL),
(24,	19,	0,	10,	10,	'2020-12-08',	1045.00,	'JAQUELINE LIMA SILVEIRA',	'N',	NULL,	NULL),
(25,	0,	20,	10,	10,	'2020-12-08',	-100.00,	'CHAVEIRO',	'N',	NULL,	NULL),
(26,	20,	0,	10,	10,	'2020-12-08',	1200.00,	'KELLY GRACE SALLES',	'N',	NULL,	NULL),
(27,	0,	21,	10,	10,	'2020-12-09',	-3000.00,	'DELL COMPUTADORES',	'N',	NULL,	NULL),
(29,	21,	0,	10,	10,	'2020-12-09',	1000.00,	'PAULA ALMEIDA SALLES',	'N',	NULL,	NULL),
(31,	22,	0,	10,	10,	'2020-12-11',	1000.00,	'JOANA DARC ALBUQUERQUE',	'N',	NULL,	NULL),
(32,	23,	0,	10,	10,	'2020-12-11',	1000.00,	'ANA MARIA AMELIA ANTUNES',	'N',	NULL,	NULL),
(36,	26,	0,	10,	10,	'2020-12-14',	1100.00,	'CLAUUDIA MARIA AMELIA ANTUNES',	'N',	NULL,	NULL),
(37,	27,	0,	10,	10,	'2020-12-14',	1200.00,	'JOANA DARC ANTUNES',	'N',	NULL,	NULL),
(38,	28,	0,	10,	10,	'2020-12-14',	1300.00,	'VANIA DOS SANTOS ALBUQUERQUE',	'N',	NULL,	NULL),
(39,	29,	0,	10,	10,	'2020-12-14',	1400.00,	'LUIZA SANTOS ALBUQUERQUE',	'N',	NULL,	NULL),
(40,	30,	0,	10,	10,	'2020-12-14',	1400.00,	'ANA LUIZA SANTOS ALBUQUERQUE',	'N',	NULL,	NULL),
(41,	31,	0,	10,	10,	'2020-12-14',	1500.00,	'CATARINA SANTOS ALBUQUERQUE',	'N',	NULL,	NULL);


INSERT INTO `usuario` (`usuario_id`, `usuario_caixa_id`, `usuario_login`, `usuario_senha`, `usuario_email`, `usuario_nome`, `usuario_primeiro_nome`, `usuario_ativo`) VALUES
(10,	10,	'josesilva',	'secreta',	'josesilva@speedtecnoshop.com.br',	'Jose da Silva',	'Jose',	'S'),
(14,	10,	'luciasilva',	'v4f8fr56r58j5s12f1r4c',	'luciasilva@speedtecnoshop.com.br',	'Lucia da Silva',	'Lucia',	'S'),
(15,	10,	'carlosafonso',	'secreta',	'carlosafonso@gmail.com',	'Carlos Afonso da Silva',	'Carlos',	'S'),
(16,	10,	'luisavalenca',	'secreta',	'luisavalenca@gmail.com',	'Luisa Valenca da Silva',	'Luisa',	'S');

-- 2020-12-14 08:33:48
