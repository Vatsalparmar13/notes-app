<?php  
session_start(); // Start the session
// Check if user is logged in 
if (!isset($_SESSION['user_id'])) { 
    header('Location: login.php');  // Redirect to login page if not logged in
    exit();  
}   

// Connect to the database  
$conn = mysqli_connect('localhost', 'root', '', 'notesDb');  
if (!$conn) { 
    die("Connection failed: " . mysqli_connect_error());  
}  

// Fetch notes for the logged-in user  
$user_id = $_SESSION['user_id'];  

// Create the SQL query  
$sql = "SELECT * FROM notes_tb WHERE user_id = '$user_id' ORDER BY createdAt DESC";  
$notes = []; 
// Execute the query  
$result = mysqli_query($conn, $sql);  
if ($result) {  
    // Fetch all notes as an associative array  
    $notes = mysqli_fetch_all($result, MYSQLI_ASSOC);  
} else {  
    echo "Error executing query: " . mysqli_error($conn);  
}   

// Close the database connection 
mysqli_close($conn);  
?>
 
<!DOCTYPE html>  
<html lang="en">  
<head>  
<meta charset="UTF-8">  
<meta name="viewport" content="width=device-width, initial-scale=1.0">  
<title>NoteHub - Notes</title>  
<!-- Bootstrap CSS -->  
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">  

<!-- Custom CSS -->  
<style> 
body{ 
background: #f7f7f7;  
}  
.card  
{ 
border-radius: 10px; box-shadow: 0 0 
20px rgba(0, 0, 0, 0.1);  
}  
.btn-primary { background-color: #007bff; border-color: #007bff;  
}  
.btn-primary:hover { 
    background-color: #0056b3; 
    border-color: #004085;  
}  
.btn-danger {  
background-color: #dc3545; 
border-color: #dc3545;  
} 
.btn-danger:hover { 
    background-color: #c82333; 
    border-color: #bd2130;  
}  
.btn-warning { 
    background-color: #ffc107; border-color: #ffc107;  
}  
.btn-warning:hover { background
color: #e0a800; border-color: 
#d39e00;  
}  
.title {  
font-family: 'Papyrus', cursive; 
font-size: 
3rem; 
color: 
#007bff; text-align: center;  
margin-bottom: 20px;  
}  
.logo-title-container { display: flex; 
align-items: center; 
justify-content:space-between; 
margin-bottom: 30px;  
}  
.logo-container { flex: 0 0 auto; /* Prevent flex item from growing 
or shrinking */  
}  
.logo-container img { 
width: 
100px;
height: 
100px; 
border-radius: 0%;  
}  
.table {  
margin-top: 20px;  
}  
.table thead th { background-color: 
#007bff; color: white;  
}  
.table tbody tr:hover { background-color: 
#e9ecef;  
}  
.title-heading { font-family: 'Comic Sans MS', cursive; /* Apply 
Papyrus font */ font-size: 2rem; /* Adjust font size as needed 
*/ color: #007bff; /* Color of the text */ text-align: center;  
}  
</style>  
<body>  
<div class="container mt-5">  
<!-- Logo and Title -->  
<div class="logo-title-container">  
<div class="logo-container">  
<img src="images/notepad.png" alt="Logo">  
</div>  
<div class="title">NoteHub</div>  
</div>  
<h1 class="mb-4 text-center title-heading">Your Notes</h1> 
<a href="add_notes.php" class="btn btn-primary mb-3">Add Note</a>  
<a href="logout.php" class="btn btn-danger mb-3">Logout</a>  
<!-- Display notes in a table -->  
<table class="table table-striped">  
<thead>  
<tr>  
<th scope="col">Note No.</th>  
<th scope="col">Title</th>  
<th scope="col">Content</th>  
<th scope="col">Actions</th>  
</tr>  
</thead>  
<tbody>  
<?php $counter=1; //initialize a counter ?>  
<?php foreach ($notes as $note): ?>  
<tr>  
<th scope="row"><?= $counter++ ?></th>  
<td><?= htmlspecialchars($note['title']) ?></td>  
<td><?= htmlspecialchars($note['content']) ?></td>  
<td>  
<a href="edit_notes.php?id=<?= $note['note_id'] ?>" class="btn btn-warning btn-sm">Edit</a>  
<a href="delete_notes.php?id=<?= $note['note_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this note?');">Delete</a>  
</td>  
</tr>  
<?php endforeach; ?>  
</tbody>
</table>
</div>  
<!-- Bootstrap JS, Popper.js, and jQuery -->  
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>  
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  
</body>  
</html> 