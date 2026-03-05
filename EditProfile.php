<?php
session_start();
include("config.php");

if (!isset($_SESSION["userID"])) {
    header("Location: index.html");
    exit;
}

$userID = $_SESSION["userID"];

/* GET CURRENT USER INFO */
$query = "SELECT first_name, last_name, email,phone,password FROM users WHERE userID='$userID'";
$result = mysqli_query($conn, $query);

if(!$result){
    die("Query Failed: " . mysqli_error($conn));
}

$user = mysqli_fetch_assoc($result);


/* UPDATE PROFILE */
if(isset($_POST["update"])){

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"]; 

    $update = "UPDATE users 
               SET first_name='$first_name', last_name='$last_name', phone='$phone', email='$email', password='$password'
               WHERE userID='$userID'";

    if(mysqli_query($conn,$update)){
        
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;

        header("Location: profile.php");
        exit;
    }else{
        echo "Update failed";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Profile</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:#f4f6fb;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.container{
background:linear-gradient(#1d1f69,#00407f);
padding:35px;
width:420px;
border-radius:12px;
box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

h2{
text-align:center;
margin-bottom:25px;
color:#ffffff;
}

.input-group{
margin-bottom:15px;
}

label{
font-size:14px;
font-weight:500;
}

input{
width:100%;
padding:10px;
margin-top:5px;
border:1px solid #ccc;
border-radius:6px;
}

.buttons{
display:flex;
justify-content:space-between;
margin-top:20px;
}

button{
padding:10px 18px;
border:none;
border-radius:6px;
cursor:pointer;
}

.update{
background:#4CAF50;
color:white;
}

.cancel{
background:#888;
color:white;
}

button:hover{
opacity:0.9;
}

</style>
</head>

<body>

<div class="container">

<h2>Edit Profile</h2>

<form method="POST">

<div class="input-group">
<label>First_Name</label>
<input type="text" name="first_name" value="<?php echo $user['first_name']; ?>" required>
</div>
<div class="input-group">
<label>Last_name</label>
<input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" required>
</div>

<div class="input-group">
<label>Email</label>
<input type="email" name="email" value="<?php echo $user['email']; ?>" required>
</div>
<div class="input-group">
<label>Phone Number</label>
<input type="text" name="phone" value="<?php echo $user['phone']; ?>" required>
</div>
<div class="input-group">
<label>Password</label>
<input type="password" name="password" placeholder="Enter new password">
</div>


<div class="buttons">
<button type="submit" name="update" class="update">Save Changes</button>
<button type="button" class="cancel" onclick="window.location.href='profile.php'">Cancel</button>
</div>

</form>

</div>

</body>
</html>