<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>💖 Menzabetha Payment Page 💖</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css"/>
  <style>
    body {
      background-color:rgb(225, 229, 255);
      font-family: "Comic Sans MS", cursive, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .payment-container {
      background: #fff;
      padding: 20px;
      border-radius: 20px;
      box-shadow: 0px 10px 20px rgba(105, 165, 255, 0.3);
      text-align: center;
      width: 350px;
    }

    h2 {
      color:rgb(105, 165, 255);
    }

    .input-field {
      width: 90%;
      padding: 10px;
      margin: 10px 0;
      border: 2px solidrgb(182, 216, 255);
      border-radius: 15px;
      font-size: 16px;
      text-align: center;
    }

    .pay-button {
      background:rgb(105, 165, 255);
      color: white;
      border: none;
      padding: 12px;
      width: 100%;
      border-radius: 25px;
      font-size: 18px;
      cursor: pointer;
      transition: 0.3s;
      box-shadow: 0px 4px 10px rgba(105, 165, 255, 0.3);
    }

    .pay-button:hover {
      background:rgb(105, 165, 255);
      box-shadow: 0px 6px 15px rgba(105, 165, 255, 0.5);
    }

    .heart-icon {
      font-size: 30px;
      margin-bottom: 10px;
    }

    .phone-container {
      margin: 10px 0;
    }

    .iti {
      width: 100%;
    }

    #error-msg {
      color: red;
      font-size: 14px;
      display: none;
      margin-top: 5px;
    }
  </style>
</head>
<body>

  <div class="payment-container">
    <div class="heart-icon">💸</div>
    <h2>Secure Payment</h2>
    <input type="text" class="input-field" placeholder="💳 Card Number">
    <input type="text" class="input-field" placeholder="📅 Expiry Date (MM/YY)">
    <input type="text" class="input-field" placeholder="🔒 CVV">

    <div class="phone-container">
      <input id="phone" type="tel" class="input-field" placeholder="📱 Phone Number">
      <span id="error-msg">⚠️ Invalid phone number</span>
    </div>

    <button class="pay-button">💸 Pay Now</button>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
  <script>
    const input = document.querySelector("#phone");
    const errorMsg = document.querySelector("#error-msg");

    const iti = window.intlTelInput(input, {
      initialCountry: "jo",
      utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js"
    });

    input.addEventListener('blur', function () {
      if (input.value.trim()) {
        if (iti.isValidNumber()) {
          errorMsg.style.display = "none";
        } else {
          errorMsg.style.display = "inline";
        }
      }
    });
  </script>

</body>
</html>

