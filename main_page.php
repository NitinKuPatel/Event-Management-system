<?php
session_start();

if (!isset($_SESSION['vendor_id'])) {
    header("Location: vendor_login.php");
    exit();
}

$vendor_id = $_SESSION['vendor_id'];

// Database connection
$conn = new mysqli("localhost", "root", "", "party_organiser");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch vendor items
$items = [];
$result = $conn->query("SELECT id, item_name, price, quantity FROM items WHERE vendor_id = $vendor_id");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        nav { margin-bottom: 20px; }
        nav a { margin-right: 20px; text-decoration: none; color: #333; font-weight: bold; }
        nav a:hover { text-decoration: underline; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #333; }
        th, td { padding: 10px; text-align: left; }
        .btn { padding: 5px 10px; background: #333; color: #fff; border: none; cursor: pointer; }
        .btn:hover { background: #575757; }
    </style>
</head>
<body>
    <nav>
        <a href="main_page.php">Your Items</a>
        <a href="add_item.php">Add Item</a>
        <a href="transactions.php">Transactions</a>
        <a href="index.html">Logout</a>
    </nav>

    <h1>Your Items</h1>
    <table>
        <tr>
            <th>Item Name</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
        <?php foreach ($items as $item): ?>
        <tr>
            <td><?php echo $item['item_name']; ?></td>
            <td><?php echo $item['price']; ?></td>
            <td><?php echo $item['quantity']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
