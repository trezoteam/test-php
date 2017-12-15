# Desafio para Vaga de Backend PHP

## Teste realizado utilizando o framework Yii2


## Sobre o Teste:

Todo o teste foi realizado em PHP, portanto algumas telas ficariam melhor com uso de Javascript.


* O SGBD utilizado foi o PostgreSQL, porém, toda a estrutura do Banco foi feita com Migrations.
Para utilizar Migrations, apenas o comando 'yii/migrate' é necessário
* Visualmente, como sugerido, foi utilizado somente Bootstrap nativo do Yii2
* Sobrescritas para URL's mais amigáveis realizadas(.htaccess) 
* O fluxo do sistema para o USUÁRIO funciona da seguinte forma:
* > Usuário escolhe um Quiz para respoder;
* > Fornece Nome e E-mail;
* > Reponde as perguntas(Múltipla Escolha ou Descursiva) e Envia;
* > Mensagem de conclusão do Quiz é exibida.
* O fluxo do sistema para o ADMIN funciona da seguinte forma:
* > Admin cria novo Quiz;
* > Uma tela com a possibilidade de inserir uma ou mais perguntas;
* > Após inserir as perguntas, poderá selecionar uma pergunta e realizar a criação das respostas(Múltipla Escolha)
* >> Para a área admin utilizar o Login: 'trezo' e Senha: '123456'
* >> Área admin disponivel em 'SEVER/trezo/admin'
* Uma API simples foi criada para exemplificação de exibição e cadastro de Informações:
* > Uma controller a parte foi criada para este propósito;
* > Apenas com autenticação via Bearer Token será possível realizar ações na API;
* > Informações de autenticação de API presente na Área ADmin do sistema;
* Apenas um relatório criado, visando abranger mais funcionalidades no sistema, como API

### Hospedagem
* Sistema está hospedado em: www.notarweb.com.br/trezo
* Área admin: www.notarweb.com.br/trezo/admin
* Servidor Ububtu 16.04, Apache 2.4, PHP 7.0

* Obrigado!
