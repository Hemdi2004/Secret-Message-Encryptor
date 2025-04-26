<?php

// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "secret_vault");

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connection successful!";  // This will confirm the connection was made
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the encrypted message from the form
    $encrypted = $_POST['encryptedMessage'] ?? '';

    if (!empty($encrypted)) {
        // Prepare SQL statement to insert message
        $sql = "INSERT INTO messages (context) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $encrypted);
        $stmt->execute();
        echo "<script> alert('Saved successfully!'); </script>";
        $stmt->close();
    } else {
        echo "<script> alert('⚠️ Saved unsuccessfully!'); </script>";
    }
}

// Close the connection
$conn->close();
?>
