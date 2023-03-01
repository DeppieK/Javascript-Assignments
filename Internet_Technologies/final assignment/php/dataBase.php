<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>IEETeL</title>
    </head>
    <body>
        <?php
            //Connecting...
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "final_ass";
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            //if connection is failed
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            mysqli_set_charset($conn, "utf8");
            //importing the data from the form inputs into the sql database
            $sql = "INSERT INTO `form`(`firstname`, `lastname`, `gender`, `email`, `phone`, `username`, `password`, `confirmpassword`, `terms`) 
            VALUES ('".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['gender']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['username']."','".$_POST['password']."','".$_POST['confirmpassword']."','".$_POST['terms']."')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                include 'C:\xampp\htdocs\final_assignment\final_program.html'; //go to the final program
            }
            mysqli_close($conn); //end connection
        ?>
    </body>
</html>