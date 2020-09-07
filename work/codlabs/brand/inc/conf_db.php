<?php
if ($_SERVER[SCRIPT_FILENAME] == str_replace("\\","/",__FILE__)) exit;

function cDB($fString) {
	global $gDB;
	if ($gDB[$fString]["dbms"] == "mysql") {
		$cString = $gDB[$fString]["dbms"].":host=".$gDB[$fString]["host"].";port=".$gDB[$fString]["port"].";dbname=".$gDB[$fString]["dbname"].";charset=".__gDBCharacterSet;
	}
	elseif ($gDB[$fString]["dbms"] == "dblib") {
		$cString = $gDB[$fString]["dbms"].":host=".$gDB[$fString]["host"].":".$gDB[$fString]["port"].";dbname=".$gDB[$fString]["dbname"].";charset=".__gDBCharacterSet;
	}
	try {
		return $cdb = new PDO($cString, $gDB[$fString]["user_id"], $gDB[$fString]["user_pass"]);
		//$cdb->exec("set names utf8");
		//return $cdb;
	}
	catch (PDOException $ex) {
		echo 'Connection failed: ' . $ex->getMessage();
		exit;
	}
}


?>
