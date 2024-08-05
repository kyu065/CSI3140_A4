 # Hospital Triage Application

This repository contains the code for the Hospital Triage application. The application helps staff and patients better understand wait times while in the emergency room.

## GitHub Repository Link

[GitHub Repository Link](https://github.com/kyu065/CSI3140_A4)

## How The Application Works

The Hospital Triage application has two main interfaces:

### Client Interface

Patients can check their current wait time by inputting their name and code on the client/patient page.

### Admin Interface

Administrators have access to a full list of patients and can manage patient data, including adding and deleting patients. 

## Application Features

- **Adding Patients**: Both the client and admin pages have forms for adding patients. The admin can view and manage all patients, while clients can only add their own information.
- **Viewing Patients**: Admins can view a complete list of patients, including their names, severity, and wait times.
- **Deleting Patients**: Admins can delete patients either from the list view or by entering a name in the provided form.


## Technical Details

### Database Setup

1. **PostgreSQL Installation**:
   - Make sure PostgreSQL is installed and running on your system.
   - Create a database named `clientdb`.

2. **Database Schema**:
   - Create a table named `patients` with the following columns:
     - `id` (serial, primary key)
     - `name` (text)
     - `severity` (text)
     - `wait_time` (integer)
   - Example SQL queries are provided in `database.sql`.

### Server Setup

1. **XAMPP Installation**:
   - Install XAMPP from [Apache Friends](https://www.apachefriends.org/index.html).
   - Start the Apache server from the XAMPP control panel.

2. **Project Directory**:
   - Place the project files into the `htdocs` directory of your XAMPP installation (usually located in `C:\xampp\htdocs`).

3. **Accessing the Application**:
   - Open a web browser (preferably Chrome).
   - Navigate to `http://localhost/a/CSI3140_A4/index.php` (adjust the path based on your directory structure and where you placed the index.php).
   - The localhost http will be set to `http://localhost/` concatenated with the directory of your file after `C:\xampp\htdocs\...`
   - Please refrain adjusting the directory structore of the code to avoid issues


### PHP Configuration

1. **Database Connection**:
   - Ensure the following credentials are set in the PHP files:
     ```php
     $dsn = 'pgsql:host=localhost;dbname=clientdb';
     $username = 'postgres';
     $password 
    - The password credential is set to your individual passwrod
    - In the current files formats, the password is set to superuser. Ensure all file documents are adjusted to contain your username and password 

 
 ## Contributors
- Kevin Yu - 300230560
- Eric Kwak - 300264568


 Student ID's : 
 Eric Kwak: 300264568
 Kevin Yu: 300
 
 Prototype steps: will be rewritten
 In order to implement and run these functions, 

DISCLAIMER:  These are all functions as followed on a 
windows (...)
 You need a couple of pre installed applications

 First you must have a valid php IDE, xampp and a
 postgresql server and database named clientdb 

An important part of this website is the connectivity and it's database
 Database. Make sure you have installed db preferably PostgreSQL. As the code in the current files are meant for a connection within a server db through Postgresql. 

 Install and make sure your
default username and password for postgresql is 
 User: postgre
 Password:superuser

 If your user name or password is different, you have to change the attribute value to support your credentials. 

the name of our database will be clientdb, if you wish to change to another name or support the data with another name, you may change 
the clientdb attribute in all the files. Preferrably however, it will be safe to use the default db names and simply create a database with the client db name. 
create a table named patients with the 3 attributes of name, severity and wait_time.

There is an example of queries in the database.sql file

Create a clientdb table within postgresql and make sure your server is running properly 
 To run xampp, 
 install xampp, 
 run the apache server for xampp 
 place the php folders and supporting documents/code inside 
 the htdocs directory under you folder installation of 
 xampp should be in your c drive by default, if else 
 search for it else where 

 We save our code all documents into the htdocs folder 

 Open up a browser, preferrably chrome on windows 

 open the localhost and type the specific directory of the files within the 
 code htdocs and its index.php 
E.g: If your file is in a  a/CSI3140_A4 directory you would type the following
 http://localhost/a/CSI3140_A4/index.php

