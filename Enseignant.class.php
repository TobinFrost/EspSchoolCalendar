<?php
class Enseignant {
	private $Type;
	private $Nom;
	private $Prenom;
	private $Grade;
	private $Affectation;
	public function __construct($TeacherInformation = null){
			if(isset($TeacherInformation)){
				$StringTemp = substr($TeacherInformation,1,strlen($TeacherInformation));
				$MarkerPos = strpos($StringTemp,"|");
				$this->Type = substr($TeacherInformation,1,$MarkerPos);
				$TeacherInformation = substr($TeacherInformation,$MarkerPos+1);
				//echo "voici = ".$TeacherInformation;
				$StringTemp = substr($TeacherInformation,1,strlen($TeacherInformation));
				$MarkerPos = strpos($StringTemp,"|");
				$this->Nom = substr($TeacherInformation,1,$MarkerPos);
				$TeacherInformation = substr($TeacherInformation,$MarkerPos+1);
				//echo "voici = ".$TeacherInformation;
				$StringTemp = substr($TeacherInformation,1,strlen($TeacherInformation));
				$MarkerPos = strpos($StringTemp,"|");
				$this->Prenom = substr($TeacherInformation,1,$MarkerPos);
				$TeacherInformation = substr($TeacherInformation,$MarkerPos+1);
				//echo "voici = ".$TeacherInformation;
				$StringTemp = substr($TeacherInformation,1,strlen($TeacherInformation));
				$MarkerPos = strpos($StringTemp,"|");
				$this->Grade = substr($TeacherInformation,1,$MarkerPos);
				$TeacherInformation = substr($TeacherInformation,$MarkerPos+1);
				//echo "voici = ".$TeacherInformation;
				$StringTemp = substr($TeacherInformation,1,strlen($TeacherInformation));
				$MarkerPos = strpos($StringTemp,"|");
				$this->Affectation = substr($TeacherInformation,$MarkerPos+1);
//				$TeacherInformation = substr($TeacherInformation,$MarkerPos+1);
//				echo "voici = ".$TeacherInformation;
			}
	}
	
	public function __get($property){
 	if (property_exists($this, $property)){
 			return $this->$property;
 		}
 	}
	
	public function __set($property,$value){
 		
 		if (property_exists($this, $property)){
 			$this->$property = $value;
 		}
 		
 		
 	}


}