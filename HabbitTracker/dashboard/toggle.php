<?php

include "../config/database.php";

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT status FROM habits WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

$new = $row['status']==1 ? 0 : 1;

mysqli_query($conn,"UPDATE habits SET status='$new' WHERE id='$id'");

header("Location: index.php");

?>