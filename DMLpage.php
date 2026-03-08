```php
<?php
session_start();

if (!isset($_SESSION["userID"])) {
    header("Location: index.html");
    exit;
}

$firstName = $_SESSION["first_name"] ?? "User";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>DML Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:#ffffff;
color:#000;
}

/* SIDEBAR */

.sidebar{
position:fixed;
left:0;
top:0;
width:70px;
height:100vh;
background:linear-gradient(180deg,#05005a,#020038);
display:flex;
flex-direction:column;
padding-top:20px;
transition:0.3s;
overflow:hidden;
}

.sidebar.active{
width:220px;
}

.menu-btn{
color:white;
font-size:24px;
background:none;
border:none;
margin-left:20px;
margin-bottom:30px;
cursor:pointer;
}

.sidebar a{
display:flex;
align-items:center;
gap:15px;
padding:12px 20px;
color:white;
text-decoration:none;
transition:0.3s;
}

.sidebar a:hover{
background:#0b0b8b;
}

.icon{
font-size:20px;
min-width:30px;
text-align:center;
}

.text{
opacity:0;
transition:0.3s;
}

.sidebar.active .text{
opacity:1;
}

.logout{
margin-top:auto;
margin-bottom:20px;
}

/* MAIN CONTENT */

.main-content{
margin-left:80px;
padding:40px;
transition:0.3s;
}

.sidebar.active ~ .main-content{
margin-left:230px;
}

/* TOPBAR */

.topbar{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
}

.search-bar{
display:flex;
gap:10px;
}

.search-bar input{
padding:8px 15px;
border-radius:20px;
border:1px solid #ccc;
outline:none;
}

.search-bar input:focus{
border-color:#00407f;
box-shadow:0 0 5px rgba(0,64,127,0.3);
}

.user-info{
background:white;
padding:8px 15px;
border-radius:20px;
font-size:14px;
}

/* TABLE */

.container{
background:linear-gradient(#1d1f69,#00407f);
padding:25px;
border-radius:12px;
box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

table{
width:100%;
border-collapse:collapse;
}

thead{
background:#f1f5f9;
}

th,td{
padding:12px;
text-align:left;
font-size:14px;
}

tbody tr{
border-bottom:1px solid #eee;
color:white;
transition:0.2s;
}

tbody tr:hover{
background:linear-gradient(to right,#10175f,#1f6ebc);
cursor:pointer;
}

/* STATUS BADGES */

.badge{
padding:4px 10px;
border-radius:20px;
font-size:12px;
color:white;
}

.active-status{background:#22c55e;}
.pending{background:#facc15;color:#333;}
.rejected{background:#ef4444;}

/* ACTIONS */

.action{
cursor:pointer;
margin-right:10px;
}

.edit{color:#2563eb;}
.delete{color:#ef4444;}

/* NOTIFICATION */

.Notification{
margin-top:20px;
}

.Notification-btn{
background:linear-gradient(to right,#1d1f69,#00407f);
color:white;
width:100%;
padding:10px;
border:none;
border-radius:8px;
cursor:pointer;
}

.Notification-btn:hover{
background:linear-gradient(to right,#000435,#001f3f);
}

</style>
</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

<button id="menuBtn" class="menu-btn">☰</button>

<a href="Dahboard.ph"><span class="icon">⎙</span><span class="text">Dashboard</span></a>
<a href="Profile.php"><span class="icon">👤</span><span class="text">Profile</span></a>
<a href="Notification.php"><span class="icon">💬</span><span class="text">Messages</span></a>
<a href="#Missions.php"><span class="icon">🗁</span><span class="text">Files</span></a>
<a href="BookingPage.php"><span class="icon"></span><span class="text">Settings</span></a>  
<a href="Setting.php"><span class="icon">⚙</span><span class="text">Settings</span></a>

<div class="logout">
<a href="logout.php"><span class="icon">☚</span><span class="text">Logout</span></a>
</div>

</div>

<!-- MAIN CONTENT -->

<div class="main-content">

<div class="topbar">

<img src="logo.png" width="150">

<div class="search-bar">
<input type="text" id="searchInput" placeholder="🔍 Search missions">
<input type="date" id="dateFilter">
</div>

<div class="user-info">
Welcome, <?php echo htmlspecialchars($firstName); ?>
</div>

</div>

<!-- TABLE -->

<div class="container">

<table>

<thead>
<tr>
<th>ID</th>
<th>Full Name</th>
<th>Title</th>
<th>Destination</th>
<th>Start Date</th>
<th>Status</th>
<th>End Date</th>
<th>Actions</th>
</tr>
</thead>

<tbody>

<tr onclick="openMission(3)">
<td>3</td>
<td>Hamzaoui Sarah</td>
<td>Business Trip</td>
<td>Paris</td>
<td>2026-02-20</td>
<td><span class="badge active-status">Active</span></td>
<td>2026-02-25</td>
<td>
<span class="action edit">✏</span>
<span class="action delete">🗑</span>
</td>
</tr>

<tr onclick="openMission(2)">
<td>2</td>
<td>Zeraouti Lyna</td>
<td>Business Trip</td>
<td>Spain</td>
<td>2026-01-05</td>
<td><span class="badge pending">Pending</span></td>
<td>2026-01-15</td>
<td>
<span class="action edit">✏</span>
<span class="action delete">🗑</span>
</td>
</tr>

<tr onclick="openMission(1)">
<td>1</td>
<td>Roumane Lydia</td>
<td>Business Trip</td>
<td>Italy</td>
<td>2025-12-04</td>
<td><span class="badge rejected">Rejected</span></td>
<td>2025-12-13</td>
<td>
<span class="action edit">✏</span>
<span class="action delete">🗑</span>
</td>
</tr>

</tbody>
</table>

</div>

<div class="Notification">
<p>Send notification here:</p>
<button class="Notification-btn">Notification</button>
</div>

</div>

<script>

/* Sidebar */

const menuBtn = document.getElementById("menuBtn");
const sidebar = document.querySelector(".sidebar");

menuBtn.addEventListener("click",(e)=>{
e.stopPropagation();
sidebar.classList.toggle("active");
});

document.addEventListener("click",function(e){
if(!sidebar.contains(e.target) && !menuBtn.contains(e.target)){
sidebar.classList.remove("active");
}
});

/* Search + Date Filter */

const searchInput=document.getElementById("searchInput");
const dateFilter=document.getElementById("dateFilter");
const rows=document.querySelectorAll("tbody tr");

function filterTable(){

let search=searchInput.value.toLowerCase();
let date=dateFilter.value;

rows.forEach(row=>{

let text=row.textContent.toLowerCase();
let start=row.cells[4].textContent.trim();

let matchSearch=text.includes(search);
let matchDate=(date==="")||start===date;

row.style.display=(matchSearch && matchDate)?"":"none";

});
}

searchInput.addEventListener("keyup",filterTable);
dateFilter.addEventListener("change",filterTable);

/* Open mission */

function openMission(id){
window.location.href="missionDetails.php?id="+id;
}

</script>

</body>
</html>
```
