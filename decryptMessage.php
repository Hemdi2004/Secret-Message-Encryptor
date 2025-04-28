<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "secret_vault";

// Create connection
$conn = new mysqli($servername, $username , $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the encrypted message ID from the URL 
$id = $_GET['id'];

// Fetch the encrypted message from DB but it could be dengerous && it leaves the app vulnerable to SQL injection attacks!
// $sql = "SELECT context FROM messages WHERE id = $id";
// $result = $conn->query($sql);

// this is a secure way to fetch the encrypted message from DB 
// Secure way
$stmt = $conn->prepare("SELECT context FROM messages WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Decrypted Message</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

</head>
<body class="bg-dark text-light d-flex justify-content-center align-items-center min-vh-100">

<div class="container-fluid px-3 px-md-5">
  <?php
  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $encryptedMessage = $row['context'];

      // Decrypt the message
      $decryptedMessage = caesarDecrypt($encryptedMessage, 3);
      ?>

      <div class="card shadow-lg border-0 rounded-4 bg-secondary">
        <div class="card-header bg-primary text-white rounded-top-4">
          <h4 class="mb-0">🔓 Your Decrypted Message</h4>
        </div>
        <div class="card-body">
          <p class="card-text fw-bold fs-5"><?php echo htmlspecialchars($decryptedMessage); ?></p>
          <a href="viewMessages.php" class="btn btn-outline-light mt-3"><i class="fas fa-arrow-left me-2"></i> Back to Messages</a>
        </div>
      </div>

  <?php
  } else {
      echo "<div class='alert alert-danger'>Message not found!</div>";
  }
  $conn->close();

  // Caesar decrypt function
  function caesarDecrypt($text, $shift){
      $shift = $shift % 26;
      $result = '';

      for($i = 0; $i < strlen($text); $i++){
          $char = $text[$i];
          if ($char >= 'A' && $char <= 'Z') {
              $result .= chr(((ord($char) - 65 - $shift + 26) % 26) + 65);
          } elseif ($char >= 'a' && $char <= 'z') {
              $result .= chr(((ord($char) - 97 - $shift + 26) % 26) + 97);
          } else {
              $result .= $char;
          }
      }
      return $result;
  }
  ?>
</div>

</body>
</html>
