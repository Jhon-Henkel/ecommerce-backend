# *EndPoint's API Carrinho e seus itens*
### *Carrinho*
- ***GET***
    - **URL:** ?app=cart
- ***GET***
    - **URL:** ?app=cart&id={cartId}
    - **Rules:**
        - retorna um objeto com os itens do carrinho, caso não exista o item ou esteja com o estoque zerado, retorna o id como chave do item com a mensagem de "out of stock".
- ***DELETE***
    - **URL:** ?app=cart&id={cartId}
    - **Rules:**
        - O item carrinho não pode ter pedido efetuado para poder ser deletado.
- ***POST***
    - **URL:** ?app=cart
    - **Rules:**
        - O cliente deve existir e é obrigatório para cadastrar carrinho.
        - O cartão presente é opcional, mas quando preenchido, deve ser válido, estando ativo e não ter atingido o máximo de utilizações.
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
    - **URL:** ?app=cart&id={cartId}
    - **Rules:**
        - O cartão presente é opcional, mas quando preenchido, deve ser válido, estando ativo e não ter atingido o máximo de utilizações.
        - O campo de order done deve ser preenchido com 0 ou 1 para ser válido.
    - **Required Fields | Type:**
      - orderDone | int (0 inativo, 1 ativo)
    - **JSON:**
        ````
        {
          "giftCardId": 2,
          "orderDone": 1
        }
        ````
### Item Carrinho
- ***GET***
    - **URL:** ?app=cart
- ***GET***
    - **URL:** ?app=cart&id={cartId}
- ***DELETE***
    - **URL:** ?app=cart&id={cartId}
    - **Rules:**
        - O item carrinho não pode ter pedido efetuado para poder ser deletado.
- ***POST***
    - **URL:** ?app=cart-item
    - **Rules:**
        - O carrinho e o estoque deve existir e é obrigatório para cadastrar o item no carrinho carrinho.
        - O estoque deve ter saldo para ser inserido.
        - O saldo inserido deve ser menor que o saldo em estoque.
        - O saldo do campo quantidade deve ser maior que zero.
    - **Required Fields | Type:**
        - cartId | int
        - stockId | int
        - quantity | int
    - **JSON:**
        ````
        {
          "cartId": 10,
          "stockId": 1,
          "quantity": 1
        }
        ````
- ***PUT***
    - **URL:** ?app=cart&id={cartId}
    - **Rules:**
        - O estoque deve ter saldo para ser inserido.
        - O saldo inserido deve ser menor que o saldo em estoque.
        - O saldo do campo quantidade deve ser maior que zero.
    - **Required Fields | Type:**
        - quantity | int
    - **JSON:**
        ````
        {
          "quantity": 1
        }
        ````