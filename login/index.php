<?php 
    session_start();

    $GLOBALS['XMLReader'] = simplexml_load_string($_SESSION['XMLReader']);
    $GLOBALS['CredConfig'] = simplexml_load_string($_SESSION['CredConfig']);
    $GLOBALS['WebConfig'] = simplexml_load_string($_SESSION['WebConfig']);
?>
<!DOCTYPE HTML>  
<!-- https://tryphp.w3schools.com/showphp.php?filename=demo_form_validation_complete -->
<html>
    <head>
        <style>
            .error {color: #FF0000;}
        </style>
    </head>
    <body>  

        <?php
            include '../function/database.php'; 
            $UsernameErr = $PasswordErr = $Username = $Password = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                if (empty($_POST["Username"])) {$nameErr = "Name is required";} 
                else 
                {
                    $Username = test_input($_POST["Username"]);
                }

                if (empty($_POST["Password"])) {$PasswordErr = "Password is required";} 
                else 
                {
                    $Password = test_input($_POST["Password"]);
                }
            }
            function test_input($data) 
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>

        <h2>Login</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
            Username: <input type="text" name="Username" value="<?php echo $Username;?>">
            <br><br>
            Password: <input type="password" name="Password" value="<?php echo $Password;?>">
            <br><br>
            <input type="submit" name="login" value="Login">  
        </form>

        <?php
            echo "<h2>Your Input:</h2>";
            echo $Username;
            echo "<br>";
            echo $Password;

            if((Query("SELECT EXISTS(select Username from siteuser where Username = '$Username') as Results;"))['Results'] == 1)
            {
                if((Query("select Password as pw from siteuser where Username = '$Username'"))['pw'] == $Password)
                {
                    header("Location:profile");
                    $_SESSION['LoginBool'] = true;
                    exit();
                }
            }

        ?>

    </body>
</html>