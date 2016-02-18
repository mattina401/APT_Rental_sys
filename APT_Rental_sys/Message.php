<?php
session_start();
$submit = filter_input(INPUT_POST, 'submit');

$username = $_SESSION['username'];

date_default_timezone_set('America/New_York');
$currentdate = date('Y/m/d');
$currentmonth = date('m');

if($submit){
    //$insertquery = mysqli_query($connection, "INSERT INTO reminder VALUES ('$selectissue','$currentdate','$message', '0')");
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
        <font size="5"><b>Message</b></font>
    </div>
    <div style="width:700px;height:250px;border:1px solid #000;">


        <form action="Message.php" method = "POST">

            <br>
            <div style="padding-left:50px;">
                <p align="right"><?php echo $currentdate ?></p>
                <p align="left">
                    <?php
                    $connection = mysqli_connect('localhost', 'root', '', '4400db');
                    $string = "SELECT R.username, R.aptno, reminderdate, message, status FROM resident AS R, reminder AS M WHERE R.aptno=M.aptno";
                    //$string = "SELECT username,message FROM resident AS R inner join reminder AS M on R.aptno=M.aptno WHERE R.username=$username";
                    $uquery=mysqli_query($connection, $string);
                    $numrows2 = mysqli_num_rows($uquery);
                    $username = $_SESSION['username'];

                    if($numrows2 != 0){
                        while($row = mysqli_fetch_assoc($uquery)){
                            if($row['username'] == $username){
                                $message = $row['message'];
                                //$status = $row['status'];
                                $aptno = $row['aptno'];
                                $date = $row['reminderdate'];
                                $status = $row['status'];
                                $updatequery = mysqli_query($connection, "UPDATE reminder SET status = '1' WHERE aptno='$aptno' and reminderdate = '$date' and message = '$message'");
                            }
                        }
                    }

                    ?>
                    Message: <br>
                <p><?php
                    if($status =='0'){echo $message;}?></p><br>
                <br>
                <div style="padding-left:300px;">
                    <input type="submit" name="submit" value="Done" >
                </div>
                </p>
            </div>
        </form>

    </div>
    </body>
</center>
</html>