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
- Documentação via swagger (ver possibilidade)

# API
- Marcas
  - URL: ?api=brand Type: GET
  - URL: ?api=brand&id={brandId} Type: GET
  - URL: ?api=brand&id={brandId} Type: DELETE
  - URL: ?api=brand Type: POST JSON: {"code": "brand-test", "name": "Brand Test"}
  - URL: ?api=brand&id={brandId} Type: PUT JSON: {"code": "brand-test", "name": "Brand Test"}