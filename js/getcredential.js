function GetCredential(str) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
            xmlhttp.open("GET", "../dasheditor/getbio.php?bio=" + str, true);
            xmlhttp.send();
        }
        // https://www.w3schools.com/php/php_ajax_database.asp
}