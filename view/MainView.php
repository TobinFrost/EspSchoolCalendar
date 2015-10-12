<!DOCTYPE html>
<html  lang="fr">


<meta http-equiv="content-type" content="text/html" />
<head>
<meta charset="">

<title>EspSchoolCalendar</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <!-- Le styles -->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
<!--    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet"> -->
    
    
        <style type="text/css">
    
    .js div#preloader { position: fixed; left: 0; top: 0; z-index: 999; width: 100%; height: 100%; overflow: visible; background: url('../images/bigpreloader.GIF') no-repeat center center; }

    body {
    margin-top:40px;
	}
	
	div#smallpreloader{position: fixed; left: 0; top: 0; z-index: 999; width: 100%; height: 100%; overflow: visible; background: url('../images/smallpreloader.GIF') no-repeat center center;}
	
	#classes{
   	
	}

	#Affectation{
	overflow-y: scroll;
	height: 600px;
	}
	
	#AffectationTable{
	overflow-y: scroll;
	
	}
	
	h3 {
    color: #1d7886;
    text-transform: uppercase;
	}
		</style>
    
</head>

  <body class="js">
    <div id="preloader">
    <center>Chargement en Cours</center>
    </div>
    
    <script src="../bootstrap/js/jquery-1.11.1.js"></script>
	<script src="../bootstrap/js/bootstrap.js"></script>
	
	<script type="text/javascript">
	$(document).ready(function(){
		var html = $(".js");
		$.post("../controller/ApplicationController.class.php",{ClassList:"voila"},function(data,status){
            //alert("Data: " + data + "\nStatus: " + status);
            if(status =="success"){
            	//load.html('');
            	//alert("youpie");
            	html.html(data);
            }else{
            	alert("Booo !");
            }
        });
		        
	});
	</script>
</body>

</html>
