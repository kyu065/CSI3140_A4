 # Hospital Triage Web Application

This repository contains the code for the Hospital Triage application. The application helps staff and patients better understand wait times while in the emergency room.

## GitHub Repository Link

[GitHub Repository Link](https://github.com/kyu065/CSI3140_A4)

## How The Application Works

The Hospital Triage application has two main interfaces:

### Client Interface

Patients can check their current wait time by inputting their name and code on the client/patient page.
- **Check WaitTime** - Patients sign in and are presented with a message displaying the current wait time.

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

