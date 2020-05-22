<?php 
    $GLOBALS['XMLReader'] = simplexml_load_string($_SESSION['XMLReader-String']);
    $GLOBALS['CredConfig'] = simplexml_load_string($_SESSION['CredConfig-String']);
    $GLOBALS['WebConfig'] = simplexml_load_string($_SESSION['WebConfig-String']);
    function GetCorrectEnvironment(string $ConfigEnv)
    {
        $val = 0;
        foreach($GLOBALS['CredConfig']->Variables->Variable as $cred)
        {
            if($ConfigEnv == $cred['Environment']){$val = $cred;}
        }
        return $val;
    }
?>