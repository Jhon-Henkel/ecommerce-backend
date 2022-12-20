# *EndPoint's API Gift Card*
- ***GET***
    - **URL:** ?app=gift-card
- ***GET***
    - **URL:** ?app=gift-card&id={giftCardId}
- ***DELETE***
    - **URL:** ?app=gift-card&id={giftCardId}
- ***POST***
    - **URL:** ?app=gift-card
    - **Required Fields | Type:**
        - code | string
        - discountType | int
        - status | int
        - discount | int
        - maxUsages | int
    - **JSON:**
        ````
        {
            "code": "CUPOM10",
            "discountType": 1,
            "status": 1,
            "discount": 1045,
            "maxUsages": 99
        }
        ````
- ***PUT***
    - **URL:** ?app=gift-card&id={giftCardId}
    - **Required Fields | Type:**
        - code | string
        - discountType | int
        - status | int
        - discount | int
        - maxUsages | int
    - **JSON:**
        ````
        {
            "code": "CUPOM10",
            "discountType": 1,
            "status": 1,
            "discount": 1045,
            "maxUsages": 99
        }
        ````