<?php
session_start();
$submit = filter_input(INPUT_POST, 'submit');
$submit1 = filter_input(INPUT_POST, 'submit1');
$username = $_SESSION['username'];

$connection = mysqli_connect('localhost', 'root', '', '4400db');

$query = mysqli_query($connection, "SELECT * FROM prospective as p WHERE NOT EXISTS (SELECT username FROM resident as r WHERE p.username = r.username)");
$numrows = mysqli_num_rows($query);

$username1 = filter_input(INPUT_POST, 'gender');

if($submit) {

    if ($username1) {
        $_SESSION['gender']=$username1;
        //echo "$username1";

        header('Location: Apartment Allotment.php');
    }
    else {
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
    <div style="width:900px;height:40px;border:1px solid #000;background-color:0099FF;">
        <font size="5"><b>Application Review</b></font>
    </div>
    <div style="width:900px;height:auto;border:1px solid #000;">
        <form action="Application Review.php" method="POST">
            <br>
            <div>
                <table border="1">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Date of Birth</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Monthly Income($)</th>
                        <th scope="col">Type of Apartment Requested</th>
                        <th scope="col">Preferred move-in date</th>
                        <th scope="col">Lease Term</th>
                        <th scope="col">Reject/Accept</th>
                        <th scope="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    </tr>
                    <?php
                    if ($numrows != 0) {
                        while ($row = mysqli_fetch_assoc($query)) {?>
                            <tr>
                                <th scope="col"><?php echo $row['uname']?></th>
                                <th scope="col"><?php echo $row['bdate']?></th>
                                <th scope="col"><?php echo $row['gender']?></th>
                                <th scope="col"><?php echo $row['monthlyincome']?></th>
                                <th scope="col"><?php echo $row['category']?></th>
                                <th scope="col"><?php echo $row['pdate']?></th>
                                <th scope="col"><?php echo $row['lease']?></th>
                                <th scope="col"><?php echo $row['acceptance']?></th>
                                <?php

                                if($row['acceptance'] == 'Accept') {

                                    ?>
                                    <th><input type="radio" name=gender value=<?php echo $row['username']; ?> class="gender" <?php if (isset($_POST['gender']) && $_POST['gender'] == 'male'): ?>checked='checked'<?php endif; ?> /> </th>

                                    <?php } else {?>

                           <?php }?>

                            </tr>
                        <?php
                        }

                    }

                    ?>
                </table>
            </div>

        <br>
        <div>
            <input type="submit" name="submit" >
        </div>
            <div>
                <input type="submit" name="submit1" value="go back to homepage" >
            </div>
        </form>
    </div>

    </body>
</center>
</html>