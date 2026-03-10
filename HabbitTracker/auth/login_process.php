<?php

session_start();
include "../config/database.php";

$email = $_POST['email'];
$password = $_POST['password'];

$query = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

$user = mysqli_fetch_assoc($query);

if($user && password_verify($password,$user['password'])){

$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];

header("Location: ../dashboard/index.php");

}else{

echo "Login gagal";

}

?>