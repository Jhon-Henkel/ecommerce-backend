# *EndPoint's API Produtos e seus atributos*
### *Cliente*
- ***GET***
    - **URL:** ?api=client
- ***GET***
    - **URL:** ?api=client&id={clientId}
- ***DELETE***
    - **URL:** ?api=client&id={clientId}
- ***POST***
    - **URL:** ?api=client
    - **Required Fields | Type:**
    - **JSON:**
        ````
        {
            "name": "joaozinho teste",
            "documentType": 2,
            "document": "622.130.770-88",
            "mainPhone": "48996558877",
            "secondPhone": "4899645899",
            "email": "fulaninho@gmail.com",
            "birthDate": "1995-10-10 00:00:00",
            "password": "12345678",
            "address": {
                "street": "avenida fulano de tal",
                "zipCode": "88750-000",
                "number": "25",
                "district": "centro",
                "city": "cidade ciclano",
                "state": "santa catarina",
                "reference": "proximo ao mercado do vilmar"
            }
        }
        ````
- **PUT**
    - **URL:** ?api=client&id={clientId}
    - **Required Fields | Type:**
    - **JSON:**
        ````
        {
            "name": "joaozinho teste",
            "documentType": 2,
            "document": "622.130.770-88",
            "mainPhone": "48996558877",
            "secondPhone": "4899645899",
            "email": "fulaninho@gmail.com",
            "birthDate": "1995-10-10 00:00:00",
            "password": "12345678"
        }
        ````
### *Endereço*
- ***GET***
  - **URL:** ?api=address
- ***GET***
  - **URL:** ?api=address&id={addressId}
- ***DELETE***
  - **URL:** ?api=client&id={clientId}