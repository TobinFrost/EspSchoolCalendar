<?php
?>
<body>

<div class="container">

<div class="panel panel-primary">
        <div class="panel-heading">
             <h3 class="panel-title">Uploader le Fichier</h3>

        </div>
    </div>

<div class="row">
	<div class="col-xs-6 col-md-offset-3">
		<div class="col-md-12">
			<h3>Choisissez le Fichier &Agrave; traiter</h3>
				<div class="form-group">
					<input id="myFile" class="form-control" placeholder="Choisissez un fichier" type="file" onchange="" accept=".xlsx,.xls">
					<br>
					
					<!-- <button class="btn btn-success nextBtn btn-lg pull-right" type="button">GENERER</button>  -->
				
				</div>
		</div>
		
		
		
	
    
	</div>
			
		
		
</div>

<br>

<div class="row">

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
									
	      						<li><button class="btn btn-default btn-block classOption" value="'.$urlLien.'_S1">Semestre 1</button></li>
	      						<li role="separator" class="divider"></li>
	      						<li><button class="btn btn-default btn-block classOption" value="'.$urlLien.'_S2">Semestre 2</button></li>
								
	    					</ul>
	  					</li>';
}

?>
					</ul>
</div>
		<div id="Affectation" class="col-md-8">
		
			<table class="table">
			<caption>Affectations</caption>
			<tr><th>Nom Professeur</th><th>Mati&egrave;re</th> <th> CM </th> <th> TD </th> <th> TP </th> </tr>
			</table>
		<button class="btn btn-success nextBtn btn-lg pull-right" type="button">GENERER</button>
		</div>	

			
			
				 		

</div>	
	
	
	
</div>






<script type="text/javascript">


$(document).ready(function(){
	var formation = $(".classOption");
		formation.click(function(){
			alert($(this).attr("value"));
		});
});


</script>

</body>
