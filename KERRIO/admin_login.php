<?php
include('db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Match with admins table
    $sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin'] = $username;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "<p style='color:red;text-align:center;'>Invalid admin credentials!</p>";
    }
}
?>

<h2 style="text-align:center;">Admin Login</h2>
<form method="POST" style="max-width:300px;margin:auto;background:#f9f9f9;padding:20px;border-radius:8px;">
    <label>Username:</label><br>
    <input type="text" name="username" required style="width:100%;padding:8px;"><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required style="width:100%;padding:8px;"><br><br>

    <button type="submit" style="width:100%;background:#007bff;color:white;padding:8px;border:none;border-radius:5px;">
        Login as Admin
    </button>
</form>
