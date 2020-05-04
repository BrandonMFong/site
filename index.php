<!DOCTYPE html>
<html lang="en">
    <?php 
        // Load xml
        $XMLReader = simplexml_load_file("config/Site.xml") or die("Failed to load");
        echo "<head>";
        echo "<title>" . $XMLReader->SiteTitle . "</title>";
        echo "<meta charset=\"UTF-8\">";
        foreach($XMLReader->Header->StyleSheets as $ref){echo "<link rel=\"stylesheet\" href=\"" . $ref . "\">";}
        echo "</head>";
    ?>
    <body>
        <?php 
            // Site header
            echo "<h1>" . $XMLReader->SiteTitle . "</h1>";
        ?>
        <?php 
            // Links
            foreach($XMLReader->Links->Link as $link)
            {
                echo "<a href=\"" . $link->URL . "\">" . $link->Name . "</a> ";
            }
        ?>
        <p>
            Brandon Fong is born and raised in the Bay Area, Hercules California.  He went to Hercules High School and currently attending San Diego State University 
            for his Bachelor's in Science in Computer Engineering.  He is currently employed by Kiran Analytics as an Associate Support Consultant since July 2019.
        </p>

        

        <?php 
            // Projects
            echo "<h2>Projects</h2>";
            foreach($XMLReader->Projects->Project as $Project)
            {
                echo "<div class=\"Project\">";
                echo "<div class=\"Project-Title\">" . $Project['Topic'] . "</div>";
                echo "<div class=\"Project-Description\">" . $Project->Description . "</div>";
                
                // SlideShow Container
                if(!empty($Project->SlideShow))
                {
                    echo "<div class=\"slideshow-container border-box\">";
                    foreach($Project->SlideShow->ImageFile as $Image)
                    {
                        echo "<div class=\"Slide\">";
                        echo "<img src=\"" . $Image . "\" class=\"ImageSlides\">";
                        echo "</div>";
                    }
                    echo "<a class=\"prev\" onclick=\"plusSlides(-1)\">&#10094;</a>";
                    echo "<a class=\"next\" onclick=\"plusSlides(1)\">&#10095;</a>";
                    echo "</div>";
                }
                echo "</div>";
            }
        ?>
        <script src="js/SlideShow.js"></script>
    </body>
</html>