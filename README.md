# _DeathStar_

#### _Epicodus-PHP, Week 5 Group Project, 07.27.2017_

#### By _**Brittany Kerr, Dylan Lewis, Calla Rudolph, Nathan Stewart, Larry Taylor**_

## Description



## Prerequisites

_You will need the following properly installed on your computer:_

* [MAMP](https://www.mamp.info/en/) for Windows or MacOS
* [PHP](https://secure.php.net/)
* [Composer](https://getcomposer.org/)

## Configuration/Dependencies

_The app will use PHPunit,  Silex, and Twig._

## Setup/Installation

* Open GitHub site on your browser: https://github.com/GStewartN/DeathStar
* Select the dropdown (green box) "Clone or download"
* Copy the link for the GitHub repository
* Open Terminal on your computer
* In Terminal, perform the following steps:
````
  $ cd desktop
  $ git clone <paste repository link>
  $ cd DeathStar
  $ composer install
  ````
* To view app in browser:
  * Open MAMP and click Preferences
  * Click Ports and set Apache Port to 8888, and Msql port to 8889
  * Click Web Server and set the document root to the web folder of DeathStar directory and click OK
  * In MAMP click Start Servers
  * In MAMP click Open WebStart page
  * In Tools menu of WebStart page, click phpMyAdmin
  * Once in phpmyadmin page, click Import tab, click browse button, then navigate to the death_star.sql file in the project directory
  * In your browser, enter 'localhost:8888' to view the webpage on your browser

## Specifications

| Behavior | Input | Output |
|----------|-------|--------|
|


## Technologies Used

* _PHP_
* _HTML_
* _Silex_
* _Twig_
* _Composer_
* _MAMP_
* _PHPUnit_
* _MySql_
* _phpMyAdmin_

## MySQL Commands Used

* CREATE DATABASE death_star;
* USE death_star;
* CREATE TABLE employees (id serial PRIMARY KEY, name VARCHAR (50), rank VARCHAR (50), species VARCHAR (50), pay INT, record TEXT);
* CREATE TABLE divisions (id serial PRIMARY KEY, div_name VARCHAR (50));
* CREATE TABLE departments (id serial PRIMARY KEY, dept_name VARCHAR (50));
* CREATE TABLE departments_employees (id serial PRIMARY KEY, department_id INT, employee_id INT);
* ALTER TABLE departments ADD division_id INT;
* INSERT INTO divisions (div_name) VALUES ('Army');
* INSERT INTO divisions (div_name) VALUES ('Navy');
* INSERT INTO divisions (div_name) VALUES ('Battle Station');
* INSERT INTO divisions (div_name) VALUES ('Imperial');
* INSERT INTO departments (dept_name, division_id) VALUES ('Army Officers', 1);
* INSERT INTO departments (dept_name, division_id) VALUES ('Army Troopers', 1);
* INSERT INTO departments (dept_name, division_id) VALUES ('Navy Officers', 2);
* INSERT INTO departments (dept_name, division_id) VALUES ('Navy Troopers', 2);
* INSERT INTO departments (dept_name, division_id) VALUES ('Gunners', 3);
* INSERT INTO departments (dept_name, division_id) VALUES ('Battle Station Troopers', 3);
* INSERT INTO departments (dept_name, division_id) VALUES ('Support/Maintenance', 3);
* INSERT INTO departments (dept_name, division_id) VALUES ('Security', 3);
* INSERT INTO departments (dept_name, division_id) VALUES ('Stormtroopers', 4);
* INSERT INTO departments (dept_name, division_id) VALUES ('Pilots', 2);

### License

MIT License

Copyright &copy; 2017 Brittany Kerr, Dylan Lewis, Calla Rudolph, Nathan Stewart, Larry Taylor

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
