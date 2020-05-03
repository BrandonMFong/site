<!DOCTYPE html>
<html lang="en">
    <?php 
        // Load xml
        $XMLReader = simplexml_load_file("config/Site.xml") or die("Failed to load");
        echo "<head>";
            echo "<title>" . $XMLReader->SiteTitle . "</title>";
            echo "<meta charset=\"UTF-8\">";
        echo "</head>";
    ?>
    <body>
        <h>Hello World!</h>
    </body>
</html>