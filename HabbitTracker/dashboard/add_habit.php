<?php

session_start();
include "../config/database.php";

$user_id = $_SESSION['user_id'];

$name = $_POST['habit_name'];

$date = date("Y-m-d");

mysqli_query($conn,"INSERT INTO habits(user_id,habit_name,status,created_at)
VALUES('$user_id','$name',0,'$date')");

header("Location: index.php");

?>