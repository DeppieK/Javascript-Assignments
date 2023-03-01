<!DOCTYPE html>
<html>
    <head>
        <title>lab 5 PHP</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php 
            $myvalues = fopen("myvalues.txt", "r") or die("Unable to open file!");
            while(!feof($myvalues)) {
                echo fgets($myvalues) . "<br>";
            }
                $row = 1;
                if (($myvalues = fopen("myvalues.txt", "r")) !== FALSE) {
                    while (($values = fgetcsv($myvalues, 1000, ",")) !== FALSE) {
                        $num = count($values);
                        $row++;
                        $sum = 0;
                        for($i=0;$i<$num;$i++){
                            $sum += $values[$i];
                        }
                        $max = max($values);
                        $min = min($values);
                        $aver = ($sum/$num);
                }
                $myvalues = fopen("myvalues2.txt", "w") or die("Unable to open file!");
                $txt = $max . " ";
                fwrite($myvalues, $txt);
                $txt = $min ." ";
                fwrite($myvalues, $txt);
                $txt = $aver. " ";
                fwrite($myvalues, $txt);
            }
            fclose($myvalues);
            ?>
    </body>
</html>