<?php
session_start();
$submit = filter_input(INPUT_POST, 'submit');

$connection = mysqli_connect('localhost', 'root', '', '4400db');
$string = "SELECT R.username, R.aptno, reminderdate, message, status FROM resident AS R, reminder AS M WHERE R.aptno =M.aptno";
//$string = "SELECT username,message FROM resident AS R inner join reminder AS M on R.aptno=M.aptno WHERE R.username=$username";
$uquery=mysqli_query($connection, $string);
$numrows2 = mysqli_num_rows($uquery);
$username = $_SESSION['username'];
$status = 1;



if($numrows2 != 0){
    while($row = mysqli_fetch_assoc($uquery)){
        if($row['username'] == $username){
            $message = $row['message'];
            $aptno = $row['aptno'];
            $date = $row['reminderdate'];
            $status = $row['status'];
        }
    }
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
        <font size="6"><b>Homepage</b></font>
    </div>
    <div style="width:700px;height:125px;border:1px solid #000;">
        <form action="Homepage.php" method="POST">
            <p align="right">
                <a href="Message.php"><font size="3"><?php if($status =='0'){?>You have message from the department<?php }?></font></a>
            </p>

            <p>
                <a href="Rent.php"><font size="3">Pay Rent</font></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="Request Maintenance.php"><font size="3">Request Maintenance</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="Payment Information.php"><font size="3">Payment Information</font></a><br>
            </p>

            <br>
        </form>

    </div>
    </body>
</center>
</html>