
<?php
include '../config/db.php';

session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}


if (isset($_POST['add_event'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    $location = $_POST['location'];

    mysqli_query(
        $conn,
        "INSERT INTO events (title, description, event_date, location)
         VALUES ('$title', '$description', '$event_date', '$location')"
    );

    header("Location: add_event.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Event</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">
    <h1>🧑‍💼 Add New Event</h1>

    <form method="post" class="form-card">
        <input type="text" name="title" placeholder="Event Title" required>
        <textarea name="description" placeholder="Event Description" required></textarea>
        <input type="date" name="event_date" required>
        <input type="text" name="location" placeholder="Event Location" required>

        <button type="submit" name="add_event">Add Event</button>
    </form>
<?php
$result = mysqli_query($conn,"SELECT * FROM events");
while($row = mysqli_fetch_assoc($result)){
?>
<div class="event-card">
<b><?= $row['title'] ?></b><br>
<a class="btn" href="edit_event.php?id=<?= $row['id'] ?>">Edit</a>
<a class="btn" href="delete_event.php?id=<?= $row['id'] ?>"
   onclick="return confirm('Delete this event?')">Delete</a>
</div>
<?php } ?>


    <a href="view_registrations.php" class="btn">View Registrations</a>
    <a href="../index.php" class="btn">Back to Home</a>
</div>

</body>
</html>
