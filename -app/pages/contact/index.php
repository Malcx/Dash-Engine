<?php 



$_INC_ARGS = "contact";
$_PAGE->AddContent("dash-header", "stockheader", getProcessedTemplateFile("../-app/templates/header.html"));
$_PAGE->AddReadyFunctionCall("setMenu", array("contact"));






// Main Page content structure
$TMP = <<<EOT

	Check out Dash-Engine on <a href="https://github.com/Malcx/Dash-Engine">GitHub</a>

EOT;
$_PAGE->AddContent("dash-content", "contact", $TMP);








$_PAGE->AddContent("dash-footer", "stockheader", getProcessedTemplateFile("../-app/templates/footer.html"));

?>