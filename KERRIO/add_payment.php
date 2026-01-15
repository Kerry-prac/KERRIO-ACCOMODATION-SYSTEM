<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_name = $_POST['student_name'];
    $tenant_id = $_POST['tenant_id'];
    $amount = $_POST['amount'];
    $date_paid = $_POST['date_paid'];
    $method = $_POST['method'];

    $sql = "INSERT INTO payments (student_name, tenant_id, amount, date_paid, method)
            VALUES ('$student_name', '$tenant_id', '$amount', '$date_paid', '$method')";

    if (mysqli_query($conn, $sql)) {
        echo "<p style='color:green;'>Payment added successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>

<h2>Add Payment</h2>
<form method="POST">
    <label>Student Name:</label><br>
    <input type="text" name="student_name" required><br><br>

    <label>Tenant ID:</label><br>
    <input type="text" name="tenant_id" required><br><br>

    <label>Amount:</label><br>
    <input type="number" step="0.01" name="amount" required><br><br>

    <label>Date Paid:</label><br>
    <input type="date" name="date_paid" required><br><br>

    <label>Payment Method:</label><br>
    <select name="method" required>
        <option value="Cash">Cash</option>
        <option value="M-Pesa">M-Pesa</option>
        <option value="Bank Transfer">Bank Transfer</option>
    </select><br><br>

    <button type="submit">Add Payment</button>
</form>
