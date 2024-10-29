<?php
session_start();

// Initialize orders session if not already set
if (!isset($_SESSION['orders'])) {
    $_SESSION['orders'] = [];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price']);

    // Check if the product is already in the session and update quantity if so
    $found = false;
    foreach ($_SESSION['orders'] as &$order) {
        if ($order['product_name'] === $product_name) {
            $order['quantity'] += $quantity;
            $found = true;
            break;
        }
    }
    // If the product is not found, add it to the orders
    if (!$found) {
        $_SESSION['orders'][] = [
            'product_name' => $product_name,
            'quantity' => $quantity,
            'price' => $price,
        ];
    }

    header("Location: order_summary.php"); // Redirect to summary page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Form</title>
</head>
<body>
    <h1>Enter Order Details</h1>
    <form action="order_form.php" method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" required><br>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" min="1" required><br>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" step="0.01" min="0" required><br>

        <button type="submit">Add to Order</button>
    </form>
    <br>
    <a href="order_summary.php">View Order Summary</a>
</body>
</html>