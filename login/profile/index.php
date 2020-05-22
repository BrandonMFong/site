<?php session_start(); ?>
<!DOCTYPE HTML>  
<html>
    <?php
    // Checks if user is allowed to be here
    if(!isset($_SESSION['LoginBool'])){throw "Not allowed!";}
    else
    {
        if($_SESSION['LoginBool'])
        {
            include '../../function/database.php'; 
            $Bio = (QueryByFile("../../sql/GetBio.sql"))['VALUE']; // Queries for bio string
            echo 
            "
                <body>
                    <form action=\"UpdateBio.php\" method=\"post\">
                        <textarea name=\"BioPost\" rows=\"20\" cols=\"100\">$Bio</textarea>
                        <input type=\"submit\" name=\"Update\">
                    </form>
                </body>
            ";
            // echo $Bio;
        }
    }
    ?>
</html>