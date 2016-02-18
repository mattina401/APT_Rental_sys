
<?php

session_start();

$submit = filter_input(INPUT_POST, 'submit');
$username = strip_tags(filter_input(INPUT_POST,'username'));
$password = strip_tags(filter_input(INPUT_POST,'password'));
$confirmpassword = strip_tags(filter_input(INPUT_POST,'confirmpassword'));

$connection = mysqli_connect('localhost', 'root', '', '4400db');

if($submit) {

    $query = mysqli_query($connection, "SELECT * FROM users WHERE username='$username'");

    $numrows = mysqli_num_rows($query);

    // check there is already same username in DB
    if ($numrows == 0) {

        // check every fields are filled or not
        if ($username && $password && $confirmpassword) {

            if ($password == $confirmpassword) {

                // username should not be over 25 character
                if (strlen($username) > 25) {

                    echo "<p align='center' style='color:red; '>Max limit for username/fullname are 25 characters</p>";

                }
                else {
                    if (strlen($password) > 25 || strlen($password) < 6) {
                        echo "<p align='center' style='color:red; '>password must be between 6 and 25 characters</p>";
                    } else {

                        //$password = md5($password);
                        //$confirmpassword = md5($confirmpassword);
                        //$query = mysqli_query($connection, "INSERT INTO users VALUES ('','$username','$password')");

                        // this can make I can use username every files
                        $_SESSION['username']=$username;
                        $_SESSION['password']=$password;

                        header('Location: Prospective Resident Application.php');


                    }
                }
            } else {

                echo "<p align='center' style='color:red; '>your passwords do not march</p>";
            }
        } else {
            echo "<p align='center' style='color:red; '>please fill in all fields!</p>";
        }
    }
    else {
        echo "<p align='center' style='color:red; '>this username already exists</p>";
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
<div style="width:500px;height:40px;border:1px solid #000;background-color:0099FF;">
<font size="6"><b>New User Registration</b></font>
</div>
<div style="width:500px;height:250px;border:1px solid #000;">


<form action='New User Registration.php' method='POST'>
<p></p>
<br>
Username: <input type="text" name="username" value = "<?php echo "$username"; ?>"><br>
Password: <input type="password" name="password" ><br>
Confirm Password: <input type="password" name="confirmpassword"><br>

<br>
<div style="padding-left:300px;">
    <input type="submit" name='submit' value="Register">

</div>
</form>
</div>
</body>
</center>
</html>