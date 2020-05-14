<?php 
    session_start();

    $GLOBALS['XMLReader'] = simplexml_load_string($_SESSION['XMLReader']);
    $GLOBALS['CredConfig'] = simplexml_load_string($_SESSION['CredConfig']);
    $GLOBALS['WebConfig'] = simplexml_load_string($_SESSION['WebConfig']);
    include '../../function/database.php'; 
    
    $UpdatedBio = $_POST['BioPost'];
    $querystring = "update sitecontent set value = '$UpdatedBio' where id = (select id from sitecontent where guid = 'c546c208-8f5b-11ea-9c0c-8c1645f97121');";
    Query($querystring);
    header("Location:./");
?>