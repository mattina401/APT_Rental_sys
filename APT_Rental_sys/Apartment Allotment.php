
<?php
session_start();
$submit = filter_input(INPUT_POST, 'submit');
$submit1 = filter_input(INPUT_POST, 'submit1');
$connection = mysqli_connect('localhost', 'root', '', '4400db');

$aptno1 = filter_input(INPUT_POST, 'gender1');

$username1 = $_SESSION['gender'];

$userinfo = mysqli_query($connection, "SELECT * FROM prospective where username = '$username1'");
$numuserinfo = mysqli_num_rows($userinfo);

if ($numuserinfo != 0) {
while ($row = mysqli_fetch_assoc($userinfo)) {
    $category = $row['category'];
    $lease = $row['lease'];
    $monthlyincome = $row['monthlyincome'];
    $pdate = $row['pdate'];
}
}

$query = mysqli_query($connection, "SELECT *  FROM apartment as p WHERE category = '$category' and lease = '$lease' and rent*3 < '$monthlyincome' and available <='$pdate' and not exists (select aptno from resident as r where p.aptno = r.aptno )");

//$query = mysqli_query($connection, "SELECT * FROM apartment as a WHERE NOT EXISTS (SELECT aptno FROM resident as r WHERE a.aptno = r.aptno)");
$numrows = mysqli_num_rows($query);

if($submit) {

    if ($username1) {
        $query1 = mysqli_query($connection, "INSERT INTO resident VALUES ('','$username1','$aptno1')");

        $query2 = mysqli_query($connection, "UPDATE users SET review = '1' WHERE username = '$username1'");
        header('Location: Manager Homepage.php');
    } else {
        echo "<p align='center' style='color:red; '>plz select one</p>";
    }

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
		<font size="5"><b>Apartment Allotment</b></font>
		</div>
		<div style="width:700px;height:auto;border:1px solid #000;">
			<form action="Apartment Allotment.php" method="POST">

                <?php
                $name = mysqli_query($connection, "SELECT uname FROM prospective WHERE username = '$username1'");

                $row = mysqli_fetch_assoc($name);

                $uname = $row['uname'];

                ?>


<p>
    Applicant Name: <?php echo "$uname"; ?>
</p>
				<br>
				<div>
					<table border="1">
					  <tr>
					    <th scope="col">Apartment No</th>
					    <th scope="col">Category</th>
					    <th scope="col">Monthly Rent($)</th>
					    <th scope="col">Sq Ft.</th>
					    <th scope="col">Available from</th>
					    <th scope="col"></th>
					  </tr>

                        <?php
                        if ($numrows != 0) {
                            while ($row = mysqli_fetch_assoc($query)) {?>
                                <tr>
                                    <th scope="col"><?php echo $row['aptno']?></th>
                                    <th scope="col"><?php echo $row['category']?></th>
                                    <th scope="col"><?php echo $row['rent']?></th>
                                    <th scope="col"><?php echo $row['sqft']?></th>
                                    <th scope="col"><?php echo $row['available']?></th>


                                    <th><input type="radio" name=gender1 value=<?php echo $row['aptno']; ?> class="gender" <?php if (isset($_POST['gender']) && $_POST['gender'] == 'male'): ?>checked='checked'<?php endif; ?> /> </th>




                                </tr>
                            <?php
                            }

                        }

                        ?>

					</table>
				</div>

			<br>
			<div>
				<input type="submit" name="submit">
			</div>
                <div>
                    <input type="submit" name="submit1" value="go back to homepage">
                </div>
            </form>
		</div>

	</body>
</center>
</html>