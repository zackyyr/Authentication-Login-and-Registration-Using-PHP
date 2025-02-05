# PHP Login & Registration System

This repository contains a simple **PHP Login & Registration System** that allows users to register, log in, and log out. The system is built using PHP and MySQL, and it's designed to help developers quickly set up a user authentication system.

## Purpose of this Repository

The goal of this repository is to provide a basic structure for a user authentication system where users can:
- **Register** by providing a username and password.
- **Login** using their registered credentials.
- **Logout** to destroy the session and end the user session.

This repository is useful for developers looking to integrate authentication into their PHP-based web applications or for those who want to learn how basic login and registration systems work.

## Step-by-Step Guide to Run the Program

### 1. Clone the Repository to Your Local Machine

- Open your terminal or Git Bash.
- Navigate to your `htdocs` folder (assuming you're using XAMPP or a similar environment).
  ```bash
  cd /path/to/htdocs
# Database Setup Instructions

This document provides detailed instructions on how to set up the database for the PHP Login & Registration System on your local environment.

## Step 2: Set Up the Database on Your Localhost

1. Open **phpMyAdmin** (usually accessible at `http://localhost/phpmyadmin`).

2. Create a new database:
   - On the **phpMyAdmin** homepage, click on the **Databases** tab.
   - In the "Create database" field, type `databaseName` (you can choose any name you like for the database) and click **Create**.

## Step 3: Create the Users Table

1. After creating the database, go to the newly created `databaseName` in **phpMyAdmin**.

2. Create a new table called `users` with the following columns:
   - **id** (Type: `INT`, Attributes: `AUTO_INCREMENT`)
   - **username** (Type: `VARCHAR(50)`, Attributes: `UNIQUE`)
   - **password** (Type: `VARCHAR(255)`)
   - **created_at** (Type: `DATETIME`, Default: `CURRENT_TIMESTAMP`)

3. Click **Go** to create the table.

## Step 4: Configure Database Connection

1. Open the `database.php` file from the cloned repository.

2. Ensure that the database connection settings match your local setup:
   - **$hostname**: `"localhost"`
   - **$username**: `"root"`
   - **$password**: `""` (empty string, as it's default in XAMPP)
   - **$database_name**: `"databaseName"`

## Step 5: Access the Application

1. Open your browser and go to `http://localhost/your-repository-name/register.php`.
   - This will bring up the registration page where you can create a new account.

2. After registration, you'll be able to log in at `http://localhost/your-repository-name/login.php` using the credentials you just created.

## Step 6: Enjoy!

Now you can enjoy using your simple login and registration system locally. You can customize it further for your needs, such as adding more features or integrating it into larger projects.
