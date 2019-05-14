<?php

// $_INC_ARGS - used for passing values to include files for processing
// May need to be revisited with a better solution?
$_INC_ARGS = null;

include_once("-page.class.php");
$_PAGE = new Page();
$_PAGE->setTemplate("default.html");

// If we are just getting page data as a json object then set update PAGE
if(isset($_REQUEST["json"]))
	$_PAGE->setResponseTypeAsJson();


// Break up the path into an array
// [0] is the top level and used for primary routing
// [n] will be used by each page to provide more detail
$_DASHPATH = isset($_REQUEST["dash-path"]) ? explode("/", $_REQUEST["dash-path"]) : array("index");



if(!file_exists("../-app/pages/" . $_DASHPATH[0] . "/index.php"))
	include_once("../-app/errors/404/index.php");

else
	include_once("../-app/pages/" . $_DASHPATH[0] . "/index.php");


$_PAGE->out();





function getProcessedTemplateFile($path){
	ob_start();
	include($path);
	$output = ob_get_contents();
	ob_end_clean();
	return $output;

}

?>