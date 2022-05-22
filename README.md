# Obrigado por avaliar meu código!

Foram utilizados as linguagens PHP  com banco de dados em MySQL e ReactJS.

PHP 8.1.6
PHPUnit 9.5.20
MySql 8.0.29
React 18


# Pastas e configurações iniciais

giver/api => Código PHP
giver/front => Código React

Abrir os arquivos
1 -> front\givers2-front\src\serverConfig.js
2 -> api\model\connection\connection.php

No arquivo serverConfig.js, alterar a propriedade apiUrl para os dados do servidor PHP.

No arquivo connection.php, alterar para conexão com o seu banco de dados MySql.

Criar uma base dados e rodar os o script bkp_table_customer.sql que está na pasta raiz do projeto.



## Rodando a aplicação (front)

Acessar: givers2/front/givers2-front;

    npm install;
    npm start;


## Rodando os testes unitários (PHP)

Rodar o comando.

    "<path do phpunit>" --bootstrap <local_arquivos>\givers2\global.php  <local_arquivos>givers2\api\tests\controller\customers\CustomersControllerTest.php

Exemplo 

    "C:/bin/phpunit" --bootstrap D:\givers2\global.php  D:\givers2\api\tests\controller\customers\CustomersControllerTest.php
