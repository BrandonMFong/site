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

        <h2>Projects</h2>
        <h3>Dual Power Generation</h3>

        <?php 
            // SlideShow Container
            echo "<div class=\"slideshow-container\">";
            foreach($XMLReader->Site->SlideShow as $Image)
            {
                echo "<div class=\"mySlides fade\">";
                echo "<img src=\"" . $Image . "\" class=\"ImageSlides\">";
                echo "</div>";
            }
            echo "<a class=\"prev\" onclick=\"plusSlides(-1)\">&#10094;</a>";
            echo "<a class=\"next\" onclick=\"plusSlides(1)\">&#10095;</a>";
            echo "</div><br>";

            echo "<div style=\"text-align:center\">";
            for($i = 0; $i < $XMLReader->Site->SlideShow->count(); $i++)
            {
                echo "<span class=\"dot\" onclick=\"currentSlide(". $i+1 . ")\"></span>";
            }
            echo "</div>";
        ?>
        <!-- Slideshow container -->
        <!-- <div class="slideshow-container">
            <div class="mySlides fade">
                    <img src="img/DualPower/DatabaseSruct_Diagram.PNG" class="ImageSlides">
            </div>
            <div class="mySlides fade">
                    <img src="img/DualPower/FinalLogo.PNG" class="ImageSlides">
            </div>
            <div class="mySlides fade">
                    <img src="img/DualPower/InsertDB_Diagram.PNG" class="ImageSlides">
            </div>
            <div class="mySlides fade">
                    <img src="img/DualPower/Max_Pwr_Tracker_Coding_Diagram.PNG" class="ImageSlides">
            </div>
            <div class="mySlides fade">
                    <img src="img/DualPower/OverallDiagram.PNG" class="ImageSlides">
            </div>
            <div class="mySlides fade">
                    <img src="img/DualPower/PhotoOfEquipment.PNG" class="ImageSlides">
            </div>
        -->
            <!-- Next and previous buttons -->
            <!-- <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>-->

        <!-- The dots/circles -->
        <!-- <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>  -->

        <script src="js/SlideShow.js"></script>
    </body>
</html>