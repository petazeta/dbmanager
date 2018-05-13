<?php
//Includes
require('includes/config.php');
require('includes/phpclasses/nodes.php');
require('includes/database_tables.php');
require('includes/phpclasses/nodesrecords.php');

if (isset($_GET["json"])) {
	$json=json_decode($_GET["json"]);
	$fields=$_GET;
}
else if (isset($_POST["json"])) {
	$json=json_decode($_POST["json"]);
	$fields=$_POST;
}
if (isset($_GET["parameters"])) $parameters=json_decode($_GET["parameters"]);
else if (isset($_POST["parameters"])) $parameters=json_decode($_POST["parameters"]);

$myelement=new NodeFemaleRecords();

$myelement->load($json);
$myelement->loadasc($json);
unset($fields["json"]);
unset($fields["parameters"]);
$myelement->properties->cloneFromArray($fields);	//For the case when some data comes from a form

switch ($parameters->action) {
	case "load unlinked": $myexecfunction="db_loadrecords"; $myparameters="load unlinked"; break;
	case "load all": $myexecfunction="db_loadrecords"; $myparameters="load all"; break;
	case "load my children not": $myexecfunction="db_loadrecords"; $myparameters="load my children not"; break;
	case "load tables": $myexecfunction="db_loadrecords"; $myparameters="load tables"; break;
	case "load this relationship": $myexecfunction="db_loadthisrel"; $myparameters=null; break;
	default: $myexecfunction=null;
}

$executed=$myelement->$myexecfunction($myparameters);

if ($executed===false) {
	$myelement->extra=new stdClass();
	$myelement->extra->error=true;
	$myelement->extra->errorinfo=new stdClass();
	$myelement->extra->errorinfo->type="database";
}
$myelement->avoidrecursion(); //needed when insert
header("Content-type: application/json");
echo json_encode($myelement);
?>