# *EndPoint's API Cliente e endereços*
### *Cliente*
- ***GET***
    - **URL:** ?app=client
- ***GET***
    - **URL:** ?app=client&id={clientId}
- ***DELETE***
    - **URL:** ?app=client&id={clientId}
- ***POST***
    - **URL:** ?app=client
    - **Required Fields | Type:**
      - name | string
      - documentType | int
      - document | string|int
      - email | string
      - birthDate | dateTime
      - password | string
      - address | object of address
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
- ***PUT***
    - **URL:** ?app=client&id={clientId}
    - **Required Fields | Type:**
      - name | string
      - documentType | int
      - document | string|int
      - email | string
      - birthDate | dateTime
      - password | string
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
  - **URL:** ?app=address
- ***GET***
  - **URL:** ?app=address&id={addressId}
- ***DELETE***
  - **URL:** ?app=address&id={addressId}
- ***POST***
  - **URL:** ?app=address
  - **Required Fields | Type:**
    - clientId | int
    - street | string
    - zipCode | string|int
    - district | string
    - city | string
    - state | string
  - **JSON:**
      ````
      {
        "clientId": 3,
        "street": "Avenida Brasil",
        "zipCode": "88750-000",
        "complement": "entregar no 6º andar",
        "number": 25,
        "district": "centro",
        "city": "cidade das estrelas",
        "state": "santa catarina",
        "reference": "proximo ao mercado do vilmar"
      }
      ````
- ***PUT***
  - **URL:** ?app=address&id={addressId}
  - **Required Fields | Type:**
    - clientId | int
    - street | string
    - zipCode | string|int
    - district | string
    - city | string
    - state | string
  - **JSON:**
      ````
      {
        "clientId": 3,
        "street": "Avenida Brasil",
        "zipCode": "88750-000",
        "complement": "entregar no 6º andar",
        "number": 25,
        "district": "centro",
        "city": "cidade das estrelas",
        "state": "santa catarina",
        "reference": "proximo ao mercado do vilmar"
      }
      ````