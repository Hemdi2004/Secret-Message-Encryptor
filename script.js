function encryptMessage(e) {
  e.preventDefault();

  const method = document.getElementById('cipherMethod').value;
  const text = document.getElementById('inputMessage').value;
  const shift = parseInt(document.getElementById('shift').value) || 3;

  let result = '';

  if (method === 'caesar') {
    result = caesarEncrypt(text, shift);
  } else if (method === 'reverse') {
    result = reverseString(text);
  }

  document.getElementById('outputMessage').value = result;
  document.getElementById('encryptedMessage').value = result;
  console.log("Encrypted Message:", result);

  // Optional: If you want automatic form submit after encryption
  // document.querySelector('form').submit();
}

function decryptMessage(e) {
  e.preventDefault();
  const method = document.getElementById('cipherMethod').value;
  const text = document.getElementById('inputMessage').value;
  const shift = parseInt(document.getElementById('shift').value) || 3;

  let result = '';

  if (method === 'caesar') {
    result = caesarDecrypt(text, shift);
  } else if (method === 'reverse') {
    result = reverseString(text);
  }

  document.getElementById('outputMessage').value = result;
  document.getElementById('decryptedMessage').value = result;
  console.log("Decrypted Message:", result);
}

function caesarEncrypt(text, shift) {
  return text.split('').map(char => {
    if (char.match(/[a-z]/i)) {
      const code = char.charCodeAt(0);
      let shifted = code;

      if (code >= 65 && code <= 90) {
        shifted = ((code - 65 + shift) % 26) + 65;
      } else if (code >= 97 && code <= 122) {
        shifted = ((code - 97 + shift) % 26) + 97;
      }

      return String.fromCharCode(shifted);
    }
    return char;
  }).join('');
}

function caesarDecrypt(text, shift) {
  return caesarEncrypt(text, (26 - shift) % 26);
}

function reverseString(text) {
  return text.split('').reverse().join('');
}
