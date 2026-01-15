<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Kerrio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            padding-top: 50px;
            text-align: center;
        }
        h1 {
            color: #2e8b57;
        }
        .container {
            background: white;
            width: 80%;
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        a {
            text-decoration: none;
            background: #2e8b57;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            display: inline-block;
            margin: 8px;
        }
        a:hover {
            background: #256d46;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #2e8b57;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Kerrio Admin Dashboard</h1>
        <p>Welcome to the admin panel. Here you can manage users and rooms.</p>

        <h2>Admin Dashboard</h2>
<nav>
    <a href="view_users.php">View Users</a> |
    <a href="add_room.php">Add Room</a> |
    <a href="view_rooms.php">View Rooms</a> |
    <a href="add_payment.php">Add Payment</a> |
    <a href="view_payments.php">View Payments</a>
</nav>
<hr>


        <hr>

        <table>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
            </tr>
            <?php
            include('db.php');
            $result = mysqli_query($conn, "SELECT id, fullname, email FROM users");
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>".$row['id']."</td>
                        <td>".$row['fullname']."</td>
                        <td>".$row['email']."</td>
                      </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
