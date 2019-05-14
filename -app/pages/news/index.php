<?php 


// The Article ID is [1] in the path
$NEWSID = isset($_DASHPATH[1]) ? intval($_DASHPATH[1]) : 0;


$_INC_ARGS = "news";
$_PAGE->AddContent("dash-header", "stockheader", getProcessedTemplateFile("../-app/templates/header.html"));
$_PAGE->AddReadyFunctionCall("setMenu", array("news"));






// Main Page content structure
$TMP = <<<EOT

	<span id="dash-news-item" dash-id="{dash-news-item-id}">{dash-news-item}</span>

	<a href="/news/1">News item 1</a><br />
	<a href="/news/15">News item 15</a><br />
	<a href="/news/21">News item 21</a><br />
EOT;
$_PAGE->AddContent("dash-content", "news", $TMP);




$NewsItem = "";
if($NEWSID)
	$NewsItem = "You are viewing news page <span id=\"dash-news\" dash-id=\"{dash-news-id}\">{dash-news}</span> <br /><br />";

$_PAGE->AddContent("dash-news-item", "news-item" . $NEWSID , $NewsItem);



$_PAGE->AddContent("dash-news", "news" . $NEWSID, " #" . $NEWSID);



$_PAGE->AddContent("dash-footer", "stockheader", getProcessedTemplateFile("../-app/templates/footer.html"));

?>