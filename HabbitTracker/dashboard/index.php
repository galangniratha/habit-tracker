<?php

session_start();
include "../config/database.php";

if(!isset($_SESSION['user_id'])){
header("Location: ../index.php");
exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$today = date("Y-m-d");
$today_text = date("l, d F Y");

$query = "SELECT * FROM habits 
WHERE user_id='$user_id'
AND created_at='$today'";

$result = mysqli_query($conn,$query);

$total=0;
$done=0;

while($row=mysqli_fetch_assoc($result)){
$total++;
if($row['status']==1){ $done++; }
}

$result = mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html>
<head>

<title>Habit Tracker</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
background:linear-gradient(135deg,#020617,#1e3a8a);
font-family:Segoe UI;
color:white;
margin:0;
}

.header{
display:flex;
justify-content:space-between;
align-items:center;
padding:20px;
}

.welcome{
font-size:22px;
font-weight:bold;
}

.subtext{
opacity:0.7;
font-size:14px;
}

.logout{
background:#ef4444;
padding:8px 15px;
border-radius:8px;
text-decoration:none;
color:white;
}

.container{
width:90%;
margin:auto;
margin-top:20px;
}

.card{
display:flex;
justify-content:space-between;
align-items:center;
padding:20px;
border-radius:18px;
margin-bottom:15px;
transition:0.3s;
}

.card:hover{
transform:scale(1.02);
}

.blue{
background:linear-gradient(135deg,#1e3a8a,#3b82f6);
}

.green{
background:linear-gradient(135deg,#064e3b,#10b981);
}

.teal{
background:linear-gradient(135deg,#134e4a,#14b8a6);
}

.habit-info{
display:flex;
gap:15px;
align-items:center;
}

.icon{
font-size:28px;
}

.button{
background:rgba(255,255,255,0.2);
border:none;
width:45px;
height:45px;
border-radius:50%;
color:white;
font-size:18px;
cursor:pointer;
}

.button:hover{
background:#22c55e;
}

.add-form{
margin:20px 0;
display:flex;
gap:10px;
}

.add-form input{
flex:1;
padding:10px;
border-radius:8px;
border:none;
}

.add-form button{
padding:10px 20px;
border:none;
background:#3b82f6;
color:white;
border-radius:8px;
}

.chart{
background:#020617;
padding:20px;
border-radius:15px;
margin-top:30px;
}

</style>

</head>

<body>

<div class="header">

<div>

<div class="welcome">
Halo <?php echo $username; ?> 👋
</div>

<div class="subtext">
Siap memulai kebiasaan baru hari ini?
</div>

<div class="subtext">
<?php echo $today_text; ?>
</div>

</div>

<a href="../auth/logout.php" class="logout">Logout</a>

</div>

<div class="container">

<form class="add-form" action="add_habit.php" method="POST">

<input type="text" name="habit_name" placeholder="Tambah kebiasaan baru..." required>

<button>Tambah</button>

</form>

<?php

$colors=["blue","green","teal"];
$icons=["🔥","📚","🏃","💧","🧘"];

$i=0;

while($row=mysqli_fetch_assoc($result)){
?>

<div class="card <?php echo $colors[$i%3]; ?>">

<div class="habit-info">

<div class="icon">
<?php echo $icons[$i%5]; ?>
</div>

<div>

<div style="font-size:18px;">
<?php echo $row['habit_name']; ?>
</div>

<div class="subtext">
Every day
</div>

</div>

</div>

<div>

<a href="toggle.php?id=<?php echo $row['id']; ?>">

<button class="button">

<?php echo $row['status']==1 ? "✔" : "+"; ?>

</button>

</a>

<a href="delete_habit.php?id=<?php echo $row['id']; ?>">

<button class="button" style="background:#ef4444;">🗑</button>

</a>

</div>

</div>

<?php
$i++;
}
?>

<div class="chart">

<h3>Evaluasi Habit Hari Ini</h3>

<canvas id="chart"></canvas>

</div>

</div>

<script>

const data = {
labels:['Selesai','Belum'],
datasets:[{
data:[<?php echo $done ?>,<?php echo $total-$done ?>],
backgroundColor:['#22c55e','#ef4444']
}]
};

new Chart(
document.getElementById('chart'),
{
type:'doughnut',
data:data
}
);

</script>

</body>
</html>