<?php
session_start();
if (isset($_SESSION["users"])) {
   header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
  
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
padding:60px;
height: 400px;
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
    background-color:  #EEF5FF;
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
  
    background-color:#B4D4FF;
}
.footer{
    align-items: center;
}
.form-control{

padding: 10px;
margin-bottom: 20px;
margin-left: -15px;


}
.reg{

background-color: blue;

}
    </style>
</head>
<body >
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    $_SESSION["using"] = $user["email"];
                    $_SESSION["user_id"] = $user["user_id"];
                    header("Location: index.php"); 

                    die();
                }else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>All fields are required</div>";
            }
        }
        ?>
      <form action="login.php" method="post">
        <div>
            <h1 style="  font-size: 80px;
   
    color:#757f76;">
                NOTE
            </h1>
            <br>
        </div>


        <div class="form-group">
            <input type="email" placeholder="  Enter Email:" name="email" class="form-control">

            <input type="password" placeholder="  Enter Password:" name="password" class="form-control">

        <div class="form-btn">
                <input type="submit" class="reg" value="Login" name="login">
                <p><b style="color:black";>Not registered yet ?</b> <a style="color:#757f76;"href="registration.php">Register Here</a></p>
            </div>
       </div>
      </form>
     <!-- <div >
        <p><b style="color:black";>Not registered yet ?</b> <a style="color:#757f76;"href="registration.php">Register Here</a></p></div>
    </div> -->
</body>
</html>