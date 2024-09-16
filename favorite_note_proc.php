<?php
// // Assuming you have database connection established
// include 'database.php';

// // Check if note_id is set and not empty
// if(isset($_POST['note_id']) && !empty($_POST['note_id'])) {
//     // Sanitize input to prevent SQL injection
//     $note_id = mysqli_real_escape_string($conn, $_POST['note_id']);
    
//     // Query to update the note status to favorite
//     $sql = "UPDATE notes SET status = 'favorite' WHERE n_id = '$note_id'";
    
//     // Execute the query
//     if(mysqli_query($conn, $sql)) {
//         // Redirect back to the page where notes are displayed
//         header("Location: index.php");
        
//         exit();
//     } else {
//         // If query execution fails, display an error message
//         echo "Error updating record: " . mysqli_error($conn);
//     }
// } else {
//     // If note_id is not set or empty, redirect back to the page where notes are displayed
//     header("Location: notes.php");
//     exit();
// }


// Start the session
session_start();

// Check if the note_id is provided and is numeric
if(isset($_POST['note_id']) && is_numeric($_POST['note_id'])) {
    // Retrieve the note_id from the POST data
    $note_id = $_POST['note_id'];
    
    // Include the database connection script
    include 'database.php';
    
    // Perform the necessary database operations to mark the note as a favorite
    $sql = "UPDATE notes SET favorite = 1 WHERE n_id = $note_id";
    
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the index page with a success message
        $_SESSION['favorite_success'] = true;
        header("Location: index.php");
        exit();
    } else {
        // If the query fails, display an error message
        echo "Error updating record: " . $conn->error;
    }
    
    // Close the database connection
    $conn->close();
} else {
    // If note_id is not provided or is not numeric, redirect to index page
    header("Location: index.php");
    exit();
}
?>

?>
