# Dash-Engine


## Description
A simple framework for web based sites.  
It's aimed around a certain class of site, that has multiple pages but the same basic template for all pages.
Content is optimised to run as a single page site, but if built correctly should work with javascript disabled.
This approach produces proper "pages" for SEO and deeplinking.




## How to

Copy everything and build the site using the files in /-app. Basically anything that might need changing should be in there. 
Generally for now I'm afraid you'll have to look at the demo app in -app as an example...


HTML Elements are replaced on the server at run time for the initial page load and require 3 pieces of information
id = unique dom id
dash-id = {<id>-id} = This will be replaced with the current piece of contents unique id
{html element content} = replaced with the actual content server side. 
<span id="dash-news-item" dash-id="{dash-news-item-id}">{dash-news-item}</span>


robots.txt
These are passed through to /-/robots.php which contains default for the Dash-Engine.
This will then look for and if_exists append robots.txt files found at / and /-app



### ToDo
Detailed readme instructions
sitemap.xml
/admin
pagenotfound 
back and forward buttons
Cache pages locally
g-analytics trigger on page load
/ link