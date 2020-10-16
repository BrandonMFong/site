<?php

    // TODO: remake the database structure
    global $Connected, $SendOverride;
    $Connected = false;
    $SendOverride = false;

    $GLOBALS['XMLReader'] = simplexml_load_string($_SESSION['XMLReader-String']);
    $GLOBALS['CredConfig'] = simplexml_load_string($_SESSION['CredConfig-String']);

    function GetCorrectEnvironment()
    {
        $val = getcwd();
        if($val == $GLOBALS["XMLReader"]->Environment->Local)
        {
            return $GLOBALS['CredConfig']->Local;
        }
        elseif($val == $GLOBALS["XMLReader"]->Environment->Server)
        {
            return $GLOBALS['CredConfig']->Server;
        }
        else{echo "Something bad happened";}
    }
    
    function GetVariables()
    {
        $x = GetCorrectEnvironment();

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
        if(!Query(fread($sqlfile, filesize($filepath)))){return $GLOBALS['Results']->fetch_assoc();}
        else{return false;}
    }

    function Query(string $querystring)
    {
        global $Connected, $SendOverride;
        if(!$Connected){Connect();}
        $GLOBALS['Results'] = $GLOBALS['conn']->query($querystring);
        if ($GLOBALS['Results']->num_rows == 0) {echo "0 results";}
        Close();
        if(!$SendOverride){return $GLOBALS['Results']->fetch_assoc();}
        else{return false;}
    }

    function UpdateQuery(string $querystring)
    {
        global $Connected, $SendOverride;
        if(!$Connected){Connect();}
        $GLOBALS['conn']->query($querystring);
        Close();
    }

    // Queries table by guid
    function GetSiteContent(string $guid)
    {
        global $Connected, $SendOverride;
        $SendOverride = true;
        if(!$Connected){Connect();}
        $filepath = "/sql/GetSiteContent.sql";
        $sqlfile =  fopen($filepath, "r") or die("Unable to read file.");
        $querystring = fread($sqlfile, filesize($filepath));
        
        if(!Query(str_replace("@guid",$GLOBALS['XMLReader']->BioGuid,$querystring))){return $GLOBALS['Results']->fetch_assoc();}
        else{return false;}
    }
?>