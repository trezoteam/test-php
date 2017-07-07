Nome Completo: Guilherme Cervo

E-mail: guic91@gmail.com

Linkedin: https://www.linkedin.com/in/guilhermecervo/

Telefone: (51) 9 9548-3253

URL QUIZ: http://desenvolverweb.com.br/quiz

URL QUIZ/ADMIN: http://desenvolverweb.com.br/quiz/admin
	login: trezo
	password: trezoteam
	


Para o desenvolvimento do quiz, foi utilizado o framework php Codeigniter. 

Modificações
	Enviar a pasta quiz para o servidor
		Arquivo config
			caminho: quiz/application/config/config.php
			variável: $config['base_url'] = seudomino.com/quiz
			
		Arquivo log
			caminho quiz/application/config/config.php
			variável: $config['sess_save_path'] = Adicionar uma pasta do servidor com permissão de escrita. Ex: "/var/codeigniterSessions";

			
	Database
		caminho: quiz/application/config/config/config.php
			Alterar: hostname (geralmente localhost, caso a base esteja em outro servidor, utilizar o IP), username, password e database
			
			
Link dos Arquivos: 	https://github.com/guicervo/quiz-php		