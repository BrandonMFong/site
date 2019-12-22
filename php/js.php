<?php
    include 'environment.php';
    echo "<script src=\"";
    
    global $home_dir;
    global $music_dir;
    global $about_dir;
    echo "<link rel=\"stylesheet\" href=\"";
    if(basename(__DIR__) == $home_dir){echo "js/ui.js";}
    elseif((basename(__DIR__) == $music_dir) || (basename(__DIR__) == $about_dir)){echo "../js/ui.js";}
    echo "\"></script>";
?>