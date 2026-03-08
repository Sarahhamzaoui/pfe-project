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
<title>Mission Details</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}
input, textarea{
width:100%;
padding:8px;
border-radius:6px;
border:1px solid #ccc;
margin-top:5px;
}

.update{
margin-top:20px;
padding:10px 20px;
background:#00407f;
color:white;
border:none;
border-radius:6px;
cursor:pointer;
}

body{
background:#ffffff;
padding:40px;
}

.container{
max-width:600px;
margin:auto;
padding:30px;
border-radius:10px;
border-color: #00407f;
    box-shadow: 0 0 5px rgba(0, 64, 127, 0.3);
        background: linear-gradient(160deg,#0f1a5b,#00407f);
    backdrop-filter: blur(10px);

}

h1{
margin-bottom:25px;
color:#ffffff;
}

p{
margin-bottom:12px;
color:#555;
font-size:15px;
}

strong{
color:#111;
}
</style>
</head>

<body>

<div class="container">

<h1>Mission Details</h1>

<p><strong>Mission ID:</strong> <span id="mission_id">3</span></p>

<p><strong>Employee Name:</strong> 
<span id="employee">Hamzaoui Sarah</span></p>

<p><strong>Mission Type:</strong> 
<span id="type">Business Trip</span></p>

<p><strong>Destination:</strong> 
<span id="destination">Paris, France</span></p>

<p><strong>Start Date:</strong> 
<span id="start">2024-07-01</span></p>

<p><strong>End Date:</strong> 
<span id="end">2024-07-10</span></p>

<p><strong>Status:</strong> 
<span id="status">Approved</span></p>

<p><strong>Notes:</strong> 
<span id="notes">Flight and hotel booked. Awaiting final itinerary.</span></p>

</div>

<div class="buttons">
<button onclick="enableEdit()" class="update">Update</button>
</div>
<div class="buttons">
<button type="submit" name="update" class="update">Save Changes</button>
</div>
<script>
function enableEdit(){

document.getElementById("employee").innerHTML =
'<input type="text" value="Hamzaoui Sarah">';

document.getElementById("type").innerHTML =
'<input type="text" value="Business Trip">';

document.getElementById("destination").innerHTML =
'<input type="text" value="Paris, France">';

document.getElementById("start").innerHTML =
'<input type="date" value="2024-07-01">';

document.getElementById("end").innerHTML =
'<input type="date" value="2024-07-10">';

document.getElementById("status").innerHTML =
'<input type="text" value="Approved">';

document.getElementById("notes").innerHTML =
'<textarea>Flight and hotel booked. Awaiting final itinerary.</textarea>';

}
</script>
</body>
</html>