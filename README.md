# Volunteer Management System

## Description
My first PHP project for a local NGO. Volunteers and activities are stored in a database, and for each activity the volunteer completes, he gets a number of points. At the end of the year, the top volunteers receive a prize, and all the other people can see transparently their hard work.

![Screenshot](https://github.com/palcu/vms/raw/master/screenshots/s1_voluntari.png)

## Instalation
Create a new database from `schema.sql` and create an admin.

```mysql
create database points;
use points;
source schema.sql;
insert into admin (user_name, user_password) values ('alex', md5('alex'));
```

Then create `constants.php` file. The realm is only for [HTTP Authentification](http://en.wikipedia.org/wiki/Basic_access_authentication).

```php
<?php
  define('DB_HOST','localhost');
  define('DB_USER','alex');
  define('DB_PASSWORD','');
  define('DB_NAME','points');
  define('REALM', 'My Secret Realm');
  define('TITLE', 'Europe Direct Valcea');
  define('MAIN_HOME_PAGE', 'http://cicvalcea.ro'); //footer link
?>
```

Also, you can create a `navmenu_links.html` file, where you can add custom links to the navigation menu.

## Problems
* Use only alphanumeric characters for naming
* Spaghetti code... lots of it
* Ugly design (planning to use Bootstrap for next version)

## Examples
* http://voluntari.cicvalcea.ro/
* http://voluntari.fundatiacasacartii.ro/

## MIT License
Copyright (c) 2012 Alexandru Palcuie

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
