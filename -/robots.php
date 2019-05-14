User-agent: *
Disallow: /-/

<?php

if(file_exists("../robots.txt"))
	readfile ("../robots.txt");


if(file_exists("../-app/robots.txt"))
	readfile ("../-app/robots.txt");

?>