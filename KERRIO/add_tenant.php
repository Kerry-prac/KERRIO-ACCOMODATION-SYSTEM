<?php
include('db.php');

if (isset($_POST['save'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $room_id = $_POST['room_id'];

    // Insert tenant record
    $query = "INSERT INTO tenants (fullname, email, room_id) VALUES ('$fullname', '$email', '$room_id')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Tenant added successfully!'); window.location='view_tenants.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Tenant - Kerrio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            text-align: center;
            padding-top: 40px;
        }
        form {
            background: white;
            width: 400px;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        input, select {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 6px;
        }
        button {
            background: #2e8b57;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #256d46;
        }
        a {
            text-decoration: none;
            color: #2e8b57;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2>Add New Tenant</h2>
    <form method="POST">
        <input type="text" name="fullname" placeholder="Full Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>

        <select name="room_id" required>
            <option value="">-- Select Room --</option>
            <?php
            $rooms = mysqli_query($conn, "SELECT * FROM rooms");
            while ($r = mysqli_fetch_assoc($rooms)) {
                echo "<option value='".$r['id']."'>".$r['room_number']." (".$r['status'].")</option>";
            }
            ?>
        </select><br>

        <button type="submit" name="save">Save Tenant</button>
    </form>
    <a href="admin.php">← Back to Admin</a>
</body>
</html>
