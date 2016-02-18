
<?php
session_start();
$submit = filter_input(INPUT_POST, 'submit');
$report = filter_input(INPUT_POST, 'report');
$connection = mysqli_connect('localhost', 'root', '', '4400db');

if($submit) {

    if($report == 1) {
        header('Location: 3 month Leasing Report.php');
    } else if ($report == 2) {
        header('Location: Service Request Resolution Report.php');
    } else {
        header('Location: Rent Defaulters.php');
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
        <font size="6"><b>Manager Homepage</b></font>
    </div>

    <form action='Manager Homepage.php' method='POST'>
    <div style="width:700px;height:200px;border:1px solid #000;">
        <br>
        <p>
            <a href="Application Review.php"><font size="3">Application Review</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="View Maintenance Requests.php"><font size="3">View Maintenance Requests</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="Reminder.php"><font size="3">Reminder</font></a>
            <br>
            <br>
            <br>

        <div style="padding-center:300px;">
            Select Report: <select name="report">
                <option value="1"<?php echo(isset($_POST['select_name'])&&($_POST['select_name']=='1')?' selected="selected"':'');?>>Leasing Report</option>
                <option value="2"<?php echo(isset($_POST['select_name'])&&($_POST['select_name']=='2')?' selected="selected"':'');?>>Service Request Resolution Report</option>
                <option value="3"<?php echo(isset($_POST['select_name'])&&($_POST['select_name']=='3')?' selected="selected"':'');?>>Rent Defaulter Report</option>
            </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="submit">
        </div>
        </p>
        <br>


    </div>
        </form>
    </body>
</center>
</html>

