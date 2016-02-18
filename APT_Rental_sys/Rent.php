<?php
session_start();
$submit = filter_input(INPUT_POST, 'submit');
$exp = filter_input(INPUT_POST, 'exp');
$selectcard = filter_input(INPUT_POST, 'selectcard');
$connection = mysqli_connect('localhost', 'root', '', '4400db');

$username = $_SESSION['username'];

$exp1 = $exp;

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
<font size="5"><b>Rent</b></font>
</div>
<div style="width:700px;height:300px;border:1px solid #000;">


<form action="Rent.php" method="POST">

<br>
<div style="padding-left:50px;">
<p align="left">
    <br>
Date: <?php
    $currentdate = new DateTime('2014-12-1');
    //$currentdate = new DateTime();
    $result = $currentdate->format('Y-m-d '); echo $result;
    ?><br>
<br>

    <?php

    $query = mysqli_query($connection, "SELECT aptno FROM resident WHERE username = '$username'");
    $row = mysqli_fetch_assoc($query)

?>
Apartment No: <?php echo $row['aptno']; ?>
<br>
    <br>
Rent for Month:<input type="date" name="exp"><br>
    <?php
    $currentyear = $currentdate->format('Y');
    $currentmonth = $currentdate->format('m');
    $currentday = $currentdate->format('d');


    $aptno = $row['aptno'];
    $userinfo = mysqli_query($connection, "SELECT * FROM apartment as a where not exists (select aptno from paysrent as p where a.aptno = p.aptno and year(p.dateofpayment) = '$currentyear' and month(p.dateofpayment)='$currentmonth') and exists (select aptno from resident as r where a.aptno=r.aptno and r.username = '$username')");
    $userinforow = mysqli_fetch_assoc($userinfo);


    if ($userinforow != 0) {

        $pdate = mysqli_query($connection,"SELECT day(pdate) FROM prospective as p WHERE username = '$username' and year(p.pdate) = '$currentyear' and month(p.pdate)='$currentmonth' ");
        $pdaterow =  mysqli_fetch_assoc($pdate);

        if ($pdaterow) {
            if($pdaterow['day(pdate)'] >= 7 ) {
                $amount = (($userinforow['rent'])/30)*($currentday - $pdaterow['day(pdate)']);

                if ($amount < 0) {
                    $amount = 0;
                }
            } else if ($pdaterow['day(pdate)'] < 7) {
                $amount = (($userinforow['rent'])/30)*($currentday-7);
            }
        } else {
            $amount = $userinforow['rent'] + 50*($currentday-3);
        }

    } else
        $amount = 0;




    ?>
    <br>

Amount due:<?php



    echo $amount; ?>


    <br>
<br>
    <?php
    $connection = mysqli_connect('localhost', 'root', '', '4400db');
    //$username = $_SESSION['username'];

    include_once('Rent.php');
    $query1 = mysqli_query($connection, "SELECT id,cardno FROM payment WHERE username='$username'");
    ?>

    Use Card: <select name="selectcard">
        <?php
        while ($rowCerts = $query1->fetch_assoc()) {
            echo "<option value=\"{$rowCerts['cardno']}\">";
            echo $rowCerts['cardno'];
            echo "</option>";
        }
        ?>
    </select>
</p>
</div>

<br>
<div style="padding-left:300px;">
<input type="submit" name="submit">

</div>
</form>
</div>
</body>
</center>
</html>

<?php
if ($submit) {



    //$currentdate = date('2014-9-24');

    //$exp = date('Y');
    //$currentdate = date('m');



    //$date = new DateTime('2000-01-01');
    //$result = $exp->format('m');

    //$result = $exp->format('mm');
   // $result = date_format($exp, 'mm');
    //echo $result;




    if ($exp && $selectcard) {
        $query = mysqli_query($connection, "INSERT INTO paysrent VALUES('$selectcard','$exp','$aptno','$result','$amount')");

        header('Location: Homepage.php');
    } else {
        echo "<p align='center' style='color:red; '>plz select all fields</p>";
    }




}
?>