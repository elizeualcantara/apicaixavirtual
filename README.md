## API Caixa Virtual

_______

A API Caixa Virtual, tem por objetivo auxiliar na gestão das movimentações diárias de caixa de uma empresa ou loja, com lançamentos de Entradas e Saídas, com atualização automática do Saldo do caixa, podendo gerenciar um ou mais caixas através da API.


Os recursos da API Caixa Virtual compreende funcionalidades referente:


- Categorias (de Entradas e Saídas)
- Usuários
- Formas de Pagamentos (a Credores)
- Formas de Receber (de Clientes)
- Contas a Pagar (de Credores ou Saídas)
- Contas a Receber (de Clientes ou Entradas)
- Movimentações de Entradas e Saídas
- Resumo Diário (Extrato com Saldo Atual e Movimentações do dia Atual, referente a Entrada e Saída na data corrente)

* * * * * * * * * * 

### AUTENTICAÇÃO POR TOKEN:

Informações sobre o acesso autorizado via API Caixa Virtual:
 
1. Cada Caixa tem acesso protegido usando a API através do uso de Token, que dá a permissão de acesso somente aos dados individuais do seu respectivo Caixa.

2. Para uso da API , é necessário a Autorização do tipo "Bearer Token", usando os dados para Autenticacao Token JWT:

- [x] $header = [ 'alg' => 'HS256', 'typ' => 'JWT' ]; 
- [x] $payload = [ 'iss' => 'http://elizeu.com.br', 'name' => 'NomeEmpresa', 'email' => 'elizeu@elizeu.com.br' ]; 
- [x] $senha_api_loja_10 = "ewrx0865720i12e7pies92g4yiim4p";

3. Documentação para a geração de Token JWT se encontra no arquivo geracao_token.txt

4. Exemplo do Token JWT para uso para API de Acesso a Caixa 10, para uso via API no Header Authorization: 
###### eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJodHRwOlwvXC9lbGl6ZXUuY29tLmJyIiwibmFtZSI6IlRlY25vU3BlZWQiLCJlbWFpbCI6ImVsaXpldUBlbGl6ZXUuY29tLmJyIn0=.aKF5hOMEJbdAwaxEKLBxEK6dTKbbkcUMcOj1NwW+0Lw=

* * * * * * * * * * 

### DOCUMENTAÇÃO

Toda documentação da API Caixa Virtual está disponível no Postman, através do link:
https://documenter.getpostman.com/view/13763433/TVsoHVxt

* * * * * * * * * * 

### INSTALAÇÃO:

1. Baixar via GIT: git clone https://github.com/elizeualcantara/apicaixavirtual.git
2. Ambiente com Apache , Mysql e PHP 5.6 ou superior
3. Rodar o arquivo Banco.sql para criar a estrutura do banco de dados, e o arquivo Dados.sql para dados de exemplo 
4. Acessar o Server Local, via caminho http://localhost:8080/ [pasta] /api/resumo , para testes e ler a documentação.

* * * * * * * * * * 

### ALGUNS EXEMPLOS PARA CONSULTAS E LISTAGENS PRINCIPAIS 
###### (Veja toda as opções na documentação https://documenter.getpostman.com/view/13763433/TVsoHVxt ) :

Ver Resumo e Saldo Atual:
http://localhost:8080/rest/api/resumo

Listar Categorias
http://localhost:8080/rest/api/categoria

Listar Usuario da Loja
http://localhost:8080/rest/api/usuario

Listar Caixas da Loja
http://localhost:8080/rest/api/caixa

Listar Movimentacoes (Lançamentos de Entrada e Saída)
http://localhost:8080/rest/api/movimentacao

Listar Formas de Pagamento
http://localhost:8080/rest/api/formapgto

Listar Formas de Recebimento
http://localhost:8080/rest/api/formarecebimento

Listar Contas a Pagar
http://localhost:8080/rest/api/contapagar

Listar Contas a Receber
http://localhost:8080/rest/api/contareceber


Consultar Categoria Específica:
http://localhost:8080/rest/api/categoria/10

Consultar Usuario Específico:
http://localhost:8080/rest/api/usuario/10

Consultar Caixa Específico:
http://localhost:8080/rest/api/caixa/10

Consultar Movimentação Específica:
http://localhost:8080/rest/api/movimentacao/10

Consultar Forma de Pagamento Específica:
http://localhost:8080/rest/api/formapgto/10

Consultar Forma de Recebimento Específica:
http://localhost:8080/rest/api/formarecebimento/10

Consultar Conta a Pagar Específica:
http://localhost:8080/rest/api/contapagar/10

Consultar Conta a Receber Específica:
http://localhost:8080/rest/api/contareceber/10





