<?php
session_start();
$submit = filter_input(INPUT_POST, 'submit');
$submit1 = filter_input(INPUT_POST, 'submit1');
$username = $_SESSION['username'];
$gender = filter_input(INPUT_POST,'gender');

$connection = mysqli_connect('localhost', 'root', '', '4400db');

$query = mysqli_query($connection, "SELECT * FROM maintenance");
$query1 = mysqli_query($connection, "SELECT * FROM maintenance");
$query2 = mysqli_query($connection, "SELECT * FROM maintenance");
$numrows = mysqli_num_rows($query);

?>


<?php
if($submit){
    echo $gender;

    while($row = mysqli_fetch_assoc($query)){
        if($gender == ($row['dateofrequest'] . $row['aptno'] . $row['issue'])){
            $resolveddateofrequest = $row['dateofrequest'];
            $resolvedaptno = $row['aptno'];
            $resolvedissue = $row['issue'];
            $resolveddate = date('Y/m/d');
            $datetime1 = new DateTime($resolveddateofrequest);
            $datetime2 = new DateTime($resolveddate);
            $interval = $datetime1->diff($datetime2);
            $tookdays = $interval->days;
            if($datetime1==$datetime2){
                $tookdays++;
            }
            $updatequery = mysqli_query($connection, "UPDATE maintenance SET dateresolved = '$resolveddate', tookdays ='$tookdays' WHERE issue='$resolvedissue' and dateofrequest = '$resolveddateofrequest' and aptno = '$resolvedaptno'");
        }
    }
    header('Location: View Maintenance Requests.php');


}

if($submit1) {
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
        <font size="5"><b>View Maintenance Requests</b></font>
    </div>
    <div style="width:700px;height:500px;border:1px solid #000;">
        <form action="View Maintenance Requests.php" method="POST">

            <br>
            <div>
                <table id = "table1" border="1">
                    <tr>
                        <th scope="col">Date of Request</th>
                        <th scope="col">Apt No</th>
                        <th scope="col">Description of Issue</th>
                        <th scope="col"></th>
                    </tr>
                    <?php
                    if ($numrows != 0) {
                        while ($row = mysqli_fetch_assoc($query1)) {
                            if($row['dateresolved']=='0000-00-00'){?>
                                <tr>
                                    <th scope="col"><?php echo $row['dateofrequest']?></th>
                                    <th scope="col"><?php echo $row['aptno']?></th>
                                    <th scope="col"><?php echo $row['issue']?></th>
                                    <th scope="col"><input type="radio" name="gender" value=<?php echo $row['dateofrequest'] . $row['aptno'] . $row['issue']; ?>  <?php if (isset($_POST['gender'])): ?>checked='checked'<?php endif; ?> /></th>
                                </tr>
                            <?php
                            }
                        }

                    }
                    ?>

                </table>
            </div>
            <br>
            <br>
            <div>
                <input type="submit" name="submit" value="Resolved">
            </div>
            <br>
            <div><p>Resolved Maintenance</p>
                <table border="1">
                    <tr>
                        <th scope="col">Date of Request</th>
                        <th scope="col">Apt No</th>
                        <th scope="col">Description of Issue</th>
                        <th scope="col">Issue resolved on</th>
                    </tr>
                    <?php
                    if ($numrows != 0) {
                        while ($row = mysqli_fetch_assoc($query2)) {
                            if($row['dateresolved'] != '0000-00-00'){?>
                                <tr>
                                    <th scope="col"><?php echo $row['dateofrequest']?></th>
                                    <th scope="col"><?php echo $row['aptno']?></th>
                                    <th scope="col"><?php echo $row['issue']?></th>
                                    <th scope="col"><?php echo $row['dateresolved']?></th>
                                </tr>
                            <?php
                            }
                        }

                    }
                    ?>
                </table>
            </div>
            <br>

            <div>
                <input type="submit" name="submit1" value="go back homepage">
            </div>
        </form>


        <br>
    </div>

    </body>
</center>
</html>