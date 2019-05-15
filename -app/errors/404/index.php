<?php 

header("HTTP/1.0 404 Not Found");
$_INC_ARGS = "none";
$_PAGE->AddContent("dash-header", "stockheader", getProcessedTemplateFile("../-app/templates/header.html"));
$_PAGE->AddReadyFunctionCall("setMenu", array("none"));



// Main Page content structure
$TMP = <<<EOT
	Error 404 - hmmm that page cannot be found...
EOT;
$_PAGE->AddContent("dash-content", "404", $TMP);



$_PAGE->AddContent("dash-footer", "stockheader", getProcessedTemplateFile("../-app/templates/footer.html"));





?>