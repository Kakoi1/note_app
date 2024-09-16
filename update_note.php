<?php
// update_note.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (isset($_POST['note_id'], $_POST['title'], $_POST['content'])) {
        // Include your database connection script
        include 'database.php';

        // Sanitize input data
        $note_id = mysqli_real_escape_string($conn, $_POST['note_id']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $content = mysqli_real_escape_string($conn, $_POST['content']);

        // Update the note in the database
        $sql = "UPDATE notes SET title='$title', content='$content' WHERE n_id='$note_id'";

        if (mysqli_query($conn, $sql)) {
      
            header("Location: index.php?success=true");



        } else {
            echo "Error updating note: " . mysqli_error($conn);
        }

        // Close database connection
        mysqli_close($conn);
    } else {
        echo "All fields are required.";
    }
} else {
    // Redirect user if accessed directly without POST request
    header("Location: edit_note.php");
    exit;
}
?>
