





<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<style>
    body{
        background-color: #EEF5FF;
        width:100%;
        height:100vh;
        overflow:auto;
       
    }

    .head{
        diplay:flex;
        align-items:center;
        width: 100%;
        height:10vh;
        background-color: #86B6F6;
        margin:0;
        margin-top:-5px;
        padding:20px;
    }

    .head h2{
        text-align:center;
        margin:0;
    }
    .head a{
        float:right;
    }
.archived-note {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    margin-bottom: 20px;
    padding: 10px;
    height:auto;
    overflow:hidden;
}

.note-title {
    color: #333;
    font-size: 18px;
    margin-bottom: 5px;
}

.note-content p {
    color: black;
    font-size: 14px;
    margin-bottom: 10px;
    word:wrap;
    word-wrap: break-word;

}

.user-id {
    color: #999;
    font-size: 12px;
}

.home-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #176B87; 
    color: #fff; 
    text-decoration: none; 
    border: none; 
    border-radius: 5px; 
}

.home-button:hover {
    background-color: #B4D4FF; 
    color:black; 
}

.home-button i {
    margin-right: 5px; /* Adjust the margin between the icon and text */
}


/* CSS styles for archived note container */
.archived-note {
    background-color: #86B6F6; /* Light gray background */
    border: 1px solid #ced4da; /* Light border */
    border-radius: 5px; /* Rounded corners */
    padding: 15px; /* Padding inside the container */
    margin-bottom: 20px; /* Spacing between archived notes */
}

/* CSS styles for note title */
.note-title {
    text-align:center;
    color: #333; /* Dark text color */
    font-size: 20px; /* Larger font size */
    margin-bottom: 10px; /* Spacing below the title */
}

/* CSS styles for note content */
.note-content {
    color: #666; /* Medium text color */
    font-size: 16px; /* Normal font size */
    margin-bottom: 15px; /* Spacing below the content */
}

/* CSS styles for user ID */
.user-id {
    color: #888; /* Light text color */
    font-size: 14px; /* Smaller font size */
    margin-bottom: 5px; /* Spacing below the user ID */
}

/* CSS styles for Restore button */
.restore-button {
    background-color: #176B87; /* Green button background */
    color: #fff; /* White text color */
    border: none; /* Remove button border */
    border-radius: 5px; /* Rounded corners */
    padding: 8px 15px; /* Padding inside the button */
    cursor: pointer; /* Show pointer cursor on hover */
}

.restore-button:hover {
    background-color: #B4D4FF; /* Darker green on hover */
}

h1 {
    color: #333;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    justify-content: center;
    text-align: center;
    text-decoration: dashed;
    font-size: xx-large;
}
h3{
    border-bottom:solid black 3px;
    text-transform:uppercase;
}
</style>
<body>


<div class="head">
    <h2><i class="bi bi-archive-fill"></i>Archived notes <a href="index.php" class="home-button"><i class="bi bi-box-arrow-left"></i></a></h2>

</div>
    <div class="container">

<br>

      <!-- Home button -->
     
<br>
<br>
        <?php
        session_start();

        // Include database connection
        include_once 'database.php';

        // Fetch archived notes from the database
        $sql = "SELECT * FROM archived_notes";
        $result = $conn->query($sql);

        // Check if there are archived notes
        if ($result->num_rows > 0) {
            // Display archived notes
            while($row = $result->fetch_assoc()) {
                echo "<div class='archived-note'>";
                echo "<h3 class='note-title'>" . htmlspecialchars($row["title"]). "</h3>";
                echo "<p class='note-content'>" . nl2br($row["content"]) . "</p>";
                echo "<p class='user-id'>User ID: " . $row["user_id"] . "</p>";

                // Restore button
                echo "<form action='restore_note.php' method='post'>";
                echo "<input type='hidden' name='note_id' value='" . $row["archived_id"] . "'>";
                echo "<button type='submit' class='restore-button'><i class='bi bi-archive'></i>Unarchive</button>";
                echo "</form>";

                echo "</div>";
            }
        } else {
            echo "<p>No archived notes found.</p>";
        }

        // Close connection
        $conn->close();
        ?>

      
    </div>
</body>

</html>