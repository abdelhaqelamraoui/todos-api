# todos-api
A simple API for todos in order to test HTTP verbs

Abdelhaq EL AMRAOUi

12/12/2023

---

### App requirements:
- create a database
- edit the database configs in [Config](app/Configs/Config.php)


### Supported HTTP requests
   1. GET
   1. POST
   1. PUST
   1. DELETE
   1. PATCH

### API URLs
- http://localhost/todos-api/index.php/todos
- http://localhost/todos-api/index.php/todos/7
- http://localhost/todos-api/index.php/todos?userId=27



| URL | Method | Use |
| --- | --- | --- |
| http://localhost/todos-api/index.php/todos | GET | get all todos |
| http://localhost/todos-api/index.php/todos | POST | create new todo |
| http://localhost/todos-api/index.php/todos?userId=3 | GET | get todo with userId = 3 |
| http://localhost/todos-api/index.php/todos/7 | GET | get todo with id = 7 |
| http://localhost/todos-api/index.php/todos/7 | PUT | update title __and__ completed of a todo with id = 7 |
| http://localhost/todos-api/index.php/todos/7 | PATCH | edit title __or__ completed of a todo with id = 7 |
