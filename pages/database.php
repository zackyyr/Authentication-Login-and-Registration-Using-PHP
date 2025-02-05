<?php 
    // Setting up the database connection details
    $hostname = "localhost"; // The server hosting the database (usually 'localhost' for local dev)
    $username = "root"; // The database username, 'root' is default for local MySQL
    $password = ""; // No password for local MySQL by default (change if necessary)
    $database_name = "databaseName"; // The name of your database (replace with your actual DB name)

    // Connect to the database
    $db = mysqli_connect($hostname, $username, $password, $database_name);

    // Check if the connection worked
    if (!$db) { 
        // If the connection failed, stop the script and show the error message
        die("Koneksi gagal: " . mysqli_connect_error());
    } 
?>
