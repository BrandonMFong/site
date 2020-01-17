<?php
    global $css;
    global $js;
    global $currpage;
    global $servername;
    global $username;
    global $password;
    global $dbname;
    global $home;
    global $about;
    global $youtube;
    global $soundcloud;
    global $facebook_page;
    global $spotify;
    global $instagram;
    
    switch($currpage)
    {
        case "About":
        {
            if(file_exists('../logs/.is_local'))
            {
                $servername     = "localhost";
                $username       = "root";
                $password       = "";
                $dbname         = 'bf_music';
                $css            = 'http://localhost/BrandonFongMusic/css/layouts/stylesheet.css';
                $js             = 'http://localhost/BrandonFongMusic/js/ui.js';
                $home           = 'http://localhost/BrandonFongMusic';
                $about          = 'http://localhost/BrandonFongMusic/About';
                $youtube        = 'https://www.youtube.com/user/TheFongBoy';
                $soundcloud     = 'https://soundcloud.com/brandonfong';
                $facebook_page  = 'https://www.facebook.com/BrandonFongMusic';
                $spotify        = 'https://open.spotify.com/artist/1AJ0HggT32RRsEbTvC6tF2?si=pqWrTK96TAmwHfXz78KcMQ';
                $instagram      = 'https://www.instagram.com/bmfong/';
                break;
            }
            else
            {
                $servername     = "localhost";
                $username       = "u820870703_BrandonMFong";
                $password       = "bfmusic27182";
                $dbname         = 'u820870703_bf_music';
                $css            = 'https://BrandonFongMusic.com/css/layouts/stylesheet.css';
                $js             = 'https://BrandonFongMusic.com/js/ui.js';
                $home           = 'https://www.brandonfongmusic.com';
                $about          = 'https://www.brandonfongmusic.com/About';
                $youtube        = 'https://www.youtube.com/user/TheFongBoy';
                $soundcloud     = 'https://soundcloud.com/brandonfong';
                $facebook_page  = 'https://www.facebook.com/BrandonFongMusic';
                $spotify        = 'https://open.spotify.com/artist/1AJ0HggT32RRsEbTvC6tF2?si=pqWrTK96TAmwHfXz78KcMQ';
                $instagram      = 'https://www.instagram.com/bmfong/';
                break;
            }
        }
        default:
        {
            if(file_exists('logs/.is_local'))
            {
                $servername     = "localhost";
                $username       = "root";
                $password       = "";
                $dbname         = 'bf_music';
                $css            = 'http://localhost/BrandonFongMusic/css/layouts/stylesheet.css';
                $js             = 'http://localhost/BrandonFongMusic/js/ui.js';
                $home           = 'http://localhost/BrandonFongMusic';
                $about          = 'http://localhost/BrandonFongMusic/About';
                $youtube        = 'https://www.youtube.com/user/TheFongBoy';
                $soundcloud     = 'https://soundcloud.com/brandonfong';
                $facebook_page  = 'https://www.facebook.com/BrandonFongMusic';
                $spotify        = 'https://open.spotify.com/artist/1AJ0HggT32RRsEbTvC6tF2?si=pqWrTK96TAmwHfXz78KcMQ';
                $instagram      = 'https://www.instagram.com/bmfong/';
                break;
            }
            else
            {
                $servername     = "localhost";
                $username       = "u820870703_BrandonMFong";
                $password       = "bfmusic27182";
                $dbname         = 'u820870703_bf_music';
                $css            = 'https://BrandonFongMusic.com/css/layouts/stylesheet.css';
                $js             = 'https://BrandonFongMusic.com/js/ui.js';
                $home           = 'https://www.brandonfongmusic.com';
                $about          = 'https://www.brandonfongmusic.com/About';
                $youtube        = 'https://www.youtube.com/user/TheFongBoy';
                $soundcloud     = 'https://soundcloud.com/brandonfong';
                $facebook_page  = 'https://www.facebook.com/BrandonFongMusic';
                $spotify        = 'https://open.spotify.com/artist/1AJ0HggT32RRsEbTvC6tF2?si=pqWrTK96TAmwHfXz78KcMQ';
                $instagram      = 'https://www.instagram.com/bmfong/';
                break;
            }
        }
    }
?>