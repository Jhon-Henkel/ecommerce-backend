# Ecommerce-clean-code
Plataforma de ecommerce feita com base no conceito clean code, clean architecture e TDD que estou vendo no curso do Rodrigo Branas.

# *Como iniciar o projeto*
Para iniciar asse projeto, basta executar os seguintes passos:
- Executar o ***composer update*** e o ***npm update*** dentro do container docker.
- Criar o banco de dados e as tabelas de acordo com o aquivo [SQL](https://github.com/Jhon-Henkel/ecommerce-clean-code/blob/main/alters/alters.sql).
- Alterar as configurações no arquivo ***config.php*** conforme for necessário.
---
# *Como rodar os testes*
- **Unitários:** composer run test-php-unit
- **Integração:** composer run test-php-feature
---
# *Bibliotecas Utilizadas*
- Kint
- Php Unit
- Jest
- Composer
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

---
## Documentações
- [Api publica de produtos e seus atributos](https://github.com/Jhon-Henkel/ecommerce-clean-code/blob/main/documentation/ApiProductAndAttributes.md)
---