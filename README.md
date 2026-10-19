## Endpoints

| URL | HTTP method | Auth | JSON Response |
| --- | --- | --- | --- |
| /users/login | POST | | user's token |
| /users | GET | Y | all users |
| /counties | GET | | all counties |
| /counties | POST | Y | new county added |
| /counties/{id} | GET | | county with the given id |
| /counties/{id} | PATCH | Y | edited county |
| /counties/{id} | DELETE | Y | id |
| /cities | GET | | all cities |
| /cities | POST | Y | new city added |
| /cities/{id} | GET | | city with the given id |
| /cities/{id} | PATCH | Y | edited city |
| /cities/{id} | DELETE | Y | id |
