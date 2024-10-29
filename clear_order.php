<?php
session_start();
unset($_SESSION['orders']); // Clear orders from session

header("Location: order_summary.php"); // Redirect to order summary
exit();
?>