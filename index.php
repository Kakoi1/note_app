<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION["user"]) || $_SESSION["user"] !== "yes") {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Access the "using" session variable
$using = $_SESSION["using"]; // Assuming "using" contains the email of the logged-in user
include_once 'database.php';
include_once 'add_note.php';


function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$user_id = $_SESSION['user_id']; // Adjust this based on how you store user_id
$sql = "SELECT * FROM notes WHERE user_id = '$user_id'";
$result = $conn->query($sql);





if (isset($_GET['success']) && $_GET['success'] == 'true') {
    
  echo "<p class='success-message'>Note updated successfully!</p>";
}






if(isset($_SESSION['favorite_success']) && $_SESSION['favorite_success'] === true) {
  echo "<p class='success-message'>Note favorited successfully!</p>";
  // Unset the session variable to prevent displaying the message again on page refresh
  unset($_SESSION['favorite_success']);
}




// Check if the restoration was successful and display alert message using JavaScript
if (isset($_SESSION['restore_success']) && $_SESSION['restore_success'] === true) {
  echo "<p class='success-message'>Note restored successfully!</p>";
  // Unset the session variable to prevent displaying the message again on page reload
  unset($_SESSION['restore_success']);
}




if(isset($_SESSION['archive_success']) && $_SESSION['archive_success'] === true) {
  echo "<p class='success-message'>Note archived successfully!</p>";
  // Unset the session variable to prevent displaying the message again on page refresh
  unset($_SESSION['archive_success']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modern Note Taking App</title>
  <!-- <link rel="stylesheet" href="./styles.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

 
  <style>

nav {
    background-color:#86B6F6;
    overflow: hidden;
      list-style: none;
  padding: 0;
  margin: 0;
}
nav a {
    float: left;
    display: block;
    color: white;
    text-align: center;
    padding: 14px 20px;
    text-decoration: none;
    margin-right: 10px;
    text-transform:uppercase;
    font-weight: bold;
  text-decoration: none;
  position: relative;
    
}


nav a:hover {
    color: black;
} 



    body {
      background-image: url('image/note.png');
      font-family: Arial, sans-serif;
      margin: 0;
      padding-bottom:50px;
      overflow:hidden;
      height:auto;
      width:100%;
    }
    
    nav {
        background-color:#86B6F6;
      color: white;
      padding: 10px 20px;
      display: flex;
      /* justify-content: space-between; */
      align-items: center;
    }
    
    nav a {
      color: white;
      text-decoration: none;
      margin-right: 10px;
    }

    /* @keyframes bounce {
      0% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
      100% { transform: translateY(0); }
  } */
  .head{
    width:100%;
    background-color:  #EEF5FF;
  }
  nav p a{
    float:right;
    color:white;
  }
  h1 {
      animation: bounce 1s infinite;
      text-align: center;
  }
    
    .container {
        margin: 0 auto;
        display: flex;
        justify-content: center;
        background-color: #EEF5FF;
        padding:0;
        
    }
    
    h2 {
      color: #333;
    }
    
    label {
      font-weight: bold;
    }
    
    input[type="text"],
    textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
      resize: none;
    }
    #note_title{
      height:10vh;
      border-bottom: 2px solid white;
    }
    #note_content{
        height:30vh; 
    }
    .note h3{
        background-color: #86B6F6;
        border-bottom: 3px solid black;
        height: 5vh;
        text-align:center;
    }
    .note p {
      margin-bottom: 0;
      padding:8px;
      background-color: #86B6F6;
      height:40vh;
      resize: none;
    }
    input[type="submit"] {
      background-color: #176B87;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    
    input[type="submit"]:hover {
      background-color: #B4D4FF;
    }
    
    .note {
      background-color: #86B6F6;
      padding: 30px;
      margin-bottom: 10px;
      border-radius: 5px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
      resize: none;
    }
    
    .note h3 {
      margin-top: 0;
    }
    
    .welcome-link {
        color: #eed9d9;
        text-decoration: none;
        margin-right: 10px;
        font-size: 18px;
        font-weight: bold;
        border: 2px solid #333;
        border-radius: 5px;
        padding: 10px 20px;
        transition: all 0.3s ease;
      }
      
      .welcome-link:hover {
        background-color:#B4D4FF;
        color: white;
      }


.shelf {
  height: 100vh;
  width: 100%;
  display: flex;
  flex-direction: column;
  margin-right: 10px;
  background-color: #EEF5FF;
  overflow:auto;
}

.notes-container {

  word-wrap: normal;
  
  margin: 20px;
 text-align: left;
}

.note {
  border: 1px solid #ccc;
  margin-bottom: 10px;
  padding: 10px;
  word-wrap: break-word;
}
.note button{
    width:100%;
    height:30px;
    border-radius:5px;
    padding:5px;
}
.note button:hover{
  color:black;
  background-color:pink;
}
.add-note-container {
  margin: 50px;
  padding:20px;
  min-height: auto;
  height:80vh;
  float: right;
  background-color:#86B6F6;
  
}
.success-message {
  color: green;
  font-weight: bold;
  text-align: center;
}
  </style>
  <script>
    function confirmLogout() {
    if (confirm("Are you sure you want to logout?")) {
        // If user confirms logout
        window.location.href = "logout.php";
    } else {
        // If user cancels logout
        return false// Prevent default link behavior
    }
}
    // Check if the URL contains a parameter indicating a new note was added
    const urlParams = new URLSearchParams(window.location.search);
    const addedNote = urlParams.get('addedNote');

    // If a new note was added, display the success message
    if (addedNote === 'true') {
        alert("New note added successfully");
        header("Location: index.php");
    }





    
//limit the word
function limitTextarea(element, maxWords) {
    let text = element.value;
    let words = text.trim().split(/\s+/).length;

    if (words > maxWords) {
        let trimmedText = text.split(/\s+/).slice(0, maxWords).join(' ');
        element.value = trimmedText;
    }
   // Update word count display
    document.getElementById('word-count').innerText = `Words: ${words}/${maxWords}`;
}



function confirmDelete() {
            if (confirm('Are you sure you want to delete this note?')) {
                document.getElementById('deleteForm').submit();
            }
        }

        function confirmArchive() {
            if (confirm('Are you sure you want to archive this note?')) {
                document.getElementById('archiveForm').submit();
            }
        }


  </script>

</head>
<body  style="background-color: #EEF5FF;">

<nav>
    <a href="index.php"><i class="fas fa-home"></i> Home</a>
    <a href="favorites.php"><i class="bi bi-star-fill"> </i> Favorites</a>
    <a href="archived_notes.php"><i class="bi bi-archive-fill"></i>Archive</a>
    <a href="#" onclick="confirmLogout();"><i class="bi bi-box-arrow-left"></i>Logout</a>
    <a href="dropdow.php">dropdown</a>
    <?php
    echo "<p> <a href='profile.php'<i class='bi bi-person-circle'></i>   $using!</a></p>";
    ?>
</div>
</nav>
<div class="user">

<!-- <div class="head">
  <h2>All Notes</h2>
  </div> -->
    <div class="container">
  <div class="add-note-container">
    <!-- Form to add a new note -->
    <h2>Add New Note</h2>
    <form action="" method="post" class="add-note-form">
      <label for="note_title">Title:</label>
      <input type="text" id="note_title" name="note_title">
      
      <label for="note_content">Content:</label>
      <textarea id="note_content" name="note_content" rows="4" cols="50" oninput="limitTextarea(this, 2000)"></textarea>
<p id="word-count">Words: 0/2000</p>


      <input type="submit" value="Add Note"  name="add_note">
    </form>
  </div>
<!-- </div> -->


  <!-- Display all notes -->
 
  <div class="shelf">
   
    <div class="notes-container">
    
    <?php




// display_notes.php

// Check if a new note has been added
if(isset($_GET['addedNote']) && $_GET['addedNote'] === 'true') {
    // Display the newly added note
    if(isset($_GET['noteTitle']) && isset($_GET['noteContent'])) {
        echo "<div class='note'>";
        echo "<h3>" . htmlspecialchars($_GET['noteTitle']) . "</h3>";
        echo "<p style='word-wrap: break-word;'> " . htmlspecialchars($_GET['noteContent']) . "</p>";
        // Add edit, archive, favorite, and delete buttons if needed
        echo "</div>";
    }
}

// Display existing notes in reverse order
if ($result->num_rows > 0) {
    // Store notes in an array
    $notes = array();
    while($row = $result->fetch_assoc()) {
        $notes[] = $row;
    }
    // Reverse the order of notes
    $notes = array_reverse($notes);

    // Output data of each note
    foreach($notes as $row) {
        echo "<div class='note'>";
        echo "<h3> " . htmlspecialchars($row["title"]). "</h3>";
        echo "<p style='word-wrap: break-word;'> " . $row["content"] . "</p>";

        // Edit button
        echo "<form action='edit_note.php' method='post' style='display: inline-block; margin-right: 10px;'>";
        echo "<input type='hidden' name='note_id' value='" . $row["n_id"] . "'>";
        echo "<button type='submit' style='background-color:  #176B87; color: white; padding: 5px 10px; border: none; cursor: pointer;'><i class='bi bi-pencil-square'></i>Edit</button>";
        echo "</form>";

// Archive button
        echo "<form id='archiveForm' action='archive_note_proc.php' method='post' style='display: inline-block; margin-right: 10px;'>";
        echo "<input type='hidden' name='note_id' value='" . $row["n_id"] . "'>";
        echo "<button type='button' onclick='confirmArchive()' style='background-color:  #176B87; color: white; padding: 5px 10px; border: none; cursor: pointer;'><i class='bi bi-archive-fill'></i>Archive</button>";
        echo "</form>";

// Favorite button
        echo "<form action='favorite_note_proc.php' method='post' style='display: inline-block; margin-right: 10px;'>";
        echo "<input type='hidden' name='note_id' value='" . $row["n_id"] . "'>";
        echo "<button type='submit' style='background-color:  #176B87; color: white; padding: 5px 10px; border: none; cursor: pointer;'> <i class='bi bi-star-fill'> </i> Favorite</button>";
        echo "</form>"; 

// Delete button
        echo "<form id='deleteForm' action='delete_note.php' method='post' style='display: inline-block;'>";
        echo "<input type='hidden' name='note_id' value='" . $row["n_id"] . "'>";
        echo "<button type='button' onclick='confirmDelete()' style='background-color: #176B87; color: white; padding: 5px 10px; border: none; cursor: pointer;'> <i class='bi bi-trash-fill'></i>Delete</button>";
        echo "</form>";

        echo "</div>";
    }
} else {
    echo "<p>No notes found.</p>";
}


?>



    </div>
</div>

    
</body>

</html>