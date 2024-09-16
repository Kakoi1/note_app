<?php
session_start();

if(isset($_POST['note_id'])) {
    // Retrieve note ID from the form
    $note_id = $_POST['note_id'];

    // Include database connection
    include_once 'database.php';

    // Retrieve the note's information before archiving
    $sql_select = "SELECT * FROM notes WHERE n_id = $note_id";
    $result_select = $conn->query($sql_select);
    
    if ($result_select->num_rows == 1) {
        // Fetch the note's information
        $row = $result_select->fetch_assoc();

        // Insert the note into the archived table
        $sql_insert = "INSERT INTO archived_notes (title, content, user_id) VALUES ('" . $row['title'] . "', '" . $row['content'] . "', '" . $row['user_id'] . "')";
        
        if ($conn->query($sql_insert) === TRUE) {
            // Delete the note from the original table
            $sql_delete = "DELETE FROM notes WHERE n_id = $note_id";
            
            if ($conn->query($sql_delete) === TRUE) {
                // Note successfully archived
                $_SESSION['archive_success'] = true;
                header("Location: index.php?archive_success=true");
                exit();
            } else {
                // Error occurred while deleting the note from the original table
                echo "Error: " . $sql_delete . "<br>" . $conn->error;
            }
        } else {
            // Error occurred while inserting the note into the archived table
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    } else {
        // Note not found or multiple notes found with the same ID
        echo "Note not found or multiple notes found with the same ID.";
    }

    // Close connection
    $conn->close();
} else {
    // Redirect if note_id is not provided
    header("Location: index.php");
    exit();
}
?>
