## _MySql Commands_

* CREATE DATABASE death_star;
* USE death_star;
* CREATE TABLE employees (id serial PRIMARY KEY, name VARCHAR (50), rank VARCHAR (50), species VARCHAR (50), pay INT, record TEXT);
* CREATE TABLE divisions (id serial PRIMARY KEY, div_name VARCHAR (50));
* CREATE TABLE departments (id serial PRIMARY KEY, dept_name VARCHAR (50));
* CREATE TABLE departments_employees (id serial PRIMARY KEY, department_id INT, employee_id INT);
