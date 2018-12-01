# PagueVeloz

Estou enviando um pull-request do teste em questão. Tenho algumas considerações à fazer, vamos lá:

1) Antes de começar o módulo, baixei o módulo "MageUp: Pagamento Interno Magento 2" para analisar a estrutura em que vocês trabalham. Percebi que não foi feito no padrão do Magento 2.2 com Gateways/Adapters e etc. Por isso, não me estendi à fazer nesso novo padrão. Até porque, como não temos nenhuma informações sigilosa (caso dos cartões de crédito), não foi preciso fazer algo tão complexo. Por esse mesmo motivo, também não incluí as interfaces, abstracts class e etc. Foi feito de uma forma mais simples, para melhor entendimento e agilidade de entrega ao cliente. Vale lembrar que, se o módulo realmente tivesse implementações mais complexas, seria feito tudo no padrão 2.2.

2) Não foi adicionado as class "Desconto" e "Split".

3) O campo "CPFCNPJSacado" foi preenchido pelo "customer:taxvar" (nativo do M2). Num projeto meu, eu iria de criar um campo específico para CPF/CPNJ e seria preenchido com o campo em questão.

4) O campo "SeuNumero" foi preenchido pelo "increment_id".

5) As parcelas, eu acredito que deva ter a opção do cliente escolher e deva ser criado um select no tela do checkout. Por enquanto, deixei fixo em "1".

6) O campo "Linha1" e "Linha2" eu iria criar um textarea no painel de controle do módulo, porém não pedia isso no teste. Então, deixei fixo com  "lorem ipsun".

7) O link do boleto está aparecendo nas telas: a) checkout_success b) my_orders c) email new_order d) adminhtml_order.

8) Foi desenvolvido com base no tema Luma. Não foi feito a parte HTML/CSS do módulo (alinhamento dos botões, troca de cor e etc).

O módulo está funcionando corretamente no momento do envio do pull-request. Se não conseguir instalar por algum motive, me comunique imediatamente.

Antes de acabar o teste, tomei a libedade de enviar os 2 últimos módulos que eu criei para a loja que estou desenvolvendo. Acho que será válido para uma melhor análise, segue: https://d.pr/f/1DkdJe .

No mais, é isso.

Fico no aguardo do retorno.