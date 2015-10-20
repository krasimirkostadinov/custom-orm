# Custom ORM and CRUD module

__Description:__
Custom Object Relation Mapper (ORM) created with PHP classes and interfaces. Implemented CRUD module and class autoloader by PSR-4 specification. 


Project information:
-------------
  I build custom PHP API, using Bootstrap 3.0, jQuery, Ajax and PHP-PDO for secure database connection. Escape dangerous tags and possible XSS attack.
  
Requirements:
-------------
  You need to have PHP 5.4.0 (because of some syntax used)
  - array notation []
  

## Installation:

  1. Download project ZIP file or clone it via GIT with command:
  
  __HTTPS__
  ```
  git clone https://github.com/krasimirkostadinov/custom-orm.git
  ```
  
  __SSH__
  ```
  git clone git@github.com:krasimirkostadinov/custom-orm.git
  ```
  
  2. Create MySQL database at your setup.
  3. Import "db_init.sql" file from project root folder to your database. This is initial database with nessesary fields.
  4. Create specific host and enable it (depends on evironment). In my case this is www.custom-orm.dev at /var/www/html/custom-orm.dev
  5. Please setup your project settings in ./config.php file.
    !important config settings:
    - HOST_PATH - host path (also URL) to your local project. This variable is used for loading dynamic libraries and files.
  6. Set Database config files. I use separate DB class for connection at /models/Database.php. See $_cnf[] variable.
    - dbname - name your created database
    - username - user for database connection
    - password - user's password for database connection


Project preview:
----------------


Future improovements:
---------------------
1. Connect relational objects to current object instance.
2. Implement user interface forms, using CRUD module for objects. 
3. UI search field to search for objects with magic methods.
