<?php 
    // Start the session so we can manage user data (like login status)
    session_start();

    // Check if the user clicked the "logout" button (when they wanna dip out)
    if(isset($_POST['logout'])) { 
        // Clear all session variables (like user info, login status, etc.)
        session_unset();

        // Destroy the session completely (goodbye login session!)
        session_destroy();

        // Redirect the user back to the homepage or login page (index.php)
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication Tutorial</title>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <style>
        * { 
            font-family: "Poppins", serif;
        }
        a { 
            text-decoration: none;
        }
        body { 

        }
        .hero { 
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            text-align: center;
            height: 80vh;
        }
        .hero-container {
            line-height: 1.2;
        }
        .hero-button { 
            display: flex;
            align-items: center;
            gap: 1.2em;
            text-decoration: none;
        }

        .hero-button .login { 
            color: #fff;
            background-color: #000;
            padding: 5px 20px;
            border-radius: 2em;
            border: 1px solid #000;
            transition: 0.2s ease;
        }
        .hero-button .login:hover { 
            background-color: #fff;
            color: #000;
        }
        .hero-button .register { 
            color: #000;
            padding: 5px 20px;
            border-radius: 2em;
            border: 1px solid #000;
            transition: 0.2s ease;
        }
        .hero-button .register:hover { 
            color: #fff;
            background-color: #000;
        }        
    </style>
</head>
<body>
    <section class="hero">
        <div class="hero-container">
            <h3 class="tagline">Good evening, <?= $_SESSION['username']?></h3> <!-- Username session here -->
            <h1>You are in a dashboard users</h1>
            <p>As long as you don't break the session, you can't go back to the login/register page.</p>
        </div>

        <div class="hero-button">
            <form action="dashboard.php" method="POST">
             <button class="login" type="submit" name="logout">Logout</button>
            </form>
            <a class="register" href="login.php">Login</a>
            <a class="register" href="register.php">Register</a>
        </div>
    </section>
</body>
</html>