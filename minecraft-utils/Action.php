<?php
class Action {
	var $date;
	var $time;
	var $action;
	//var $coordinates;
	function __construct($date, $time, $action)
    {
		$this->date = $date;
		$this->time = $time;
		$this->action = $action;
		if (strpos($action, 'logged ') !== false){
			$words = explode("]", $action);
			$ret = $words[0];
			$temp = substr($action,strlen($ret)+1 );
			$words = explode(")", $temp);
			$ret2 = $words[0];
			$this->coordinates = substr($temp,0, strlen($ret2));
		}
    } 
}
?>