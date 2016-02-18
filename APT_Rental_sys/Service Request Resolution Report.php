<?php
session_start();
$submit = filter_input(INPUT_POST, 'submit');
$username = $_SESSION['username'];

date_default_timezone_set('America/New_York');
$currentdate = date('Y/m/d');
$currentmonth = date('m');

$connection = mysqli_connect('localhost', 'root', '', '4400db');


//$temp = ""
$query = mysqli_query($connection, "SELECT month(dateofrequest), issue, round(avg(tookdays),0) FROM maintenance as a WHERE month(dateofrequest) >7 and month(dateofrequest) < 11 group by month(dateofrequest), issue");
//$query = mysqli_query($connection, "SELECT month(dateofrequest), a.issue, avg(tookdays) FROM maintenance as a INNER JOIN issue as i on a.issue=i.issue WHERE month(dateofrequest) >7 and month(dateofrequest) < 11 group by month(dateofrequest), i.issue");
$numrows = mysqli_num_rows($query);
//"SELECT month(dateofrequest), issue, avg(tookdays) FROM maintenance as a WHERE IN (SELECT month(dateofrequest), issue, avg(tookdays) FROM maintenance WHERE (dateofrequest) >7 and month(dateofrequest) < 11 group by dateofrequest) group by dateofrequest,issue"
//$inner = "SELECT distinct  month(dateofrequest), issue, avg(tookdays) FROM maintenance WHERE (dateofrequest) >7 and month(dateofrequest) < 11 group by issue";
//$query = mysqli_query($connection, "SELECT distinct month(dateofrequest), issue, avg(tookdays) FROM $inner WHERE (dateofrequest) >7 and month(dateofrequest) < 11 group by dateofrequest");
//$numrows = mysqli_num_rows($query);
if($submit){
    //$insertquery = mysqli_query($connection, "INSERT INTO reminder VALUES ('$selectissue','$currentdate','$message', '0')");
    header('Location: Manager Homepage.php');
}

?>




<html>
<center>
    <h1></h1>
    <body>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div style="width:700px;height:40px;border:1px solid #000;background-color:0099FF;">
        <font size="5"><b>Service Request Resolution Report</b></font>
    </div>
    <div style="width:700px;height:250px;border:1px solid #000;">
        <form action="Service Request Resolution Report.php" method="POST">

            <br>
            <div>
                <table border="1">
                    <tr>
                        <th scope="col">Month</th>
                        <th scope="col">Type of Request</th>
                        <th scope="col">Average No of Days</th>
                    </tr>
                    <?php
                    $a = 0;
                    $b = 0;
                    $c = 0;
                    if ($numrows != 0) {
                    while ($row = mysqli_fetch_assoc($query)) {?>
                    <tr>
                        <th scope="col"><?php

                            if($row['month(dateofrequest)'] == 8 && $a == 0) {
                                $a = 1;
                                echo "August";
                            } elseif($row['month(dateofrequest)'] == 9 && $b == 0) {
                                $b = 1;
                                echo "September";
                            } else if($row['month(dateofrequest)'] == 10 && $c == 0) {
                                $c = 1;
                                echo "October";
                            }

                            ?></th>
                        <th scope="col"><?php echo $row['issue']?></th>
                        <th scope="col"><?php echo $row['round(avg(tookdays),0)']?></th>


                        <?php }}?>

                    </tr>
                </table>
            </div>
            <br>
            <div>
                <input type="submit" name="submit" value="go back to homepage" >
            </div>

        </form>
        <br>

    </div>

    </body>
</center>
</html>