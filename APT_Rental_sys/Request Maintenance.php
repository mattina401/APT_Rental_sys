<?php
session_start();
$username = $_SESSION['username'];
$submit = filter_input(INPUT_POST, 'submit');
$selectissue = strip_tags(filter_input(INPUT_POST,'selectissue'));

$connection = mysqli_connect('localhost', 'root', '', '4400db');
$query = mysqli_query($connection, "SELECT * FROM resident WHERE username='$username'");
$numrows = mysqli_num_rows($query);


if ($numrows != 0) {

    while ($row = mysqli_fetch_assoc($query)) {
        //$dbusername = $row['username'];
        $dbaptnumber = $row['aptno'];
    }
}
if($submit){
    // if ($numrows != 0) {

    //     while ($row = mysqli_fetch_assoc($query)) {
    //          $dbusername = $row['username'];
    //         $dbaptnumber = $row['aptno'];
    //     }
    // }
    date_default_timezone_set('America/New_York');
    $requestdate = date('Y/m/d');
    $insertquery = mysqli_query($connection, "INSERT INTO maintenance VALUES ('$selectissue','$requestdate','$dbaptnumber', '0' , '0')");
    header('Location: Homepage.php');
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
        <font size="5"><b>Request Maintenance</b></font>
    </div>
    <div style="width:700px;height:250px;border:1px solid #000;">

        <form action="Request Maintenance.php" method="POST">
            <br>
            <div style="padding-left:50px;">
                <p align="right">Date of Request:<?php date_default_timezone_set('America/New_York'); $date = date('Y/m/d', time()); echo $date;?></p>
                <p align="left">
                    Apartment No:<?php echo $dbaptnumber; ?><br>
                    <br>
                    <?php
                    $connection = mysqli_connect('localhost', 'root', '', '4400db');
                    $username = $_SESSION['username'];

                    include_once('Request Maintenance.php');
                    $query1 = mysqli_query($connection, "SELECT * FROM issue");
                    ?>

                    Issue: <select name="selectissue">
                        <?php
                        while ($rowCerts = $query1->fetch_assoc()) {
                            echo "<option value=\"{$rowCerts['issue']}\">";
                            echo $rowCerts['issue'];
                            echo "</option>";
                        }
                        ?>
                    </select>
                    <br>
            </div>
            <br>

            <div style="padding-left:300px;">
                <input type="submit" name="submit" value="Submit Request">
            </div>
        </form>


    </div>

    </body>
</center>
</html>