<?php
Include ('User.php');
class MinecraftParser {
	
	var $Users;
	
	function __construct($folder)
    {
		$this->Users = array();
		foreach (glob("*.log") as $filename) {
			$this->parseFile($filename);
		}
	}
	
	function parseFile($file){
		$data = file($file,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$filedate  = substr($file,0,strlen($file)-6);
			
		foreach ($data as $dat){ // iterate over file() generated array
			$time  = substr($dat,1,8);
			preg_match_all("/\\[(.*?)\\]/", $dat, $matches); 
			$info = $matches[1][1];
			$value   = substr($dat,strlen($time) + strlen($info) + 6);
			if (strpos($value, 'logged') !== false) {
				$words = explode(" ", $value);
				$newname = $words[1];
				$words = explode("[", $newname);
				$newname = $words[0];
				$found = false;
				$user  = 0;
				foreach ($this->Users as &$cuser) {
					$tempname = $cuser->getName();
					if (strpos($tempname, $newname) !== false){
						$found  = true;
						$user = $cuser;
					}
				}
				if($found == false) {
					$user = new User($newname);
					$this->Users[] = $user;
				}
				$words = explode("]", $value);
				$ret = $words[0];
				$user->addAction($filedate, $time, substr($value,strlen($ret)+2));
			}else {
				$words = explode(" ", $value);
				$newname = $words[1];
				$found = false;
				$user  = 0;
				foreach ($this->Users as &$cuser) {
					$tempname = $cuser->getName();
					
					if (strpos($tempname, $newname) !== false){
						// echo "true";
						$found  = true;
						$user = $cuser;
					}
				}
				if($found !== false) {
					$user->addAction($filedate, $time, substr($value,strlen($newname)+1));
				}
			}
		}
	}
	
	function printInfo(){
		$data = array();
		foreach ($this->Users as &$cuser) {
			$user_data = $cuser->getGanttData();
			foreach ($user_data as &$entry) {
				$data[] = $entry;
			}
		}
		return $data;
	}
}
?>