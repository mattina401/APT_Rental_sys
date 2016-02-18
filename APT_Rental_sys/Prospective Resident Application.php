<?php

session_start();

$connection = mysqli_connect('localhost', 'root', '', '4400db');

$submit = filter_input(INPUT_POST, 'submit');
$name = strip_tags(filter_input(INPUT_POST,'name'));
$bdate = strip_tags(filter_input(INPUT_POST,'bdate'));

$gender = strip_tags(filter_input(INPUT_POST,'gender'));
$monthlyincome = strip_tags(filter_input(INPUT_POST,'monthlyincome'));
$category = strip_tags(filter_input(INPUT_POST,'category'));

$rentmin = strip_tags(filter_input(INPUT_POST,'rentmin'));
$rentmax = strip_tags(filter_input(INPUT_POST,'rentmax'));
$moveindate = strip_tags(filter_input(INPUT_POST,'moveindate'));
$lease = strip_tags(filter_input(INPUT_POST,'lease'));
$prevresidence = strip_tags(filter_input(INPUT_POST,'prevresidence'));
$pdate = strip_tags(filter_input(INPUT_POST,'pdate'));

//$currentdate = date('Y-m-d');



if($submit) {


    $query = mysqli_query($connection, "SELECT * FROM prospective WHERE uname ='$name' and bdate ='$bdate'");

    $numrows = mysqli_num_rows($query);

    // check there is a combination of name and bdate in DB
    if ($numrows == 0) {

        // check every fields are filled
        if($name&&$gender&&$monthlyincome&&$rentmin&&$rentmax&&$prevresidence) {


            $datetime1 = new DateTime($pdate);

            // current date
            $datetime2 = new DateTime();

            // current date - pdate
            $interval = $datetime1->diff($datetime2);

            // convert int
            $nbDays = $interval->days;

            // pdate cannot be beyond 2 months from current date
            if($nbDays <  61) {

                // get from New User Registration
                $username = $_SESSION['username'];
                $password = $_SESSION['password'];

                // insert username and password here (protect the case user did not do this applicaion after registration)
                $query = mysqli_query($connection, "INSERT INTO users VALUES ('','$username','$password','false')");

                // select all apartment
                //$query1 = mysqli_query($connection, "SELECT *  FROM apartment WHERE category = '$category' and rent*3 < '$monthlyincome'");
                $query1 = mysqli_query($connection, "SELECT *  FROM apartment as p WHERE category = '$category' and lease = '$lease' and rent*3 < '$monthlyincome' and available <='$pdate' and not exists (select aptno from resident as r where p.aptno = r.aptno )");

                $numrows1 = mysqli_num_rows($query1);

                if($numrows1 !=0 ) {
                    // accept
                    $query = mysqli_query($connection, "INSERT INTO prospective VALUES ('','$username','$name','$bdate','$gender','$monthlyincome','$category','$pdate','$lease','$prevresidence','Accept')");
                    header('Location: Welcome Letter.php');
                } else {
                    // reject
                    $query = mysqli_query($connection, "INSERT INTO prospective VALUES ('','$username','$name','$bdate','$gender','$monthlyincome','$category','$pdate','$lease','$prevresidence','Reject')");
                    header('Location: Welcome Letter.php');
                }

            }
            else {
                echo "<p align='center' style='color:red; '>the move in date cannot be beyond 2 months from the current date</p>";
            }
        }
        else {
            echo "<p align='center' style='color:red; '>please fill in all fields!</p>";
        }
    }
    else {
        echo "<p align='center' style='color:red; '>the combination of name and date of birth already exists</p>";
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
<div style="width:900px;height:40px;border:1px solid #000;background-color:0099FF;">
<font size="5"><b>Prospective Resident Application Form</b></font>
</div>
<div style="width:900px;height:500px;border:1px solid #000;">


<form action="Prospective Resident Application.php" method="POST">

<br>
<div style="padding-left:50px;">
<p align="left">Name:<input type="text" name="name" value="<?php echo "$name"; ?>"><br>
<br>
Date of Birth: <input type="date" name="bdate" value="<?php echo "$bdate"; ?>"><br>
<br>
Gender:

    <input type="radio" name="gender" value="male" class="gender" <?php if (isset($_POST['gender']) && $_POST['gender'] == 'male'): ?>checked='checked'<?php endif; ?> /> Male
    <input type="radio" name="gender" value="female"  class="gender" <?php if (isset($_POST['gender']) && $_POST['gender'] ==  'female'): ?>checked='checked'<?php endif; ?> /> Female
<br>
<br>
    Monthly Income($):<input type="text" name="monthlyincome" value="<?php echo "$monthlyincome"; ?>"><br>
<br>
    Category of Apartment:<select name="category"><option value="1bdr-1bth">1 bdr-1bth</option><option value="2bdr-1bth">2bdr-1bth</option><option value="2bdr-2bth">2bdr-2bth</option></select>
    Monthly Rent($) min:<input type="text" name="rentmin" value="<?php echo "$rentmin"; ?>"> max:<input type="text" name="rentmax" value="<?php echo "$rentmax"; ?>"><br>
<br>



    Preferred Move in date: <input type="date" name="pdate">




    <!--
    Preferred Move in date: <select name="pyear"><option value="2000">2000</option></select><select name="pmonth"><option value="march">march</option></select><select name="pday"><option value="1">1</option></select> --><br>
<br>
Lease Term:<select name="lease"><option value="3">3</option><option value="6">6</option><option value="12">12</option></select> months <br>
<br>
Prev Residence:<input type="text" name="prevresidence" value="<?php echo "$prevresidence"; ?>"><br></p>
</div>

<br>
<div style="padding-left:300px;">
<input type="submit" name="submit" value="prospective">

</div>



</form>
</div>
</body>
</center>
</html>