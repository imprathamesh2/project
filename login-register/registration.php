<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Document</title>
</head>
<body>
    <div class="background2">
        <?php
        if(isset($_POST["submit"])){
          $fullname=$_POST["fullname"];
          $email=$_POST["email"];
          $password=$_POST["password"];
          $passwordRepeat=$_POST["repassword"];
          $password_hash=password_hash($password, PASSWORD_DEFAULT);
          $error = array();
          if(empty($fullname) OR empty($email) OR empty($password) OR empty($passwordRepeat)){
            array_push($error,"All fields are required");
          }
          if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            array_push($error,"email is not valid");
          }
          if(strlen($password)<8){
            array_push($error,"password must be atleast 8 characters");
          }
          if($password!==$passwordRepeat){
            array_push($error,"password does not match");
          }
          if(count($error)>0){
            foreach($error as $error){
                echo "<div class='alert alert-danger'>$error</div>";

            }
          }else{
            require_once "database.php";
            $sql = "INSERT INTO users(fullName,email,password) VALUES(?,?,?)";
            $stmt=mysqli_stmt_init($conn);
            $preparestmt=mysqli_stmt_prepare($stmt,$sql);
            if($preparestmt) {
                mysql_stmt_bind_param($stmt,"sss",$fullname,$email,$password_hash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered succesfully</div>";
            }else{
                die("something went wrong");
            }
          }
        }
        ?>
        <form action="registration.php" method="post">
            <div class="forminfo">

                <h2> Register Here ! !</h2>

                <input type="text" id="fullname" name="fullname" placeholder="Fullname:">


                <input type="email" id="email" name="email" placeholder="Email-Id" :>


                <input type="password" id="password" name="password" placeholder="Password:">


                <input type="password" id="repassword" name="repassword" placeholder="Re-Enter password:">

                <button type="submit" value="reg" name="submit">Register</button>
                <p>Already have an account?</p>
                <a href="login.html">Login here!</a>
                
            </div>

    </div>


</body>

</html>
    
</body>
</html>