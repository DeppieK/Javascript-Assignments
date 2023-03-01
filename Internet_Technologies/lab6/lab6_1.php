<!DOCTYPE html>
<html>
        <head>
            <meta charset="utf-8">
            <title>ΚΟΜΥ</title>
        </head>
        <body>
            <?php
                //connecting...
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "personal2";
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                //utf-8
                mysqli_set_charset($conn, "utf8");
                $row = 1;
                $k = 1;
                $l = 0;
                $sum = 0;
                $table = [];
                $myfile = fopen("file.csv", "r");
                while (!feof($myfile)){
                    while (($data = fgetcsv($myfile, 2000, ",")) !== FALSE) {
                        $range = count($data);
                        //deleting the samples with the word "ΤΕΛΟΣ"
                        for ($i=0; $i < $range; $i++) {
                            if ($data[$i] == "ΤΕΛΟΣ"){
                                unset($data[$i]);
                                unset($data[$i-1]);
                            }
                            //deleting the title
                            else{
                                if (($data[$i] == "Περιοχή")||($data[$i] == "Δείγματα")){
                                    unset($data[$i]);
                                }
                            }
                        }
                        $range = count($data);
                        $l = count($table);
                        for($i=0;$i < $range;$i++){
                            $table[$l] = $data[$i];
                            $l++;
                        }
                    }
                }
                //inserting the data into the dataBase
                fclose($myfile);
                       for($i=0;$i <($l-1);$i+=2){
                           $k = $i + 1;
                           $sql = "INSERT INTO `me2` (`region`, `sample`) VALUES ('$table[$i]', '$table[$k]')";
                           mysqli_query($conn, $sql);
                        }
                
                $k=1;
                $max = 0;
                $conn->close(); //ending connection
                //creating a 2d (region,sample) array with the amount of positive samples in each region
                for($i=0;$i < 20;$i++){
                    $j = 0;
                    $sameRegn = 1;
                    $positives[$i][$j] = $table[$k-1];
                    $sum = 0;
                    while (($sameRegn == 1)&&($k < (count($table)-1))){
                        if ($table[$k] == "Θ"){
                            $sum++;
                        }
                        if ($k != count($table)){
                            if ($table[$k - 1] != $table[$k+1]){ //if the region is different
                                $sameRegn = 0;
                            }
                        }
                        $k+=2;
                    }
                    $j++;
                    $positives[$i][$j] = $sum;
                }
                //finding the max of the positives array
                for($i=0;$i < 20;$i++){
                    if($positives[$i][1] >= $max){
                        $max = $positives[$i][1];
                    }
                }
                //printing all the max values
                for($i=0;$i < 20;$i++){
                    if($positives[$i][1] == $max){
                        echo "Περιοχή/Περιοχές με τα περισσότερα θετικά δείγματα:". "<br/>";
                        echo $positives[$i][0] . "\n";
                        echo $positives[$i][1]. "<br/>";
                        echo "<br/>";

                    }
                }
                //creating a sorting function
                function sortt($x){
                    for($i=0;$i<20;$i++){
                        for($j=0;$j<19-$i;$j++){
                            if($x[$j+1][1] > $x[$j][1] ){
                                $flag = $x[$j+1][0];
                                $x[$j+1][0] = $x[$j][0];
                                $x[$j][0] = $flag;
                                $flag = $x[$j+1][1];
                                $x[$j+1][1] = $x[$j][1];
                                $x[$j][1] = $flag;
                            }
                        }
                    }
                    return $x;
                }
                //sorting the array
                $x = sortt($positives);
                //printing the sorted array
                echo "Περιοχές κατα φθίνουσα σείρα με βάση τα θετικά δείγματα:" . "<br/>";
                for($i=0;$i<20;$i++){
                    echo $x[$i][0] . "<br/>";
                }
            ?>
        </body>
</html>