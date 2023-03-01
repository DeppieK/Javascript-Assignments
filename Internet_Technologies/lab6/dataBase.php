<?php
    $servername = "localhost";
    $regionName = "root";
    $password = "";
    $dbname = "personal2";
        // Δημιουργία σύνδεσης
        $conn = mysqli_connect($servername, $regionName, $password, $dbname);
        // Έλεγχος σύνδεσης
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        //ορισμός charset της σύνδεσης ώστε να παρουσιάζονται τα ελληνικά σωστά
        mysqli_set_charset($conn, "utf8");
        //Δημιουργία ερωτήματος
        $sql = "INSERT INTO `me2`(`region`)
        VALUES('".$_POST['region']."')";
        //εκτέλεση ερωτήματος στη βάση
        $result = mysqli_query($conn, $sql);
        //έλεγχος αποτελεσμάτων
        if ($result) {
            //Εμφάνιση αποτελεσμάτων σε μορφή πίνακα
            header("Location: http://localhost/lab6_1.php");
        }
    //κλείσιμο σύνδεσης
    mysqli_close($conn);
?>