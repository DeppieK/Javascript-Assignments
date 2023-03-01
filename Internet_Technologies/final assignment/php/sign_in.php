<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>IEETeL</title>
    </head>
    <body>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "final_ass";
            $con = mysqli_connect($servername, $username, $password, $dbname);
            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }
            mysqli_set_charset($con, "utf8");

            $username = $_POST['username'];  
            $password = $_POST['password'];  
          
            //to prevent from mysqli injection  
            $username = stripcslashes($username);  
            $password = stripcslashes($password);  
            $username = mysqli_real_escape_string($con, $username);  
            $password = mysqli_real_escape_string($con, $password);  
          
            $sql = "select *from form where username = '$username' and password = '$password'";  
            $result = mysqli_query($con, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $count = mysqli_num_rows($result);  
              
            if($count == 1){  
                include 'C:\xampp\htdocs\final_assignment\final_program.html';  //go to final program
            }  
            else{  
                include 'file:///C:/xampp/htdocs/final_assignment/sign_in.html'; //error: the credentials don't match to a registered user
                echo '<script>alert("Invalid credentials")</script>';
            }     
        ?>
    </body>
</html>