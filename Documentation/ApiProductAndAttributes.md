# *EndPoint's API Produtos e seus atributos*
### *Marcas*
- ***GET***
    - **URL:** ?api=brand
- ***GET***
    - **URL:** ?api=brand&id={brandId}
- ***DELETE***
    - **URL:** ?api=brand&id={brandId}
- ***POST***
    - **URL:** ?api=brand
    - **Required Fields | Type:**
        - code | string
        - name | string
    - **JSON:**
        ````
        {
            "code": "brand-test",
            "name": "Brand Test"
        }
        ````
- **PUT**
    - **URL:** ?api=brand&id={brandId}
    - **Required Fields|Type:**
        - code | string
        - name | string
    - **JSON:**
        ````
        {
            "code": "brand-test", 
            "name": "Brand Test"
        }
        ````
---
### *Categorias*
- **GET**
    - **URL:** ?api=category
- **GET**
    - **URL:** ?api=category&id={categoryId}
- **DELETE**
    - **URL:** ?api=category&id={categoryId}
- **POST**
    - **URL:** ?api=category
    - **Required Fields:**
        - code | string
        - name | string
    - **Optional fields**
        - fatherId | int
    - **JSON:**
        ````
        {
            "code": "category-test", 
            "name": "Category Test",
            "fatherId": 2
        }
        ````
- **PUT**
    - **URL:** ?api=category&id={categoryId}
    - **Required Fields:**
        - code | string
        - name | string
    - **Optional Fields:**
        - fatherId | int
    - **JSON:**
        ````
        {
            "code": "category-test", 
            "name": "Category Test",
            "fatherId": 2
        }
        ````
---
### *Cores*
- **GET**
    - URL: ?api=color
- **GET**
    - URL: ?api=color&id={colorId}
- **DELETE**
    - URL: ?api=color&id={colorId}
- **POST**
    - **URL:** ?api=color
    - **Required Fields:**
        - code | string
        - name | string
    - **JSON:**
        ````
        {
            "code": "color-test", 
            "name": "Color Test"
        }
        ````
- **PUT**
    - **URL:** ?api=color&id={colorId}
    - **Required Fields:**
        - code | string
        - name | string
    - **JSON:**
        ````
        {
            "code": "color-test", 
            "name": "Color Test"
        }
        ````
---
### *Tamanhos*
- **GET**
    - **URL:** ?api=size
- **GET**
    - **URL:** ?api=size&id={sizeId}
- **DELETE**
    - **URL:** ?api=size&id={sizeId}
- **POST**
    - **URL:** ?api=size
    - **Required Fields:**
        - code | string
        - name | string
    - **JSON:**
        ````
        {
            "code": "size-test", 
            "name": "Size Test"
        }
        ````
- **PUT**
    - **URL:** ?api=size&id={sizeId}
    - **Required Fields|Type:**
        - code | string
        - name | string
    - **JSON:**
        ````
        {
            "code": "size-test", 
            "name": "Size Test"
        }
        ````
---
### *Produtos*
- **GET**
    - **URL:** ?api=product
- **GET**
    - **URL:** ?api=product&id={productId}
- **DELETE**
    - **URL:** ?api=product&id={productId}
- **POST**
    - **URL:** ?api=product
    - **Required Fields:**
        - code | string
        - name | string
        - categoryId | int
        - stock | array
    - **Optional Fields:**
        - description | string
    - **JSON:**
        ````
        {
            "code": "product-code", 
            "name": "product-name", 
            "description": "product-description", 
            "categoryId": 1, 
            "stock": [
                {
                    "code": "stock-1", 
                    "name": "stock 1 name", 
                    "quantity": 10, 
                    "colorId": 1, 
                    "sizeId": 2, 
                    "brandId": 3, 
                    "price": 15.45, 
                    "width": 10, 
                    "height": 150, 
                    "length": 20, 
                    "grossWeight": 1600
                }, 
                {
                    "code": "stock-2", 
                    "name": "stock 2 name", 
                    "quantity": 5, 
                    "colorId": 2, 
                    "sizeId": 1, 
                    "brandId": 4, 
                    "price": 16.10, 
                    "width": 50, 
                    "height": 2, 
                    "length": 200, 
                    "grossWeight": 50
                }
            ]
        }
        ````
- **PUT**
    - **URL:** ?api=product&id={productId}
    - **Required Fields:**
        - code | string
        - name | string
        - categoryId | int
    - **Optional Fields:**
        - description | string
    - **JSON:**
    ````
    {
        "code": "product-codee", 
        "name": "product-name", 
        "description": "product-description", 
        "categoryId": 1
    }
    ````
---
### *Estoques*
- **GET**
    - **URL:** ?api=stock
- **GET**
    - **URL:** ?api=stock&id={stockId}
- **DELETE**
    - **URL** ?api=stock&id={stockId}
- **POST**
    - **URL:** ?api=stock
    - **Required Fields:**
        - code | string
        - name | string
        - quantity | int
        - colorId | int
        - sizeId | int
        - brandId | int
        - productId | int
        - price | int
        - width | int
        - height | int
        - length | int
        - grossWeight | int
    - **JSON:**
        ````
        {
            "code": "stock-122", 
            "name": "stock 122 name", 
            "quantity": 10, 
            "colorId": 2, 
            "sizeId": 3, 
            "brandId": 3, 
            "productId": 9, 
            "price": 15.00, 
            "width": 10, 
            "height": 150, 
            "length": 20, 
            "grossWeight": 1600
        }
       ````
- **PUT**
    - **URL** ?api=stock&id={stockId}
    - **Required Fields:**
        - code | string
        - name | string
        - quantity | int
        - colorId | int
        - sizeId | int
        - brandId | int
        - productId | int
        - price | int
        - width | int
        - height | int
        - length | int
        - grossWeight | int
    - **JSON:**
        ````
        {
            "code": "stock-122", 
            "name": "stock 122 name", 
            "quantity": 10, 
            "colorId": 2, 
            "sizeId": 3, 
            "brandId": 3, 
            "productId": 9, 
            "price": 15.00, 
            "width": 10, 
            "height": 150, 
            "length": 20, 
            "grossWeight": 1600
        }
        ````  
