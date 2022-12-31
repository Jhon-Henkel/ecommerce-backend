# *EndPoint's API cálculo de frete*
- ***GET***
    - **URL:** ?app=calculate-shipping&type={type}&id={id do estoque ou do carrinho}&zip-code={CEP de destino}
    - **Rules:**
      - O id co carrinho ou do estoque deve existir.
      - O CEP deve ser válido.
      - O parâmetro ***type*** deve ser do tipo válido.
        - 5 para carrinho
        - 6 para estoque