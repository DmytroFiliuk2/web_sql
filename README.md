
## Getting Started

These instructions will get you a copy of the project up and running on your local machine . See deployment for notes on how to deploy the project on a live system.

### Prerequisites

What things you need to install the software and how to install them

```
PHP 7.2
RDBMS  MySQL 5.6 + 
```

### Installing

Copy files to your  PHP server 

Rename config.example  to  config.php

```
 /web_sql$ mv config.example config.php

```
Insert your options 

To seed db -> connect to the MySQL server using the mysql command-line client with the following command:  
```
shell> mysql -u root -p
```

Execute the books-schema.sql script to create the database structure by using the following command: 
### Warning books-schema.sql -  remove  existing db books and create new. If u use db with name  books make dump or 
### create another  mysql user.

```
mysql> SOURCE path/to/projectDir/web_sql/books-schema.sql;
```

Execute the books-data.sql script to populate the database structure with the following command: 
```
mysql> SOURCE path/to/projectDir/web_sql/books-data.sql.sql;
```


## Ready  

