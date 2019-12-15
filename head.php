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
            echo "<link rel=\"stylesheet\" href=\"\""; 
            if(getcwd() == 'About'){ echo "../css/layouts/stylesheet.css\">";}
            elseif(getcwd() == 'Music'){ echo "../css/layouts/stylesheet.css\">";}
            else { echo "css/layouts/stylesheet.css\">";}
        ?>
        <!--<![endif]-->
</head>