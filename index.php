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
        include 'function/database.php';

        echo "<head>";
        echo "<title>" . $GLOBALS['XMLReader']->SiteTitle . "</title>";
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html\; charset=UTF-8\" />";
        echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=9\" />";
        // Load CSS
        foreach($GLOBALS['XMLReader']->Header->StyleSheets as $ref)
        {
            echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . $ref . "\" media=\"screen\">";
        }
        echo "</head>";
    ?>
    <body>
        <div class="header">
            <div class="hero-text">
                <?php 
                    // Button Links
                    foreach($GLOBALS['XMLReader']->Links->Link as $link){echo "<a href=\"" . $link->URL . "\" class=\"button\">" . $link->Name . "</a> ";}
                ?>
            </div>
        </div>
        <div class="Content">

            <?php 
                /* Bio */ 
                echo "<div class=\"bio-container\">";
                echo "<div class=\"push-center\">";
                echo "<img src='img/SMTrip.jpg'/>";
                echo "<p>" . (QueryByFile("sql/GetBio.sql"))['VALUE'] . "</p>";
                echo "</div>";
                echo "</div>";
            ?>
            <div class="project-container">
                <?php 
                    // Projects
                    echo "<h2>Projects</h2>";
                    $i = 1;
                    foreach($GLOBALS['XMLReader']->Projects->Project as $Project)
                    {
                        echo "<div class=\"Project NotVisible\">";
                        echo "<div class=\"Project-Title\">" . $Project['Topic'] . "</div>";
                        echo "<div class=\"Project-Description\">" . $Project->Description . "</div>";
                        
                        // SlideShow Container
                        if(!empty($Project->SlideShow))
                        {
                            echo "<div class=\"slideshow-container border-box\">";
                            $ImgCount = 0;
                            foreach($Project->SlideShow->ImageFile as $Image)
                            {
                                echo "<div class=\"Slide SlideClass" . $i . "\">";
                                echo "<img src=\"" . $Image . "\" class=\"ImageSlides\">";
                                echo "</div>";
                                $ImgCount++;
                            }
                            if($ImgCount > 1) // If there is more than one image
                            {
                                echo "<a class=\"prev\" onclick=\"plusSlides(-1,'SlideClass" . $i . "')\">&#10094;</a>";
                                echo "<a class=\"next\" onclick=\"plusSlides(1,'SlideClass" . $i . "')\">&#10095;</a>";
                            }
                            echo "</div>";
                            echo "<div class=\"Tag\" Value=\"" . $i . "\"></div>";
                        }
                        echo "</div>";
                        $i++;
                    }
                ?>
            </div>
            <?php 
                echo "<footer>";
                echo "<div class=\"footer-container\"";
                echo "<p>© " .  str_replace("@year", date("Y"), $GLOBALS['XMLReader']->Footer->Copyright) . "</p>";
                echo "<p><a href=\"https://github.com/BrandonMFong/Site\">Open Source</a></p>";
                echo "</div>";
                echo "</footer>";
            ?>
            <?php 
                // Load Javascripts
                foreach($GLOBALS['XMLReader']->Scripts->Script as $script)
                {
                    echo "<script ";
                    if(!empty($script['type'])) {echo "type=\"" . $script['type'] . "\" ";}
                    echo "src=\"" . $script . "\"></script>";
                }
            ?>
        </div>
    </body>
</html>