<?php  
session_start();  
// Check if user is logged in  
if (!isset($_SESSION['user_id'])) { 
    header('Location: login.php');  
exit();  
}   
// Connect to the database  
$conn = mysqli_connect('localhost', 'root', '', 'notesDb');
if 
(!$conn) 
{ 
die("Connection failed: " . mysqli_connect_error());  
}   
// Get the note ID from the query string  
$note_id = $_GET['id'];  
// Delete the note  
$sql = "DELETE FROM notes_tb WHERE note_id = '$note_id' AND user_id = '" . $_SESSION['user_id'] . "'";  
if (mysqli_query($conn, $sql)) { 
    header('Location: mainPage.php');  
exit();  
} else {  
echo "Error deleting record: " . mysqli_error($conn);  
}   
// Close the database connection 
mysqli_close($conn);  
?> 