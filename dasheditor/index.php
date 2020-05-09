<!DOCTYPE HTML>  
<?php 
    session_start();

    $GLOBALS['XMLReader'] = simplexml_load_string($_SESSION['XMLReader']);
    $GLOBALS['CredConfig'] = simplexml_load_string($_SESSION['CredConfig']);
    $GLOBALS['WebConfig'] = simplexml_load_string($_SESSION['WebConfig']);
?>
<html>
    <head>
        <style>
            .error {color: #FF0000;}
        </style>
    </head>
    <body>  

        <?php
            include '../function/database.php'; 
            $comment =  (QueryByFile("../sql/GetBio.sql"))['VALUE'];

            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                $comment = test_input($_POST["comment"]);
            }

            function test_input($data) 
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>
        <!-- TODO insert into database when form submitted -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
            Comment: <textarea name="comment" rows="10" cols="100"><?php echo $comment;?></textarea>
            <br><br>
            <input type="submit" name="submit" value="Submit">  
        </form>
    </body>
</html>