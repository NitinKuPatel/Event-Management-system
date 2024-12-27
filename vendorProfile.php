<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['vendor_id'])) {
    header("Location: vendor_login.php");
    exit();
}

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

// Fetch vendor information from the database
$vendor_id = $_SESSION['vendor_id']; // Assuming vendor_id is stored in session
$sql = "SELECT firstname, lastname, email, phone, state, pincode FROM vendor WHERE id='$vendor_id'";
$result = $conn->query($sql);
$vendor = $result->fetch_assoc();

// Update vendor information
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];

    $update_sql = "UPDATE vendor SET firstname='$firstname', lastname='$lastname', email='$email', phone='$phone', state='$state', pincode='$pincode' WHERE id='$vendor_id'";

    if ($conn->query($update_sql) === TRUE) {
        echo "Profile updated successfully!";
        // Refresh the page to show updated information
        header("Location: vendorProfile.php");
        exit();
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Profile</title>
    <style>
        body { font-family: Arial, sans-serif;  margin-top: 50px; }
        form { display: inline-block; text-align: left; }
        input { margin: 10px 0; padding: 8px; width: 100%; }
        .btn { padding: 10px; background: #333; color: #fff; border: none; cursor: pointer; }
        .btn:hover { background: #575757; }
        #CONTENT{
            margin: 0 auto;
            width: 30%;
            padding: 5%;
            border: 1px solid #333;
            background-color: #ababab;
            font-size: 25px;
            color; rgb(255,0,0);
            border-radius: 10%;

            

        }
    </style>
</head>
<body>
    <h1>Vendor Profile</h1>
    <DIV ID="CONTENT">
        <h2>Hello <?php echo $vendor['firstname']; ?>!</h2>
        <LABEL>First Name: "<?php echo $vendor['firstname']; ?></LABEL>
        <br>
        <LABEL>Last Name: "<?php echo $vendor['lastname']; ?></LABEL><br>
        <LABEL>Email: "<?php echo $vendor['email']; ?></LABEL><br>
        <LABEL>Phone: "<?php echo $vendor['phone']; ?></LABEL><br>
        <LABEL>State: "<?php echo $vendor['state']; ?></LABEL><br>
        <LABEL>Pincode: "<?php echo $vendor['pincode']; ?></LABEL><br>

    </DIV>
    <h2>Update Profile</h2>
    

        
    <form method="POST">
        <input type="text" name="firstname" placeholder="First Name" value="<?php echo $vendor['firstname']; ?>" required><br>
        <input type="text" name="lastname" placeholder="Last Name" value="<?php echo $vendor['lastname']; ?>" required><br>
        <input type="email" name="email" placeholder="Email" value="<?php echo $vendor['email']; ?>" required><br>
        <input type="tel" name="phone" placeholder="Phone Number" value="<?php echo $vendor['phone']; ?>" required><br>
        <input type="text" name="state" placeholder="State" value="<?php echo $vendor['state']; ?>" required><br>
        <input type="text" name="pincode" placeholder="Pincode" value="<?php echo $vendor['pincode']; ?>" required><br>
        <button class="btn" type="submit">Update Profile</button>
    </form>
    <a href="vendor_login.php">Logout</a>
</body>
</html>