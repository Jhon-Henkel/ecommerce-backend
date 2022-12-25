# *EndPoint's API Carrinho e seus itens*
### *Carrinho*
- ***GET***
    - **URL:** ?app=cart
- ***GET***
    - **URL:** ?app=cart&id={cartId}
    - **Rule:**
        - retorna um objeto com os itens do carrinho, caso não exista o item ou esteja com o estoque zerado, retorna o id como chave do item com a mensagem de "out of stock".
- ***DELETE***
    - **URL:** ?app=cart&id={cartId}
- ***POST***
    - **URL:** ?app=cart
    - **Rule:**
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
    - **Rule:**
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