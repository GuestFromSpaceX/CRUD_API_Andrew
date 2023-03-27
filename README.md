CRUD_API_Andrew
Задание от Андрея.
# Семён Ермолинский
1. Создал объект src/Entity/Book.php с атрибутами id | author | title 
2. Создал контроллеры для get, delete, getCollection, patch, post, put. src/Controller/Book...Controller.php

get collection instruction
curl http(s)://localhost:port/getcollectionbooks

post instruction
curl -X POST http://127.0.0.1:46045/addbook(space)
(space)-H 'Content-Type: application/json'((space))
((space))-d '{"author": "what u want to add","title": "what u want to add"}'

put instruction
curl -X PUT -H "Content-Type: application/json"
-d '{"author": "chenged Book author", "title": "chenged Book Title"}'
http://127.0.0.1:45635/updatebook/{id}
если не упомянуть атрибут, то он станет равным null

patch instruction
curl -X PATCH -H "Content-Type: application/json"
-d '{"author": "chenged Book author" !OR! "title": "chenged Book Title"}'
http://127.0.0.1:45635/patchbook/{id}
не пиши инвалидный айди, а то он сойдет с ума!!!

delete instruction
curl -X DELETE http://127.0.0.1:8000/deletebook/{id}

get instruction
curl http://127.0.0.1:45635/getbook/{id}
