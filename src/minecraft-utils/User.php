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
		$timeOnServer = 0;
		foreach ($this->Actions as &$action) {
			if (strpos($action->action, "logged in") !== false){
				
				if($found_start){
					$start = $action->time;
				}else{
					$start = $action->time;
					$startdate  = $action->date;
					$found_start = true;
				}
			}
			if (strpos($action->action, "left the game") !== false){
				if($found_start !== false) {
					$end = $action->time;
					$enddate = $action->date;
					
					if (strpos($enddate, $startdate) !== false){
						$timeOnServer = $timeOnServer + (strtotime($end)-strtotime($start))/3600;
						
						
					}else{
					   $temptime = (strtotime($end)-strtotime($start))/3600;
					    						
						if($temptime<0){
							$temptime = $temptime + 24;
						} 

						$timeOnServer = $timeOnServer + $temptime;
						
						$data[] = array(
						  'label' => $this->Name,
						  'start' => $startdate, 
						  'end'   => $enddate,
						  'class' => round($timeOnServer,1)
						);
						$timeOnServer = 0;
						$found_start = false;
						$found_end= false;
						$start = "";
						$end = "";
						$startdate  = "";
						$enddate = "";
					}
				}else{
					$timeOnServer = 0;
						$found_start = false;
						$found_end= false;
						$start = "";
						$end = "";
						$startdate  = "";
						$enddate = "";
				}
			}
		}
		$data[] = array(
						  'label' => $this->Name,
						  'start' => $startdate, 
						  'end'   => $enddate,
						  'class' => round($timeOnServer,1)
						);
		return $data;
	}
} 
?>