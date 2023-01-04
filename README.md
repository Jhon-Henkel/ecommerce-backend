# Ecommerce-clean-code
Backend de uma plataforma de ecommerce feita com base no conceito clean code, clean architecture e TDD que estudei no curso do Rodrigo Branas.

O objetivo desse projeto é solidificar os conhecimentos adquiridos nos estudos do curso.
# *Como iniciar o projeto*
Para iniciar asse projeto, basta executar os seguintes passos:
- Executar o ***composer update*** e ***npm update*** dentro do container docker.
- Criar o banco de dados e as tabelas de acordo com o aquivo [SQL](https://github.com/Jhon-Henkel/ecommerce-clean-code/blob/main/alters/alters.sql).
- Alterar as configurações nos arquivos da pasta ***src/Configs*** conforme for necessário.
- Para rodar coverage, deve-se ter o php debug instalado (No Dockerfile ja está instalando) e colocar o seguinte código no php.ini do container:
    ````
    [XDEBUG]
    zend_extension="xdebug.so"
    xdebug.mode=coverage
    xdebug.client_host = 127.0.0.1
    xdebug.client_port = 9003
    xdebug.start_with_request=trigger
    ````
---
# *Como rodar os testes*
- **Unitários:** composer run php-unit
- **Integração:** composer run php-feature
- **Coverage:** composer run php-coverage
- **Atalho relatório coverage:** [Aqui](http://localhost/tests/coverage/)
---
# *Bibliotecas Utilizadas*
- Kint - Utilizado para debug no php. 
- Php Unit - Utilizado para testes unitários, testes de integração e relatório de coverage.
- Composer - Utilizado para instalar as bibliotecas mencionadas aqui.
- GuzzleHttp - Utilizado para as requisições http, no momento estou utilizando nos testes para garantir o funcionamento dos meus end-points da API.
---
## Documentações
- [API's](https://github.com/Jhon-Henkel/ecommerce-clean-code/blob/main/documentation/API)
---
# Upgrades Futuros
- Autenticação nas API's.
- apiIndex com paginação.
- Delete de atributo terá que validar se o mesmo não está vinculado a algum produto. (categoria e marca já estão ok)
- Validar quantidade de caracteres dos valores inseridos.
- Colocar o 'criado em' e de 'atualizado em' nas tabelas de produtos e seus atributos. (categoria e marca já estão ok)
- Salvar CPF no banco com formatação mesmo se vir sem formatação.
- Salvar telefones com formatação mesmo se vier sem formatação.
- Salvar cep com formatação mesmo se vier sem formatação.
- Ao deletar produto validar se não tem pedido vinculado. (categoria e marca já estão ok)
- Definir o preenchimento das dimensões e do peso como obrigatório no produto.
