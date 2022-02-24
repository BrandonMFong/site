<?php 
    session_start();
    $_SESSION['Tab'] = "";
    include $_SESSION['Tab'] . "function/mod.php"; // Load useful functions to environment
    
    // Load config files
    $_SESSION['XMLReader-String'] = file_get_contents("config/Site.xml") or die("Failed to load");
    #$_SESSION['CredConfig-String'] = file_get_contents("config/creds.xml") or die("Failed to load");
    $GLOBALS['XMLReader'] = simplexml_load_string($_SESSION['XMLReader-String']);
    #$GLOBALS['CredConfig'] = simplexml_load_string($_SESSION['CredConfig-String']);

    if($GLOBALS['XMLReader']->IsUnderMaintenance == 'True') // if I am working on the site and it isn't ready to be public
    {
        header("Location:views/Maintenance.html");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php GetHeader(); // Header has CSS and metadata?>

  <body>    
    <?php 
      // Load the sections of the html that defines the website
      $results = initPage('0302fe9df0f54d91');
      while($item = $results->fetch_assoc())
      {
        echo "<section id=\"" . $item["SectionID"] . "\" class=\"" . $item["DivClasses"] . "\">";
        GetSection($item["SectionType"], $item);
        echo "</section>";
      }
      GetJavascript(); // load scripts

      // footer hyperlink does not work
    ?>
  </body>
</html>
