<?php
include('includes/db_connect.php');
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Incorrect password. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('No account found with that email.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Kerrio</title>

    <style>
        body{
            font-family: Arial;
            /* Background image */
            background: url('loginsbackground.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card{
            width: 350px;
            background: #90EE90; /* slightly transparent */
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
        }

        h2{
            text-align: center;
            margin-bottom: 15px;
        }

        label{
            font-size: 14px;
        }

        input{
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 12px;
            border-radius: 6px;
            border: 1px solid gray;
        }

        button{
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: none;
            background: teal;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover{
            opacity: 0.8;
        }

        .bottom-text{
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }

        a{
            text-decoration: none;
            color: teal;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="card">
    <h2>Kerrio Login</h2>

    <form method="POST" action="">

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">Login</button>
    </form>

    <p class="bottom-text">
        Don't have an account? <a href="register.php">Register here</a>
    </p>
</div>

</body>
</html>
