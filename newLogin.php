<?php
/* set db login */
$dbuser = "enter db username";
$dbpass = "enter db pwd";
$dbname = "SSID";
$db = oci_connect($edbuser, $dbpass, $dbname);

if (!$db)  {
    echo "connection error"; 
    exit; 
}

$user = $_POST['username'];
$pass = $_POST['password'];

$sql_login = "SELECT Username FROM users WHERE Username='%".$user."%'"; 

$login_stmt = oci_parse($db, $sql_login);

if(!$login_stmt)
{
    echo "An error occurred in parsing the sql string.\n"; 
    exit; 
}

oci_execute($login_stmt);

while(oci_fetch_array($login_stmt))
{
    $password = oci_result($login_stmt,"Password");
}

if ($password == "")
{
    echo 'Password = blank';
}

if ($pass == $password)
{
    echo 'Logged In';
}
else
{
    echo 'Login Failed';
}


?>
