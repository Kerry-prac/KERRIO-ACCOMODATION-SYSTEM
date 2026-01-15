<?php
include('includes/db_connect.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if room ID is provided
if (!isset($_GET['id'])) {
    header("Location: rooms_view.php");
    exit();
}

$room_id = $_GET['id'];

// Fetch room details
$stmt = $conn->prepare("SELECT * FROM rooms WHERE id = ?");
$stmt->bind_param("i", $room_id);
$stmt->execute();
$result = $stmt->get_result();
$room = $result->fetch_assoc();

if (!$room || $room['status'] == 'Booked') {
    echo "<script>alert('Room is already booked or not found.'); window.location='rooms_view.php';</script>";
    exit();
}

// Handle booking
if (isset($_POST['book_room'])) {
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("INSERT INTO bookings (user_id, room_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $room_id);

    if ($stmt->execute()) {
        // Update room status to Booked
        $update = $conn->prepare("UPDATE rooms SET status='Booked' WHERE id=?");
        $update->bind_param("i", $room_id);
        $update->execute();

        echo "<script>alert('Room booked successfully!'); window.location='rooms_view.php';</script>";
        exit();
    } else {
        $message = "Failed to book the room. Try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Room - Kerrio</title>
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
            text-align: center;
        }
        input, button{
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 6px;
            border: 1px solid gray;
        }
        button{
            background: teal;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover{
            opacity: 0.8;
        }
        .message{
            color: red;
            margin-bottom: 10px;
        }
        a{
            display: block;
            margin-top: 15px;
            text-decoration: none;
            color: teal;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Book Room: <?php echo $room['room_number']; ?></h2>

    <?php if(isset($message)) echo "<p class='message'>$message</p>"; ?>

    <form method="POST" action="">
        <p>Room Type: <?php echo $room['room_type']; ?></p>
        <p>Capacity: <?php echo $room['capacity']; ?></p>
        <p>Price: <?php echo $room['price']; ?></p>

        <button type="submit" name="book_room">Confirm Booking</button>
    </form>

    <a href="rooms_view.php">Back to Rooms</a>
</div>

</body>
</html>
