<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "secret_vault";

$conn = new mysqli($servername, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch messages from DB
$sql = "SELECT id, context FROM messages";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saved Messages - Secret Vault</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"/>
</head>
<body class="bg-dark text-white">

<nav class="navbar navbar-dark bg-dark px-4 py-3 d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center gap-2">
        <i class="bi bi-lock-fill fs-4 text-white"></i>
        <span class="navbar-brand mb-0 h1">Secret Vault</span>
    </div>
    <a href="index.html" class="btn btn-outline-light">Back to Encryptor</a>
</nav>

<section class="container py-5">
    <h2 class="mb-4 text-center">Saved Messages</h2>

    <?php
    if ($result->num_rows > 0) {
        echo "<div class='list-group'>";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='list-group-item bg-secondary d-flex align-items-center justify-content-between rounded mb-3'>
                    <div class='d-flex align-items-center'>
                        <div class='bg-primary text-white rounded-circle d-flex justify-content-center align-items-center' style='width: 40px; height: 40px;'>
                            <i class='bi bi-chat-dots'></i>
                        </div>
                        <div class='ms-3'>
                            <h5 class='mb-1'>Encrypted Message:</h5>
                            <p class='mb-0'>" . htmlspecialchars($row['context']) . "</p>
                        </div>
                    </div>
                    <a href='decryptMessage.php?id=" . $row['id'] . "' class='btn btn-outline-light'>Decrypt</a>
                  </div>";
        }
        echo "</div>";
    } else {
        echo "<p class='text-center text-muted'>No messages found.</p>";
    }
    ?>

</section>

</body>
</html>

<?php
$conn->close();
?>
