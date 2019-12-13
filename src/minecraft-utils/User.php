<?php
Include ('Action.php');

class User {
	
    var $Name;
	var $Actions;
	function __construct($Name)
    {
		$words = explode("[", $Name);
		$this->Name = $words[0];
		$this->Actions = array();
    } 
   
    function getName() {
        return $this->Name;
    }
	
	function addAction($date, $time, $action){
		$this->Actions[] = new Action($date, $time, $action);
	}
	
	function getGanttData(){
		$data = array();
		$start = "";
		$end = "";
		$startdate = "";
		$enddate = "";
		$found_start = false;
		$found_end= false;
		foreach ($this->Actions as &$action) {
			if (strpos($action->action, "logged in") !== false){
				$start = $action->time;
				$found_start = true;
				$startdate  = $action->date;
			}
			if (strpos($action->action, "left the game") !== false){
				$end = $action->time;
				$found_end = true;
				$enddate  = $action->date;
			}
			if($found_start !== false) {
				if ($found_end !== false){
					$timeOnServer = round((strtotime($end)-strtotime($start))/3600,0);
					if($timeOnServer<0){
						$timeOnServer = $timeOnServer + 24;
					}
					$data[] = array(
						  'label' => $this->Name,
						  'start' => $startdate, 
						  'end'   => $enddate,
						  'class' => $timeOnServer
						);
					$found_start = false;
					$found_end= false;
				}
			}
		}
		return $data;
	}
} 
?>