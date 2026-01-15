<?php
include('db.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Rooms - Kerrio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            text-align: center;
            padding-top: 40px;
        }
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #2e8b57;
            color: white;
        }
        tr:hover {
            background: #f1f1f1;
        }
        h2 {
            color: #2e8b57;
        }
        a {
            text-decoration: none;
            background: #2e8b57;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            display: inline-block;
            margin: 10px;
        }
        a:hover {
            background: #256d46;
        }
    </style>
</head>
<body>
    <h2>All Registered Rooms</h2>
    <a href="add_room.php">➕ Add New Room</a>
    <a href="admin.php">← Back to Admin</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Room Number</th>
            <th>Capacity</th>
            <th>Price</th>
            <th>Status</th>
        </tr>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM rooms");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>".$row['id']."</td>
                    <td>".$row['room_number']."</td>
                    <td>".$row['capacity']."</td>
                    <td>".$row['price']."</td>
                    <td>".$row['status']."</td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
