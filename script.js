function encryptMessage() {
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
  }
  
  function decryptMessage() {
    const method = document.getElementById('cipherMethod').value;
    const text = document.getElementById('inputMessage').value;
    const shift = parseInt(document.getElementById('shift').value) || 3;
  
    let result = '';
  
    if (method === 'caesar') {
      result = caesarEncrypt(text, -shift); // same function, reverse shift
    } else if (method === 'reverse') {
      result = reverseString(text); // reverse of reverse = original
    }
  
    document.getElementById('outputMessage').value = result;
  }
  
  function caesarEncrypt(str, shift) {
    return str.split('').map(char => {
      if (char.match(/[a-z]/i)) {
        const base = char === char.toUpperCase() ? 65 : 97;
        return String.fromCharCode(((char.charCodeAt(0) - base + shift + 26) % 26) + base);
      }
      return char;
    }).join('');
  }
  
  function reverseString(str) {
    return str.split('').reverse().join('');
  }
  