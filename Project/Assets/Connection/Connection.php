<?php
$Server = "localhost";
$User = "root";
$Password = "";
$DB = "db_florabee";

$Con = mysqli_connect($Server,$User,$Password,$DB);

if(!$Con)
{
	echo "Not Connected";
}

?>