<?php
include('db.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Tenants - Kerrio</title>
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
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #2e8b57;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #2e8b57;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Tenant List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Room</th>
        </tr>

        <?php
        $query = "SELECT tenants.id, tenants.fullname, tenants.email, rooms.room_number 
                  FROM tenants 
                  LEFT JOIN rooms ON tenants.room_id = rooms.id";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['fullname']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['room_number']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No tenants found</td></tr>";
        }
        ?>
    </table>

    <a href="admin.php">← Back to Admin</a>
</body>
</html>
