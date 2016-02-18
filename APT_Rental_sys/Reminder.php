<?php
session_start();
$submit = filter_input(INPUT_POST, 'submit');
$submit1 = filter_input(INPUT_POST, 'submit1');
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');
$selectissue = strip_tags(filter_input(INPUT_POST,'selectissue'));
$message = strip_tags(filter_input(INPUT_POST,'Message'));

$connection = mysqli_connect('localhost', 'root', '', '4400db');
$query = mysqli_query($connection, "SELECT * FROM reminder");
$numrows = mysqli_num_rows($query);

date_default_timezone_set('America/New_York');
$currentdate = date('Y/m/d');
$currentmonth = date('m');
$currentday = date('d');
$currentyear = date('Y');
//$currentmonth = MONTH($currentdate);

if($submit){
    $insertquery = mysqli_query($connection, "INSERT INTO reminder VALUES ('$selectissue','$currentdate','$message', '0')");
    header('Location: Manager Homepage.php');
}

if ($submit1) {
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
        <font size="5"><b>Reminder</b></font>
    </div>
    <div style="width:700px;height:250px;border:1px solid #000;">


        <form action="Reminder.php" method = "POST">

            <br>
            <div style="padding-left:50px;">
                <p align="right"><?php echo $currentdate ?></p>
                <p align="left">
                    <?php
                    $connection = mysqli_connect('localhost', 'root', '', '4400db');
                    $username = $_SESSION['username'];

                    include_once('Reminder.php');
                    $query1 = mysqli_query($connection, "SELECT aptno FROM apartment as a WHERE not EXISTS (SELECT aptno FROM paysrent as p WHERE a.aptno = p.aptno AND month(p.payfor) = $currentmonth AND year(p.payfor)=$currentyear) AND '01'< $currentday AND EXISTS (SELECT aptno FROM resident as r WHERE a.aptno = r.aptno)");
                    ?>

                    Apartment No: <select name="selectissue">
                        <?php
                        while ($rowCerts = $query1->fetch_assoc()) {
                            echo "<option value=\"{$rowCerts['aptno']}\">";
                            echo $rowCerts['aptno'];
                            echo "</option>";
                        }
                        ?>
                    </select>
                    <br>
                    Message: <br>
                    <textarea name="Message" rows="4" cols="50"> Your payment is past due. Please pay immediately.</textarea><br>
                    <br>
                <div style="padding-left:300px;">
                    <input type="submit" name="submit" value="Send">
                </div>
                <div style="padding-left:300px;">
                    <input type="submit" name="submit1" value="go back to homepage">
                </div>
                </p>
            </div>
        </form>

    </div>
    </body>
</center>
</html>