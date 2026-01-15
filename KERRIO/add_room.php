<?php
include('includes/db_connect.php');
session_start();

// Optional: check if admin is logged in
// if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
//     header("Location: login.php");
//     exit();
// }

if (isset($_POST['add_room'])) {
    $room_number = $_POST['room_number'];
    $room_type = $_POST['room_type'];
    $capacity = $_POST['capacity'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("INSERT INTO rooms (room_number, room_type, capacity, price) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $room_number, $room_type, $capacity, $price);

    if($stmt->execute()){
        $message = "Room added successfully!";
    } else {
        $message = "Failed to add room. Try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Room - Kerrio</title>
    <style>
        body{
            font-family: Arial;
            background: #f2f6fc;
        }
        .container{
            width: 400px;
            margin: 50px auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        input, select{
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 15px;
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
        .message{
            text-align: center;
            margin-bottom: 15px;
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Add New Room</h2>

    <?php if(isset($message)){ echo "<p class='message'>$message</p>"; } ?>

    <form method="POST" action="">
        <label>Room Number</label>
        <input type="text" name="room_number" required>

        <label>Room Type</label>
        <select name="room_type" required>
            <option value="">Select Type</option>
            <option value="Single">Single</option>
            <option value="Double">Double</option>
            <option value="Suite">Suite</option>
        </select>

        <label>Capacity</label>
        <input type="number" name="capacity" required>

        <label>Price</label>
        <input type="number" name="price" required>

        <button type="submit" name="add_room">Add Room</button>
    </form>
</div>

</body>
</html>
