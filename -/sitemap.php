<?php
header('Content-Type: application/xml; charset=utf-8');
echo "<" . "?xml version=\"1.0\" encoding=\"utf-8\"?".">";

include_once("../-app/config.php");

?>


<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
   xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
   xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">


    <url>
        <loc><?php echo $_CONFIG["canonical"]; ?></loc>
        <lastmod>2006-11-18</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>


<?php

if(file_exists("../sitemap.php"))
	include_once ("../sitemap.php");


if(file_exists("../-app/sitemap.php"))
	include_once ("../-app/sitemap.php");

?>

</urlset>
