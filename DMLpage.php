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

/* Search bar FIXED */
.search-bar {
    display: flex;
    align-items: center;
    gap: 10px;
}

.search-bar input {
    padding: 8px 15px;
    border-radius: 20px;
    border: 1px solid #ccc;
    outline: none;
    width: 200px;
    transition: 0.3s;
}

.search-bar input:focus {
    border-color: #00407f;
    box-shadow: 0 0 5px rgba(0, 64, 127, 0.3);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background-color: #ffffff;
    color: #000000;
}

/* Sidebar */
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

/* Top Header */
.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    gap: 20px;
}

.user-info {
    background: white;
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 14px;
}

/* Table Container */
.container {
    background:linear-gradient(#1d1f69,#00407f);
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background: #f1f5f9;
}

th, td {
    padding: 12px;
    text-align: left;
    font-size: 14px;
}

tbody tr {
    border-bottom: 1px solid #eee;
    color:white;
}

tbody tr:hover {
    background: linear-gradient(to right, #10175f, #1f6ebc);
}

/* Status badge */
.badge {
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    color: white;
}

.active { background: #22c55e; }
.pending { background: #facc15; color: #333; }
.rejected { background: #ef4444; }

/* Action icons */
.action {
    cursor: pointer;
    margin-right: 10px;
}
.edit { color: #2563eb; }
.delete { color: #ef4444; }

/* Notification */
.Notification {
    margin-top: 20px;
}

.Notification-btn{
    background: linear-gradient(to right, #1d1f69, #00407f);
    color:white;
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: 0.3s;
}

.Notification-btn:hover{
    background: linear-gradient(to right, #000435, #001f3f);
    box-shadow: 0 0 5px rgba(0, 78, 146, 0.4);
}

</style>
</head>

<body>

<!-- Sidebar -->
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

<!-- Main Content -->
<div class="main-content">

    <div class="topbar">
        <button id="menuBtn" style="font-size:22px;border:none;background:none;cursor:pointer;">
☰
</button>
        <img src="logo.png" alt="Profile" width="150">
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="🔍 Search missions...">
            <input type="date" id="dateFilter">
        </div>

        <div class="user-info">
            Welcome, <?php echo htmlspecialchars($firstName); ?>
        </div>
    </div>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full name</th>
                    <th>Title</th>
                    <th>Destination</th>
                    <th>Start Date</th>
                    <th>Status</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>3</td>
                    <td>Hamzaoui sarah</td>
                    <td>Business Trip</td>
                    <td>Paris</td>
                    <td>2026-02-20</td>
                    <td><span class="badge active">Active</span></td>
                    <td>2026-02-25</td>
                    <td>
                        <span class="action edit">✏</span>
                        <span class="action delete">🗑</span>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Zeraouti lyna</td>
                    <td>Business trip</td>
                    <td>Spain</td>
                    <td>2026-01-05</td>
                    <td><span class="badge pending">Pending</span></td>
                    <td>2026-01-15</td>
                    <td>
                        <span class="action edit">✏</span>
                        <span class="action delete">🗑</span>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Roumane lydia</td>
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

    <!-- Notification Back -->
    <div class="Notification">
        <p>Send notification here:</p>
        <button class="Notification-btn">Notification</button>
    </div>

</div>

<script>
const searchInput = document.getElementById("searchInput");
const dateFilter = document.getElementById("dateFilter");

function filterTable() {
    let searchValue = searchInput.value.toLowerCase();
    let selectedDate = dateFilter.value;
    let rows = document.querySelectorAll("tbody tr");

    rows.forEach(row => {
        let rowText = row.textContent.toLowerCase();
        let startDate = row.cells[4].textContent.trim();

        let matchesSearch = rowText.includes(searchValue);
        let matchesDate = selectedDate === "" || startDate === selectedDate;

        row.style.display = (matchesSearch && matchesDate) ? "" : "none";
});
}

searchInput.addEventListener("keyup", filterTable);
dateFilter.addEventListener("change", filterTable);
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