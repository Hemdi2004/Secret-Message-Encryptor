# Secret Message Encryptor

A web-based tool that allows users to securely encrypt and decrypt messages using classic encryption methods like the Caesar Cipher and Reverse Cipher. With added PHP and MySQL integration, users can now save their encrypted messages to a database for later use.

## Features

- **Caesar Cipher**: Encrypt and decrypt messages by shifting letters in the alphabet.
- **Reverse Cipher**: Flip your message backwards for simple obfuscation.
- **Message Saving**: Encrypted messages can be saved to a MySQL database using PHP.
- **User-Friendly Interface**: Input your message, choose a cipher, and get results instantly.
- **Secure Messaging**: Makes it easier to privately share encoded text.

## How to Use

1. Open the project using a local PHP server (like **XAMPP**, **MAMP**, or **WAMP**).
2. Navigate to the project directory in your browser (e.g., `http://localhost/Secret%20Message%20Encryptor/`).
3. Enter your message in the input field.
4. Choose a cipher method (Caesar or Reverse).
5. (Optional for Caesar) Enter a shift value.
6. Click "Encrypt" to encode the message or "Decrypt" to decode it.
7. Click "Save Secret" to store the encrypted message in the database.

## Technologies Used

- **HTML**: Page structure.
- **CSS**: Styling and layout.
- **JavaScript**: Encryption/Decryption logic.
- **PHP**: Backend to handle saving to database.
- **MySQL**: Store encrypted messages securely.

## Installation

To run this project locally with database support:

1. Clone the repository:
   ```bash
   git clone https://github.com/Hemdi2004/Secret-Message-Encryptor.git
