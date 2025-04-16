<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Connect to MySQL
    $conn = new mysqli("localhost", "root", "", "secret_vault");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the encrypted message from the form
    $encrypted = $_POST['encryptedMessage'] ?? '';

    if (!empty($encrypted)) {
        $sql = "INSERT INTO messages (content) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $encrypted);
        $stmt->execute();
        echo "<script>alert('saved successfully !')</script>";
        $stmt->close();
    } else {
        echo "<script>alert('⚠️ saved unsuccessfully')</script>";
    }

    $conn->close();
}
?>
