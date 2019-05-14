<?php
header('Content-Type: application/javascript');
?>


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

	/* Handle A clicks*/
	$(document).on("click", "a", function(e){
		var targetHref = $(this).attr("href");
		var trimmedHref = targetHref.replace(/^\//, '');
		var rootHref = trimmedHref.split("/")[0];


		// Detect if the user is trying to open in a new window / covers most browsers
		if ( e.ctrlKey || e.shiftKey || e.metaKey || (e.button && e.button == 1) )
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


});



function dashPageTo(href){
	$.ajax({
  type: 'GET',
  url: href,
  data: {json: '1'},
  dataType: 'json',
  success: function (data) {
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

  }
});
}




var mbx = function() {

	
  this.run = function() {
    console.log( 'hello!');
  }





}




