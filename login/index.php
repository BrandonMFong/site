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
            // define variables and set to empty values
            $UsernameErr = $PasswordErr = $Username = $Password = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                if (empty($_POST["Username"])) {$nameErr = "Name is required";} 
                else 
                {
                    $Username = test_input($_POST["Username"]);
                    if (!preg_match("/^[a-zA-Z ]*$/",$Username)) 
                    {
                        $UsernameErr = "Only letters and white space allowed";
                    }
                }

                if (empty($_POST["Password"])) {$PasswordErr = "Password is required";} 
                else 
                {
                    $Password = test_input($_POST["Password"]);
                    if (!preg_match("/^[a-zA-Z ]*$/",$Password)) 
                    {
                        $PasswordErr = "Invalid Password format";
                    }
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

        <h2>PHP Form Validation Example</h2>
        <p>
            <span class="error">* required field</span>
        </p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
            Username: <input type="text" name="Username" value="<?php echo $Username;?>">
            <span class="error">* <?php echo $UsernameErr;?></span>
            <br><br>
            Password: <input type="text" name="Password" value="<?php echo $Password;?>">
            <span class="error">* <?php echo $PasswordErr;?></span>
            <br><br>
            <input type="submit" name="login" value="Login">  
        </form>

        <?php
            echo "<h2>Your Input:</h2>";
            echo $Username;
            echo "<br>";
            echo $Password;
        ?>

    </body>
</html>