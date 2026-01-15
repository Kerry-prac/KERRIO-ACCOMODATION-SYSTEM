<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kerrio Accommodation System</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: url('home 2.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            text-align: center;
            color: #333;
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            width: 400px;
            margin: 120px auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        h1 {
            color: #004080;
            margin-bottom: 10px;
        }

        p {
            color: #444;
            margin-bottom: 20px;
        }

        a.button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            margin: 10px;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
        }

        a.button:hover {
            background-color: #0056b3;
        }

        footer {
            margin-top: 60px;
            color: #555;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Kerrio Accommodation System</h1>
        <p>Welcome! Please choose your login type:</p>

        <a href="login.php" class="button">STUDENT LOGIN</a>
        <a href="Register.php" class="button">REGISTER</a>
        <a href="admin_login.php" class="button">ADMIN LOGIN</a>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> Kerrio Accommodations | All Rights Reserved
    </footer>

</body>
</html>
