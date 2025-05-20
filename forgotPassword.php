<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Crem De La Crem</title>
    <link rel="stylesheet" href="dist/loginPageStyles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Maven+Pro:wght@400..900&display=swap" rel="stylesheet">
</head>
<body>
    <img src="image/window.jpg">
    <div class="login">
        <div class="loginProper">
            <h1>Forgot Password</h1>
            <h5 style="--i:2;">Please enter your email address to receive a password reset link.</h5>
            <form id="forgot-password-form">
                <label style="--i:2;"><b>Email Address</b></label> <br>
                <input style="--i:3;" type="email" id="email" placeholder="Enter your email" required>
            </form>
            <button id="reset-password" style="--i:4;">Send Reset Link</button>
            <br>
            <p style="text-align:center; margin-top:10px; --i:6;" id="contact">If you did not request a reset, please <a href="#" style="text-decoration: none;" class="help">contact support</a>.</p>
            <div id="error-message" style="text-align: center; margin-top: 10px;"></div>
        </div>
    </div>
    <script src="forgotPassword.js"></script>
</body>
</html>
