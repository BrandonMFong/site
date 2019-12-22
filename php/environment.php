<?php
    global $css;
    global $js;
    
    if(file_exists('logs/.is_local'))
    {
        $css = 'http://localhost/BrandonFongMusic/css/layouts/stylesheet.css';
        $js = 'http://localhost/BrandonFongMusic/js/ui.js';
    }
    else
    {
        $css = 'https://BrandonFongMusic.com/css/layouts/stylesheet.css';
        $js = 'https://BrandonFongMusic.com/js/ui.js';
    }
?>