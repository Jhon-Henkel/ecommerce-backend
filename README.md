# Ecommerce-clean-code
Plataforma de ecommerce feita com base no conceito clean code, clean architecture e TDD que estou vendo no curso do Rodrigo Branas.

# *Como iniciar o projeto*
Para iniciar asse projeto, basta executar os seguintes passos:
- Executar o ***composer update*** e o ***npm update*** dentro do container docker.
- Criar o banco de dados e as tabelas de acordo com o aquivo [SQL](https://github.com/Jhon-Henkel/ecommerce-clean-code/blob/main/alters/alters.sql).
- Alterar as configurações na pasta ***src/Configs*** conforme for necessário.
- Para rodar coverage, deve-se colocar o seguinte código (caso não tenha) no php.ini do container:
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
- **Coverage unitário:** composer run php-unit-coverage
- **Integração:** composer run php-feature
- **Coverage integração:** composer run php-feature-coverage
- **Atalho relatório coverage:** (Aqui)[http://localhost/tests/coverage/] 
---
# *Bibliotecas Utilizadas*
- Kint
- Php Unit
- Jest
- Composer
- GuzzleHttp
---
# Fazer
- Autenticação nas API's.
- apiIndex com paginação.
- Documentação API.
- Chave estrangeira na coluna de categoria pai.
- Delete de atributo terá que validar se o mesmo não está vinculado a algum produto.
- Validar quantidade de caracteres dos valores inseridos.
- Validar se os campos obrigatórios não são nulos.
- Colocar o 'criado em' e de 'atualizado em' nas tabelas de produtos e seus atributos.
- Salvar CPF no banco com formatação mesmo se vir sem formatação.

---
## Documentações
- [Api publica de produtos e seus atributos](https://github.com/Jhon-Henkel/ecommerce-clean-code/blob/main/documentation/ApiProductAndAttributes.md)
---