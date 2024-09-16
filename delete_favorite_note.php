<?php
// Include database connection
include_once 'database.php';

// Check if delete_note_id is set and is a valid number
if(isset($_POST['delete_note_id']) && is_numeric($_POST['delete_note_id'])) {
    // Sanitize input to prevent SQL injection
    $note_id = mysqli_real_escape_string($conn, $_POST['delete_note_id']);

    // Prepare delete query
    $sql = "DELETE FROM notes WHERE n_id = $note_id";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Redirect back to favorites.php upon successful deletion
        header("Location:favorites.php?success=true");
        
        exit();
    } else {
        // Display error message if query execution fails
        echo "Error deleting note: " . mysqli_error($conn);
    }
} else {
    // Handle invalid or missing delete_note_id
    echo "Invalid or missing note ID.";
}
?>
