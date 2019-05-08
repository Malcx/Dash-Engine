var _mbx = null;


// When ready
$(document).ready(function(){
	_mbx = new mbx();
	_mbx.run();




	/* Handle A clicks*/
	$(document).on("click", "a", function(e){
		console.log($(this).attr("href"));
		history.pushState({},"",$(this).attr("href"));
		return false;
	});


});



var mbx = function() {

	
  this.run = function() {
    console.log( 'hello!');
  }





}




