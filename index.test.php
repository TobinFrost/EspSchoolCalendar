<?php ?>
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
.stepwizard-step p {
    margin-top: 10px;
}

	h3 {
    color: #1d7886;
    text-transform: uppercase;
	}

.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 50%;
    position: relative;
}
.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}
    
    
    
    </style>
    
</head>

<body>

<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
             <h3 class="panel-title">Calendriers</h3>

        </div>
    </div>
    <div class="stepwizard col-md-offset-3">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step"> <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>

<!--                 <p>Semaine 1</p> -->
            </div>
            <div class="stepwizard-step"> <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>

<!--                 <p>Semaine 2</p> -->
            </div>
            <div class="stepwizard-step"> <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>

<!--                 <p>Semaine 3</p> -->
            </div>
            <div class="stepwizard-step"> <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>

<!--                 <p>Semaine 4</p> -->
            </div>
            <div class="stepwizard-step"> <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>

<!--                 <p>Semaine 5</p> -->
            </div>
            <div class="stepwizard-step"> <a href="#step-6" type="button" class="btn btn-default btn-circle" disabled="disabled">6</a>

<!--                 <p>Semaine 6</p> -->
            </div>
            
            <div class="stepwizard-step"> <a href="#step-7" type="button" class="btn btn-default btn-circle" disabled="disabled">7</a>

<!--                 <p>Semaine 7</p> -->
            </div>
            
            <div class="stepwizard-step"> <a href="#step-8" type="button" class="btn btn-default btn-circle" disabled="disabled">8</a>

<!--                 <p>Semaine 8</p> -->
            </div>
            
            <div class="stepwizard-step"> <a href="#step-9" type="button" class="btn btn-default btn-circle" disabled="disabled">9</a>

<!--                 <p>Semaine 9</p> -->
            </div>
            
            <div class="stepwizard-step"> <a href="#step-10" type="button" class="btn btn-default btn-circle" disabled="disabled">10</a>

<!--                 <p>Semaine 10</p> -->
            </div>
            
            <div class="stepwizard-step"> <a href="#step-10" type="button" class="btn btn-default btn-circle" disabled="disabled">11</a>

<!--                 <p>Semaine 11</p> -->
            </div>
            
            <div class="stepwizard-step"> <a href="#step-10" type="button" class="btn btn-default btn-circle" disabled="disabled">12</a>

<!--                 <p>Semaine 12</p> -->
            </div>
            
            <div class="stepwizard-step"> <a href="#step-10" type="button" class="btn btn-default btn-circle" disabled="disabled">13</a>

<!--                 <p>Semaine 13</p> -->
            </div>
            
            <div class="stepwizard-step"> <a href="#step-10" type="button" class="btn btn-default btn-circle" disabled="disabled">14</a>

<!--                 <p>Semaine 14</p> -->
            </div>
            
            <div class="stepwizard-step"> <a href="#step-10" type="button" class="btn btn-default btn-circle" disabled="disabled">15</a>

<!--                 <p>Semaine 15</p> -->
            </div>
            
            
        </div>
    </div>
    <div class="row setup-content" id="step-1">
        <div class="col-xs-6 col-md-offset-3">
            <div class="col-md-12">
                 <h3> Step 1</h3>

                
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button"><i class="glyphicon glyphicon-chevron-right"></i></button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-2">
        <div class="col-xs-6 col-md-offset-3">
            <div class="col-md-12">
                 <h3> Step 2</h3>

                
                <button class="btn btn-primary prevBtn btn-lg pull-left" type="button"><i class="glyphicon glyphicon-chevron-left"></i></button>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button"><i class="glyphicon glyphicon-chevron-right"></i></button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-3">
        <div class="col-xs-6 col-md-offset-3">
            <div class="col-md-12">
                 <h3> Step 3</h3>

                <button class="btn btn-primary prevBtn btn-lg pull-left" type="button"><i class="glyphicon glyphicon-chevron-left"></i></button>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button"><i class="glyphicon glyphicon-chevron-right"></i></button>
                <!-- <button class="btn btn-success btn-lg pull-right" type="submit">Submit</button>   -->
            </div>
        </div>
    </div>
    
    <div class="row setup-content" id="step-4">
        <div class="col-xs-6 col-md-offset-3">
            <div class="col-md-12">
                 <h3> Step 4</h3>

                <button class="btn btn-primary prevBtn btn-lg pull-left" type="button"><i class="glyphicon glyphicon-chevron-left"></i></button>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button"><i class="glyphicon glyphicon-chevron-right"></i></button>
                <!-- <button class="btn btn-success btn-lg pull-right" type="submit">Submit</button>   -->
            </div>
        </div>
    </div>
    
    <div class="row setup-content" id="step-5">
        <div class="col-xs-6 col-md-offset-3">
            <div class="col-md-12">
                 <h3> Step 5</h3>

                <button class="btn btn-primary prevBtn btn-lg pull-left" type="button"><i class="glyphicon glyphicon-chevron-left"></i></button>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button"><i class="glyphicon glyphicon-chevron-right"></i></button>
                <!-- <button class="btn btn-success btn-lg pull-right" type="submit">Submit</button>   -->
            </div>
        </div>
    </div>
    
    
    <div class="row setup-content" id="step-6">
        <div class="col-xs-6 col-md-offset-3">
            <div class="col-md-12">
                 <h3> Step 6</h3>

                <button class="btn btn-primary prevBtn btn-lg pull-left" type="button"><i class="glyphicon glyphicon-chevron-left"></i></button>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button"><i class="glyphicon glyphicon-chevron-right"></i></button>
                <!-- <button class="btn btn-success btn-lg pull-right" type="submit">Submit</button>   -->
            </div>
        </div>
    </div>
    
    
</div>


<script src="bootstrap/js/jquery-1.11.1.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>

    <script type="text/javascript">

    $(document).ready(function () {
    	  var navListItems = $('div.setup-panel div a'),
    	          allWells = $('.setup-content'),
    	          allNextBtn = $('.nextBtn'),
    	  		  allPrevBtn = $('.prevBtn');

    	  allWells.hide();

    	  navListItems.click(function (e) {
    	      e.preventDefault();
    	      var $target = $($(this).attr('href')),
    	              $item = $(this);

    	      if (!$item.hasClass('disabled')) {
    	          navListItems.removeClass('btn-primary').addClass('btn-default');
    	          $item.addClass('btn-primary');
    	          allWells.hide();
    	          $target.show();
    	          $target.find('input:eq(0)').focus();
    	      }
    	  });
    	  
    	  allPrevBtn.click(function(){
    	      var curStep = $(this).closest(".setup-content"),
    	          curStepBtn = curStep.attr("id"),
    	          prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

    	          prevStepWizard.removeAttr('disabled').trigger('click');
    	  });

    	  allNextBtn.click(function(){
    	      var curStep = $(this).closest(".setup-content"),
    	          curStepBtn = curStep.attr("id"),
    	          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
    	          curInputs = curStep.find("input[type='text'],input[type='url']"),
    	          isValid = true;

    	      //Very Interresting Tobin
    	      // Take a look of this
    	      
    	      $(".form-group").removeClass("has-error");
    	      for(var i=0; i<curInputs.length; i++){
    	          if (!curInputs[i].validity.valid){
    	              isValid = false;
    	              $(curInputs[i]).closest(".form-group").addClass("has-error");
    	          }
    	      }

    	      if (isValid)
    	          nextStepWizard.removeAttr('disabled').trigger('click');
    	  });

    	  $('div.setup-panel div a.btn-primary').trigger('click');
    	});


    </script>



</body>

</html>