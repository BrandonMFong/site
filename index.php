<?php 
    session_start();
    
    // Load xml
    $_SESSION['XMLReader-String'] = file_get_contents("config/Site.xml") or die("Failed to load");
    $_SESSION['CredConfig-String'] = file_get_contents("config/creds.xml") or die("Failed to load");
    $GLOBALS['XMLReader'] = simplexml_load_string($_SESSION['XMLReader-String']);
    $GLOBALS['CredConfig'] = simplexml_load_string($_SESSION['CredConfig-String']);

    if($GLOBALS['XMLReader']->IsUnderMaintenance == 'True')
    {
        header("Location:views/Maintenance.html");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php 
      include 'function/mod.php';
      GetHeader();
    ?>

  <body>    
    <?php 
      foreach($GLOBALS['XMLReader']->Sections->Section as $section)
      {
        echo "<section id=\"" . $section["ID"] . "\" class=\"" . $section->DivClasses . "\">";
        GetSection($section["Type"], $section);
        echo "</section>";
      }
      GetJavascript();
    ?>
  </body>
</html>