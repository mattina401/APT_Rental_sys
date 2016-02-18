<?php


session_start();
$submit = filter_input(INPUT_POST, 'submit');
$submit1 = filter_input(INPUT_POST, 'submit1');
$report = filter_input(INPUT_POST, 'report');
//$username = $_SESSION['username'];

$paymonth = 1;


$connection = mysqli_connect('localhost', 'root', '', '4400db');

$query = mysqli_query($connection, "SELECT p.aptno as apt, p.amount-a.rent, (p.amount-a.rent)/50 as mo from paysrent as p, apartment as a where p.aptno = a.aptno and p.amount - a.rent > 0 and month(p.dateofpayment)='$paymonth'");
$numrows = mysqli_num_rows($query);


if ($submit) {

    $paymonth = $report;
    $query = mysqli_query($connection, "SELECT p.aptno as apt, p.amount-a.rent, round((p.amount-a.rent)/50,0) from paysrent as p, apartment as a where p.aptno = a.aptno and p.amount - a.rent > 0 and month(dateofpayment)='$paymonth'");
    $numrows = mysqli_num_rows($query);

    //header('Location: Rent Defaulters.php');
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
		<font size="5"><b>Rent Defaulters</b></font>
		</div>
		<div style="width:700px;height:250px;border:1px solid #000;">
			<form action="Rent Defaulters.php" method="POST">

				<br>
				<p align="center">
					Month: <select name="report">
                        <option value="1"<?php echo(isset($_POST['select_name'])&&($_POST['select_name']=='1')?' selected="selected"':'');?>>January</option>
                        <option value="2"<?php echo(isset($_POST['select_name'])&&($_POST['select_name']=='2')?' selected="selected"':'');?>>February</option>
                        <option value="3"<?php echo(isset($_POST['select_name'])&&($_POST['select_name']=='3')?' selected="selected"':'');?>>March</option>
                        <option value="4"<?php echo(isset($_POST['select_name'])&&($_POST['select_name']=='1')?' selected="selected"':'');?>>April</option>
                        <option value="5"<?php echo(isset($_POST['select_name'])&&($_POST['select_name']=='2')?' selected="selected"':'');?>>May</option>
                        <option value="6"<?php echo(isset($_POST['select_name'])&&($_POST['select_name']=='3')?' selected="selected"':'');?>>June</option>
                        <option value="7"<?php echo(isset($_POST['select_name'])&&($_POST['select_name']=='1')?' selected="selected"':'');?>>July</option>
                        <option value="8"<?php echo(isset($_POST['select_name'])&&($_POST['select_name']=='2')?' selected="selected"':'');?>>August</option>
                        <option value="9"<?php echo(isset($_POST['select_name'])&&($_POST['select_name']=='3')?' selected="selected"':'');?>>September</option>
                        <option value="10"<?php echo(isset($_POST['select_name'])&&($_POST['select_name']=='1')?' selected="selected"':'');?>>October</option>
                        <option value="11"<?php echo(isset($_POST['select_name'])&&($_POST['select_name']=='2')?' selected="selected"':'');?>>November</option>
                        <option value="12"<?php echo(isset($_POST['select_name'])&&($_POST['select_name']=='3')?' selected="selected"':'');?>>December</option>
                    </select><br>
				</p>
				<div>
					<table border="1">
					  <tr>
					    <th scope="col">Apartment</th>
					    <th scope="col">Extra Amount Paid($)</th>
					    <th scope="col">Defaulted By</th>
					  </tr>
                        <?php
                        if ($numrows != 0) {
                        while ($row = mysqli_fetch_assoc($query)) {?>
                        <tr>
                            <th scope="col"><?php echo $row['apt']?></th>
                            <th scope="col"><?php echo $row['p.amount-a.rent']?></th>
                            <th scope="col"><?php echo $row['round((p.amount-a.rent)/50,0)']?></th>


                            <?php }}?>

                        </tr>


					</table>
				</div>
				<br>

                <div>
                    <input type="submit" name="submit" >
                </div>
                <div>
                    <input type="submit" name="submit1" value="go back homepage" >
                </div>
				
			</form>
			<br>

		</div>

	</body>
</center>
</html>