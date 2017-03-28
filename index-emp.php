<!DOCTYPE html>
<html lang="en">
<head>
 <title>Nexus v1.0</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- /*
	Added by: Annie 'Vany' Deloso
	Reference:
	1. AJAX Submit form without refreshing it
	   https://www.youtube.com/watch?v=AofECml9pQU	

	*/ -->
   <script src="https://code.jquery.com/jquery-3.2.0.min.js" integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=" crossorigin="anonymous"></script>
   <script>
    function mngProgress()
    {
			
	  var button = document.getElementById('done-event').value;	
	  var idTask = document.getElementById('idTask').value;	
	  var idAssigned = document.getElementById('idAssigned').value;
	  var progress = document.getElementById('progress').value;
	 
	   
      var dataString='button='+ button + '&idTask='+ idTask + '&idAssigned='+ idAssigned + '&progress='+ progress;
	  
      $.ajax({
        type: "POST",
        url: "dbmanager/progress-post-data.php",
        data: dataString,
        cache: false,
        success: function(html){
           //$('#msg').html(html);
		   //alert('Done=' + employee);
		    console.log('employee progress submitted');
        }
      });
	  
      return false;
	  
    }
  </script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="css/bootstrap-year-calendar.css" rel="stylesheet">
  
  <!-- my styles -->
  <link href="css/styles.css" rel="stylesheet">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="js/bootstrap-year-calendar.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/bootstrap-popover.js"></script>
  
  
</head>
<body class="dashbody">
<?php
/*
	Added by: Annie 'Vany' Deloso

	*/
	session_start();
	echo $idEmp = $_SESSION['idEmp'];
	echo $priv = $_SESSION['priv'];

	require_once 'dbmanager/dbcon_pdo.php';
	   
	//get name
	$stmt = $dbcon_pdo->prepare("SELECT CONCAT(fname, ' ', lName) As Name FROM employee WHERE idEmp=?");
	$stmt->execute([$idEmp]);
	$name = $stmt->fetchColumn();

?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<?php include('navbar-header.php');?>         
</nav>
<div class="spacer"></div>
<div class="spacer"></div>
<div class="container"> 
<!-- main content -->
    <div class="continer main-panel">
        <div data-provide="calendar" id="calendar"></div>
            <div class="modal fade" id="event-modal" role="dialog">
                <div class="modal-dialog">
					<!--start modal content-->
					<div class="modal-content">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal">&times;</button>
						  <h4 class="modal-title" id="mod-title"></h4>
						</div>
						<div class="modal-body">
						  <!--<form class="form-group" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">-->
						  <form class="form-group">
                          <div id="myMainModal">
                          	<input name="idEmp" id="idEmp" type="hidden" value="<?php echo $idEmp;?>">
							<input name="priv" id="priv" type="hidden" value="<?php echo $priv;?>">
							<input name="idAssigned" id="idAssigned" type="hidden">
							<input name="event-index" id="idTask" type="text" style="display:none" class="form-control">
							<input name="event-name" type="text" class="form-control" readonly>
							<br>
							<textarea name="event-location" type="text" class="form-control" readonly></textarea>
							<br>
							<textarea name="event-progress-remarks" id="progress" type="text" placeholder="Enter progress remarks" class="form-control" required data-validation-required-message="Please enter progress remarks"></textarea>
							<br>
							
							<div class="modal-footer">
								<button type="submit" name="button" value="send" class="btn btn-success" id="done-event" data-dismiss="modal" onclick="return mngProgress()">Send</button>
								<button type="button" name="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>	
                          </div>
                          <div id="myReportModal">
                            	<button class="accordion">Section 1</button>
                                
							
						  </form><!--end form-->
						</div><!--end modal-body-->
					</div><!--end modal-content-->
                  <!-- modal end-->
                </div><!--end modal-dialog-->
            </div><!--end modal fade-->
    </div><!--end continer main-panel--> 	
</div>
<!-- main end -->
</div>
</body>
</html>