<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if file was uploaded without errors
    if (isset($_FILES['textfile']) && $_FILES['textfile']['error'] == 0) {
        $uploadedFile = $_FILES['textfile'];
        
        // Define a location to store the uploaded file
        $uploadDirectory = 'uploads/';
        $uploadFilePath = $uploadDirectory . basename($uploadedFile['name']);
        
        // Check if the uploaded file is a text file
        $fileType = strtolower(pathinfo($uploadFilePath, PATHINFO_EXTENSION));
        if ($fileType != 'txt') {
            echo "Error: Only .txt files are allowed.";
            exit();
        }

        // Move uploaded file to the desired directory
        if (move_uploaded_file($uploadedFile['tmp_name'], $uploadFilePath)) {
            // Read the file contents
            $fileContents = nl2br(file_get_contents($uploadFilePath));
            echo "<h1>File Contents:</h1>";
            echo "<pre>$fileContents</pre>";
        } else {
            echo "Error uploading your file.";
        }
    } else {
        echo "Error: " . $_FILES['textfile']['error'];
    }
} else {
    echo "Invalid request method.";
}
?>