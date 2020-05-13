<?php 
    session_start();

    $GLOBALS['XMLReader'] = simplexml_load_string($_SESSION['XMLReader']);
    $GLOBALS['CredConfig'] = simplexml_load_string($_SESSION['CredConfig']);
    $GLOBALS['WebConfig'] = simplexml_load_string($_SESSION['WebConfig']);
?>
<!DOCTYPE HTML>  
<html>
    <head>
    </head>
    <body>  
        <?php
            include '../function/database.php'; 
            $bio = intval($_GET['bio']);
            $bioguid = $GLOBALS['XMLReader']->BioGuid;
            Query("update sitecontent set Value = '$bio' where guid = $bioguid");
        ?>
    </body>
</html>