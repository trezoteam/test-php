# Desafio para Vaga de Backend PHP

## Vem ser #TrezoTeam!
Nosso café está sempre fresquinho e ainda temos lanche a tarde! E sabemos que você tem muito a contribuir com a nossa equipe. ;)
Faça parte da nossa família #TrezoTeam!

## Sobre o Teste:

Desenvolver um sistema de **QUIZ**, utilizando apenas **PHP, Mysql ou PostgreSQL, HTML e CSS**.
A utilização de um **framework PHP** é bem vinda.
Requisitos do sistema:

* Utilizar bootstrap (apenas para não deixar o layout feio, mas a avaliação do layout não será premissa)
* O sistema terá um sistema administrativo para visualizar as respostas e cadastros de quiz.
* > Terá controle de login e senha (pode ser um login e senha fixo: trezo|senha)
* >> Deve-se informar login e senha para acesso administrativo no README.md
* > Terá o cadastro do QUIZ com: name, description, created_at, updated_at
* > Terá o cadastro das questões: subject, quiz_id, type, created_at, updated_at
* > Terá o cadastro das opções de respostas (quando o type for multipla escolha): answer, is_correct, question_id, created_at, updated_at
* > Terá visualização das respostas realizadas pelos usuários com o total de respostas, acertos e erros. (relatório)
* O sistema terá uma home pública com a listagem de todos os QUIZ cadastrados
* > Terá a página do QUIZ que todas as suas questões
* >> Para iniciar o QUIZ o usuário deve informar nome e e-mail
* > Ao iniciar o QUIZ, deverá ser registrado o horário de início do QUIZ
* > Ao finalizar o QUIZ, deverá ser registrado o horário fim do QUIZ
* > Terá que cadastrar cada resposta realizada pelo usuário (para poder visualizar em relatório administrativo)

* **O Sistema deverá ser hospedado e configurado em um servidor a sua escolha**
* Recomendamos hospedar na https://www.openshift.com/ que possui uma aplicação **FREE** a ser publicada
* Nos envie o link publicado


### Nossas espectativas:

Não esperamos que você faça tudo 100% ou que gaste dias para fazer o teste. Esperamos apenas um pouco de capricho pelo menos na lógica, funcionalidade (se há uma tela de cadastro, ela tem que funcionar), e organização do código.
Não se preocupe com o LAYOUT, será o item menos importante da avaliação, apenas sugerimos utilizar o bootstrap para que também não fique feio demais, porém o principal é avaliar a aptidão lógica para resolver o problema anunciado.
Na entrevista será questionado sobre as lógicas realizadas no sistema para reforçar o que foi desenvolvido.
Oriente no README.md sobre informações necessárias para rodar o sistema, como por exemplo:
* Rotas criadas
* Como importar ou fazer o SEED de dados/tabelas do banco de dados
* Login e senha do sistema admin ou como fazer para criar este acesso


### O que avaliaremos:

* Capricho no código
* Seguir as indicações de PSR-FIG, ao menos de formatação de código
* Se foi ou não utilizado algum Design Pattern
* Aptidão Lógica para resolver problemas
* Organização no código
* Codar em inglês!*


### Diferenciais:

* PHPDocs nos métodos e classes
* Melhores orientações ou explicações como foi construído a lógica do sistema
* Demonstrar no sistema algum conhecimento de API
* > Exemplo: Fazer com que o cadastro das respostas dos QUIZs aconteçam via API


Criatividade para novas funcionalidades, não descritas acima, valerão pontos. Sinta-se a vontade nesse quesito para fluir suas habilidades.

Para participar basta fazer um Fork desse repositório e dá-lhe, após a conclusão enviar um pull-request com suas informações adicionadas no arquivo **Candidato.md**.


Boa sorte!
