<?php

    global $Connected, $SendOverride;
    $Connected = false;
    $SendOverride = false;

    $GLOBALS['XMLReader'] = simplexml_load_string($_SESSION['XMLReader-String']);
    $GLOBALS['CredConfig'] = simplexml_load_string($_SESSION['CredConfig-String']);

    function GetCorrectEnvironment()
    {
        $val = getcwd();
        if($val == $GLOBALS["XMLReader"]->Environment->Local)
        {
            return $GLOBALS['CredConfig']->Local;
        }
        elseif($val == $GLOBALS["XMLReader"]->Environment->Server)
        {
            return $GLOBALS['CredConfig']->Server;
        }
        else{echo "Something bad happened";}
    }
    
    function GetVariables()
    {
        $x = GetCorrectEnvironment();

        $GLOBALS['servername'] = $x->Servername;
        $GLOBALS['username'] = $x->Username;
        $GLOBALS['password'] = $x->Password;
        $GLOBALS['dbname'] = $x->Database;
    }

    function Connect()
    {
        GetVariables();
        $GLOBALS['conn'] = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
        if ($GLOBALS['conn']->connect_error) {die("Connection failed: " . $GLOBALS['conn']->connect_error);}
        else{$Connected = true;}
    }

    function Close(){$GLOBALS['conn']->close();}

    function QueryByFile(string $filepath) 
    {
        global $Connected, $SendOverride;
        $SendOverride = true;
        if(!$Connected){Connect();}
        $sqlfile =  fopen($filepath, "r") or die("Unable to read file.");
        if(!Query(fread($sqlfile, filesize($filepath)))){return $GLOBALS['Results']->fetch_assoc();}
        else{return false;}
    }

    function Query(string $querystring)
    {
        // echo $querystring . "\n"; 
        global $Connected, $SendOverride;
        if(!$Connected){Connect();}
        $GLOBALS['Results'] = $GLOBALS['conn']->query($querystring);
        if ($GLOBALS['Results']->num_rows == 0) {echo "0 results"; return false;}
        else{Close(); return true;}
    }

    function UpdateQuery(string $querystring)
    {
        global $Connected, $SendOverride;
        if(!$Connected){Connect();}
        $GLOBALS['conn']->query($querystring);
        Close();
    }

    // Queries table by guid
    function GetSiteContent(string $guid)
    {
        global $Connected, $SendOverride;
        $SendOverride = true;
        if(!$Connected){Connect();}
        $filepath = "sql/GetSiteContent.sql";
        $sqlfile =  fopen($filepath, "r") or die("Unable to read file.");
        $querystring = fread($sqlfile, filesize($filepath));
        
        if(Query(str_replace("@guid",$guid,$querystring))){return $GLOBALS['Results'];}
        else{return false;}
    }

    function GetNav($section)
    {
      // Navigation 
      echo "<nav class=\"navbar navbar-expand-md tm-navbar\" id=\"tmNav\">";    
      echo "<div class=\"container\">";
      echo "<div class=\"tm-next\">";
      echo "<a href=\"#infinite\" class=\"navbar-brand\">" . $GLOBALS['XMLReader']->SiteTitle . "</a>";
      echo "</div>";
            
      echo "<button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">";
      echo "<i class=\"fas fa-bars navbar-toggler-icon\"></i>";
      echo "</button>";
      echo "<div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">";
      // Load sub items for nav
      echo "<ul class=\"navbar-nav ml-auto\">";
      for($i = 0; $i < 5; $i++)
      {
        echo "<li class=\"nav-item\">";
        echo "<a class=\"nav-link tm-nav-link\" href=\"#" . $section->NavItems->NavItem[$i]['ID'] . "\">" . $section->NavItems->NavItem[$i]['Name'] . "</a>";
        echo "</li>";
      }
      echo "</ul>";
      echo "</div>";   
      echo "</div>";
      echo "</nav>";
    }

    function GetHero($section)
    {
      $infiniteObject = null;

      $infiniteObject = GetSiteContent($section->Guid)->fetch_assoc();  
      GetNav($section);

      // About me
      
      echo "<div class=\"text-center tm-hero-text-container\">";
      echo "<img src=\"" . $infiniteObject["Image"] . "\" alt=\"Avatar\" class=\"img-avatar\">";
      echo "<div class=\"tm-hero-text-container-inner\">";
      // echo "<img src=\"" . $infiniteObject["Image"] . "\" alt=\"Image\" class=\"img-fluid mx-auto\">";
      echo "<h2 class=\"tm-hero-title\">" . $infiniteObject['Subject'] . "</h2>";
      echo "<p class=\"tm-hero-subtitle\">";
      echo $infiniteObject['Value'];
      echo "</p>";
      echo "</div>";
      echo "</div>";
    }

    function GetGrid($section)
    {
      $containerObject = null;

      $containerObject = GetSiteContent($section->Guid)->fetch_assoc();  
      
      echo "<div class=\"container\">";
      echo "<div class=\"row tm-content-box\">";
      echo "<div class=\"col-lg-12 col-xl-12\">";
      echo "<div class=\"tm-intro-text-container\">";
      echo "<h2 class=\"tm-text-primary mb-4 tm-section-titl\">" . $containerObject['Subject'] . "</h2>";
      echo "<p class=\"mb-4 tm-intro-text\">";
      echo $containerObject['Value'];
      echo "</p>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
    }

    function GetBubbles($section)
    {
      $containerObject = null;

      $containerObject = GetSiteContent($section->Guid)->fetch_assoc();  

      // Load content
      echo "<div class=\"container tm-testimonials-content\">";
      echo "<div class=\"row\">";
      echo "<div class=\"col-lg-12 tm-content-box\">";
      echo "<h2 class=\"text-white text-center mb-4 tm-section-title\">" . $containerObject["Subject"] . "</h2>";
      echo "<p class=\"mx-auto tm-section-desc text-center\">";
      echo $containerObject["Value"];
      echo "</p>";

      echo "<div class=\"mx-auto tm-gallery-container tm-gallery-container-2\">";
      echo "<div class=\"tm-testimonials-carousel\">";

      // Load Carousel

      $results = GetSiteContent($section->Items);
      while($item = $results->fetch_assoc())
      {
        echo "<figure class=\"tm-testimonial-item\"  "; 
        if(!empty($item["Hyperlink"])) { echo "onclick=\"window.open('" . $item["Hyperlink"] . "','mywindow');\">";} // if there is a hyperlink connected to this data
        else {echo ">";}
        echo "<img src=\"" . $item["Image"] . "\" alt=\"Image\" class=\"img-fluid mx-auto\">";
        echo "<blockquote>" . $item["Value"] . "</blockquote>";
        echo "<figcaption>" . $item["Subject"] . "</figcaption>";
        echo "</figure>";
      }
      echo "</div>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
    }

    function GetGallery($section)
    {
      $galleryObject = null;

      $galleryObject = GetSiteContent($section->Guid)->fetch_assoc(); 
      
      echo "<div class=\"container tm-container-gallery\">";
      echo "<div class=\"row\">";
      echo "<div class=\"text-center col-12\">";
      echo "<h2 class=\"tm-text-primary tm-section-title mb-4\">" . $galleryObject['Subject'] . "</h2>";
      echo "<p class=\"mx-auto tm-section-desc\">";
      echo $galleryObject['Value'];
      echo "</p>";
      echo "</div>";            
      echo "</div>";

      echo "<div class=\"row\">";
      echo "<div class=\"col-12\">";
      echo "<div class=\"mx-auto tm-gallery-container\">";
      echo "<div class=\"grid tm-gallery\">";

      $results = GetSiteContent($section->Items);
      while($item = $results->fetch_assoc())
      {
        echo "<a href=\"" . $item["Image"] . "\">";
        echo "<figure class=\"effect-honey tm-gallery-item\">";
        echo "<img src=\"" . $item["Image"] . "\" alt=\"Image 1\" class=\"img-fluid\">";
        echo "<figcaption>";
        echo "<h2><i>" . $item["Subject"] . " <span><br/>" . $item["Value"] . "</span></i></h2>";
        echo "</figcaption>";
        echo "</figure>";
        echo "</a>";
      }
      echo "</div>";
      echo "</div>";                
      echo "</div>";       
      echo "</div>";
      echo "</div>";
    }

    function GetInfo($section)
    {
      $contactObject = null;

      $contactObject = GetSiteContent($section->Guid)->fetch_assoc(); 

      echo "<div class=\"container tm-container-contact\">";
      echo "<div class=\"row\">";
      echo "<div class=\"text-center col-12\">";
      echo "<h2 class=\"tm-section-title mb-4\">" . $contactObject['Subject'] . "</h2>";
      echo "<p class=\"mb-5\">";
      echo $contactObject['Value'];
      echo "<br>";

      $results = GetSiteContent($section->Items);
      while($item = $results->fetch_assoc())
      {
        echo "<div class=\"contact-item\">";
        echo "<i class=\"far fa-2x fa-envelope mr-4\"></i>";
        echo "<span class=\"mb-0\">" . $item["Subject"] . "</span>";
        echo "</div>";
      }
      
      echo "</p>";
      echo "</div>";
      echo "<div class=\"contact-item\">&nbsp;</div>";
      echo "</div>";
      echo "</div>";
      GetFooter();
    }

    function GetFooter()
    {
      // FOOTER 
      echo "<footer class=\"text-center small tm-footer\">";
      echo "<div class=\"footer-container\"";
      echo "<p class=\"mb-0\">© " .  str_replace("@year", date("Y"), $GLOBALS['XMLReader']->Footer->Copyright) . "</p>";
      echo "<p><a href=\"https://github.com/BrandonMFong/Site\">Open Source</a></p>";
      echo "</div>";
      echo "</footer>";
    }

    function GetHeader()
    {
      echo "<head>";
      echo "<title>" . $GLOBALS['XMLReader']->SiteTitle . "</title>";
      echo "<meta charset=\"UTF-8\" />";
      echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />";
      echo "<meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\" />";
      GetCSS(); // Get CSS
      echo "</head>";
    }

    function GetCSS()
    {
      // Load CSS
      foreach($GLOBALS['XMLReader']->Header->StyleSheets as $ref)
      {
          echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . $ref . "\" media=\"screen\">";
      }
    }

    function GetJavascript()
    {
      // Load Javascripts
      foreach($GLOBALS['XMLReader']->Scripts->Script as $script)
      {
          echo "<script src=\"" . $script . "\"></script>";
      }
    }

    function GetSection($SectionType, $SectionObject)
    {
      switch($SectionType)
      {
        case "Hero":
          GetHero($SectionObject);
          break;  
        case "Grid":
          GetGrid($SectionObject);
          break;  
        case "Bubbles":
          GetBubbles($SectionObject);
          break;  
        case "Gallery":
          GetGallery($SectionObject);
          break;  
        case "Info":
          GetInfo($SectionObject);
          break;  
      }
    }
?>