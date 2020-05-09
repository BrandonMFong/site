<?php 
    $GLOBALS['XMLReader'] = simplexml_load_string($_SESSION['XMLReader']);
    $GLOBALS['CredConfig'] = simplexml_load_string($_SESSION['CredConfig']);
    $GLOBALS['WebConfig'] = simplexml_load_string($_SESSION['WebConfig']);
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