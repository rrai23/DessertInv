<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page | Crem De La Crem</title>
    <link rel="stylesheet" href="dist/loginPageStyles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Maven+Pro:wght@400..900&display=swap" rel="stylesheet">
</head>
<body>
    <img src="image/window.jpg">
    <div class="login">

        <div class="loginProper">
            <h1>LOGIN</h1>
            <h5 style="--i:2;">Welcome back! Please login to your account.</h5>
            <form id="input">
                <label style="--i:2;"><b>User Name</b></label>
                <input style="--i:3;" type="text" id="username" placeholder="username">
                <label style="--i:4;" class="pass"><b>Password</b></label>
                <input style="--i:5;"type="password" id="password" placeholder="password">
            </form>
            <button id="login" style="--i:4;">Login</button>
            <div id="error-message"></div>
            <p style="text-align:center; margin-top:10px;" class="forgot">
                <a style="text-decoration:none; --i:6;" href="forgotPasswordPage.html" id="forgot1" class="help">Forgot your password?</a>
            </p>
        </div>
    </div>
    <script src="loginPageScript.js"></script>
</body>
</html>