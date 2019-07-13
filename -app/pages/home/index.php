<?php 


$_INC_ARGS = "home";
$_PAGE->AddContent("dash-header", "stockheader", getProcessedTemplateFile("../-app/templates/header.html"));
$_PAGE->AddReadyFunctionCall("setMenu", array("home"));
$_PAGE->setDoNotCache();




$TMP = <<<EOT

	<strong>This is the demo home page for Dash-Engine</strong>


	<br /><br />
	Links:<br />
	<ul>
	<li>"/" always go <a href="/">Home</a><br /></li>
	<li>direct to an actual <a href="/demofiles/temp.pdf">existing file</a> will be passed through<br /><small>N.b. Files in /-app must be in /-app/assets for security</small></li>
	<li>bad links got to a <a href="/nowhere/index.html">404</a></li>
	<li>images should be under the /-app/assets/ directory<br />
	<img src="/-app/assets/img/noimage.png" width="100" /></li>

	<li>Or may be outside of /-app altogether<br />
	<img src="/demofiles/noimage.png" width="100" /></li>

	<li><a href="Dash-launch">Use full paths - relative will not work</a></li>
	<li>External links work as normal <a href="http://www.google.com">Google</a></li>

	</ul>


	<br />

EOT;

$_PAGE->AddContent("dash-content", "home", $TMP);





$_PAGE->AddContent("dash-footer", "stockheader", getProcessedTemplateFile("../-app/templates/footer.html"));


?>