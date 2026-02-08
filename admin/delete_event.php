<?php
session_start();
include '../config/db.php';
if(!isset($_SESSION['admin'])) header("Location: login.php");

$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM events WHERE id=$id");
header("Location: add_event.php");
