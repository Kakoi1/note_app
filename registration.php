<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
 <style>
    body{
text-align: center;
height:100vh;
max-width: 100%;
background-color: #EEF5FF;
background-size: cover;
background-position: center;
background-repeat: no-repeat;
display: flex;
align-items: center;
justify-content: center;

}
.container{
max-width: 500px;
margin:0 auto;
padding:50px;
height: 500px;
box-shadow: rgba(0, 0, 0,0.3) 0px 8px 10px 0px;
background-color:#86B6F6;
font-family: Arial, Helvetica, sans-serif;
text-align: center;
align-items: center;

}

.form-group{
        margin-bottom:30px;
        height: 20px;
        margin-top: -10px;
        height: 50px;
        padding: 10px;
        
}
.form-group input{
    border: none;
    height: 30px;
    width: 500px;
    border-radius: 30px;    
    background-color: #EEF5FF;
    margin-top: -5px;
}
.form-btn input {
   
    background-color: #176B87;
    color: black;
    border-radius: 30px;
    width: 130px;
    height:50px;
    font: 1em sans-serif;
    font-weight: bold;
   
}
.form-btn input:hover{
    
    background-color: #B4D4FF;
}
.title h1{
    font-size: 80px;
    margin-top: -20px;
    color:#757f76;

}

.form-control{

    padding: 10px;
    margin-bottom: 20px;
    margin-left: -15px;


}

.title h2{

    float: left;
    font-size: 25px;
    margin-top: -20px;
    margin-left: 5px;

}

.reg{

    background-color: blue;


}
.alert-danger {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #f44336; /* Red background */
    color: white;
    padding: 10px;
    text-align: center;
}
.alert-success{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color:  green; /* Red background */
    color: white;
    padding: 10px;
    text-align: center;
    
}

 </style>
  
</head>
<body>
   
        <?php
        if (isset($_POST["submit"])) {
           $fullName = $_POST["fullname"];
           $email = $_POST["email"];
           $password = $_POST["password"];
           $passwordRepeat = $_POST["repeat_password"];

           $passwordHash = password_hash($password, PASSWORD_DEFAULT);

           $errors = array();

           if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
            array_push($errors,"All fields are required");
           }
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
           }
           if (strlen($password)<8) {
            array_push($errors,"Password must be at least 8 charactes long");
           }
           if ($password!==$passwordRepeat) {
            array_push($errors,"Password does not match");
           }
           require_once "database.php";
           $sql = "SELECT * FROM users WHERE email = '$email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"Email already exists!");
           }
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{

            $sql = "INSERT INTO users (full_name, email, password) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss",$fullName, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
            }else{
                die("Something went wrong");
            }
           }


        }
        ?>
         <div  class="container ">
            <form action="registration.php" method="post">
        <div class="title">
            <h1>
                NOTE
            </h1>
            <h2>Register</h2>
            <br>
        </div>
        <div class="form-group" >
                <input type="text" class="form-control" name="fullname" placeholder="   Full Name:">
                <input type="emamil" class="form-control" name="email" placeholder="   Email:">
                <input type="password" class="form-control" name="password" placeholder="  Password:">
                <input type="password" class="form-control" name="repeat_password" placeholder="  Repeat Password:">
                <div class="form-btn">
                <input type="submit" class="reg" value="Register" name="submit">
            </div>
            <div>
        <div><p><b style="color:black;">Already Registered ?</b> <a style="color:#757f76" href="login.php">Login Here</a></p></div>
      </div>

        </div>
        
        </form>
        
    </div>
</body>
</html>