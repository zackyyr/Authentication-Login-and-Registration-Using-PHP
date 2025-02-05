<?php 
    // 🔊 Turn on error reporting so we can see any mistakes instead of debugging in the dark
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // 🛜 Include database connection file (so we can talk to our database)
    include('database.php');

    // 🔑 Start a session to track user login state
    session_start(); 
    
    // Variables to store messages and their corresponding CSS classes
    $register_msg = ''; // Will hold success or error messages
    $msg_class = '';  // Will determine the message color/style

    // Check if user is already logged in
    if(isset($_SESSION["is_Login"])){
        // Redirect to dashboard if session exists (user is logged in)
        header("Location: dashboard.php");
        exit(); // Make sure script stops executing after redirect
    }

    // 📝 Check if the form is submitted (when user clicks "Create Account")
    if(isset($_POST["register"])){
        // Grab the username and password from the form
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Hash the password using SHA-256 (so we don’t store plain passwords)
        $hash_password = hash("sha256", $password);
        
        try { 
            // SQL query to insert new user into the database
            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hash_password')";
    
            // 📡 Execute the query and check if it was successful
            if($db->query($sql)) { 
                $register_msg = 'Account Created Successfully'; // Success message
                $msg_class = 'success'; // Set CSS class to green
            } else { 
                $register_msg = 'Account Creation Failed'; //General failure message
                $msg_class = 'failed'; // Set CSS class to red
            }
        } catch(mysqli_sql_exception) { 
            // If username already exists, catch the error and show message
            $register_msg = 'Username already exists'; // Warning message
            $msg_class = 'exists'; //Set CSS class to yellow
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <style>
        * { 
            font-family: "Poppins", serif;
        }
        .form-container { 
            display: flex;
            justify-content: center;
            flex-direction: column;
        }
        .form { 
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 80vh;
        }
        form { 
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
            gap: 1em;
        }
        form input { 
            padding: 10px;
            width: 93.5%;
            border: 1px solid #e0e0e0;
            background-color: #f6f6f6;
            border-radius: 2px;
        }
        form button { 
            width: 100%;
            padding: 10px; 
            border: none; 
            background-color: #007bff; 
            color: white; 
            cursor: pointer; 
            border-radius: 2px; 
            text-align: center;
        }
        .status { 
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .success {
            background-color: #d4edda;
            border: 2px solid #28a745;
            color: #155724;
        }
        .failed {
            background-color: #f8d7da;
            border: 2px solid #dc3545;
            color: #721c24;
        }
        .exists {
            background-color: #fff3cd;
            border: 2px solid #ffc107;
            color: #856404;
        }
    </style>
</head>
<body>
    <section class="form">
        <div class="form-container">
            <h3>Create an Account</h3>
            <?php if($register_msg): ?>
                <p class="status <?= $msg_class ?>"><?= $register_msg ?></p>
            <?php endif; ?>
            <form action="register.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="register">Create Account</button>
            </form>

            <p>Already have an account? <a href="login.php">Log in</a></p>
        </div>
    </section>
</body>
</html>
