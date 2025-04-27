<?php

// Database connection

 $servername = "localhost";
 $username = "root";
 $password = "";
 $db_name = "secret_vault";

// create connection

$conn = new mysqli($servername, $username, $password, $db_name);

//chech connection

if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}

                  // This will display each encrypted message in the database along with a Decrypt button next to it.

//Fetch messages from DB 
$sql = "SELECT id , context FROM messages";
$result = $conn->query($sql);

//check if there's any saved messages 
if ($result->num_rows > 0) {
   while ($row = $result->fetch_assoc()) {
    echo "<div class='message'>";
    echo "<p>Encrypted Message : " . htmlspecialchars($row['context']) . "</p>";

    //Add the "Decrypt Button" (we'll handle decryption next)
    echo "<a href='decryptMessage.php?id=" . $row['id'] . "' class='btn btn-primary'>Decrypt</a>";
    echo "</div><hr>";

   };
}else {
    echo "No messages found.";
}

$conn->close();

?>