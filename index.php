<!doctype html>
<html lang="en">
    <?php 
        global $currpage;
        $currpage = "Home"; // Include this to distinguish the page for the other php
        include 'php/head.php'; 
    ?>
<body>

<div id="layout">
    <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>

    <div id="menu">
        <div class="pure-menu">

            <ul class="pure-menu-list">
                <!-- TODO code in link var --> 
                <li class="pure-menu-item">
                    <a href="https://www.brandonfongmusic.com" class="pure-menu-link">Home</a>
                </li>

                <li class="pure-menu-item">
                    <a href="https://www.brandonfongmusic.com/About" class="pure-menu-link">About</a>
                </li>

                <li class="pure-menu-item">
                    <a href="https://www.youtube.com/user/TheFongBoy" class="pure-menu-link">Youtube</a>
                </li>

                <li class="pure-menu-item">
                    <a href="https://soundcloud.com/brandonfong" class="pure-menu-link">SoundCloud</a>
                </li>
                
                <li class="pure-menu-item">
                    <a href="https://www.facebook.com/BrandonFongMusic" class="pure-menu-link">Facebook</a>
                </li>

                <li class="pure-menu-item">
                    <a href="https://open.spotify.com/artist/1AJ0HggT32RRsEbTvC6tF2?si=pqWrTK96TAmwHfXz78KcMQ" class="pure-menu-link">Spotify</a>
                </li>

                <li class="pure-menu-item">
                    <a href="https://www.instagram.com/bmfong/" class="pure-menu-link">Instagram</a>
                </li>
            </ul>
        </div>
    </div>

    <div id="main">
        <div class="header">
            <h1>Brandon Fong Music</h1>
            <h2>Musician</h2>
        </div>
        <!-- TODO put this in a DB -->
        <div class="content">

			<!-- Youtube Begin -->
            <h1>Latest Video</h1>
			<div class="video-container">
            <?php 
                global $Type;
                $Type = "Youtube";
                include 'php/Media_Query.php';
            ?>
            </div>
			<!-- Youtube End -->
			
			<!-- SC Begin -->
            <h1>SoundCloud</h1>
            <?php 
                global $Type;
                $Type = "SoundCloud";
                include 'php/Media_Query.php';
            ?>
            <!-- SC End -->
			
			<!-- Spot Begin -->
            <h1>Spotify</h1>
            <?php 
                global $Type;
                $Type = "Spotify";
                include 'php/Media_Query.php';
            ?>
            <!-- Spot End -->
			
			<!-- Insta Begin -->
			<h1>Instagram</h1>
			<?php 
                global $Type;
                $Type = "Instagram";
                include 'php/Media_Query.php';
            ?>
            <!-- Insta End -->
		</div>

    </div>
</div>

<?php include 'php/js.php'; ?>

</body>
</html>


<?php include 'php/footer.php'; ?>
