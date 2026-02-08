<?php
session_start();
include '../config/db.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = mysqli_query($conn,
        "SELECT * FROM admin WHERE username='$username' AND password='$password'"
    );

    if(mysqli_num_rows($query) == 1){
        $_SESSION['admin'] = true;
        header("Location: add_event.php");
        exit;
    } else {
        $error = "Invalid credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">
<h2>Admin Login</h2>

<form method="post" class="form-card">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button name="login">Login</button>
<p style="color:red;"><?php echo $error ?? ''; ?></p>
</form>
</div>

</body>
</html>
