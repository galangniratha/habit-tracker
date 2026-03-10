<!DOCTYPE html>
<html>

<head>

<title>Habit Tracker Login</title>

<style>

body{
background:linear-gradient(135deg,#0f172a,#1e3a8a);
font-family:Arial;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
color:white;
}

.card{
background:#020617;
padding:40px;
border-radius:10px;
width:300px;
}

input{
width:100%;
padding:10px;
margin:10px 0;
border:none;
border-radius:5px;
}

button{
width:100%;
padding:10px;
background:#3b82f6;
border:none;
color:white;
}

a{color:#3b82f6}

</style>

</head>

<body>

<div class="card">

<h2>Login</h2>

<form action="auth/login_process.php" method="POST">

<input type="email" name="email" placeholder="Email">

<input type="password" name="password" placeholder="Password">

<button>Login</button>

</form>

<p>Belum punya akun?</p>

<a href="register.php">Register</a>

</div>

</body>
</html>