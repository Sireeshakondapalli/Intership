<?php
session_start();

// Calculate total amount
$total = 0;
foreach ($_SESSION['orders'] as $order) {
    $total += $order['quantity'] * $order['price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Summary</title>
</head>
<body>
    <h1>Order Summary</h1>
    
    <?php if (!empty($_SESSION['orders'])): ?>
        <table border="1">
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
            <?php foreach ($_SESSION['orders'] as $order): ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                    <td><?php echo $order['quantity']; ?></td>
                    <td><?php echo number_format($order['price'], 2); ?></td>
                    <td><?php echo number_format($order['quantity'] * $order['price'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td><strong><?php echo number_format($total, 2); ?></strong></td>
            </tr>
        </table>
    <?php else: ?>
        <p>No items in your order.</p>
    <?php endif; ?>

    <br>
    <a href="order_form.php">Add More Products</a> | 
    <a href="clear_order.php">Clear Order</a>
</body>
</html>