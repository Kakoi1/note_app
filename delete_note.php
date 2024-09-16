<?php
// delete_note.php

// Check if note_id is set and is a valid number
if(isset($_POST['note_id']) && is_numeric($_POST['note_id'])) {
    // Include database connection code here
    include 'database.php';

    // Prepare SQL statement to delete note
    $note_id = $_POST['note_id'];
    $sql = "DELETE FROM notes WHERE n_id = $note_id";

    // Execute the SQL statement
    if (mysqli_query($conn, $sql)) {
        // Note deleted successfully
        // Redirect back to display_notes.php with success message
        header("Location: index.php?delete_success=true");
        exit(); // Terminate script execution
    } else {
        // Error occurred while deleting note
        echo "Error deleting note: " . mysqli_error($conn);
    }
} else {
    // Invalid note_id or note_id not set
    echo "Invalid note ID.";
}


?>

