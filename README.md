List Equipment
-------------
http://127.0.0.1:8000/api/v1/equipments -  get all equipments
http://127.0.0.1:8000/api/v1/equipments/iPhone -  it will search in name, category, number and description fields for match
equipment_list:
    path: /api/v1/equipments/{search}
    methods: [GET]
    defaults:  { _controller: App\Controller\EquipmentController:indexAction, search: 1 }
    requirements:
        search: '^[a-zA-Z0-9_.-]*$'
		
Create Equipment
-------------	
http://127.0.0.1:8000/api/v1/equipments
Request:
{
	"name":"Iphone",
	"category":"phone",
	"number":"9876543210",
	"description":"Its expensive phone to use"
}

Response
Status: 200
{
    "id": 1,
    "name": "Iphone",
    "category": "phone",
    "number": "9876543210",
    "description": "Its expensive phone to use",
    "createdAt": "2023-01-24T08:35:10+00:00",
    "updatedAt": "2023-01-24T08:35:10+00:00"
}
equipment_create:
    path: /api/v1/equipments
    controller: App\Controller\EquipmentController:createAction
    methods: [POST]
	

Update Equipment
----------------
http://127.0.0.1:8000/api/v1/equipments/1/update
Request:
{
	"name":"Iphone 13",
	"category":"phone mobile",
	"number":"9876543211",
	"description":"Its expensive phone to use !!!!"
}

Response
Status: 200
{
    "id": 1,
    "name": "Iphone 13",
    "category": "phone mobile",
    "number": "9876543211",
    "description": "Its expensive phone to use !!!!",
    "createdAt": "2023-01-24T08:40:50+00:00",
    "updatedAt": "2023-01-24T14:11:34+00:00"
}
equipment_update:
    path: /api/v1/equipments/{equipmentId}/update
    controller: App\Controller\EquipmentController:updateAction
    methods: [PATCH]
    requirements:
        equipmentId: '\d+'
		
Delete Equipment
-----------------
http://127.0.0.1:8000/api/v1/equipments/6/delete
equipment_delete:
  path: /api/v1/equipments/{equipmentId}/delete
  controller: App\Controller\EquipmentController:deleteAction
  methods: [DELETE]
  requirements:
    equipmentId: '\d+'
	
	
For Unit Test
---------------
comopser.json update
 "scripts": {
	....
	"test": [
            "C:/bin/phpunit"
        ]
 }
	
Run this command:
composer test
