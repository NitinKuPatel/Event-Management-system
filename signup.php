<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $servername = "localhost";
    $username = "root"; // Replace with your DB username
    $password = "";     // Replace with your DB password
    $dbname = "party_organiser";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];

    // Prepare and execute SQL statement
    $sql = "INSERT INTO users (firstname, lastname, email, phone, password, state, pincode) 
            VALUES ('$firstname', '$lastname', '$email', '$phone', '$password', '$state', '$pincode')";

    if ($conn->query($sql) === TRUE) {
        echo "Account created successfully for $firstname $lastname!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        form { display: inline-block; text-align: left; }
        input { margin: 10px 0; padding: 8px; width: 100%; }
        .btn { padding: 10px; background: #333; color: #fff; border: none; cursor: pointer; }
        .btn:hover { background: #575757; }
    </style>
   
</head>
<body>
    <h1>Sign Up</h1>
    <form method="POST" onsubmit="return validateForm(event)">
        <input type="text" name="firstname" placeholder="First Name" required><br>
        <input type="text" name="lastname" placeholder="Last Name" required><br>
        <input type="email" id="email" name="email" placeholder="Email" required><br>
        <input type="tel" id="phone" name="phone" placeholder="Phone Number" required><br>
        <input type="password" name="password" placeholder="password" required><br>
        <input type="text" name="state" placeholder="State" required><br>
        <input type="text" name="pincode" placeholder="Pincode" required><br>
        <button class="btn" type="submit">Sign Up</button>
    </form>
</body>
</html>
