<?php
    global $css;
    global $js;
    global $currpage;
    global $servername;
    global $username;
    global $password;
    global $dbname;
    
    switch($currpage)
    {
        case "About":
        {
            if(file_exists('../logs/.is_local'))
            {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = 'bf_music';
                $css = 'http://localhost/BrandonFongMusic/css/layouts/stylesheet.css';
                $js = 'http://localhost/BrandonFongMusic/js/ui.js';
                break;
            }
            else
            {
                $servername = "localhost";
                $username = "u820870703_BrandonMFong";
                $password = "bfmusic27182";
                $dbname = 'bf_music';
                $css = 'https://BrandonFongMusic.com/css/layouts/stylesheet.css';
                $js = 'https://BrandonFongMusic.com/js/ui.js';
                break;
            }
        }
        default:
        {
            if(file_exists('logs/.is_local'))
            {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = 'bf_music';
                $css = 'http://localhost/BrandonFongMusic/css/layouts/stylesheet.css';
                $js = 'http://localhost/BrandonFongMusic/js/ui.js';
                break;
            }
            else
            {
                $servername = "localhost";
                $username = "u820870703_BrandonMFong";
                $password = "bfmusic27182";
                $dbname = 'bf_music';
                $css = 'https://BrandonFongMusic.com/css/layouts/stylesheet.css';
                $js = 'https://BrandonFongMusic.com/js/ui.js';
                break;
            }
        }
    }
?>