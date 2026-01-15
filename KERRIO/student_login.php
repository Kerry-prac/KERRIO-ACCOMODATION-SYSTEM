<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admission = $_POST['admission'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM students WHERE admission=?");
    $stmt->bind_param("s", $admission);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['student_id'] = $id;
            header("Location: student_dashboard.php");
            exit();
        } else {
            $error = "Wrong student password";
        }
    } else {
        $error = "Student not found";
    }
}
?>
<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
}
?>
