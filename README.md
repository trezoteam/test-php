Para o desenvolvimento do projeto foi utilizado:

PHP 7
ZendFramework 3
Doctrine
AngularJS
Bootstap 3


Para que o quiz funcione primeiramente é necessário atualizar o composer, acesse a parta raiz do projeto com o composer instalado e execute o comando (composer update)
feito isso é necessário configurar uma conexão de banco de dados no zend e executar o comando no seu console.

./vendor/bin/doctrine-module orm:schema-tool:create (inicializa a estrutura do banco de dados)

Isso é necesário para gerar o banco de dados com o doctrine