<?php 
    session_start();

    $_SESSION['Tab'] = "../";
    $GLOBALS['XMLReader'] = simplexml_load_string($_SESSION['XMLReader-String']);
    $GLOBALS['CredConfig'] = simplexml_load_string($_SESSION['CredConfig-String']);
    include $_SESSION['Tab'] . "function/mod.php"; // Load useful functions to environment

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
      // $results = initPage('0302fe9df0f54d91'); // home 
      $results = initPage('ec1f316d8f8f4e3b');// info 
      while($item = $results->fetch_assoc())
      {
        echo "<section id=\"" . $item["SectionID"] . "\" class=\"" . $item["DivClasses"] . "\">";
        GetSection($item["SectionType"], $item);
        echo "</section>";
      }
      GetJavascript(); // load scripts
    ?>
  </body>
</html>