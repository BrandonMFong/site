<?php
    if(file_exists('logs/.is_local'))
    {
        global $home_dir;
        global $music_dir;
        global $about_dir;

        $home_dir = '\BrandonFongMusic\\';
        $music_dir = '\Music\\';
        $about_dir = '\About\\';
    }
    else
    {
        global $home_dir;
        global $music_dir;
        global $about_dir;

        $home_dir = '\Public_Html\\';
        $music_dir = '\Music\\';
        $about_dir = '\About\\';
    }
?>