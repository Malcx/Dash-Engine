<?php 

$_PAGE->AddContent("dash-header", "Page not found");

$TMP = <<<EOT

	Unfortunately the page you are looking for could not be found.

EOT;

$_PAGE->AddContent("dash-content", $TMP);


?>