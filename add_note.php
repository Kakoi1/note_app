<?php
if(isset($_POST['add_note'])) {
    // Retrieve form data
    $note_title = $_POST['note_title'];
    $note_content = $_POST['note_content'];
    
    // Retrieve user_id (assuming it's stored in a session variable)
    // session_start();
    $user_id = $_SESSION['user_id']; // Adjust this based on how you store user_id
    
    include_once 'database.php';
    // Insert new note into the database
    $sql = "INSERT INTO notes (title, content, user_id) VALUES ('$note_title', '$note_content', '$user_id')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?addedNote=true");

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
