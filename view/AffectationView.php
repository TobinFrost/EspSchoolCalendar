<?php
include_once '../controller/DataFilterController.class.php';
$filter = new DataFilterController();
$filter->execute();
?>
<div id="classes" class="col-md-2">
				 
					 <ul class="nav nav-pills nav-stacked">
				
					 
<?php
array_shift($filter->filteredClassList);
foreach ($filter->filteredClassList as $value) {
	$urlLien =str_ireplace(' ', '.', $value);
	echo '<li role="presentation" class="active dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">'.$value.' <span class="caret"></span></a>
	  						<ul class="dropdown-menu">
									
	      						<li><button class="btn btn-default btn-block" value="'.$urlLien.'_S1">Semestre 1</button></li>
	      						<li role="separator" class="divider"></li>
	      						<li><button class="btn btn-default btn-block" value="'.$urlLien.'_S2">Semestre 2</button></li>
								
	    					</ul>
	  					</li>';
}

?>
					</ul>
</div>
		<div id="Affectation" class="col-md-8">
		
			<table class="table">
			<caption>Affectations</caption>
			<tr><th>Nom Professeur</th><th>Matiére</th> <th> CM </th> <th> TD </th> <th> TP </th> </tr>
			</table>
		<button class="btn btn-success nextBtn btn-lg pull-right" type="button">GENERER</button>
		</div>	
