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
        <div class="hero-image">
            <div class="hero-text">
                <?php 
                    // Links
                    foreach($XMLReader->Links->Link as $link){echo "<a href=\"" . $link->URL . "\" class=\"button\">" . $link->Name . "</a> ";}
                ?>
            </div>
        </div>

        <p>
            Brandon Fong is born and raised in the Bay Area, Hercules California.  He went to Hercules High School and currently attending San Diego State University 
            for his Bachelor's in Science in Computer Engineering.  He is currently employed by Kiran Analytics as an Associate Support Consultant since July 2019.
        </p>

        

        <?php 
            // Projects
            echo "<h2>Projects</h2>";
            $i = 1;
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
                        echo "<div class=\"Slide SlideClass" . $i . "\">";
                        echo "<img src=\"" . $Image . "\" class=\"ImageSlides\">";
                        echo "</div>";
                    }
                    echo "<a class=\"prev\" onclick=\"plusSlides(-1,'SlideClass" . $i . "')\">&#10094;</a>";
                    echo "<a class=\"next\" onclick=\"plusSlides(1,'SlideClass" . $i . "')\">&#10095;</a>";
                    echo "</div>";
                }
                echo "</div>";
                $i++;
            }
        ?>

        <?php 
            // Load Javascripts
            foreach($XMLReader->Scripts->Script as $script){echo "<script src=\"" . $script . "\"></script>";}
        ?>

        <?php 
            echo "<footer>";
            echo "<p>© " .  str_replace("@year", date("Y"), $XMLReader->Footer->Copyright) . "</p>";
            echo "<p><a href=\"https://github.com/BrandonMFong/Site\">Open Source</a></p>";
            echo "</footer>";
        ?>
    </body>
</html>