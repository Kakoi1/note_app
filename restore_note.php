<?php
session_start();

if(isset($_POST['note_id'])) {
    // Retrieve note ID from the form
    $archived_id = $_POST['note_id'];

    // Include database connection
    include_once 'database.php';

    // Retrieve the archived note's information before restoring
    $sql_select = "SELECT * FROM archived_notes WHERE archived_id = $archived_id";
    $result_select = $conn->query($sql_select);
    
    if ($result_select->num_rows == 1) {
        // Fetch the archived note's information
        $row = $result_select->fetch_assoc();

        // Insert the archived note back into the original table
        $sql_insert = "INSERT INTO notes (title, content, user_id) VALUES ('" . $row['title'] . "', '" . $row['content'] . "', '" . $row['user_id'] . "')";
        
        if ($conn->query($sql_insert) === TRUE) {
            // Delete the archived note from the archived table
            $sql_delete = "DELETE FROM archived_notes WHERE archived_id = $archived_id";
            
            if ($conn->query($sql_delete) === TRUE) {
                // Note successfully restored
                $_SESSION['restore_success'] = true;
                header("Location: index.php");
                exit();
            } else {
                // Error occurred while deleting the archived note from the archived table
                echo "Error: " . $sql_delete . "<br>" . $conn->error;
            }
        } else {
            // Error occurred while restoring the archived note to the original table
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    } else {
        // Archived note not found or multiple archived notes found with the same ID
        echo "Archived note not found or multiple archived notes found with the same ID.";
    }

    // Close connection
    $conn->close();
} else {
    // Redirect if note_id is not provided
    header("Location: archivenotes.php");
    exit();
}
?>
