<?php
include 'config/db.php';

/* Check if event_id exists */
if (!isset($_GET['event_id'])) {
    header("Location: index.php");
    exit;
}

$event_id = $_GET['event_id'];

/* Fetch event details */
$eventQuery = mysqli_query($conn, "SELECT * FROM events WHERE id = '$event_id'");
$event = mysqli_fetch_assoc($eventQuery);

if (!$event) {
    echo "Invalid event selected.";
    exit;
}

/* Handle form submission */
if (isset($_POST['register'])) {

    $student_name = $_POST['student_name'];
    $email = $_POST['email'];
    $department = $_POST['department'];

    mysqli_query(
        $conn,
        "INSERT INTO registrations (event_id, student_name, email, department)
         VALUES ('$event_id', '$student_name', '$email', '$department')"
    );

    header("Location: success.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Registration</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container">
    <h1>Register for Event</h1>

    <div class="event-card">
        <h2><?php echo htmlspecialchars($event['title']); ?></h2>
        <p><?php echo htmlspecialchars($event['description']); ?></p>
        <p><strong>Date:</strong> <?php echo $event['event_date']; ?></p>
        <p><strong>Location:</strong> <?php echo htmlspecialchars($event['location']); ?></p>
    </div>

    <form method="post" class="form-card">
        <input type="text" name="student_name" placeholder="Student Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="text" name="department" placeholder="Department" required>

        <button type="submit" name="register">Register</button>
    </form>
</div>

</body>
</html>
