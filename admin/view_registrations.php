<?php
include '../config/db.php';

session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Event Registrations</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">
    <h1>📋 Student Registrations</h1>

    <table>
        <tr>
            <th>Event</th>
            <th>Student Name</th>
            <th>Email</th>
            <th>Department</th>
        </tr>

        <?php
        $query = "
            SELECT events.title, registrations.student_name, registrations.email, registrations.department
            FROM registrations
            JOIN events ON registrations.event_id = events.id
            ORDER BY events.event_date
        ";

        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['title']}</td>
                    <td>{$row['student_name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['department']}</td>
                  </tr>";
        }
        ?>
    </table>

    <a href="add_event.php" class="btn">Add Event</a>
    <a href="../index.php" class="btn">Back to Home</a>
</div>

</body>
</html>
