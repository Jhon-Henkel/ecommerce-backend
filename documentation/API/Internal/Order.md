# *EndPoint's API Pedidos*
- ***POST***
    - **URL:** ?app=order
    - **Rules:**
        - O Cliente deve existir.
        - O endereço deve existir.
        - O id do carrinho deve existir e os itens do carrinho tem que ser válido. Sendo com saldo suficiente em estoque e cupom desconto válido.
        - O status deve ser um número inteiro (5 para ***pendente*** ou 6 para ***pago***).
        - Pode ser aplicado valores de taxas extras pelo parâmetro ***extraFareValue***, deve-se ser preenchido no tipo ***float***.
        - O valor do frete pode ser preenchido no parâmetro ***shippingValue***, deve-se ser preenchido no tipo ***float***.
        - O prazo do frete pode ser colocado em número de dias no parâmetro ***shippingDeadline***.
    - **Required Fields | Type:**
        - clientId | int
        - addressId | int
        - cartId | int
        - status | float
    - **JSON:**
        ````
        {
            "clientId": 1,
            "addressId": 1,
            "cartId": 10,
            "status": 5,
            "shippingValue": 15.00,
            "extraFareValue": 10.00,
            "shippingDeadline": 5
        }
        ````