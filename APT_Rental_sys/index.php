<?php
session_start();
$submit = filter_input(INPUT_POST, 'submit');
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');


if ($submit) {

    if ($username && $password) {
        $connection = mysqli_connect('localhost', 'root', '', '4400db');

        $query = mysqli_query($connection, "SELECT * FROM users WHERE username='$username'");

        $numrows = mysqli_num_rows($query);

        // check user name is in DB or not
        if ($numrows != 0) {

            while ($row = mysqli_fetch_assoc($query)) {
                $dbusername = $row['username'];
                $dbpassword = $row['password'];
            }

            if ($username == $dbusername && $password == $dbpassword) {

                $query1 = mysqli_query($connection, "SELECT * FROM users WHERE username='$username' and password = '$password' and review = '1'");

                $numrows1 = mysqli_num_rows($query1);

                // check user is under review or not
                if ($numrows1 != 0) {

                    $_SESSION['username'] = $username;

                    if($username != admin) {

                        header('Location: Homepage.php');
                    }
                    else {
                        header('Location: Manager Homepage.php');
                    }

                } else {
                    echo "<p align='center' style='color:red; '>your application is under review</p>";
                }
            } else

            echo "<p align='center' style='color:red; '>incorrect password</p>";
        } else
            echo "<p align='center' style='color:red; '>that user does not exist!</p>";


    } else
    echo "<p align='center' style='color:red; '>plz enter username and password</p>";
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
        <font size="6"><b>Log In</b></font>
    </div>
    <div style="width:500px;height:250px;border:1px solid #000;">


        <form action='index.php' method='POST'>
            <p></p>
            <br>
            <br>
            Username: <input type="text" name='username'><br>
            Password: <input type="password" name='password'><br>

        <br>
        <div style="padding-left:300px;">
            <input type='submit' name="submit" value='Log in'>
           <!-- <input type="button" name="b1" value="Login" onclick="location.href='Homepage.php'">-->

            <a href="New User Registration.php"><font size="3">Create Account</font></a>
        </div>
        </form>
    </div>
    </body>
</center>

</html>


