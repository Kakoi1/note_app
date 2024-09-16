<?php
// edit_note.php

if(isset($_POST['note_id']) && is_numeric($_POST['note_id'])) {
    $note_id = $_POST['note_id'];
    // Include your database connection script
    include 'database.php';
    
    // Fetch the note details from the database based on note_id
    $sql = "SELECT * FROM notes WHERE n_id = $note_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            // Display form for editing the note
    
        } else {
            echo "Note not found.";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Invalid note ID.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Note</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    /* Style for the form container */
    .edit-note-container {
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        background-color:   #86B6F6;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Style for the form elements */
    .edit-note-container input[type='text'],
    .edit-note-container textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        height:30vh;
    }
    .edit-note-container input[type='text']{
        width: 100%;
        height:10vh;
        padding: 10px;
        margin-bottom: 15px;  
    }
    /* Style for the submit button */
    .edit-note-container button[type='submit'] {
        background-color:  #176B87;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    
    body{
        background-color:  #EEF5FF;
        width:100%;
        height:100vh;
    }
    /* Style for the submit button on hover */
    .edit-note-container button[type='submit']:hover {
        background-color: #B4D4FF;
    }
    .container{
        margin:50px;
     height:auto;
     width:100%;
    }
</style>
</head>
<body>
<div class= "container">


<div class="edit-note-container">
    <h2><i class='bi bi-pencil-square'></i>Edit Note</h2>
    <form action="update_note.php" method="post">
        <input type="hidden" name="note_id" value="<?php echo $note_id; ?>">
        Title: <input type="text" name="title" value="<?php echo htmlspecialchars($row["title"]); ?>"><br>
        Content: <textarea name="content"><?php echo $row["content"]; ?></textarea><br>
        <button type="submit">Save Changes</button>
    </form>
</div>
</div>
</body>
</html>
