<?php
include('includes/db_connect.php');
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$tenant_id = $_SESSION['user_id'];
$message = "";

if (isset($_GET['book_id'])) {
    $room_id = $_GET['book_id'];

    $stmt = $conn->prepare("SELECT * FROM rooms WHERE id=? AND status='Available'");
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {    
        $stmt2 = $conn->prepare("INSERT INTO bookings (user_id, room_id) VALUES (?, ?)");
        $stmt2->bind_param("ii", $tenant_id, $room_id);
        $stmt2->execute();
        $stmt3 = $conn->prepare("UPDATE rooms SET status='Booked' WHERE id=?");
        $stmt3->bind_param("i", $room_id);
        $stmt3->execute();

        $message = "Room booked successfully!";
    } else {
        $message = "Room is already booked.";
    }
}


$rooms = $conn->query("SELECT * FROM rooms ORDER BY room_number ASC");

$bookings = $conn->query("
    SELECT b.id as booking_id, r.room_number, r.room_type, r.capacity, r.price, b.booking_date
    FROM bookings b
    JOIN rooms r ON b.room_id = r.id
    WHERE b.user_id = $tenant_id
    ORDER BY b.booking_date DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tenant Dashboard - Kerrio</title>
    <style>
        body { font-family: Arial; background: #f2f6fc; margin:0; padding:0; }
        .container { width: 90%; margin: 30px auto; }
        h2 { text-align: center; }
        .message { text-align: center; color: green; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background: teal; color: white; }
        a.book-btn { padding: 6px 10px; background: teal; color: white; border-radius: 5px; text-decoration: none; }
        a.book-btn:hover { opacity: 0.8; }
    </style>
</head>
<body>

<div class="container">
    <h2>Welcome, <?php echo $_SESSION['fullname']; ?></h2>

    <?php if($message) echo "<p class='message'>$message</p>"; ?>

    <h3>Available Rooms</h3>
    <table>
        <tr>
            <th>Room Number</th>
            <th>Type</th>
            <th>Capacity</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <?php if($rooms->num_rows > 0): ?>
            <?php while($room = $rooms->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $room['room_number']; ?></td>
                    <td><?php echo $room['room_type']; ?></td>
                    <td><?php echo $room['capacity']; ?></td>
                    <td><?php echo $room['price']; ?></td>
                    <td>
                        <?php if($room['status'] == 'Available'): ?>
                            <a class="book-btn" href="?book_id=<?php echo $room['id']; ?>">Book</a>
                        <?php else: ?>
                            Booked
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5">No rooms available.</td></tr>
        <?php endif; ?>
    </table>

    <h3>Your Booking History</h3>
    <table>
        <tr>
            <th>Room Number</th>
            <th>Type</th>
            <th>Capacity</th>
            <th>Price</th>
            <th>Booking Date</th>
        </tr>
        <?php if($bookings->num_rows > 0): ?>
            <?php while($b = $bookings->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $b['room_number']; ?></td>
                    <td><?php echo $b['room_type']; ?></td>
                    <td><?php echo $b['capacity']; ?></td>
                    <td><?php echo $b['price']; ?></td>
                    <td><?php echo $b['booking_date']; ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5">You have no bookings yet.</td></tr>
        <?php endif; ?>
    </table>

    <p style="text-align:center;"><a href="logout.php">Logout</a></p>
</div>

</body>
</html>
