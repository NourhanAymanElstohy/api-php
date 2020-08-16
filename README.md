# api-php

## Installation

### Prerequisites

You have to install php, mysql or mariadb, apache web server and configure it

### Cloneing

```
git clone https://github.com/NourhanAymanElstohy/api-php
cd api_php
```

### Database

```
create database employees_api;
use employees_api;
create table employees(id integer, name varchar(50), phone varchar(50), age integer, PRIMARY KEY (id));
```

### Postman

_To make GET Request, send get request to_

```
http://localhost/your_project_path/api/read.php
```

_To make POST Request_

- change method to POST
- add header content-type: application/json
- add a data to be post in body like

```
{
  "name":"john",
  "phone":"0100158821",
  "age":24
}
```

and make sure its json then send post request to

```
http://localhost/your_project_path/api/create.php
```

_To make a PUT or Update Request_

- change method to PUT
- add header content-type: application/json
- add a data to be post in body like

```
{
  "name":"john",
  "phone":"0100158821",
  "age":24
  "id":"1"
}
```

and make sure of

- the id is exist in your db.
- your data is json
  then send put request to

```
http://localhost/your_project_path/api/update.php
```

_To make a DELETE Request_

- change method to DELETE
- add header content-type: application/json
- add a data to be post in body like

```
{
  "id":"1"
}
```

and make sure of

- the id is exist in your db.
- your data is json
  then send put request to

```
http://localhost/your_project_path/api/delete.php
```
