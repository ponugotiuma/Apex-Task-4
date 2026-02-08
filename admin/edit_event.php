<?php
session_start();
include '../config/db.php';
if(!isset($_SESSION['admin'])) header("Location: login.php");

$id = $_GET['id'];
$event = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM events WHERE id=$id"));

if(isset($_POST['update'])){
    mysqli_query($conn,"UPDATE events SET
        title='$_POST[title]',
        description='$_POST[description]',
        event_date='$_POST[event_date]',
        location='$_POST[location]'
        WHERE id=$id");
    header("Location: add_event.php");
}
?>
<html>
<head>
<link rel="stylesheet" href="../assets/style.css">
<title>Edit Events</title>
</head>
<body>
<form method="post" class="form-card">
<input name="title" value="<?= $event['title'] ?>" required>
<textarea name="description"><?= $event['description'] ?></textarea>
<input type="date" name="event_date" value="<?= $event['event_date'] ?>">
<input name="location" value="<?= $event['location'] ?>">
<button name="update">Update Event</button>
</form>
</body>
</html>
