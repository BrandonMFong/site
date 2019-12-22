<?php include 'environment.php'?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example with a side menu that hides on mobile, just like the Pure website.">    
    <title>
        Brandon Fong Music
    </title>    
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css" integrity="sha384-" crossorigin="anonymous">
    
        <!--[if gt IE 8]><!-->
        <?php
            global $home_dir;
            global $music_dir;
            global $about_dir;
            
            echo "<link rel=\"stylesheet\" href=\"";
            if(basename(__DIR__) == $home_dir){echo "css/layouts/stylesheet.css\">";}
            elseif((basename(__DIR__) == $music_dir) || (basename(__DIR__) == $about_dir)){echo "../css/layouts/stylesheet.css\">";}

        ?>
        <!--<![endif]-->
</head>