<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Notes</title>
</head>
<body>
    <h2>Select User:</h2>
    <form action="" method="post">
        <select name="user_id" id="userSelect" onchange="this.form.submit()">
            <?php
            include 'database.php';
            // Execute the SQL query to fetch all users
            $sql = "SELECT `user_id`, `full_name` FROM `users`";
            $result = mysqli_query($conn, $sql);

            // Check if there are any users
            if (mysqli_num_rows($result) > 0) {
                // Loop through each row of the result set
                while ($row = mysqli_fetch_assoc($result)) {
                    // Output the user as an option in the dropdown
                    echo "<option value='" . $row["user_id"] . "'>" . htmlspecialchars($row["full_name"]) . "</option>";
                }
            } else {
                // If there are no users, display a default option
                echo "<option value=''>No users found.</option>";
            }

            // Free the result set
            mysqli_free_result($result);
            ?>
        </select>
    </form>
    <br>
    <h2>User Notes:</h2>
    <div id="noteContent">
        <?php
        // Check if user_id is set
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"])) {
            $selected_user_id = $_POST["user_id"];
            
            // Execute the SQL query to fetch notes associated with the selected user
            $sql = "SELECT `title`, `content` FROM `notes` WHERE `user_id` = $selected_user_id";
            $result = mysqli_query($conn, $sql);

            // Check if there are any notes for the selected user
            if (mysqli_num_rows($result) > 0) {
                // Loop through each row of the result set
                while ($row = mysqli_fetch_assoc($result)) {
                    // Output the title and content of each note
                    echo "<h3>" . htmlspecialchars($row["title"]) . "</h3>";
                    echo "<p>" . htmlspecialchars($row["content"]) . "</p>";
                }
            } else {
                // If there are no notes for the selected user, display a message
                echo "No notes found for this user.";
            }
        }
   
