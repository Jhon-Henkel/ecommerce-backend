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
- Delete de atributo terá que validar se o mesmo não está vinculado a algum produto.
- Validar quantidade de caracteres dos valores inseridos
- Validar se os campos obrigatórios não são nulos

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
    - Type: PUT 
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
    - Type: PUT 
        URL: ?api=size&id={sizeId} 
        JSON: {"code": "size-test", "name": "Size Test"}
### Produtos
    - Type: GET
        URL: ?api=product
    - Type: GET
        URL: ?api=product&id={productId}
    - Type: DELETE
        URL: ?api=product&id={productId}
    - Type: POST 
        URL: ?api=product
        JSON: {"code": "product-code", "name": "product-name", "description": "product-description", "categoryId": 1, "stock": [{"code": "stock-1", "name": "stock 1 name", "quantity": 10, "colorId": 1, "sizeId": 2, "brandId": 3, "price": 15.45, "width": 10, "height": 150, "length": 20, "grossWeight": 1600}, {"code": "stock-2", "name": "stock 2 name", "quantity": 5, "colorId": 2, "sizeId": 1, "brandId": 4, "price": 16.10, "width": 50, "height": 2, "length": 200, "grossWeight": 50}]}
    - Type: PUT
        URL: ?api=product&id={productId}
        JSON: {"code": "product-codeee", "name": "product-nameee", "description": "product-description", "categoryId": 1}
### Estoque
    - Type: GET
        URL: ?api=stock
    - Type: GET
        URL: ?api=stock&id={stockId}
    - Type: POST
        URL: ?api=stock
        JSON: {"code": "stock-122", "name": "stock 122 name", "quantity": 10, "colorId": 2, "sizeId": 3, "brandId": 3, "productId": 9, "price": 15.00, "width": 10, "height": 150, "length": 20, "grossWeight": 1600}
