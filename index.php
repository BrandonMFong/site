<?php 
    session_start();
    include 'function/mod.php'; // Load useful functions to environment 
    
    // Load config files
    $_SESSION['XMLReader-String'] = file_get_contents("config/Site.xml") or die("Failed to load");
    $_SESSION['CredConfig-String'] = file_get_contents("config/creds.xml") or die("Failed to load");
    $GLOBALS['XMLReader'] = simplexml_load_string($_SESSION['XMLReader-String']);
    $GLOBALS['CredConfig'] = simplexml_load_string($_SESSION['CredConfig-String']);

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
      foreach($GLOBALS['XMLReader']->Sections->Section as $section)
      {
        echo "<section id=\"" . $section["ID"] . "\" class=\"" . $section->DivClasses . "\">";
        GetSection($section["Type"], $section);
        echo "</section>";
      }
      GetJavascript(); // load scripts
    ?>
  </body>
</html>