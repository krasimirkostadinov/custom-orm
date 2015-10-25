# Custom ORM and CRUD module

__Description:__
Custom Object Relation Mapper (ORM) created with PHP classes and interfaces. Implemented CRUD module and class autoloader by PSR-4 specification. Include normalised database to 3th level and created tables with relations. Every table has their own PHP Entity class. Object properties are mapped with table columns. CRUD module impelement functionality trought Entiti object. Save method update/save and validate inserted data.  

**Review database model from: ./database_EER_model.mwb with MySQL Workbench**


__ORM module include methods:__
 - find() / findAll() -> realise search entity functionality. Support optional parameters for sorting resultset, rows LIMIT, orders etc. 
    - Example: $result = $employers->findAll([], '*', 'employee_name DESC');
 - save() / delete() method
 - findBy*Criteria*And*Criteria* - dynamic search filter for entity. See example file. 
    - Example:  $result = $employers->findByCountry_IdAndCity_id(4, 2);
 - validate input data from Help Class: validate "not empty", int value, valid date, is string, calculate order total price - it's agregated value, convert ip address, validate percent amounth and etc/

**Review all examples are in ./views/test_classes.php**


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
1. Tab "Companies" list all registered companies to CRM
  ![alt tag](/docs/tab-companies.png?raw=true "Tab companies")

2. Tab "Employers" list all employers related to Companty
  ![alt tag](/docs/tab-employers.png?raw=true "Tab employers")

3. Tab "Orders" list all orders
  ![alt tag](/docs/tab-orders.png?raw=true "Tab orders")


ORM Examples:
----------------

 ```
 //--- Create new city. ---
 //--- *Wrong country_id. Must be int, zip can not be empty
  $city = new \models\City();
  $city->setCountryId('4');
  $city->setCity('Stara Zagora');
  $city->setZip(null); // should be '9000'
  $result = $city->save();
  
  //--- Create new Order ---
  // *Wrong IP address. Must be valid IP address.
  $order = new \models\Order();
  $order->setCompanyId(3);
  $order->setShippingCountryId(3);
  $order->setShippingCityId(3);
  $order->setShippingAddress('London, LSE Houghton Street, London, WC2A 2AE');
  $order->setNote('Please check shipping price and write to me for total amount!');
  $order->setIp('123456789'); //158.58.202.50
  $result = $order->save();
  
  
  //------------------ Queries --------------------//
  $employers = new \models\Employer();
  
  // ------- Find employer by dynamic parameters
  $result = $employers->findByEmployee_Email('info@krasimirkostadinov.com');
  
  // ------- Find employers by name -------
  $result = $employers->find(['employee_name' => 'Красимир Костадинов']);
  
  // ------- Find ALL employers with limit 2
  $result = $employers->findAll([], '*', '', 2);

  
  // ------- Validate date -----------
  var_dump(models\helpers\Helper::isValidDate('22/10/2015'));
  ```


Future improovements:
---------------------
1. Connect relational objects to current object instance.
2. Implement user interface forms, using CRUD module for objects. 
3. UI search field to search for objects with magic methods.
