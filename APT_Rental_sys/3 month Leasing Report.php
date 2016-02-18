<?php

session_start();
$submit = filter_input(INPUT_POST, 'submit');
//$username = $_SESSION['username'];

$connection = mysqli_connect('localhost', 'root', '', '4400db');

$query = mysqli_query($connection, "SELECT month(available), category, count(category) FROM apartment as a WHERE EXISTS (SELECT aptno FROM resident as r WHERE a.aptno = r.aptno) and month(available) >7 and month(available) < 11 group by available,category");
$numrows = mysqli_num_rows($query);


if ($submit) {
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
		<font size="5"><b>3 month Leasing Report</b></font>
		</div>
		<div style="width:700px;height:auto;border:1px solid #000;">
			<form action="3 month Leasing Report.php" method="POST">

				<br>
				<div>
					<table border="1">
					  <tr>
					    <th scope="col">Month</th>
					    <th scope="col">Category</th>
					    <th scope="col">No. of Apartments</th>
					  </tr>
                        <?php
                        $a = 0;
                        $b = 0;
                        $c = 0;
                        if ($numrows != 0) {
                            while ($row = mysqli_fetch_assoc($query)) {?>
                                <tr>
                                    <th scope="col"><?php

                                        if($row['month(available)'] == 8 && $a == 0) {
                                            $a = 1;
                                            echo "August";
                                        } elseif($row['month(available)'] == 9 && $b == 0) {
                                            $b = 1;
                                            echo "September";
                                        } else if($row['month(available)'] == 10 && $c == 0) {
                                            $c = 1;
                                            echo "October";
                                        }

                                        ?></th>
                                    <th scope="col"><?php echo $row['category']?></th>
                                    <th scope="col"><?php echo $row['count(category)']?></th>


                                   <?php }}?>

                                </tr>

					</table>
				</div>
				<br>
                <div>
                    <input type="submit" name="submit" >
                </div>
				
			</form>
			<br>

		</div>

	</body>
</center>
</html>