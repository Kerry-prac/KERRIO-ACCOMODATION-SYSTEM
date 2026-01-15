<?php
include('db.php');

$sql = "SELECT * FROM payments ORDER BY date_paid DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Payments | Kerrio</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6f8;
        margin: 0;
        padding: 20px;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    table {
        width: 90%;
        margin: 20px auto;
        border-collapse: collapse;
        background: white;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #007bff;
        color: white;
        text-transform: uppercase;
        font-size: 14px;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    .no-data {
        text-align: center;
        padding: 20px;
        color: #888;
    }

    .btn {
        display: block;
        width: 200px;
        margin: 20px auto;
        text-align: center;
        padding: 10px;
        background: #28a745;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

    .btn:hover {
        background: #218838;
    }
</style>
</head>
<body>

<h2>All Payments</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Student Name</th>
        <th>Tenant ID</th>
        <th>Amount</th>
        <th>Date Paid</th>
        <th>Method</th>
    </tr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['student_name']}</td>";
            echo "<td>{$row['tenant_id']}</td>";
            echo "<td>Ksh {$row['amount']}</td>";
            echo "<td>{$row['date_paid']}</td>";
            echo "<td>{$row['method']}</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6' class='no-data'>No payments found</td></tr>";
    }
    ?>
</table>

<a href="add_payment.php" class="btn">Add New Payment</a>

</body>
</html>
