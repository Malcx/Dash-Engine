<?php

class Page {


    // constructor
    public function __construct() {

		$this->outputJSON = false;
		$this->_TEMPLATE = "";
		$this->_META = array();
		$this->_CONTENT = array();
		$this->_SCRIPT = array();
    }



    public function setResponseTypeAsJson() {
		$this->outputJSON = true;
	}

    public function setTemplate($tPath) {
    	$this->_TEMPLATE = $tPath;
    	$o = file_get_contents("../-app/templates/" . $this->_TEMPLATE);
    }



    public function AddContent($domID, $dashID, $str){
    	$myContentObj = new stdClass;
		$myContentObj->dashID = $dashID;
		$myContentObj->html = $str;

    	$this->_CONTENT[$domID] = $myContentObj;
    }


	public function AddReadyFunctionCall($function, $args)
	{
		array_push($this->_SCRIPT, array($function, $args));
	}

    public function out(){

    	if($this->outputJSON)
    		$this->JSONout();
    	else
    		$this->HTMLout();

    }


/*
    private function HTMLreplace($html, $key, $value)
    {

    	if(!is_array($value))
    		return str_replace("{".$key."}", $value, $html);
    	else
	    	foreach ($value as $k => $v) {
	    		$html = $this->HTMLreplace($html, $k, $v);
    		}

    	return $html;
    }
    */

	private function HTMLout(){
    	$o = file_get_contents("../-app/templates/" . $this->_TEMPLATE);



    	foreach ($this->_CONTENT as $k => $v) {
    		$o = str_replace("{".$k."-id}", $v->dashID, $o);
    		$o = str_replace("{".$k."}", $v->html, $o);
   		}


   		
   		$initScript = "<script>\n";
   		foreach ($this->_SCRIPT as $key => $value) {

   			$args = implode("\",\"", $value[1]);
   			if(count($value[1]))
   				$args = "\"" . $args . "\"";

   			$initScript .= $value[0] . "(".$args.");\n";
   		}
   		$initScript .= "</script>";


   		$o = str_replace("{dash-init-script}", $initScript, $o);


//    	$o = $this->HTMLreplace($o, "", $this->_CONTENT);
//    	$o = $this->HTMLreplace($o, "", $this->_META);

    	echo $o;

	}


    private function JSONout(){
    	$o = array();
    	$o["META"] = $this->_META;
    	$o["CONTENT"] = $this->_CONTENT;
    	$o["SCRIPT"] = $this->_SCRIPT;
    	echo json_encode($o);

    }



}

?>