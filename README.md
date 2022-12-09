# ecommerce-clean-code
Plataforma de ecommerce feita com base no conceito clean code, clean architecture e TDD

# Bibliotecas
- Kint
- phpunit
- jest
- composer

# Fazer
- Autenticação api
- apiIndex com paginação
- Documentação (ver possibilidade de usar swagger)
- Chave estrangeira na coluna de categoria pai
- Adequar api de marcas ao novo formato

# API
- Marcas
  - URL: ?api=brand Type: GET
  - URL: ?api=brand&id={brandId} Type: GET
  - URL: ?api=brand&id={brandId} Type: DELETE
  - URL: ?api=brand Type: POST JSON: {"code": "brand-test", "name": "Brand Test"}
  - URL: ?api=brand&id={brandId} Type: PUT JSON: {"code": "brand-test", "name": "Brand Test"}
- Categoria
  - URL: ?api=category  JSON: {"code": "category-test", "name": "Category Test"} OPTIONAL: {"fatherId": "2"}

# Fazer testes automatizados
- BrandDAO
- BrandController
- ProductController
- BrandBO
- Response
- Api marcas (feature de get, post, put, delete)
- CategoryController
- CategoryBO
- CategoryDAO
- CategoryDtoFactory
- BasicDAO
- BasicBO