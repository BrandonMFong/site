<?php
    include("variables.php");
    global $Connected, $SendOverride;
    $Connected = false;
    $SendOverride = false;
    
    $GLOBALS['XMLReader'] = simplexml_load_string($_SESSION['XMLReader']);
    $GLOBALS['CredConfig'] = simplexml_load_string($_SESSION['CredConfig']);
    $GLOBALS['WebConfig'] = simplexml_load_string($_SESSION['WebConfig']);

    function GetVariables()
    {
        $x = GetCorrectEnvironment($GLOBALS['WebConfig']->Environment);

        $GLOBALS['servername'] = $x->Servername;
        $GLOBALS['username'] = $x->Username;
        $GLOBALS['password'] = $x->Password;
        $GLOBALS['dbname'] = $x->Database;
    }

    function Connect()
    {
        GetVariables();
        $GLOBALS['conn'] = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
        if ($GLOBALS['conn']->connect_error) {die("Connection failed: " . $GLOBALS['conn']->connect_error);}
        else{$Connected = true;}
    }

    function Close(){$GLOBALS['conn']->close();}

    function QueryByFile(string $filepath) 
    {
        global $Connected, $SendOverride;
        $SendOverride = true;
        if(!$Connected){Connect();}
        $sqlfile =  fopen($filepath, "r") or die("Unable to read file.");
        if(!Query(fread($sqlfile, filesize("sql/GetBio.sql")))){return $GLOBALS['Results']->fetch_assoc();}
        else{return 0;}
    }

    function Query(string $querystring)
    {
        global $Connected, $SendOverride;
        if(!$Connected){Connect();}
        $GLOBALS['Results'] = $GLOBALS['conn']->query($querystring);
        if ($GLOBALS['Results']->num_rows == 0) {echo "0 results";}
        Close();
        if(!$SendOverride){return $GLOBALS['Results']->fetch_assoc();}
        else{return 0;}
    }
?>