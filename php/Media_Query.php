<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
//define( 'WP_USE_THEMES', true );

/** Loads the WordPress Environment and Template */
//require( dirname( __FILE__ ) . '/wp-blog-header.php' );
    global $currpage;
    global $Type;
	include 'environment.php';

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname_datacenter);
	// Check connection
	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	}
			
	$sql = 
	"
	select Description 
        from type_content tc 
            join site_content sc 
                on tc.ID = sc.Type_ID
        where
            tc.Type = $Type
            and
            sc.Time >= curdate()

	";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) 
	{
		// output data of each row
		while($row = $result->fetch_assoc()) 
		{
			echo $row["Organization_Name"];
			echo "|" ;
			echo $row["ID"] ;
			echo "|" ;
			echo $row["Time"] ;
			echo "|" ;
			echo $row["Power"] ;
			echo "|" ;
			echo $row["ID"] ; // the tables have the same names, how do I distinguish between the two?
			echo "|" ;
			echo $row["Time"] ;
			echo "|" ;
			echo $row["Power"] ;
			echo "|<br>";
		}
	} 
	else 
	{
		echo "0 results";
	}

	$conn->close();
?>


