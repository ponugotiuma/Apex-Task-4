<?php
include 'config/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
  <link rel="stylesheet" href="assets/style.css">
<title>College Event Management</title>
    
</head>
<body>

<div class="container">
    <h1>📅 College Events</h1>

    <?php
    $result = mysqli_query($conn, "SELECT * FROM events ORDER BY event_date ASC");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <div class="event-card">
            <h2><?php echo htmlspecialchars($row['title']); ?></h2>
            <p><?php echo htmlspecialchars($row['description']); ?></p>
            <p><strong>Date:</strong> <?php echo $row['event_date']; ?></p>
            <p><strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></p>

            <a href="register.php?event_id=<?php echo $row['id']; ?>" class="btn">
                Register
            </a>
        </div>
    <?php
        }
    } else {
        echo "<p>No upcoming events.</p>";
    }
    ?>
</div>

</body>
</html>
