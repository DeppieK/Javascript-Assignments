<!DOCTYPE html>
<html>
    <head>
        <title>Εφαρμογή 1 PHP</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php 
            for($k=0;$k<=10;$k++)
            {
                for($m=10;$m >=$k;$m--)
                {
                    echo "$m";
                }
                echo "<br>";
            }        
            echo "<br>";
            echo "<br>";
            for ($k=0;$k<=10;$k++)
            {
                $l=0;
                for ($m=0;$m<=$k;$m++)
                {
                    echo"$l";
                    $l+=1;
                }
                echo "<br>";
            }
            ?>
    </body>
</html>