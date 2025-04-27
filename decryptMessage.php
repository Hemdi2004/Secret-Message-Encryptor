<?php
   //Database connection
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "secret_vault";

   //Create connection
   $conn = new mysqli($servername, $username , $password, $dbname);

   //check connection
   if ($conn->connect_error) {
     die("connection failed: " . $conn->connect_error);
}

   //Get the encrypted message id from the URL 
   $id = $_GET['id'];

   //Fetch the encrypted Messages from the DB
    $sql = "SELECT context FROM messages WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        //Get the encrypted messages
        $row = $result->fetch_assoc();
        $encryptedMessage = $row['context'];

        //Decrypt the message using decryption function
        $decryptedMessage = caesarDecrypt($encryptedMessage, 3);

        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>Decrypted Message</h5>";
        echo "<p class='card-text'>" . htmlspecialchars($decryptedMessage) . "</p>";
        echo "</div></div>";

    }else{
        echo "Message not found!";
    }
    $conn->close();

    //caesar decrypt function

    function caesarDecrypt($text, $shift){
            $shift = $shitf % 26;
            $result = '';

            for($i = 0; $i < strlen($text); $i++){
                  $char = $text[$i];
                  if ($char >= 'A' && $char <='Z') {
                    $result .= chr(((ord($char) - 65 - $shift + 26 ) % 26) + 65);
                  }elseif ($char >= 'a' $$ $char <= 'z') {
                    $result .= chr(((ord($char) - 97 - $shift + 26 ) % 26) + 97);
                  }else{
                    $result .= $char;
                  }
            }

            return $result;
    }
?>