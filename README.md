# ecommerce-clean-code
Plataforma de ecommerce feita com base no conceito clean code, clean architecture e TDD

# Bibliotecas
- Kint
- Php Unit
- Jest
- Composer

# Fazer
- Autenticação api
- apiIndex com paginação
- Documentação (ver possibilidade de usar swagger)
- Chave estrangeira na coluna de categoria pai

---
# EndPoint's API
### Marcas
    - Type: GET 
        URL: ?api=brand
    - Type: GET 
        URL: ?api=brand&id={brandId} 
    - Type: DELETE 
        URL: ?api=brand&id={brandId} 
    - Type: POST 
        URL: ?api=brand 
        JSON: {"code": "brand-test", "name": "Brand Test"}
    - Type: PUT 
        URL: ?api=brand&id={brandId} 
        JSON: {"code": "brand-test", "name": "Brand Test"}
### Categorias
    - Type: GET 
        URL: ?api=category
    - Type: GET 
        URL: ?api=category&id={categoryId}
    - Type: DELETE 
        URL: ?api=category&id={categoryId} 
    - Type: POST 
        URL: ?api=category 
        JSON: {"code": "category-test", "name": "Category Test"} OPTIONAL: {"fatherId": "2"}
    - Type: PUT 
        URL: ?api=category&id={categoryId} 
        JSON: {"code": "category-test", "name": "Category Test"} OPTIONAL: {"fatherId": "2"}
### Cores
    - Type: GET 
        URL: ?api=color
    - Type: GET 
        URL: ?api=color&id={colorId}
    - Type: DELETE 
        URL: ?api=color&id={colorId}
    - Type: POST 
        URL: ?api=color 
        JSON: {"code": "color-test", "name": "Color Test"}
    - Type: POST 
        URL: ?api=color&id={colorId}
        JSON: {"code": "color-test", "name": "Color Test"}
### Tamanhos
    - Type: GET 
        URL: ?api=size
    - Type: GET 
        URL: ?api=size&id={sizeId}
    - Type: DELETE 
        URL: ?api=size&id={sizeId}
    - Type: POST 
        URL: ?api=size 
        JSON: {"code": "size-test", "name": "Size Test"}
    - Type: POST 
        URL: ?api=size&id={sizeId} 
        JSON: {"code": "size-test", "name": "Size Test"}

---
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
- BasicController
- ColorController
- ColorBO
- ColorDAO
- ColorDtoFactory
- BasicDtoFactory
- SizeBO
- SizeController
- SizeDAO
- SizeDtoFactory