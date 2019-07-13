<?php
header('Content-Type: application/javascript');
?>


var imported = document.createElement('script');
imported.src = '/-/libs/md5.js';
document.head.appendChild(imported);


var _HISTORY = new Array();
var _ROUTES = new Array();


<?php
	echo "_ROUTES.push('')\n";

	$dirs = array_filter(glob('../-app/pages/*'), 'is_dir');

	for ($i = 0; $i < count($dirs); $i++) {
		$dirs[$i] = str_replace('../-app/pages/', "", $dirs[$i]);
		echo "_ROUTES.push('".$dirs[$i]."')\n";
	}
?>

// When ready
$(document).ready(function(){


	// Handle back and forward buttons
	window.onpopstate = function(event) {
		var host = document.location.protocol + "//" +document.location.hostname;
		dashPageTo(document.location.href.replace(host,''));
	};



	/* Handle A clicks*/
	$(document).on("click", "a", function(e){
		var targetHref = $(this).attr("href");
		var targetWindow = $(this).attr("target");
		var trimmedHref = targetHref.replace(/^\//, '');
		var rootHref = trimmedHref.split("/")[0];


		// Detect if the user is trying to open in a new window / covers most browsers
		if ( targetWindow || e.ctrlKey || e.shiftKey || e.metaKey || (e.button && e.button == 1) )
			return true;


		// If it's one of our _ROUTES then get the json for it and update navigation history
		for (var i = 0; i <_ROUTES.length ; i++) {
			if(_ROUTES[i] == rootHref)
			{
				dashPageTo(targetHref);

				history.pushState({},"",targetHref);
				e.preventDefault();
				return false;
			}
		}

		return true;

	});

	dashPostProcessPageLoad();

});



function dashPageTo(href){

  	var md5href = md5(href);

  	// Is the content cached?
	if(_HISTORY[md5href] !== undefined)
	{
		// Has it expired?
		if(_HISTORY[md5href].EXPIRESTIME > Math.floor((new Date).getTime()/1000))
		{
			dashProcessPage(_HISTORY[md5href]);
			return;
		}
	}



	$.ajax({
  type: 'GET',
  url: href,
  data: {json: '1'},
  dataType: 'json',
  success: function (data) {



  	data.EXPIRESTIME = Math.floor((new Date).getTime()/1000) + data.CACHETIME;
  	// if do not cache set time to 1970
  	if(data.DONOTCACHE)
  		data.EXPIRESTIME = 0;

  	// if perm cache set time to year 5138
  	if(data.PERMCACHE)
  		data.EXPIRESTIME = 99999999999;

  	_HISTORY[md5href] = data;

  	dashProcessPage(data);

  }
});
}




function dashProcessPage(data){


	if (typeof dashPreProcessPageLoad === 'function') {
		dashPreProcessPageLoad();
	}

  	// Update all the content on the page - IF Dash-id's have changed
  	$.each(data.CONTENT, function(index, element) {
        var domObj = $("#" + index);
        if(domObj.attr("dash-id") != element.dashID)
        {
        	domObj.html(element.html);
        	domObj.attr("dash-id", element.dashID);
        }
    });


  	// Update all the meta on the page




  	// Run any javascript functions.
  	// All params are passed as strings only.
  	// Functions specs should already be loaded
  	// https://stackoverflow.com/questions/36517173/how-to-store-a-javascript-function-in-json
  	$.each(data.SCRIPT, function(index, element) {
  		var args = "";
  		for(var i=0;i<element[1].length; i++)
  			args += "\""+element[1][i]+"\", ";

  		new Function("", element[0]+"("+args.slice(0, -2)+")")();
    });



	if (typeof dashPostProcessPageLoad === 'function') {
		dashPostProcessPageLoad();
	}

}

var mbx = function() {

	
  this.run = function() {
    console.log( 'hello!');
  }





}




