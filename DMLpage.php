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
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

/* Background */
body {
    background-color: #ffffff;
    color: #000000;
}
/* Sidebar */
.sidebar {
    width: 250px;
    height: 100vh;
    background: linear-gradient(to right, #adaffc, #6fa9e3);
    color: black;
    padding: 20px;
    position: fixed;
    top: 0;
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
    color:black
    #000000;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
    border-radius: 8px;
    transition: 0.3s;
}

.sidebar ul li a:hover,
.sidebar ul li a.active {
    background: #2563eb;
    color: Black;
}

/* Main Content */
.main-content {
    margin-left: 250px;
    padding: 40px;
}

/* Top Header */
.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    color: balck;
}

.user-info {
    background: white;
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 14px;
    color: #333;
}

/* Table Container */
.container {
    background: linear-gradient(to right, #adaffc, #6fa9e3);
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

/* Table */
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
}

tbody tr:hover {
    background: linear-gradient(to right, #828bed, #80bffe);
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

</style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>DML Panel</h2>
    <ul>
        <li><a href="#">🏠 Dashboard</a></li>
        <li><a href="#" class="active">📄 Missions</a></li>
        <li><a href="#">👥 Users</a></li>
        <li><a href="#">📊 Reports</a></li>
        <li><a href="#">⚙ Settings</a></li>
        <li><a href="logout.php">🚪 Logout</a></li>
    </ul>
</div>

<!-- Main Content -->
<div class="main-content">

    <div class="topbar">
        <img src="logo.png" alt="Profile" width="150">
        <h1>Mission List</h1>
        <div class="user-info">
            Welcome, <?php echo htmlspecialchars($firstName); ?>
        </div>
    </div>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
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
                    <td>1</td>
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
            </tbody>
        </table>
    </div>

</div>

</body>
</html>