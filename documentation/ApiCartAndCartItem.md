# *EndPoint's API Carrinho e seus itens*
### *Carrinho*
- ***GET***
    - Apresentação comum mesmo, sem mostrar os itens, mas mostrando valor.
    - **URL:** ?app=cart
- ***GET***
    - Fazer a apresentação com os itens do carrinho e mostrando valor.
    - Se um item estiver fora de estoque, colocar um flag "outOfStock" = true
    - **URL:** ?app=cart&id={cartId}
- ***DELETE***
    - Fazer o delete de item antes de deletar o carrinho9
    - **URL:** ?app=cart&id={cartId}
- ***POST***
    - **URL:** ?app=cart
    - **Required Fields | Type:**
        - clientId | int
    - **JSON:**
        ````
        {
          "clientId": 2,
          "giftCardId": 5
        }
        ````
- ***PUT***
    - validar ainda como vai funcionar o PUT
    - **URL:** ?app=cart&id={cartId}
    - **Required Fields | Type:**
    - **JSON:**
        ````
        {
        }
        ````