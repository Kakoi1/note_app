<?php
include('database.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['update'])) {
        $id = $_POST['user_id'];
        $fname = $_POST['fname'];
        $email = $_POST['email'];

        $sqli = "UPDATE `users` SET `full_name`='$fname',`email`='$email' WHERE `user_id`='$id'";
        $result = mysqli_query($conn, $sqli);

        if ($result) {
            echo "<div class='alert alert-success'>Profile updated successfully.</div>";
            // Update session email if email changed
            $_SESSION["using"] = $email;
        } else {
            echo "<div class='alert alert-danger'>Error updating profile: " . mysqli_error($conn) . "</div>";
        }
    }
}

if (isset($_SESSION["user"])) {
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT * FROM `users` WHERE `user_id` = '$user_id'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        padding: 20px;
        display:flex;
        justify-content:center;
        align-items:center;
        margin:5%;
    }

    h1 {
        color: #333;
        text align: center;
        font-size: 24px;
        justify-items: center;
    text-align: center;
    width:50%;
    }

    form {
        background-color: #86B6F6;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 80%;
        margin:auto;
        
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
    }

    button[type="submit"] {
        background-color: #007bff;
        color: black;
        padding: 15px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        text-align:center;
       
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

 a{
        float:right;
        color:black;
        background-color:#007bff;  
        height:30px;
        border-radius:5px;
        border: none;
       text-decoration:normalizer_normalize;
    }
    
    button a:hover {
        background-color: #0056b3;
    }
#head{
    width:100%;
    align-items:center;
}
</style>


<body>
    

<!-- <button class="home-button" onclick="location.href='index.php';"><i class="fas fa-home"></i> Home</button> -->
 
<form action="" method="POST">
        <ul>
            <li>
                <h1>FULL NAME:</h1>
                <!-- Hidden input to store user_id -->
                <input type="hidden" value="<?php echo $user['user_id']; ?>" name="user_id">
                <input type="text" value="<?php echo $user['full_name']; ?>" name="fname">
            </li>
            <li>
                <h1>EMAIL:</h1>
                <input type="text" value="<?php echo $user['email']; ?>" name="email">
            </li>
            <li>
                <button type="submit" name="update">Update</button>
            </li>
        </ul>
    </form>


    

</body>
</html>



























<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<style>

body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        padding: 20px;
    }

    h1 {
        color: #333;
        text align: center;
        font-size: 24px;
        justify-items: center;
    text-align: center;
    width:50%;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 50%;
        margin:auto;
        
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
    }

    button[type="submit"] {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    .a {
        float:left;
        color:white;

    }
</style>
<body>
    <!-- Your HTML content -->
    <a href="index.php">Back</a>
    <h1>Profile</h1>
    
</body>
</html>
