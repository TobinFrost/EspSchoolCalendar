<?php 

/*
 LA CLASS CONTROLLER

classe abstraite comportant les attributs suivants :

 * action (string) : action à exécuter
 * destination (string) : page de destination après exécution du traitement
 * repertoire(string) : chemin menant vers la page de destination
 * repost_data(array) : regroupe les données à renvoyer (encore)

 PS: seul les fonctions protected peuvent être réeutilisation par la classe fille
 	donc la classe fille devra definir l' algorigthme d' execution :execute() et la politique de reposter les données : repost()

*/



abstract class Controller {
		// action à exécuter
		protected $action="";
		// page de destination php
		protected $destination="index.php";
		// repertoire de la page de destination
		protected $repertoire="vue";
		// donnée à reposter (si necessaire)
		protected $repost_data=array();
		
		protected $projectname="EspSchoolCalendar";
		// constructeur
		public function __construct(){

		}

		// process : déroule l'algorigthme avec la redirection
		public function process() {

		$this->action=$_GET['control']; 
		$this->execute();
		$url='http://'.$_SERVER['HTTP_HOST']."/EspSchoolCalendar/".$this->repertoire.'/'.$this->destination;
		if (count($this->repost_data)==0) header('Location: '.$url);
		else $this->repost($url);

		

		}
		
		// algorithme d'exécution

		protected function execute(){

		}
		// reposter les données à $this->destination
		protected function repost($url){
			$finalUrl = $url."?";
			
//			print_r($this->repost_data);
			
//			for ($i = 0; $i < count($this->repost_data); $i++) {
				

			if(isset($this->repost_data["id"])){
				$finalUrl.= "id=".$this->repost_data["id"];
			}
			
			if(isset($this->repost_data["level"])){
				$finalUrl.= "&level=".$this->repost_data["level"];
			}
				
		
			header('Location: '.$finalUrl);
				
//			}
		}


}



/*

*****************************************
*										*
* 	EXEMPLE D'UTILISATION DE LA CLASSE 	*
*										*
*****************************************

<li><a href=’controleur/uneclasse_controller.php?action=create’>ajouter</a></li>
<form name=’user_login’ action=’controleur/uneclasse_controller.php?action=login’>

*/



 ?>