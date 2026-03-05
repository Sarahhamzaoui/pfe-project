<?php
session_start();

if (!isset($_SESSION["userID"])) {
    header("Location: index.html");
    exit;
}

$first_name = $_SESSION["first_name"];
$userID = $_SESSION["userID"];
$role = $_SESSION["role"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Profile</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}
/* Sidebar */
.sidebar {
    width: 250px;
    height: 100vh;
    background: linear-gradient(to right, #1d1f69, #00407f);
    padding: 20px;
    position: fixed;
    top: 0;
    left: -250px; /* hidden */
    color: white;
    transition: 0.3s;
    z-index: 1000;
}

/* When sidebar is open */
.sidebar.active {
    background: linear-gradient(to right, #1d1f69, #00407f);    
    left: 0;
}

.sidebar h2 {
    margin-bottom: 40px;
    text-align: center;
}

.sidebar ul {
    list-style: none;
}

.sidebar ul li {
    margin-bottom: 20px;
}

.sidebar ul li a {
    text-decoration: none;
    color:white;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
    border-radius: 8px;
    transition: 0.3s;
}

.sidebar ul li a:hover,
.sidebar ul li a.active {
    background:linear-gradient(to right, #000435, #001f3f);
}

/* Main Content */
.main-content {
    padding: 40px;
}

body{
background:#ffffff;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.profile-container{
background:linear-gradient(#1d1f69,#00407f);
color:white;
width:420px;
padding:35px;
border-radius:15px;
box-shadow:0 10px 30px rgba(0,0,0,0.1);
text-align:center;
}

.profile-image{
width:110px;
height:110px;
border-radius:50%;
margin:auto;
margin-bottom:15px;
background:#ddd;
background-image:url('https://cdn-icons-png.flaticon.com/512/149/149071.png');
background-size:cover;
}

.profile-container h2{
margin-bottom:5px;
color:white;
}

.role{
color:white;
font-size:14px;
margin-bottom:25px;
}

.info{
text-align:left;
margin-top:10px;
}

.info p{
margin:10px 0;
font-size:14px;
color:white;
}

.label{
font-weight:600;
color:#222;
}

.buttons{
margin-top:25px;
display:flex;
justify-content:space-between;
}

button{
padding:10px 20px;
border:none;
border-radius:8px;
cursor:pointer;
font-size:14px;
}

.edit{
background:#4CAF50;
color:white;
}

.logout{
background:#ff4b5c;
color:white;
}

button:hover{
opacity:0.9;
}

</style>
</head>

<body>
    <div class="sidebar">
    <h2>DML Panel</h2>
    <ul>
        <li><a href="#">Dashboard</a></li>
        <li><a href="DMLpage.php">Missions</a></li>
        <li><a href="BookingPage.php"> Booking </a></li>
        <li><a href="Profile.php">Profile</a></li>
        <li><a href="#">⚙ Settings</a></li>
        <li><a href="logout.php"> Logout</a></li>
    </ul>
</div>
<div class="main-content">

    <div class="topbar">
        <button id="menuBtn" style="font-size:22px;border:none;background:none;cursor:pointer;">
☰
</button>
</div>
<div class="profile-container">
<div class="profile-image"></div>

<h2><?php echo $first_name; ?></h2>
<p class="role"><?php echo $role; ?></p>

<div class="info">
<p><span class="label">User ID:</span> <?php echo $_SESSION["userID"]; ?></p>
<p><span class="label">Email:</span> <?php echo $_SESSION["Email"]; ?></p>
<p><span class="label">First Name:</span> <?php echo $_SESSION["first_name"]; ?></p>
<p><span class="label">Role:</span> <?php echo $_SESSION["role"]; ?></p>
<p><span class="label">Phone</span>: <?php echo $_SESSION["phone"] ?? "Not provided"; ?></p>

</div>

<div class="buttons">
<button class="edit" onclick="window.location.href='EditProfile.php'">Edit Profile</button>
<button class="logout" onclick="window.location.href='logout.php'">Logout</button>
</div>

</div>
<script>
    const menuBtn = document.getElementById("menuBtn");
const sidebar = document.querySelector(".sidebar");

menuBtn.addEventListener("click", () => {
    sidebar.classList.toggle("active");
    document.addEventListener("click", function(e){
    if(!sidebar.contains(e.target) && !menuBtn.contains(e.target)){
        sidebar.classList.remove("active");
    }
});
});
</script>

</body>
</html>