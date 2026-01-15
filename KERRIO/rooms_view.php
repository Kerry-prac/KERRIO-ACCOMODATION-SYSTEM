<?php
include('includes/db_connect.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all rooms
$result = $conn->query("SELECT * FROM rooms ORDER BY room_number ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Rooms - Kerrio</title>
    <style>
        body{
            font-family: Arial;
            background: #f2f6fc;
        }
        .container{
            width: 90%;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td{
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th{
            background: teal;
            color: white;
        }
        h2{
            text-align: center;
        }
        .book-btn{
            padding: 6px 10px;
            background: teal;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }
        .book-btn:hover{
            opacity: 0.8;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Available Rooms</h2>

    <table>
        <tr>
            <th>Room Number</th>
            <th>Type</th>
            <th>Capacity</th>
            <th>Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php if($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['room_number']; ?></td>
                    <td><?php echo $row['room_type']; ?></td>
                    <td><?php echo $row['capacity']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <?php if($row['status'] == 'Available'): ?>
                            <a class="book-btn" href="book_room.php?id=<?php echo $row['id']; ?>">Book</a>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No rooms available.</td>
            </tr>
        <?php endif; ?>
    </table>
</div>

</body>
</html>
