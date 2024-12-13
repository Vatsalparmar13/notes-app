<!DOCTYPE html>  
<html lang="en">  
<head>  
<meta charset="UTF-8">  
<meta name="viewport" content="width=device-width, initial-scale=1.0">  
<title>NoteHub - Login</title>  
<!-- Bootstrap CSS -->  
<link  href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom CSS -->  
<style> 
body {
background: #66c2ff;  
}  
.card
{ 
border-radius: 10px; box-shadow: 0 0 
20px rgba(0, 0, 0, 0.1);  
}  
.form-group label { font-weight: 
bold;  
}  
.btn-primary { 
    background-color: #007bff; 
border-color: #007bff;  
}  
.btn-primary:hover { 
    background-color: #0056b3; 
border-color: 
#004085;  
}  
.btn-secondary { 
    margin-top: 10px;  
}  
.alert {  
margin-top: 20px;  
}  
.title {  
font-family: 'Papyrus', cursive;  
font-size: 3rem;
color: #007bff; text-align: center;  
margin-bottom: 20px;  
}  
.logo-container { 
    text-align: center;  
margin-bottom: 20px;  
}  
.logo-container img { 
width: 
height: 
60px; 
60px; 
border-radius: 0%;  
}  
.login-heading { font-family: 'Comic Sans MS', cursive; /* Apply 
Papyrus font */ font-size: 2rem; /* Adjust font size as needed 
*/ color: #007bff; /* Blue color for the text */ text-align: 
center;  
}  
</style>  
</head>  
<body>  

<?php

session_start();  
$successMessage = "";  
$errorMessage = ""; 
if (isset($_POST['submit'])) {  
    // Connect to the database  
    $conn = mysqli_connect('localhost', 'root', '', 'notesDb');  
    if (!$conn) 
    { 
    die("Connection failed: 
    " . mysqli_connect_error());  
    }  
    $email = $_POST['email'];  
    $password = $_POST['password'];  
    // Create the SQL query  
    
    
    $sql = "SELECT * FROM usersTb WHERE email = '$email' ";  
    // Execute the query  
    $result = mysqli_query($conn, $sql);  
    // Fetch the user  
    if ($result) {  
    $user = mysqli_fetch_assoc($result);  
    // Check if user exists and password matches if 
    if ($user && $password === $user['password']) {  
    // Password is correct, set session variables and redirect to the notes page  
    $_SESSION['user_id'] = $user['uid'];  
    $_SESSION['username'] = $user['userName'];  
    $successMessage = "Login successful!";  
    // Redirect to notes page after successful login 
    header ('Location: mainPage.php');  
    exit();  
} else {  
$errorMessage = "Invalid email or password.";  
}  
} else {  
$errorMessage = "Error executing query: " . mysqli_error($conn);  
}  
// Close the database connection 
mysqli_close($conn);  
}  
?>
<div class="container mt-5 mb-4">  
<div class="row justify-content-center">  
<div class="col-md-6">  
<div class="card">  
<div class="card-body">  
<div class="logo-container">  
<img src="images/notepad.png" alt="Logo">  
</div>  
<div class="title">NoteHub</div>  
<h2 class="text-center mb-4 login-heading">Login</h2>  
<?php if (!empty($successMessage)): ?>  
<div class="alert alert-success text-center">  
<strong>Success!</strong> <?= htmlspecialchars($successMessage) ?>  
</div>  
<?php endif; ?>  
<?php if (!empty($errorMessage)): ?>  
<div class="alert alert-danger text-center">  
<?= htmlspecialchars($errorMessage) ?>  
</div>  
<?php endif; ?>  
<form method="post">  
<div class="form-group">  
<label for="email">Email:</label>  
<input type="email" id="email" name="email" class="form-control" required>  
</div>  
<div class="form-group">  
<label for="password">Password:</label>  
<input type="password" id="password" name="password" class="form-control" required>  
</div>  
<button type="submit" name="submit" id="submit" class="btn btn-primary btn-block">Login</button>  
</form>  
<a href="register.php" class="btn btn-secondary btn-block">Don't have an account? 
Register</a>  
</div>  
</div>  
</div>  
</div>  
</div> 
<!-- Bootstrap JS, Popper.js, and jQuery -->  
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>  
<script  
src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>  
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  
</body>  
</html> 