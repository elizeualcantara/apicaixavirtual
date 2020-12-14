
SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `caixa`;
CREATE TABLE `caixa` (
  `caixa_id` int(10) NOT NULL AUTO_INCREMENT,
  `caixa_identificacao` varchar(100) DEFAULT NULL,
  `caixa_localizacao` varchar(100) DEFAULT NULL,
  `caixa_tecnologia` varchar(50) DEFAULT NULL,
  `caixa_versao_aplicacao` varchar(10) DEFAULT NULL,
  `caixa_data_inicio_movimentacao` date DEFAULT NULL,
  `caixa_valor_inicio_movimentacao` decimal(12,2) DEFAULT 0.00,
  `caixa_observacao` varchar(200) DEFAULT NULL,
  `caixa_emissao_razao_social` varchar(100) DEFAULT NULL,
  `caixa_emissao_cnpj` varchar(18) DEFAULT NULL,
  `caixa_emissao_inscricao_estadual` varchar(14) DEFAULT NULL,
  `caixa_emissao_inscricao_municipal` varchar(20) DEFAULT NULL,
  `caixa_contato_suporte` varchar(30) DEFAULT NULL,
  `caixa_telefone_suporte` varchar(20) DEFAULT NULL,
  `caixa_email_suporte` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`caixa_id`),
  UNIQUE KEY `uc_caixa_identificacao_caixa_localizacao` (`caixa_identificacao`,`caixa_localizacao`),
  KEY `ix_caixa_identificacao` (`caixa_identificacao`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 COMMENT='caixas';


DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `categoria_id` int(10) NOT NULL AUTO_INCREMENT,
  `categoria_movimentacao` varchar(40) NOT NULL,
  `categoria_flag_entrada_saida` char(1) NOT NULL,
  `categoria_flag_atualiza_saldo` char(1) DEFAULT 'S',
  `categoria_flag_ativo` char(1) DEFAULT 'S',
  PRIMARY KEY (`categoria_id`),
  UNIQUE KEY `uc_categoria_movimentacao` (`categoria_movimentacao`),
  KEY `ix_categoria_flag_ativo` (`categoria_flag_ativo`,`categoria_id`),
  KEY `ix_categoria_flag_entrada_saida` (`categoria_flag_entrada_saida`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1 COMMENT='categorias de movimentacoes';


DROP TABLE IF EXISTS `conta`;
CREATE TABLE `conta` (
  `conta_id` int(10) NOT NULL AUTO_INCREMENT,
  `conta_caixa_id` int(11) NOT NULL DEFAULT 0,
  `conta_numero_banco` char(3) NOT NULL,
  `conta_nome_banco` varchar(15) NOT NULL,
  `conta_numero_agencia` varchar(6) NOT NULL DEFAULT '0',
  `conta_digito_verificador_agencia` int(1) NOT NULL DEFAULT 0,
  `conta_numero_conta` varchar(10) NOT NULL,
  `conta_digito_verificador_conta` int(1) NOT NULL,
  `conta_valor_saldo_atual` decimal(12,2) NOT NULL DEFAULT 0.00,
  `conta_data_atual` date DEFAULT NULL,
  `conta_valor_saldo_data_anterior` decimal(12,2) DEFAULT 0.00,
  `conta_data_anterior` date DEFAULT NULL,
  `conta_valor_aplicado` decimal(12,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`conta_id`),
  KEY `ix_conta_caixa_id` (`conta_caixa_id`),
  CONSTRAINT `FK_conta_caixa_id` FOREIGN KEY (`conta_caixa_id`) REFERENCES `caixa` (`caixa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COMMENT='contas bancárias';


DROP TABLE IF EXISTS `contapagar`;
CREATE TABLE `contapagar` (
  `contapagar_id` int(10) NOT NULL AUTO_INCREMENT,
  `contapagar_formapgto_id` int(10) NOT NULL,
  `contapagar_conta_id` int(10) NOT NULL,
  `contapagar_categoria_id` int(10) NOT NULL,
  `contapagar_caixa_id` int(11) NOT NULL DEFAULT 0,
  `contapagar_nome_credor` varchar(50) DEFAULT NULL,
  `contapagar_descricao` varchar(250) DEFAULT NULL,
  `contapagar_numero_duplicata` varchar(15) DEFAULT NULL,
  `contapagar_numero_documento` varchar(15) DEFAULT NULL,
  `contapagar_data_emissao` date NOT NULL,
  `contapagar_data_vencimento` date NOT NULL,
  `contapagar_data_pagamento` date DEFAULT NULL,
  `contapagar_valor_duplicata` decimal(12,2) NOT NULL DEFAULT 0.00,
  `contapagar_valor_juros` decimal(12,2) NOT NULL DEFAULT 0.00,
  `contapagar_valor_desconto` decimal(12,2) NOT NULL DEFAULT 0.00,
  `contapagar_valor_total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `contapagar_observacao` varchar(50) DEFAULT NULL,
  `contapagar_nome_banco` varchar(10) DEFAULT NULL,
  `contapagar_numero_agencia` varchar(6) DEFAULT NULL,
  `contapagar_numero_conta` varchar(10) DEFAULT NULL,
  `contapagar_data_lancamento` date DEFAULT NULL,
  `contapagar_numero_nota_fiscal` varchar(12) DEFAULT NULL,
  `contapagar_numero_parcela` varchar(3) DEFAULT '0',
  `contapagar_nosso_numero` varchar(12) DEFAULT NULL,
  `contapagar_obs_mudanca_vencimento` text DEFAULT NULL,
  `contapagar_flag_cancelada` char(1) DEFAULT 'N',
  `contapagar_flag_estorno_devolucao` char(1) DEFAULT 'N',
  PRIMARY KEY (`contapagar_id`),
  KEY `ix_contapagar_categoria_id` (`contapagar_categoria_id`),
  KEY `ix_contapagar_conta_id` (`contapagar_conta_id`),
  KEY `ix_contapagar_caixa_id` (`contapagar_caixa_id`),
  KEY `ix_contapagar_data_vencimento_caixa` (`contapagar_caixa_id`,`contapagar_data_vencimento`),
  KEY `ix_contapagar_data_pagamento_caixa` (`contapagar_caixa_id`,`contapagar_data_pagamento`),
  KEY `ix_contapagar_formapgto_id` (`contapagar_formapgto_id`),
  CONSTRAINT `fk_contapagar_caixa_id` FOREIGN KEY (`contapagar_caixa_id`) REFERENCES `caixa` (`caixa_id`),
  CONSTRAINT `fk_contapagar_categoria_id` FOREIGN KEY (`contapagar_categoria_id`) REFERENCES `categoria` (`categoria_id`),
  CONSTRAINT `fk_contapagar_conta_id` FOREIGN KEY (`contapagar_conta_id`) REFERENCES `conta` (`conta_id`),
  CONSTRAINT `fk_contapagar_formapgto_id` FOREIGN KEY (`contapagar_formapgto_id`) REFERENCES `formapgto` (`formapgto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1 COMMENT='contas a pagar';


DELIMITER ;;

CREATE TRIGGER `contapagar_valor_total_Alteracao` AFTER UPDATE ON `contapagar` FOR EACH ROW
BEGIN

   IF !(NEW.contapagar_valor_total <=> OLD.contapagar_valor_total) THEN

		  update movimentacao 
		  set movimentacao_valor_lancamento= NEW.contapagar_valor_total * -1
		  WHERE movimentacao_contapagar_id=NEW.contapagar_id; 
  
   END IF;
   
END;;

DELIMITER ;

DROP TABLE IF EXISTS `contareceber`;
CREATE TABLE `contareceber` (
  `contareceber_id` int(10) NOT NULL AUTO_INCREMENT,
  `contareceber_formarecebimento_id` int(10) NOT NULL,
  `contareceber_conta_id` int(10) NOT NULL,
  `contareceber_categoria_id` int(10) NOT NULL,
  `contareceber_caixa_id` int(11) NOT NULL DEFAULT 0,
  `contareceber_nome_cliente` varchar(50) NOT NULL,
  `contareceber_descricao` varchar(200) DEFAULT NULL,
  `contareceber_numero_duplicata` varchar(15) NOT NULL,
  `contareceber_numero_documento` varchar(15) NOT NULL,
  `contareceber_data_emissao` date NOT NULL,
  `contareceber_data_vencimento` date NOT NULL,
  `contareceber_data_recebimento` date DEFAULT NULL,
  `contareceber_valor_duplicata` decimal(12,2) NOT NULL DEFAULT 0.00,
  `contareceber_valor_juros` decimal(12,2) NOT NULL DEFAULT 0.00,
  `contareceber_valor_desconto` decimal(12,2) NOT NULL DEFAULT 0.00,
  `contareceber_valor_total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `contareceber_observacao` varchar(150) DEFAULT NULL,
  `contareceber_data_lancamento` date DEFAULT NULL,
  `contareceber_numero_nota_fiscal` varchar(12) DEFAULT NULL,
  `contareceber_numero_parcela` tinyint(4) DEFAULT 0,
  `contareceber_nosso_numero` varchar(20) DEFAULT NULL,
  `contareceber_data_mudanca_vencimento` date DEFAULT NULL,
  `contareceber_obs_mudanca_vencimento` text DEFAULT NULL,
  `contareceber_flag_cancelada` char(1) DEFAULT 'N',
  `contareceber_flag_estorno_devolucao` char(1) DEFAULT 'N',
  PRIMARY KEY (`contareceber_id`),
  KEY `ix_contareceber_categoria_id` (`contareceber_categoria_id`),
  KEY `ix_contareceber_conta_id` (`contareceber_conta_id`),
  KEY `ix_contareceber_caixa_id` (`contareceber_caixa_id`),
  KEY `ix_contareceber_data_vencimento_caixa` (`contareceber_caixa_id`,`contareceber_data_vencimento`),
  KEY `ix_contareceber_data_recebimento_caixa` (`contareceber_caixa_id`,`contareceber_data_recebimento`),
  KEY `ix_contareceber_formarecebimento_id` (`contareceber_formarecebimento_id`),
  CONSTRAINT `fk_contareceber_caixa_id` FOREIGN KEY (`contareceber_caixa_id`) REFERENCES `caixa` (`caixa_id`),
  CONSTRAINT `fk_contareceber_categoria_id` FOREIGN KEY (`contareceber_categoria_id`) REFERENCES `categoria` (`categoria_id`),
  CONSTRAINT `fk_contareceber_conta_id` FOREIGN KEY (`contareceber_conta_id`) REFERENCES `conta` (`conta_id`),
  CONSTRAINT `fk_contareceber_formarecebimento_id` FOREIGN KEY (`contareceber_formarecebimento_id`) REFERENCES `formarecebimento` (`formarecebimento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 COMMENT='contas a receber';


DELIMITER ;;

CREATE TRIGGER `contareceber_valor_total_Alteracao` AFTER UPDATE ON `contareceber` FOR EACH ROW
BEGIN

   IF !(NEW.contareceber_valor_total <=> OLD.contareceber_valor_total) THEN

		  update movimentacao 
		  set movimentacao_valor_lancamento= NEW.contareceber_valor_total 
		  WHERE movimentacao_contareceber_id=NEW.contareceber_id; 
  
   END IF;
   
END;;

DELIMITER ;

DROP TABLE IF EXISTS `formapgto`;
CREATE TABLE `formapgto` (
  `formapgto_id` int(10) NOT NULL AUTO_INCREMENT,
  `formapgto_descricao` varchar(20) NOT NULL,
  PRIMARY KEY (`formapgto_id`),
  UNIQUE KEY `uc_formapgto_descricao` (`formapgto_descricao`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COMMENT='forma de pagamentos para contas a receber';


DROP TABLE IF EXISTS `formarecebimento`;
CREATE TABLE `formarecebimento` (
  `formarecebimento_id` int(10) NOT NULL AUTO_INCREMENT,
  `formarecebimento_descricao` varchar(20) NOT NULL,
  PRIMARY KEY (`formarecebimento_id`),
  UNIQUE KEY `uc_formarecebimento_descricao` (`formarecebimento_descricao`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COMMENT='forma de recebimento para contas a receber';


DROP TABLE IF EXISTS `movimentacao`;
CREATE TABLE `movimentacao` (
  `movimentacao_id` int(10) NOT NULL AUTO_INCREMENT,
  `movimentacao_contareceber_id` int(10) NOT NULL,
  `movimentacao_contapagar_id` int(10) NOT NULL,
  `movimentacao_conta_id` int(10) NOT NULL,
  `movimentacao_caixa_id` int(10) NOT NULL DEFAULT 0,
  `movimentacao_data_lancamento` date DEFAULT NULL,
  `movimentacao_valor_lancamento` decimal(12,2) NOT NULL,
  `movimentacao_referente` varchar(250) NOT NULL,
  `movimentacao_flag_estorno` enum('S','N') DEFAULT 'N',
  `movimentacao_observacao` text DEFAULT NULL,
  `movimentacao_obs_estorno` text DEFAULT NULL,
  PRIMARY KEY (`movimentacao_id`),
  KEY `ix_movimentacao_conta_id` (`movimentacao_conta_id`),
  KEY `ix_movimentacao_caixa_id` (`movimentacao_caixa_id`),
  KEY `ix_movimentacao_contapagar_id` (`movimentacao_contapagar_id`),
  KEY `ix_movimentacao_contareceber_id` (`movimentacao_contareceber_id`),
  KEY `ix_movimentacao_data_movimentacao_caixa` (`movimentacao_data_lancamento`,`movimentacao_caixa_id`),
  CONSTRAINT `fk_movimentacao_caixa_id` FOREIGN KEY (`movimentacao_caixa_id`) REFERENCES `caixa` (`caixa_id`),
  CONSTRAINT `fk_movimentacao_conta_id` FOREIGN KEY (`movimentacao_conta_id`) REFERENCES `conta` (`conta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1 COMMENT='movimentacoes de entrada e saida';


DELIMITER ;;

CREATE TRIGGER `Movimentacao_Atualiza_Saldo_Conta_Entrada` BEFORE INSERT ON `movimentacao` FOR EACH ROW
BEGIN
  update Conta set conta_valor_saldo_atual=conta_valor_saldo_atual+NEW.movimentacao_valor_lancamento WHERE conta_id=NEW.movimentacao_conta_id; 
END;;

CREATE TRIGGER `Movimentacao_Atualiza_Saldo_Conta_Alteracao` AFTER UPDATE ON `movimentacao` FOR EACH ROW
BEGIN

   IF !(NEW.movimentacao_valor_lancamento <=> OLD.movimentacao_valor_lancamento) THEN

		  update conta
		  set conta_valor_saldo_atual=conta_valor_saldo_atual - OLD.movimentacao_valor_lancamento
		  WHERE conta_id = OLD.movimentacao_conta_id; 

		  update conta 
		  set conta_valor_saldo_atual=conta_valor_saldo_atual+NEW.movimentacao_valor_lancamento 
		  WHERE conta_id=NEW.movimentacao_conta_id; 
  
   END IF;
   
END;;

CREATE TRIGGER `Movimentacao_Atualiza_Saldo_Conta_Saida` BEFORE DELETE ON `movimentacao` FOR EACH ROW
BEGIN
  update conta
  set conta_valor_saldo_atual=conta_valor_saldo_atual - OLD.movimentacao_valor_lancamento
  WHERE conta_id = OLD.movimentacao_conta_id; 
END;;

DELIMITER ;

DROP TABLE IF EXISTS `parcelareceber`;
CREATE TABLE `parcelareceber` (
  `parcelareceber_id` int(11) NOT NULL AUTO_INCREMENT,
  `parcelareceber_contareceber_id` int(11) NOT NULL DEFAULT 0,
  `parcelareceber_formapgto_id` int(10) NOT NULL,
  `parcelareceber_numero_parcela` tinyint(4) unsigned DEFAULT NULL,
  `parcelareceber_prazos_dias` smallint(6) DEFAULT 0,
  `parcelareceber_data_vencimento` date DEFAULT NULL,
  `parcelareceber_valor_parcela` decimal(12,2) DEFAULT 0.00,
  PRIMARY KEY (`parcelareceber_id`),
  KEY `ix_parcelareceber_formapgto_id` (`parcelareceber_formapgto_id`),
  KEY `ix_parcelareceber_contareceber_id` (`parcelareceber_contareceber_id`),
  CONSTRAINT `fk_parcelareceber_contareceber_id` FOREIGN KEY (`parcelareceber_contareceber_id`) REFERENCES `contareceber` (`contareceber_id`),
  CONSTRAINT `fk_parcelareceber_formapgto_id` FOREIGN KEY (`parcelareceber_formapgto_id`) REFERENCES `formapgto` (`formapgto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='parcelas de cobranca a receber';


DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `usuario_id` int(10) NOT NULL AUTO_INCREMENT,
  `usuario_caixa_id` int(10) DEFAULT NULL,
  `usuario_login` varchar(30) DEFAULT NULL,
  `usuario_senha` varchar(50) DEFAULT NULL,
  `usuario_email` varchar(40) DEFAULT NULL,
  `usuario_nome` varchar(100) DEFAULT NULL,
  `usuario_primeiro_nome` varchar(20) DEFAULT NULL,
  `usuario_ativo` char(1) DEFAULT 'S',
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `uc_usuario_login` (`usuario_login`),
  KEY `ix_usuario_caixa_id` (`usuario_caixa_id`),
  KEY `ix_usuario_primeiro_nome` (`usuario_primeiro_nome`),
  KEY `ix_usuario_login` (`usuario_login`),
  CONSTRAINT `fk_usuario_caixa_id` FOREIGN KEY (`usuario_caixa_id`) REFERENCES `caixa` (`caixa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 COMMENT='usuarios do caixa';


-- 2020-12-14 08:33:06
