<?php
include('includes/db_connect.php');
session_start();

// Optional: check if admin is logged in
// if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
//     header("Location: login.php");
//     exit();
// }

// Delete room if 'delete_id' is set
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt = $conn->prepare("DELETE FROM rooms WHERE id=?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    header("Location: rooms_list.php");
    exit();
}

// Fetch all rooms
$result = $conn->query("SELECT * FROM rooms ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rooms List - Kerrio</title>
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
        a{
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 5px;
            color: white;
        }
        a.edit{
            background: orange;
        }
        a.delete{
            background: red;
        }
        a:hover{
            opacity: 0.8;
        }
        h2{
            text-align: center;
        }
        .add-room{
            display: block;
            width: 150px;
            margin: 10px auto;
            text-align: center;
            background: teal;
            color: white;
            padding: 8px 0;
            border-radius: 6px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>All Rooms</h2>
    <a class="add-room" href="add_room.php">Add New Room</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Room Number</th>
            <th>Type</th>
            <th>Capacity</th>
            <th>Price</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php if($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['room_number']; ?></td>
                    <td><?php echo $row['room_type']; ?></td>
                    <td><?php echo $row['capacity']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <a class="edit" href="edit_room.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a class="delete" href="rooms_list.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this room?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No rooms found.</td>
            </tr>
        <?php endif; ?>
    </table>
</div>

</body>
</html>
