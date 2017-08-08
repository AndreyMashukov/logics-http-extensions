<?php

namespace Tests;

if (isset($GLOBALS["_GET"]["Cache-Control"]) === true)
    {
	header("Cache-Control: " . $GLOBALS["_GET"]["Cache-Control"]);
    }

if (isset($GLOBALS["_GET"]["Expires"]) === true)
    {
	header("Expires: " . $GLOBALS["_GET"]["Expires"]);
    }

echo "Method: " . $_SERVER["REQUEST_METHOD"] . "<br/>";
echo "User-agent: " . $_SERVER["HTTP_USER_AGENT"] . "<br/>";
echo "Time: " . date("Y-m-d H:i:s") . "<br/>";

$headers = getallheaders();
foreach ($headers as $name => $value)
    {
	echo "HEADER: " . $name . " = " . str_replace("\n", "", var_export($value, true)) . "<br/>";
    }

foreach ($GLOBALS["_GET"] as $name => $value)
    {
	echo "GET: " . $name . " = " . str_replace("\n", "", var_export($value, true)) . "<br/>";
    }

foreach ($GLOBALS["_POST"] as $name => $value)
    {
	echo "POST: " . $name . " = " . str_replace("\n", "", var_export($value, true)) . "<br/>";
    }

echo "Request body: " . file_get_contents("php://input");

?>
