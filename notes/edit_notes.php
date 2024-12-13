<?php  
session_start();  
// Check if user is logged in 
if (!isset($_SESSION['user_id'])) { 
header('Location: login.php');  
exit();  
}   
// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'notesDb');
if (!$conn) { 
    die("Connection failed: " . mysqli_connect_error());  
}   
// Get the note ID from the query string  
$note_id = $_GET['id'];  
// Fetch the note details  
$sql = "SELECT * FROM notes_tb WHERE note_id = '$note_id' AND user_id = '" . $_SESSION['user_id'] . "'";  
$result = mysqli_query($conn, $sql);  
if ($result && mysqli_num_rows($result) > 0) {  
    $note = mysqli_fetch_assoc($result);  
} else {  
    echo "Note not found.";  
    exit();  
}  
// Handle form submission 
if (isset($_POST["submit"])) {  
    $title = mysqli_real_escape_string($conn, $_POST['title']);  
    $content = mysqli_real_escape_string($conn, $_POST['content']);  
    $sql = "UPDATE notes_tb SET title = '$title', content = '$content', createdAt = NOW() WHERE note_id = 
    '$note_id'";  
    if (mysqli_query($conn, $sql)) { 
        header('Location: mainPage.php');  
        exit();  
    } else {  
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);  
    } 
}   
// Close the database connection mysqli_close($conn);  
?>  
<!DOCTYPE html>  
<html lang="en">  
<head>  
<meta charset="UTF-8">  
<meta name="viewport" content="width=device-width, initial-scale=1.0">  
<title>Edit Note - NoteNest</title>  
<!-- Bootstrap CSS -->  
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">  
<!-- Custom CSS -->  
<style>  
body { 
    background: #CCCCFF;  
}  
.container { margin-top: 50px;  
}  
.card { border-radius: 10px; box-shadow: 
0 0 20px rgba(0, 0, 0, 0.1);  
}  
.btn-primary { 
    background-color: #007bff; border-color: #007bff;  
}  
.btn-primary:hover { 
    background-color: #0056b3; border-color: #004085; 
}  
.btn-secondary { 
    background-color: #6c757d; border-color: #6c757d;  
}  
.btn-secondary:hover { 
background-color: #5a6268; 
border-color: #545b62;  
}  
.logo-title-container { 
display: flex; align-items: 
center; justify-content: 
center; margin-bottom: 
20px;  
}  
.logo-container { 
    text-align: center;
    margin-right: 20px;  
}  
.logo-container img { 
width: 100px; height: 
100px;  
}  
.title {  
font-family: 'Papyrus', cursive; 
font-size: 
3rem; 
color: 
#007bff; text-align: center;  
}  
.form-container { background: #ffffff; 
padding: 20px; border-radius: 10px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}  
.title-heading { font-family: 'Comic Sans MS', cursive; 
font-size: 2rem; 
color: #ff69b4; /* Pink color */ 
text-align: center;  
}  
</style>  
</head>  
<body>  
<div class="container">  
<!-- Logo and Title -->  
<div class="logo-title-container">  
<div class="logo-container">  
<img src="images/notepad.png" alt="Logo">  
</div>  
<div class="title">NoteHub</div>  
</div>  
<div class="form-container">  
<h1 class="text-center mb-4 title-heading">Edit Note</h1>  
<form method="post">  
<div class="form-group">  
<label for="title">Title</label>  
<input type="text" name="title" class="form-control" value="<?=  
htmlspecialchars($note['title']) ?>" required>  
</div>  
<div class="form-group">  
<label for="content">Content</label>  
<textarea name="content" class="form-control" rows="5" required><?=  
htmlspecialchars($note['content']) ?></textarea>  
</div> 
<button type="submit" name="submit" id="submit" class="btn btn-primary btn-block">Save Changes</button>  
</form>  
<a href="mainPage.php" class="btn btn-secondary btn-block mt-3">Back to Notes</a>  
</div>  
</div>  
<!-- Bootstrap JS, Popper.js, and jQuery -->  
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>  
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  
</body>  
</html> 
