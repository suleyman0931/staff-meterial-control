<!DOCTYPE html>


<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="login.css" />
  <style>
    body {
      font-family: "Arial", sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #2c3e50;
      color: #ecf0f1;
      padding: 15px 30px;
      height: 50px;
    }

    .navbar .logo img {
      height: 40px;
    }

    .navbar .logo span {
      font-size: 1.6em;
      margin-left: 8px;
      font-weight: bold;
    }

    .navbar .nav-links {
      list-style: none;
      display: flex;
      align-items: center;
    }

    .navbar .nav-links li {
      margin: 0 20px;
    }

    .navbar .nav-links a {
      color: #ecf0f1;
      text-decoration: none;
      font-size: 1em;
      transition: color 0.3s;
    }

    .navbar .nav-links a:hover {
      color: #3498db;
    }

    .background-container {
      background: url("images/photo-1581091226825-a6a2a5aee158.jspeg") no-repeat center center;
      background-size: cover;
      height: 600px;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      text-align: center;
      color: white;
      background-color: black;
    }

    .background-container strong {
      font-size: 2.5em;
      margin-bottom: 20px;
    }

    .background-container p {
      left: 10px;
    }

    .background-container button {
      padding: 15px 30px;
      font-size: 1.2em;
      cursor: pointer;
      background-color: #3498db;
      color: #fff;
      border: none;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .background-container button:hover {
      background-color: #2980b9;
    }

    .welcome {
      text-align: center;
      position: absolute;
      top: 100px;
    }

    .welcome h2 {
      font-size: 36px;
      color: #f7efef;
      text-shadow: 8px 8px 8px rgba(131, 128, 128, 0.63);
    }

    .login-box {
      position: relative;
      width: 300px;
      padding: 40px;
      background: rgba(0, 0, 0, 0.8);
      text-align: center;
      border-radius: 10px;
    }

    .login-box h2 {
      margin: 0 0 20px;
      padding: 0;
      color: #fff;
    }

    .user-box {
      position: relative;
    }

    .user-box input {
      width: 100%;
      padding: 10px 0;
      margin-bottom: 30px;
      background: transparent;
      border: none;
      border-bottom: 1px solid #fff;
      outline: none;
      color: #fff;
      font-size: 16px;
    }

    .user-box label {
      position: absolute;
      top: 0;
      left: 0;
      padding: 10px 0;
      pointer-events: none;
      transition: 0.5s;
      color: #fff;
    }

    .user-box input:focus~label,
    .user-box input:valid~label {
      top: -20px;
      left: 0;
      color: #3498db;
      font-size: 12px;
    }

    .login-box a button {
      width: 100%;
      padding: 10px;
      background: #3498db;
      border: none;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .login-box a button:hover {
      background: #2980b9;
    }
  </style>
</head>
<?php
include ("connection.php");
session_start();

// Hardcoded credentials for demonstration purposes
$valid_username = 'admin';
$valid_password = '12345678';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($username == $valid_username && $password == $valid_password) {
    // Redirect to the welcome page on successful login
    header("Location: new2.html");
    exit();
  } else {
    // Redirect to the error page on failed login
    header("Location: new.html");
    exit();
  }
}
?>


<body>
  <nav class="navbar">
    <div class="logo">
      <img src="images/logo.png" alt="Logo" />
      <span>Staff Material Control</span>
    </div>
    <ul class="nav-links">
      <li><a href="#">About us</a></li>
      <li><a href="#">Contact us</a></li>
    </ul>
  </nav>

  <div class="background-container">
    <div class="welcome">
      <h2>Welcome back</h2>
    </div>
    <div class="login-box">
      <h2>Login</h2>
      <form method="POST" action="login.php">
        <div class="user-box">
          <input type="text" name="username" required="" />
          <label>Username</label>
        </div>
        <div class="user-box">
          <input type="password" name="password" required="" />
          <label>Password</label>
        </div>
        <a href="#"><button type="submit">Login</button></a>
        <p style="color: antiquewhite">Don't have an account?
          <a style="display: inline" href="signin.html">Register</a>
        </p>
      </form>
    </div>
  </div>
</body>

</html>