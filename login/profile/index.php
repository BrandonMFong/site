<?php 
    session_start();

    $GLOBALS['XMLReader'] = simplexml_load_string($_SESSION['XMLReader']);
    $GLOBALS['CredConfig'] = simplexml_load_string($_SESSION['CredConfig']);
    $GLOBALS['WebConfig'] = simplexml_load_string($_SESSION['WebConfig']);
?>
<!DOCTYPE HTML>  
<?php
if($_SESSION['LoginBool'])
{
    include '../../function/database.php'; 
    $Bio = (QueryByFile("../../sql/GetBio.sql"))['VALUE'];
    echo 
    "
        <html>
            <body>
                <form action=\"UpdateBio.php\">
                    <textarea rows=\"4\" cols=\"50\">$Bio</textarea>
                    <input type=\"submit\">
                </form>
            </body>
        </html>
    ";
}
else{echo "Not allowed";}
?>