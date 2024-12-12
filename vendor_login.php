<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simulating login (Replace with actual database verification)
    if ($username == 'admin' && $password == 'admin123') {
       // session_start();
        //$_SESSION['vendor_id'] = 'admin'; // Or any unique identifier for admin
        header("Location: main_page.php"); // Redirect to main_page.php
        //exit(); 
        
    } else {
        echo "Invalid credentials!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        form { display: inline-block; text-align: left; }
        input { margin: 10px 0; padding: 8px; width: 100%; }
        .btn { padding: 10px; background: #333; color: #fff; border: none; cursor: pointer; }
        .btn:hover { background: #575757; }
        .signup-link { display: block; margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Login</h1>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button class="btn" type="submit">Login</button>
    </form>
    <a class="signup-link" href="vendor_signup.php">Don't have an account? Sign Up</a>
</body>
</html>
