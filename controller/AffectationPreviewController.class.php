<?php
require_once 'Controller.class.php';
require_once '../modele/Affectation.class.php';
require_once 'DataAnalyserController.class.php';

class AffectationPreview extends Controller{
	
	public $Classe;
	public $Semestre;
	public $MatiereList = array();
	public $RequestMatiere = array();
	
	function __construct($ClasseRequest,$MatiereList){
		parent::__construct();
		$this->MatiereList = $MatiereList;
		$tireposition = strrpos($ClasseRequest, "_");
		$this->Semestre = substr($ClasseRequest, $tireposition+1,2);
		$this->Classe = substr($ClasseRequest,0,strlen($ClasseRequest)-3);	
		$this->Classe = str_replace(".", " ", $this->Classe);
	}
	
	function execute(){
		
		for ($i = 0; $i < count($this->MatiereList); $i++) {
			$Matiere = $this->MatiereList[$i];
			if($Matiere->Classe == $this->Classe){
				//echo "ok";
				if("S".$Matiere->Semestre == $this->Semestre){
					//var_dump($Matiere);
					array_push($this->RequestMatiere, $Matiere);
				}// Semestre Test
				
			}// class Test
		}
	} // end of execute algorithme
	
} // end of classes


//$preview  = new AffectationPreview("Master-1.GL_S2");
//$preview->execute();
//var_dump($preview);