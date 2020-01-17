<!doctype html>
<html lang="en">
    <?php 
        global $currpage;
        $currpage = "About"; // Include this to distinguish the page for the other php
        include '../php/head.php'; 
    ?>
<body>

<div id="layout">
    <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>

    <div id="menu"><?php include 'php/Side_Menu.php';?></div>

    <div id="main">
        <div class="header">
            <h1>Brandon Fong Music</h1>
            <h2>Musician</h2>
        </div>
        <!-- TODO put this in a DB -->
        <div class="content">
            <?php 
                global $Type;
                $Type = "About";
                include '../php/Media_Query.php';
            ?>
			
        </div>

    </div>
</div>

<?php include '../php/js.php'; ?>

</body>
</html>


<?php include '../php/footer.php'; ?>