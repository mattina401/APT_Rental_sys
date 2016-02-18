<?php
session_start();

$submit1 = filter_input(INPUT_POST, 'submit1');
$submit2 = filter_input(INPUT_POST, 'submit2');
$name = strip_tags(filter_input(INPUT_POST,'name'));
$cardnumber = strip_tags(filter_input(INPUT_POST,'cardnumber'));
$exp = strip_tags(filter_input(INPUT_POST,'exp'));
$cvv = strip_tags(filter_input(INPUT_POST,'cvv'));
$selectcard = strip_tags(filter_input(INPUT_POST,'selectcard'));

$username = $_SESSION['username'];

$connection = mysqli_connect('localhost', 'root', '', '4400db');


if($submit1) {

    if($name&&$cardnumber&&$exp&&$cvv) {

        $query = mysqli_query($connection, "SELECT * FROM payment WHERE username='$username' and cardno = '$cardnumber'");

        $numrows = mysqli_num_rows($query);

        if($numrows == 0) {

            $query = mysqli_query($connection, "INSERT INTO payment VALUES ('','$username','$name','$cardnumber','$exp','$cvv')");
            header('Location: Homepage.php');

        }
        else {
            echo "<p align='center' style='color:red; '>you already added this card</p>";
        }


    }
    else {
        echo "<p align='center' style='color:red; '>please fill in all fields!</p>";
    }
}

if($submit2) {

    $query = mysqli_query($connection, "DELETE FROM payment WHERE username='$username' and cardno = '$selectcard'");
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
<font size="5"><b>Payment Information</b></font>
</div>

<div style="width:350px;height:300px; float: left">
</div>
<div style="width:250px;height:300px; float: left">
</div>
<form action="Payment Information.php" method="POST">
<div style="width:350px;height:300px;border:1px solid #000; float: left">

    <p><u><b>Add Card</b></u></p>
    <div style="padding-left:30px;">
    <p align="left">
        Name on the card:<input type="text" name="name"><br>
        <br>
        Card Number:<input type="text" name="cardnumber"><br>
        <br>
        Expiration Date: <input type="month" name="exp"><br><br>
        <br>
        CVV:<input type="text" name="cvv"><br>
    </p>
        </div>
<br>
    <div style="padding-center:200px;padding-top: 30px">
        <input type="submit" name="submit1" value="Add Card">

    </div>


</div>
<div style="width:350px;height:300px;border:1px solid #000; float: left">

    <p><u><b>Delete Card Information</b></u></p>
    <div style="padding-left:30px;">

    <p align="left">

        <?php
        $connection = mysqli_connect('localhost', 'root', '', '4400db');
        $username = $_SESSION['username'];

        include_once('Payment Information.php');
        $query1 = mysqli_query($connection, "SELECT id,cardno FROM payment WHERE username='$username'");
        ?>

        Select Card: <select name="selectcard">
            <?php
            while ($rowCerts = $query1->fetch_assoc()) {
                echo "<option value=\"{$rowCerts['cardno']}\">";
                echo $rowCerts['cardno'];
                echo "</option>";
            }
            ?>
        </select>


        <br>
    </p>
</div>
    <br>
    <br>
    <br>
    <br><br>
    <p align="right">
        <a href="Homepage.php"><font size="3">go back Hompage</font></a>
    </p>
    <div style="padding-center:300px; padding-top: 40px">
        <input type="submit" name="submit2" value="Delete Card">
    </div>
    </div>
</form>
</body>
</center>

</html>
