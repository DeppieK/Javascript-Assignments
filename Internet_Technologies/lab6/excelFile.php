<?php
    require "C:/xampp/htdocs/excel.csv";
    $myfile = fopen("excel.csv", "r") or die("Unable to open file!");
        $row = 1;
        if (($myfile = fopen("excel.csv", "r")) !== FALSE) {
            while (($array = fgetcsv($myfile, 1000, ",")) !== FALSE) {
                $row++;
                $num = count($array);
            }
            if($row == 1){
                $i = 0;
                $txt = "Περιοχή-Δείγματα";
                fwrite($myfile, $txt);

            }
            else{
                $i +=1;
            }
            $list[$i] = $_POST['sample'];
            $myfile = fopen('excel.csv', 'w');
            if($row % 100 == 0){
                foreach ($list as &$value) {
                    fputcsv($myfile,$_POST['region']);
                    fputcsv($myfile, $value);
                }
            }
    }
    
    fclose($myfile);
    $servername = "localhost";
    $sampleName = "root";
    $password = "";
    $dbname = "personal2";
        // Δημιουργία σύνδεσης
        $conn = mysqli_connect($servername, $sampleName, $password, $dbname);
        // Έλεγχος σύνδεσης
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        //ορισμός charset της σύνδεσης ώστε να παρουσιάζονται τα ελληνικά σωστά
        mysqli_set_charset($conn, "utf8");
        //Δημιουργία ερωτήματος
        $sql = "INSERT INTO `me2`(`sample`)
        VALUES('".$_POST['sample']."')";
        //εκτέλεση ερωτήματος στη βάση
        $result = mysqli_query($conn, $sql);
        //έλεγχος αποτελεσμάτων
        if ($result) {
            //Εμφάνιση αποτελεσμάτων σε μορφή πίνακα
            header("Location: http://localhost/lab6_1.php");
        }
    //κλείσιμο σύνδεσης
    mysqli_close($conn);

















    header("Location: http://localhost/lab6_1.php");



?>