<?php
    // Turn on error reporting so we can see mistakes (let's not be in the dark!)
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Include database connection file so we can interact with the database
    include('database.php');
    
    // Start a session to track the user's login state
    session_start();

    // Variables for login messages and their styles
    $login_msg = ''; // Will hold the login message (e.g., success or error)
    $msg_class = ''; // Will hold the message style (success, failed)

    // Check if the user is already logged in
    if(isset($_SESSION["is_Login"])){
        // If they're logged in, redirect them to the dashboard (no need for login again)
        header("Location: dashboard.php");
    }

    // Check if the login form is submitted
    if(isset($_POST['login'])) { 
        // Get username and password from the login form
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Hash the password with SHA-256 (because storing passwords as plain text is a big no-no)
        $hash_password = hash('sha256', $password);

        // SQL query to search for a user with the entered username and hashed password
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$hash_password'";

        // Execute the query
        $result = $db->query($sql);

        // Check if the query found any matching user
        if($result->num_rows > 0) { 
            // 🚀 If there's a match, grab the user's data from the database
            $data = $result->fetch_assoc();

            // Store the user's username in session and set the login status to true
            $_SESSION["username"] = $data['username'];
            $_SESSION["is_Login"] = true;

            // Redirect to the dashboard since login was successful
            header("Location: dashboard.php");
        } else { 
            // If login fails (no user found), show error message
            $login_msg = 'Login Failed'; 
            $msg_class = 'failed'; // Set CSS class to red for error style
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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
            <h3>Log in to your Account</h3>
            <?php if($login_msg): ?>
                <p class="status <?= $msg_class ?>"><?= $login_msg ?></p>
            <?php endif; ?>
            <form action="login.php" method="POST">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <button type="submit" name="login">Log in</button>
            </form>

            <p>Don't have an account? <a href="register.php">Create an Account</a></p>
        </div>
    </section>
</body>
</html>