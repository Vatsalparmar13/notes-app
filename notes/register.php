<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="UTF-8">  
<meta name="viewport" content="width=device-width, initial-scale=1.0">  
<title>NoteHub - Register</title>  
<!-- Bootstrap CSS -->  
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">  

<!-- Custom CSS -->  
<style> 
body {
    background: #66c2ff; 
}
 
.card { border-radius: 10px; box-shadow: 
0 0 20px rgba(0, 0, 0, 0.1);  
}  
.form-group{
    margin-bottom: 20px;
}
.form-group label { font-weight: 
bold;  
}  
.btn-success { background
color: #28a745; border
color: #28a745;  

}  
.btn-success:hover { background
color: #218838; border-color: 
#1e7e34;  
}  
.btn-secondary { margin-top: 
10px;  
}  
.alert {  
margin-top: 20px;
}  
.title {  
font-family: 'Papyrus', cursive; 
font-size: 
3rem; 
color: #28a745; text-align: center;  
margin-bottom: 20px;  
}  
.logo-container { text-align: center; margin-bottom: 20px;  
}  
.logo-container img { 
width: 
height: 
70px; 
70px; 
border-radius: 0%;  
}  
.register-heading { font-family: 'Comic Sans MS', cursive; /* 
Apply Papyrus font */ font-size: 2rem; /* Adjust font size as 
needed */ color: #28a745; /* Color of the text */ text-align: 
center;  
}  
</style>  
</head>  
<body>  

<?php  
$successMessage = ""; 
if (isset($_POST['submit'])) { 
    $conn = mysqli_connect('localhost', 'root', '', 'notesDb');  
    if (!$conn) { 
        die("Connection failed:".mysqli_connect_error());  
    }  
    $name = $_POST['username'];  
    $email = $_POST['email'];  
    $password = $_POST['password'];  
    $createdAt = date('Y-m-d H:i:s');  
    // Correct the SQL query  
    
    $sql = "INSERT INTO usersTb(userName, email,password, createdAt) VALUES ('$name', '$email', '$password', '$createdAt')";  
    if (mysqli_query($conn, $sql)) {  
        $successMessage = "Registration successfully done!"; 
        header('Location: login.php');  
        exit();  
    } else { 
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);  
    }  
    mysqli_close($conn);  
}  
?>  
<div class="container mt-5 mb-5">  
<div class="row justify-content-center">  
<div class="col-md-6">
<div class="card">  
<div class="card-body">  
<div class="logo-container">  
<img src="images/notepad.png" alt="Logo">  
</div>  
<div class="title">NoteHub</div>  
<h2 class="text-center mb-4 register-heading">Register</h2>  
<?php if (!empty($successMessage)): ?>  
<div class="alert alert-success text-center" role="alert">  
<?= $successMessage ?>  
</div>  
<?php endif; ?>  
<form method="POST">  
<div class="form-group">  
<label for="username">Username:</label>  
<input type="text" id="username" name="username" class="form-control" required>  
</div>  
<div class="form-group">  
<label for="email">Email:</label>  
<input type="email" id="email" name="email" class="form-control" required>  
</div>  
<div class="form-group">  
<label for="password">Password:</label>  
<input type="password" id="password" name="password" class="form-control" required>  
</div>  
<button type="submit" id="submit" name="submit" class="btn btn-success btn-block">Register</button>  
</form> 
<a href="login.php" class="btn btn-secondary btn-block">Already have an account? Login</a>  
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