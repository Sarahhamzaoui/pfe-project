<?php
session_start();

if (!isset($_SESSION["userID"])) {
    header("Location: index.html");
    exit;
}

$firstName = $_SESSION["first_name"] ?? "User";

// If form submitted, capture data (optional save logic here)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hotel = $_POST["hotel_name"];
    $checkin = $_POST["checkin_date"];
    $checkout = $_POST["checkout_date"];
    $guests = $_POST["guests"];
    $message = "Booking submitted for $hotel from $checkin to $checkout for $guests guest(s).";
}

// --- Example special residences (Algérie Télécom) ---
$specialResidences = [
    ["name" => "Résidence AT Alger", "city" => "Alger"],
    ["name" => "Résidence AT Oran", "city" => "Oran"],
    ["name" => "Résidence AT Constantine", "city" => "Constantine"],
];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>DML Hotel Booking</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif;}
body { background:#fff; }
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
.sidebar h2 {
    margin-bottom:40px;
    text-align:center;
}
.sidebar ul {
    list-style:none;
 }
.sidebar ul li {
    margin-bottom:20px;
}
.sidebar ul li a {
    text-decoration:none;
    color:white;
    display:flex;
    gap:10px;
    padding:10px;
    border-radius:8px;
    transition:0.3s;
}
.sidebar ul li a:hover,.sidebar ul li a.active { background:linear-gradient(to right,#000435,#001f3f); }

.main-content { 
    padding:40px; 
}
.topbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:30px; flex-wrap:wrap; gap:10px; }
.user-info { background:white; padding:8px 15px; border-radius:20px; font-size:14px; }

.form-container {
    background:linear-gradient(#1d1f69,#00407f); padding:30px; border-radius:12px; color:white;
    max-width:700px;
}

.form-group { margin-bottom:20px; }
.form-group label { display:block; margin-bottom:6px; font-size:14px; }
.form-group input, .form-group select { width:100%; padding:10px; border-radius:8px; border:none; outline:none; }

.submit-btn { background:white; color:#00407f; padding:10px; border:none; border-radius:8px; font-weight:600; cursor:pointer; width:100%; transition:0.3s; }
.submit-btn:hover { background:#e5e5e5; }

.hotel-list { margin-top:30px; }
.hotel-item { background:#f1f1f1; padding:15px; margin-bottom:15px; border-radius:8px; color:#000; }
.hotel-item span { font-weight:600; }
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
        <h1>Hotel Booking</h1>
        <div class="user-info">Welcome, <?php echo htmlspecialchars($firstName); ?></div>
    </div>

    <!-- Booking Form -->
    <div class="form-container">
        <form method="POST" action="">
            <div class="form-group">
                <label>Select Hotel / Residence</label>
                <select name="hotel_name" required>
                    <optgroup label="Special Résidences AT">
                        <?php foreach($specialResidences as $residence): ?>
                            <option value="<?php echo $residence['name']; ?>">
                                <?php echo $residence['name'] . " (" . $residence['city'] . ")"; ?>
                            </option>
                        <?php endforeach; ?>
                    </optgroup>
                    <optgroup label="Other Hotels">
                        <option value="Hotel Paris">Hotel Paris</option>
                        <option value="Hotel Lyon">Hotel Lyon</option>
                        <option value="Hotel Marseille">Hotel Marseille</option>
                    </optgroup>
                </select>
            </div>

            <div class="form-group">
                <label>Check-in Date</label>
                <input type="date" name="checkin_date" required>
            </div>

            <div class="form-group">
                <label>Check-out Date</label>
                <input type="date" name="checkout_date" required>
            </div>

            <div class="form-group">
                <label>Number of Guests</label>
                <input type="number" name="guests" min="1" value="1" required>
            </div>

            <button type="submit" class="submit-btn">Book Now</button>
        </form>

        <?php if(isset($message)): ?>
            <div style="margin-top:20px; padding:10px; background:#22c55e; border-radius:8px; color:white;">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Example Hotel List -->
    <div class="hotel-list">
        <h2> Hotels booking</h2>

        <div class="hotel-item">
            <span>Résidence AT Alger</span><br>
            City: Alger<br>
            Special for Algérie Télécom
        </div>

        <div class="hotel-item">
            <span>Hotel Paris</span><br>
            City: Paris<br>
            Standard hotel
        </div>

        <div class="hotel-item">
            <span>Résidence AT Oran</span><br>
            City: Oran<br>
            Special for Algérie Télécom
        </div>

        <div class="hotel-item">
            <span>Hotel Lyon</span><br>
            City: Lyon<br>
            Standard hotel
        </div>
        <div class="hotel-item">
            <span>Résidence AT Constantine</span><br>
            City: Constantine<br>
            Special for Algérie Télécom
    </div>
        <div class="hotel-item">
            <span>Hotel Marseille</span><br>
            City: Marseille<br>
            Standard hotel
        </div>
        <div class="hotel-item">
            <span>Résidence AT Nice</span><br>
            City: Nice<br>
            Special for Algérie Télécom
        </div>
        <div>
            <span>Hotel Bordeaux</span><br>
            City: Bordeaux<br>
            Standard hotel  
        </div>.
        <div class="hotel-item">
            <span>Résidence AT Annaba</span><br>
            City: Annaba<br>
            Special for Algérie Télécom
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