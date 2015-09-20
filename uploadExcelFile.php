<?php
?>
<!DOCTYPE html>
<html lang="fr">


<meta http-equiv="content-type" content="text/html" />
<head>
<meta charset="">

<title>EspSchoolCalendar</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
<!--    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet"> -->
    
    
        <style type="text/css">
    
    body {
    margin-top:40px;
	}

	
	h3 {
    color: #1d7886;
    text-transform: uppercase;
	}
</style>
    
</head>


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
			<h3>Choisissez le Fichier à traiter</h3>
				<div class="form-group">
					<input id="myFile" class="form-control" placeholder="Choisissez un fichier" type="file" onchange="show(this.value)" accept=".xlsx,.xls">
					<br>
					
					<button class="btn btn-success nextBtn btn-lg pull-right" type="button">GENERER</button>
				
				</div>
		</div>
		
		
		
	
    
	</div>
			
		
		
</div>

<br>

<div class="row">

	<div class="col-xs-6 col-md-offset-3">
			<div class="col-md-12">
			
				 <div class="result"></div>
				 
			</div>
		</div>

</div>	
	
	
	
</div>




<script src="bootstrap/js/jquery-1.11.1.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>

<script type="text/javascript">


 	function show(lib){
 	 	//alert("the message is "+lib);
 	 	//this.files[0].fileName;
 	 	alert(document.getElementById("myFile").files[0].name);
 	 			var filepath = document.getElementById("myFile").files[0].name;
 	 			var input  = document.getElementById("myFile");
 	 	 	 	var fileReader =  new FileReader();
 	 	 	 	fileReader.readAsDataURL(input.files[0]);
 	 	 	 	fileReader.onloadend = function(e){

 	 	 	 	$.post("readTest.php",{myFile:filepath},function(data,status){
 	 	 	 	 	//alert(data);
 	 	 	 	 	if(status =="success"){
 	// 	 	 	 		alert(data);
 	 	 	 	 		$(".result").html(data);
 	 	 	 	 	}
 	 	 	 	 	
 	 	 	 	});
	 	 	 	 	 	 	
 	 	 	 	 	
 	 	 	 	}
 	 	 	 	 	
 	 	
 	}


</script>
</body>

</html>