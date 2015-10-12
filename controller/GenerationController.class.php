<?php
require_once 'Controller.class.php';
require_once '../modele/Affectation.class.php';
require_once '../modele/Jour.class.php';
require_once '../modele/Semaine.class.php';
require_once '../modele/FlyweightHeureFactory.php';
require_once '../modele/FlyweightJourFactory.php';
require_once '../modele/Matiere.class.php';
require_once '../Classes/PHPExcel.php';
require_once '../Classes/PHPExcel/Writer/Excel2007.php';

class GenerationController extends Controller{
	
	public $MatiereListToGenerate;
	public $AffectationList = array();
	public $AffectationDone;
	public $JoursList = array();
	public $SemaineList = array();
	public $AffectationRemaining;
	
	public function __construct($MatiereList){
		parent::__construct();
		$this->MatiereListToGenerate = $MatiereList;
		$this->AffectationRemaining =  new ArrayObject(array());
	}
	
	public function execute(){
		// First Step : Make Affectation List with "Matiere" and Hours
		$HeureFactory = new FlyweightHeureFactory();
		
		//$makefunction = "makeHeure".$int;
		for ($i = 0; $i < count($this->MatiereListToGenerate); $i++) {
			//$makefunction = "makeHeure".$int;
			$makefunction = "makeHeure".rand(1,4);	
			$aff = new Affectation($this->MatiereListToGenerate[$i], $HeureFactory->$makefunction()); // Hours is associate to the Affectation That's not what we want
			// Correct This
			array_push($this->AffectationList, $aff);
			
		}
		
		// Second Step : 
		//var_dump($this->AffectationList);
		$counter = count($this->AffectationList);
		$limit = $counter;
		$it = 0;
		$cours = array("CM","TD","TP");
		
		$arr = new ArrayObject(array());
		
		$newAff = new Affectation();
		
		while($counter>0){
			$random = rand(0,2);
			$currentCour =$cours[$random];
			//echo $currentCour."<br />";
				for ($i = 0; $i < $limit; $i++) {
					
					$rand = rand(0, $limit-1); // le hasard sur les affectations
				
					if(!is_null($this->AffectationList[$rand])&&(!is_null($this->AffectationList[$i]))){
						
					
						if($this->AffectationList[$rand]->Matiere->$currentCour > 0){
							//$this->AffectationList[$it]->$currentCour=$this->AffectationList[$it]->$currentCour-2;
							$makefunction = "makeHeure".rand(1,4);
							$this->AffectationList[$rand]->Heure = $HeureFactory->$makefunction(); // change the Hours
							// Test de parité
							$alt = $this->AffectationList[$rand]->Matiere->$currentCour;
							$alt =&$alt;
							
							$newAff = clone $this->AffectationList[$rand];
							
							if($this->AffectationList[$rand]->Matiere->$currentCour % 2 == 0){ // if parite is yes
								
								$alt -=2;
								//$this->AffectationList[$rand]->Matiere->$currentCour -= 2; // we decrement  2 hours
								$this->AffectationList[$rand]->Matiere->$currentCour=$alt;
								// For each affectation planified we put it in AffectationDone Array
								//array_push($this->AffectationDone, $this->AffectationList[$rand]);
								
								//var_dump($this->AffectationList[$rand]);
																
								
								
								$arr->append($newAff);
								
							}else{ // if not parite
								if($this->AffectationList[$rand]->Matiere->$currentCour == 1){ // if  1 hours remain
									$this->AffectationList[$rand]->Matiere->$currentCour -= 1; // we decrement  1 hours
									
									// For each affectation planified we put it in AffectationDone Array
									//array_push($this->AffectationDone, $this->AffectationList[$rand]);
									
									//var_dump($this->AffectationList[$rand]);
									
								}else{ // if 1 hours not remain yet 
									$this->AffectationList[$rand]->Matiere->$currentCour -= 2; // we decrement  2 hours
									
									// For each affectation planified we put it in AffectationDone Array
									//array_push($this->AffectationDone, $this->AffectationList[$rand]);
									
									//var_dump($this->AffectationList[$rand]);
								}
							}
							
							//$counter++;
						}
						
						if($this->AffectationList[$i]->Matiere->CM == 0 && $this->AffectationList[$i]->Matiere->TP == 0 && $this->AffectationList[$i]->Matiere->TD == 0){
							// The first Affectation to obtain 0 at all course go to the AffectationDone List
							//array_push($this->AffectationDone, $this->AffectationList[$i]);
							$this->AffectationList[$i] = null;
							//unset()
							$counter--;
						}
						//var_dump($this->AffectationList[$i]);
						//var_dump($this->AffectationList[$rand]);
						//array_push($this->AffectationDone, var_dump($this->AffectationList[$rand]));
					 }// is_null test	
					 	
					 	//echo $counter;
					 	
				} // end of for
	
			//echo "----------------END----------------------- <br /> ";
		} // end of while
		
		//var_dump($arr);
		$this->AffectationDone = $arr;
		
	} // end of execute

	public function prepareDays(){
		$JourFactory = new FlyweightJourFactory();
		$arrayTemp = $this->AffectationDone->getArrayCopy();
		
/**		for ($i = count($arrayTemp)-2; $i >=0; $i--) {
			for ($j = 0; $j <= $i; $j++) {
				if($arrayTemp[$j+1]->Heure->getHoraireDebut() > $arrayTemp[$j]->Heure->getHoraireDebut()){
					$t = $arrayTemp[$j+1];
					$arrayTemp[$j+1] = $arrayTemp[$j];
					$arrayTemp[$j] = $t;
				}
			}
		}
**/		
		$array08 = new ArrayObject(array());
		$array10 = new ArrayObject(array());
		$array14 = new ArrayObject(array());
		$array16 = new ArrayObject(array());
		for ($i = 0; $i < count($arrayTemp); $i++) {
			if($arrayTemp[$i]->Heure->getHoraireDebut() == "16H30"){
				
				$array16->append($arrayTemp[$i]);
			}
			if($arrayTemp[$i]->Heure->getHoraireDebut() == "14H30"){
				
				$array14->append($arrayTemp[$i]);
			}
			if($arrayTemp[$i]->Heure->getHoraireDebut() == "10H00"){
				
				$array10->append($arrayTemp[$i]);
			}
			if($arrayTemp[$i]->Heure->getHoraireDebut() == "08H00"){
				
				$array08->append($arrayTemp[$i]);
			}
		}
//		var_dump(count($array08));
//		var_dump(count($array10));
//		var_dump(count($array14));
//		var_dump(count($array16));
		$allarray = array($array08,$array10,$array14,$array16);
		$max = 0;
		for ($i = 1; $i < count($allarray); $i++) {
			if(count($allarray[$max]) < count($allarray[$i])){
				$max = $i;
			}
		}
		
		//echo "le max est : ".count($allarray[$max])." et indice : ".$max;
		$arraymax = $allarray[$max];
		
		for ($i = 0; $i < count($arraymax); $i++) {
			for ($y = 1; $y <= 6; $y++) {
				$makefunction = "makeJour".$y;
				$jourLibelle = $JourFactory->$makefunction();
				//var_dump($jourLibelle);
				if(($jourLibelle == "Mercredi")||($jourLibelle == "Samedi")){
					$length08 = $array08->count(); 
					$key08 = rand(0, $length08);
					//$key08 = 0;
					$length10 = $array10->count();
					$key10 = rand(0, $length10);
					$aff08 = null;
					$aff10 = null;
					if($array08->offsetExists($key08) == true){
						$aff08 = $array08[$key08]; 
						$array08->offsetUnset($key08);
						$array08->exchangeArray($array08->getArrayCopy());
//						echo "08H00 : ".$key08.",",PHP_EOL;
						
					}
					
					if($array10->offsetExists($key10) == true){
						$aff10 = $array10[$key10];
						$array10->offsetUnset($key10);
//						echo "10H00 : ".$key10.",",PHP_EOL;
					
					}
					
					if(!is_null($aff08)|| !is_null($aff10)){
						array_push($this->JoursList, new Jour($jourLibelle, array($aff08,$aff10)));
					}
					
					//$array08->offsetUnset($key08);	
				}else{
					$length08 = $array08->count();
					$key08 = rand(0, $length08);
					//$key08 = 0;
					$length10 = $array10->count();
					$key10 = rand(0, $length10);
					$length14 = $array14->count();
					$key14 = rand(0, $length14);
					$length16 = $array16->count();
					$key16 = rand(0, $length16);
					$aff08 = null;
					$aff10 = null;
					$aff14 = null;
					$aff16 = null;
					if($array08->offsetExists($key08) == true){
						$aff08 = $array08[$key08];
						$array08->offsetUnset($key08);
						//$array08->exchangeArray($array08->getArrayCopy());
//						echo "08H00 : ".$key08.",",PHP_EOL;
					
					}
						
					if($array10->offsetExists($key10) == true){
						$aff10 = $array10[$key10];
						$array10->offsetUnset($key10);
//						echo "10H00 : ".$key10.",",PHP_EOL;
							
					}
					
					if($array14->offsetExists($key14) == true){
						$aff14 = $array14[$key14];
						$array14->offsetUnset($key14);
						//$array14->exchangeArray($array08->getArrayCopy());
//						echo "14H30 : ".$key14.",",PHP_EOL;
							
					}
					
					if($array16->offsetExists($key16) == true){
						$aff16 = $array16[$key16];
						$array16->offsetUnset($key16);
						//$array14->exchangeArray($array08->getArrayCopy());
//						echo "16H30 : ".$key16.",",PHP_EOL;
							
					}
//					echo "</br>";
//					var_dump($aff08);
//					var_dump($aff10);
//					var_dump($aff14);
//					var_dump($aff16);
					if(!is_null($aff08)|| !is_null($aff10) || !is_null($aff14) || !is_null($aff16)){
						array_push($this->JoursList, new Jour($jourLibelle, array($aff08,$aff10,$aff14,$aff16)));
					}
					//
				}
			}
//			echo "</br>";
		}
//		echo "</br>";
//			var_dump(count($array08));
//			var_dump(count($array10));
//			var_dump(count($array14));
//			var_dump(count($array16));
//			$this->AffectationRemaining->exchangeArray(array($array08,$array10,$array14,$array16));
//			echo "</br>";
			//var_dump(count($this->JoursList));
			//var_dump($this->JoursList[5]->Affectations);
			//var_dump($this->JoursList[5]->LibelleJour);
		//var_dump(($array08));
		//var_dump(count($array08));
		//var_dump(count($array10));
		//var_dump(count($array14));
		//var_dump(count($array16));
		
		
		
		//echo "</br>";
		
		$this->distributeHours($array08, $array10, $array14, $array16);
		
		//var_dump(count($array08));
		//var_dump(count($array10));
		//var_dump(count($array14));
		//var_dump(count($array16));
		//echo "</br>";
		$this->distributeHours($array08, $array10, $array14, $array16);
		//var_dump(count($array08));
		//var_dump(count($array10));
		//var_dump(count($array14));
		//var_dump(count($array16));
		//echo "</br>";
		$this->distributeHours($array08, $array10, $array14, $array16);
		//var_dump(count($array08));
		//var_dump(count($array10));
		//var_dump(count($array14));
		//var_dump(count($array16));
		
		
			
		// don't worry I will found a recursive formula !!!
		//var_dump(count($this->JoursList));
		//var_dump(count(array_chunk($this->JoursList, 6)));
		//var_dump($this->JoursList[4]);
		// and the end we fill the SemaineList or the list of weeks. Oh Yeah !!!
		//$this->SemaineList = array_chunk($this->JoursList, 6);
		//var_dump($this->SemaineList[3]);
		
	} // end of distributeBis
	
	public function distributeHours($array08,$array10,$array14,$array16){
		$JourFactory = new FlyweightJourFactory();
		$array08->exchangeArray(array_values($array08->getArrayCopy()));
		$array10->exchangeArray(array_values($array10->getArrayCopy()));
		$array14->exchangeArray(array_values($array14->getArrayCopy()));
		$array16->exchangeArray(array_values($array16->getArrayCopy()));
		$allarray = array($array08,$array10,$array14,$array16);
		$max = 0;
		for ($i = 1; $i < count($allarray); $i++) {
			if(count($allarray[$max]) < count($allarray[$i])){
				$max = $i;
			}
		}
		
		$arraymax = $allarray[$max];
		//var_dump($arraymax->count());
		
				
		
		if(count($arraymax) > 0){
				for ($i = 0; $i < count($arraymax); $i++) {
					for ($y = 1; $y <= 6; $y++) {
						$makefunction = "makeJour".$y;
						$jourLibelle = $JourFactory->$makefunction();
						//var_dump($jourLibelle);
						if(($jourLibelle == "Mercredi")||($jourLibelle == "Samedi")){
							$length08 = $array08->count();
							$key08 = rand(0, $length08);
							//$key08 = 0;
							$length10 = $array10->count();
							$key10 = rand(0, $length10);
							$aff08 = null;
							$aff10 = null;
							if($array08->offsetExists($key08) == true){
								$aff08 = $array08[$key08];
								$array08->offsetUnset($key08);
								$array08->exchangeArray($array08->getArrayCopy());
								
				
							}
								
							if($array10->offsetExists($key10) == true){
								$aff10 = $array10[$key10];
								$array10->offsetUnset($key10);
								
									
							}
								
							if(!is_null($aff08)|| !is_null($aff10)){
								array_push($this->JoursList, new Jour($jourLibelle, array($aff08,$aff10)));
							}
								
							//$array08->offsetUnset($key08);
						}else{
							$length08 = $array08->count();
							$key08 = rand(0, $length08);
							//$key08 = 0;
							$length10 = $array10->count();
							$key10 = rand(0, $length10);
							$length14 = $array14->count();
							$key14 = rand(0, $length14);
							$length16 = $array16->count();
							$key16 = rand(0, $length16);
							$aff08 = null;
							$aff10 = null;
							$aff14 = null;
							$aff16 = null;
							if($array08->offsetExists($key08) == true){
								$aff08 = $array08[$key08];
								$array08->offsetUnset($key08);
															
							}
				
							if($array10->offsetExists($key10) == true){
								$aff10 = $array10[$key10];
								$array10->offsetUnset($key10);
								
									
							}
								
							if($array14->offsetExists($key14) == true){
								$aff14 = $array14[$key14];
								$array14->offsetUnset($key14);
								
									
							}
								
							if($array16->offsetExists($key16) == true){
								$aff16 = $array16[$key16];
								$array16->offsetUnset($key16);
								
									
							}
							//					echo "</br>";
							//					var_dump($aff08);
							//					var_dump($aff10);
							//					var_dump($aff14);
							//					var_dump($aff16);
							if(!is_null($aff08)|| !is_null($aff10) || !is_null($aff14) || !is_null($aff16)){
								array_push($this->JoursList, new Jour($jourLibelle, array($aff08,$aff10,$aff14,$aff16)));
							}
							//
						}
					}
					//			echo "</br>";
				}//end of for
		
				//var_dump($arraymax->count());
		}
		
	}//end of redistribute
	
	
	
	
	
	
	
	
	
	
	public function distribute(){
		//$doneAffectationlength = count($this->AffectationDone);
		$JourFactory = new FlyweightJourFactory();
		$arrayTemp = $this->AffectationDone->getArrayCopy();
		shuffle($arrayTemp);
		$this->AffectationDone->exchangeArray(array_chunk($arrayTemp, 4));
		//$randkey = array_rand($this->AffectationDone->getArrayCopy());
		//var_dump($this->AffectationDone[$randkey]);
		//var_dump($this->AffectationDone->count());
		//$this->AffectationDone->;
		//$count = $this->AffectationDone->count();
		//$limit = $count;
		while($this->AffectationDone->count()>0){
			$makefunction = "makeJour".rand(1,6);
			$randkey = array_rand($this->AffectationDone->getArrayCopy());
			$jour = $JourFactory->$makefunction();
			
			$jourAffectation = $this->AffectationDone[$randkey];
					
			for ($i = 2; $i >= 0; $i--) {
				for ($j = 0; $j <= $i; $j++) {
					if(isset($jourAffectation[$j+1])){
						if($jourAffectation[$j+1]->Heure->getHoraireDebut() === $jourAffectation[$j]->Heure->getHoraireDebut()){
							$jourAffectation[$j+1]->Heure->setHoraireDebut(null);
							$jourAffectation[$j+1]->Heure->setHoraireFin(null);
						}	
					}
					
				}
			}
			
			if(($jour == "Samedi") || ($jour == "Mercredi")){
				
				if(isset($this->AffectationDone[$randkey][0]) && isset($this->AffectationDone[$randkey][1])){
					$jourAffectation = array($this->AffectationDone[$randkey][0],$this->AffectationDone[$randkey][1]);
					
					if(($this->AffectationDone[$randkey][1]->Heure->getHoraireDebut() == "14H30") || ($this->AffectationDone[$randkey][1]->Heure->getHoraireDebut() == "16H30")){
						$jourAffectation = array(); // donc pas de cours || So no course
					}
				}
				
				
				
				
			}
			$jtmp = new Jour($jour, $jourAffectation);
			if(count($jtmp->nextJour)>0){
				//echo "surplus", PHP_EOL;
				//$arrayTemp = array_merge($arrayTemp,$jtmp->nextJour);
				//$this->AffectationDone->exchangeArray(array_chunk($arrayTemp, 4));
			}
			array_push($this->JoursList, $jtmp);
			$this->AffectationDone->offsetUnset($randkey);
		}
			//var_dump($this->JoursList);
		//var_dump($this->JoursList[12]->Affectations); echo  PHP_EOL;
		
		//var_dump($this->JoursList[12]->LibelleJour);
		
	}
	
	

	public function prepareWeeks(){
		$arrayLundi = new ArrayObject(array());
		$arrayMardi = new ArrayObject(array());
		$arrayMercredi = new ArrayObject(array());
		$arrayJeudi = new ArrayObject(array());
		$arrayVendredi = new ArrayObject(array());
		$arraySamedi = new ArrayObject(array());
		
		for ($i = 0; $i < count($this->JoursList); $i++) {
						
			if($this->JoursList[$i]->LibelleJour == "Lundi"){
				$arrayLundi->append($this->JoursList[$i]);
			}
			
			if($this->JoursList[$i]->LibelleJour == "Mardi"){
				$arrayMardi->append($this->JoursList[$i]);
			}
			
			if($this->JoursList[$i]->LibelleJour == "Mercredi"){
				$arrayMercredi->append($this->JoursList[$i]);
			}
			
			if($this->JoursList[$i]->LibelleJour == "Jeudi"){
				$arrayJeudi->append($this->JoursList[$i]);
			}
			
			if($this->JoursList[$i]->LibelleJour == "Vendredi"){
				$arrayVendredi->append($this->JoursList[$i]);
			}
			
			if($this->JoursList[$i]->LibelleJour == "Samedi"){
				$arraySamedi->append($this->JoursList[$i]);
			}
		} // end of old for $i  
		
		$allarray = array($arrayLundi,$arrayMardi,$arrayMercredi,$arrayJeudi,$arrayVendredi,$arraySamedi);
		$max = 0;
		for ($i = 1; $i < count($allarray); $i++) {
			if(count($allarray[$max]) < count($allarray[$i])){
				$max = $i;
			}
		}
		
		$arraymax = $allarray[$max];
		//var_dump(count(array_chunk($this->JoursList, 6)));
		
		for ($i = 0; $i < count($arraymax); $i++) {
			$semaineTemp = array();
			if ($arrayLundi->offsetExists($i) && $arrayMardi->offsetExists($i) && $arrayMercredi->offsetExists($i) && $arrayJeudi->offsetExists($i) && $arrayVendredi->offsetExists($i) && $arraySamedi->offsetExists($i)){
				array_push($semaineTemp, $arrayLundi[$i]);
				array_push($semaineTemp, $arrayMardi[$i]);
				array_push($semaineTemp, $arrayMercredi[$i]);
				array_push($semaineTemp, $arrayJeudi[$i]);
				array_push($semaineTemp, $arrayVendredi[$i]);
				array_push($semaineTemp, $arraySamedi[$i]);
				
				$arrayLundi->offsetUnset($i);
				$arrayMardi->offsetUnset($i);
				$arrayMercredi->offsetUnset($i);
				$arrayJeudi->offsetUnset($i);
				$arrayVendredi->offsetUnset($i);
				$arraySamedi->offsetUnset($i);
				
				array_push($this->SemaineList, new Semaine($semaineTemp));
			}
			
			//array_push($this->SemaineList, new Semaine($semaineTemp));
		}
		
		
				
		
		$this->distributeDays($arrayLundi, $arrayMardi, $arrayMercredi, $arrayJeudi, $arrayVendredi, $arraySamedi);
		$this->distributeDays($arrayLundi, $arrayMardi, $arrayMercredi, $arrayJeudi, $arrayVendredi, $arraySamedi);
		$this->distributeDays($arrayLundi, $arrayMardi, $arrayMercredi, $arrayJeudi, $arrayVendredi, $arraySamedi);
		$this->distributeDays($arrayLundi, $arrayMardi, $arrayMercredi, $arrayJeudi, $arrayVendredi, $arraySamedi);
		$this->distributeDays($arrayLundi, $arrayMardi, $arrayMercredi, $arrayJeudi, $arrayVendredi, $arraySamedi);
		$this->distributeDays($arrayLundi, $arrayMardi, $arrayMercredi, $arrayJeudi, $arrayVendredi, $arraySamedi);
		
		// don't woory a will found a recursive formula for this !!!
		//var_dump($this->SemaineList[0]->Jours[0]->Affectations[0]->Matiere->libelle);
	} // end of generate function
	
	
public function distributeDays($arrayLundi,$arrayMardi,$arrayMercredi,$arrayJeudi,$arrayVendredi,$arraySamedi){
	$arrayLundi->exchangeArray(array_values($arrayLundi->getArrayCopy()));
	$arrayMardi->exchangeArray(array_values($arrayMardi->getArrayCopy()));
	$arrayMercredi->exchangeArray(array_values($arrayMercredi->getArrayCopy()));
	$arrayJeudi->exchangeArray(array_values($arrayJeudi->getArrayCopy()));
	$arrayVendredi->exchangeArray(array_values($arrayVendredi->getArrayCopy()));
	$arraySamedi->exchangeArray(array_values($arraySamedi->getArrayCopy()));
	
	$allarray = array($arrayLundi,$arrayMardi,$arrayMercredi,$arrayJeudi,$arrayVendredi,$arraySamedi);
	$max = 0;
	for ($i = 1; $i < count($allarray); $i++) {
		if(count($allarray[$max]) < count($allarray[$i])){
			$max = $i;
		}
	}
	
	$arraymax = $allarray[$max];
	
	for ($i = 0; $i < count($arraymax); $i++) {
		$semaineTemp = array();
		if ($arrayLundi->offsetExists($i) && $arrayMardi->offsetExists($i) && $arrayMercredi->offsetExists($i) && $arrayJeudi->offsetExists($i) && $arrayVendredi->offsetExists($i) && $arraySamedi->offsetExists($i)){
			array_push($semaineTemp, $arrayLundi[$i]);
			array_push($semaineTemp, $arrayMardi[$i]);
			array_push($semaineTemp, $arrayMercredi[$i]);
			array_push($semaineTemp, $arrayJeudi[$i]);
			array_push($semaineTemp, $arrayVendredi[$i]);
			array_push($semaineTemp, $arraySamedi[$i]);
	
			$arrayLundi->offsetUnset($i);
			$arrayMardi->offsetUnset($i);
			$arrayMercredi->offsetUnset($i);
			$arrayJeudi->offsetUnset($i);
			$arrayVendredi->offsetUnset($i);
			$arraySamedi->offsetUnset($i);
	
			array_push($this->SemaineList, new Semaine($semaineTemp));
		}
		
		//array_push($this->SemaineList, new Semaine($semaineTemp));
	}
}// end of redistributeBis function
	

// Here we are... the Generating function ... creepy !! don't you ?
// I'm shocked ... i can tell you what i'm feeling .... very creepy
// Really exciting ... i swear

public function generate($Semestre,$Classe,$Year){
	$this->prepareDays();
	$this->prepareWeeks();
	for ($i = 0; $i < count($this->SemaineList); $i++) {
		$objPHPExcel = new PHPExcel();
		// Setting the police
		$objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');
		// And the 	font size
		$objPHPExcel->getDefaultStyle()->getFont()->setSize(8);
		//create the write for creating the final xlxs file
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
		
		$objSheet = $objPHPExcel->getActiveSheet();
		// Set the title of the Sheet or "feuillet" in french
		$objSheet->setTitle('Emploi du Temps'); 
		
		// Setting the header of the calendar : Semestre classe year
		$objSheet->getStyle('B5:N7')->getFont()->setBold(true)->setSize(12);
		// Setting The header
		$objSheet->getCell('B5')->setValue('Semestre : '.$Semestre);
		$objSheet->getCell('E5')->setValue('Classe : '.$Classe);
		$objSheet->getCell('H5')->setValue($Year);
/**
		$objSheet->getCell('B7')->setValue("Horaire");
		$objSheet->getCell('D7')->setValue("Lundi");
		$objSheet->getCell('F7')->setValue("Mardi");
		$objSheet->getCell('H7')->setValue("Mercredi");
		$objSheet->getCell('J7')->setValue("Jeudi");
		$objSheet->getCell('L7')->setValue("Vendredi");
		$objSheet->getCell('N7')->setValue("Samedi");
**/		
		
		$objSheet->getCell('B7')->setValue("Horaire");
		$objSheet->getCell('C7')->setValue("Lundi");
		$objSheet->getCell('D7')->setValue("Mardi");
		$objSheet->getCell('E7')->setValue("Mercredi");
		$objSheet->getCell('F7')->setValue("Jeudi");
		$objSheet->getCell('G7')->setValue("Vendredi");
		$objSheet->getCell('H7')->setValue("Samedi");
		
		$objSheet->getCell('B9')->setValue("08H00-10H00");
		$objSheet->getCell('B12')->setValue("10H00-12H00");
		$objSheet->getCell('B15')->setValue("14H30-16H30");
		$objSheet->getCell('B18')->setValue("16H30-18H30");
		
		$objSheet->getColumnDimension("B")->setAutoSize(true);
		//$columnArray = range("D", "N",2);
		$columnArray = range("C", "H",1);
		$rowAray = range(9,18,3);
		
			for ($y = 0; $y < 4; $y++) {
				
					for ($z = 0; $z < 6; $z++) {
						//$objSheet->getCellByColumnAndRow($columnArray[$y],$rowAray[$z])->setValue("val ".$rowAray[$z]);
						//echo "coord : ".$columnArray[$z]."".$rowAray[$y],PHP_EOL;
						$temp = $columnArray[$z]."".$rowAray[$y];
						//echo $temp,PHP_EOL;
						
						//$val = $this->SemaineList[$i]->Jours[$z]->Affectations[]->Matiere->libelle;
						//$val = "val ".$z;
						if($this->SemaineList[$i]->Jours[$z]->Affectations->offsetExists($y)){
							$val = $this->SemaineList[$i]->Jours[$z]->Affectations[$y]->Matiere->libelle."\n ".$this->SemaineList[$i]->Jours[$z]->Affectations[$y]->Matiere->Enseignants[0]->__toString();
							//$val = $this->SemaineList[$i]->Jours[$z]->Affectations[$y]->Matiere->libelle."\n "."Mr Tel";
						}else{
							$val = "Vacant"; // Then no Courses;
						}
						
						
						
						$objSheet->getCell($temp)->setValue($val);
						$style = array(
								'alignment' => array(
										'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
										'vertical' => PHPExcel_Style_Alignment::VERTICAL_DISTRIBUTED,
								)
						);
						$objSheet->getCell($temp)->getStyle()->applyFromArray($style);
						
						$col = $columnArray[$z];
						$objSheet->getColumnDimension($col)->setAutoSize(true);
					}
					//$col = $columnArray[$z];
					$row = $rowAray[$y];
					//$objSheet->getColumnDimension($col)->setAutoSize(true);
					//$objSheet->getRowDimension($row)->setRowHeight(30);
					
						
				//$this->SemaineList[$i]->Jours[$y]->Affectations[0]->Matiere->libelle; // affectations indice=0 for 08H00-10H00
				//$this->SemaineList[$i]->Jours[$y]->Affectations[0]->Matiere->libelle; // affectations indice=0 for 08H00-10H00
				//echo "<br/>";
			}

			
		$objSheet->getStyle('B5:H20')->getFont()->setBold(true)->setSize(12);
		$objSheet->getStyle('B5:H20')->getBorders()->getInside()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		//$objSheet->getStyle('B5:O20')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objSheet->getStyle('B5:H20')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
		$objSheet->getStyle('B5:H20')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
		$objSheet->getStyle('C5:H20')->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
		$objSheet->getStyle('B7:H7')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
		
		if(!file_exists("../results/".$Classe."/")){
			mkdir("../results/".$Classe,0755,true);
		}else{
			//rmdir("../results/".$Classe."/");
		}
		$fileName = "../results/".$Classe."/".$Classe."_".$Semestre."_".$i.".xlsx";
		//$fileName = $Classe."_".$Semestre."_".$i.".xlsx";
		try {
			$objWriter->save($fileName);
		}catch(Exception $e){
			echo "probleme de fichier";
		}
		
	}// end of for $i
	
	
}


}// end of classe

/**
$m1 = new Matiere();
$m1->libelle = "Matiere Why So Seriousssss!!!!";
$m1->CM = 12;
$m1->TP = 20;
$m1->TD = 50;


$m2 = new Matiere();
$m2->libelle = "Matiere \n PRuuuuuuuuuuuuuuuuuuuut";
$m2->CM = 24;
$m2->TP = 20;
$m2->TD = 0;

$m3 = new Matiere();
$m3->libelle = "Matiere \n Shaaaringaaaaaaann !!!!";
$m3->CM = 60;
$m3->TP = 10;
$m3->TD = 30;


$m4 = new Matiere();
$m4->libelle = "Matiere \n MuuultiClooooooonaaagggee \n Suuuupraaaa";
$m4->CM = 18;
$m4->TP = 15;
$m4->TD = 36;

$m5 = new Matiere();
$m5->libelle = "Matiere YAAAAAMEEEEYYAAAAMEEEEEEE \n YAAAAAAAAAA!!!!!!";
$m5->CM = 18;
$m5->TP = 58;
$m5->TD = 38;

$m6 = new Matiere();
$m6->libelle = "Matiere Houba Houba \n Bobo Bibi BUbu";
$m6->CM = 12;
$m6->TP = 06;
$m6->TD = 12;

$m7 = new Matiere();
$m7->libelle = "Matiere Youssou Ndour \n Omar Pene Dièli, \n Gouney Dakar";
$m7->CM = 20;
$m7->TP = 10;
$m7->TD = 12;

$m8 = new Matiere();
$m8->libelle = "Matiere Bruce Lee \n Chuck Norris \n Jet Lee";
$m8->CM = 20;
$m8->TP = 10;
$m8->TD = 12;

$m9 = new Matiere();
$m9->libelle = "Matiere Maître Yoda le Maître JEDI";
$m9->CM = 15;
$m9->TP = 15;
$m9->TD = 0;

$m10 = new Matiere();
$m10->libelle = "Matiere EisenBerg Walter White";
$m10->CM = 30;
$m10->TP = 10;
$m10->TD = 10;


// The fours Affectation are taken randomly

$gen  = new GenerationController(array($m1,$m4,$m10,$m3,$m2,$m9,$m5,$m7,$m6,$m10,$m3,$m2,$m1,$m4,$m10,$m3,$m7,$m6,$m10,$m3,$m2,$m5,$m7,$m6,$m10));

$gen->execute();

//var_dump($gen->AffectationDone);
$gen->generate("S1","Licence GL","2015");
//$gen->prepareDays();
//$gen->prepareWeeks();
//$jour = new Jour("Mardi",$gen->AffectationDone);

//var_dump($jour->Affectations);


// Note : A la fin du traitement  il arrivera que des affectations aient les mêmes de Heures on le gérera la classe Semaine
// T'inquiete !! Smile :) 
**/