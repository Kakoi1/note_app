<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Favorite Notes</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
  body {
    font-family: Arial, sans-serif;
    background-color:#EEF5FF;
    width:100%;
    height:100vh;
    margin: 0;
    padding-bottom:50px;
    overflow:hidden;
  }

  .head{
        diplay:flex;
        align-items:center;
        width: 100%;
        height:10vh;
        background-color: #86B6F6;
        margin:0;
        padding:15px;
    }

    .head h2{
        text-align:center;
        margin:0;
    }
    .head h2 a i{
        float:right;
    }

  .container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color:#86B6F6;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width:100%;
    height:auto;
    margin-bottom:20px;
  }

  .favorited-note {
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 5px;
    margin-bottom: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    
    display: block;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    unicode-bidi: isolate;
  }
  .favorited-note button{
    background-color:#176B87;
    border-radius:5px;
    color:white;
    height:30px;
  }
  .favorited-note h3{
     border-bottom:solid black 2px;
     text-align:center;
     text-transform:uppercase;
  }
  .favorited-note p{
    
  }
  .note-title {
    margin: 0;
    font-size: 20px;
    color: #333;
  }

  .note-content {
    margin-top: 10px;
    color: #666;
  }

  .note-actions {
    margin-top: 10px;
    text-align: right;
  }

  .note-actions button {
    background-color: #EEF5FF;
    color: black;
    border: none;
    padding: 8px 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .success-message {
  color: green;
  font-weight: bold;
  text-align: center;
}
  .note-actions button:hover {
    background-color: #45a049;
  }

  .home-button {
    background-color:#176B87;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 20px; /* Adjust spacing as needed */
}

.home-button:hover {
    background-color:  #B4D4FF;
}



</style>
</head>
<body>

<div class="head">
<h2><i class="bi bi-star-fill"> </i>Favorite Notes<button class="home-button" onclick="location.href='index.php';"><i class="bi bi-box-arrow-left"></i></a></h2>
</div>
<br>
<br>
<br>
<div class="container">

    

<?php
if (isset($_GET['success']) && $_GET['success'] == 'true') {
    
  echo "<p class='success-message'>Note deleted successfully!</p>";
}

// Include database connection
include_once 'database.php';

// Fetch favorited notes from the database
$sql = "SELECT * FROM notes WHERE favorite = 1"; // Assuming you have a column to mark notes as favorites
$result = $conn->query($sql);

// Check if there are favorited notes
if ($result->num_rows > 0) {
    // Display favorited notes
    while($row = $result->fetch_assoc()) {
        echo "<div class='favorited-note'>";
        echo "<h3 class='note-title'>" . htmlspecialchars($row["title"]) . "</h3>";
        echo "<p class='note-content'>" . $row["content"] . "</p>";
        echo "<form action='delete_favorite_note.php' method='post'>";
        echo "<input type='hidden' name='delete_note_id' value='" . $row["n_id"] . "'>"; // Assuming 'id' is the primary key
        echo "<button type='submit'><i class='bi bi-trash-fill'></i>Delete</button>"; // Font Awesome trash icon
        
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "<p>No favorited notes found.</p>";
}

// Close connection
$conn->close();
?>


</div>

</body>
</html>
