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
    function addTask()
    {
			
	  var button = document.getElementById('save-event').value;	
	  var idTask = document.getElementById('idTask').value;	
      var assgndBy = document.getElementById('assgndBy').value;
	  var task = document.getElementById('task').value;
	  var details = document.getElementById('details').value;
	  var dateStart = document.getElementById('dateStart').value;
	  var dateEnd = document.getElementById('dateEnd').value;
	  var priority = document.getElementById('priority').value;
	  var employee = $('select').val();

      var empString = JSON.stringify(employee);  
	  
	  console.log('idTask = ' + idTask);
	   
      var dataString='button='+ button + '&idTask='+ idTask + '&assgndBy='+ assgndBy + '&task='+ task + '&details='+ details + '&dateStart='+ dateStart + '&dateEnd='+ dateEnd + '&priority='+ priority + '&employee='+ empString;
	  
      $.ajax({
        type: "POST",
        url: "dbmanager/task-post-data.php",
        data: dataString,
        cache: false,
        success: function(html){
           //$('#msg').html(html);
		   //alert('Done=' + employee);
		    console.log('employee post success ' + empString);
        }
      });
	  
      return false;
	  
    }
  </script>
   <script>
    function updateTask()
    {
			
	  var button = document.getElementById('update-event').value;	
	  var idTask = document.getElementById('idTask').value;	
      var assgndBy = document.getElementById('assgndBy').value;
	  var task = document.getElementById('task').value;
	  var details = document.getElementById('details').value;
	  var priority = document.getElementById('priority').value;

	   
      var dataString='button='+ button + '&idTask='+ idTask + '&assgndBy='+ assgndBy + '&task='+ task + '&details='+ details + '&priority='+ priority;
	  
      $.ajax({
        type: "POST",
        url: "dbmanager/task-post-data.php",
        data: dataString,
        cache: false,
        success: function(html){
           //$('#msg').html(html);
		   //alert('Done=' + employee);
		    console.log('employee post success ' + empString);
        }
      });
	  
      return false;
	  
    }
  </script>
  <script>
    function doneTask()
    {
			
	  var button = document.getElementById('done-event').value;	
	  var idTask = document.getElementById('idTask').value;	
	   
      var dataString='button='+ button + '&idTask='+ idTask;
	  
      $.ajax({
        type: "POST",
        url: "dbmanager/task-post-data.php",
        data: dataString,
        cache: false,
        success: function(html){
           //$('#msg').html(html);
		   //alert('Done=' + employee);
		    console.log('task post success ');
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

	require_once 'dbmanager/dbcon_pdo.php';
	   
	//get name
	$stmt = $dbcon_pdo->prepare("SELECT CONCAT(fname, ' ', lName) As Name FROM employee WHERE idEmp=?");
	$stmt->execute([$idEmp]);
	$name = $stmt->fetchColumn();
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<?php include('navbar-header.php'); ?>
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
							<!-- <form class="form-group" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" > -->
							<form class="form-group">
								<input name="assgndBy" id="assgndBy" type="hidden" value="<?php echo $idEmp; ?>">
								<input name="event-index" id="idTask" type="hidden" class="form-control">
								<input name="idAssigned" id="idAssigned" type="hidden">
								<input name="event-name" id="task" type="text" placeholder="Enter Task Name" class="form-control" required data-validation-required-message="Please enter a Task Name.">
								<br>
								<textarea name="event-location" id="details" type="text" placeholder="Enter Details" class="form-control" required data-validation-required-message="Please enter the Details"></textarea>
								<br>
								<div class="input-group input-daterange" data-provide="datepicker">
									<input name="event-start-date" id="dateStart" type="text" class="form-control" data-date-format="yyyy-mm-dd" >
									<span class="input-group-addon">to</span>
									<input name="event-end-date" id="dateEnd" type="text" class="form-control" data-date-format="yyyy-mm-dd" >
								</div>
								<!--employee select-->
								<h6 style="text-align:left">Assign Task to:</h6>
								<div class="row">
									<div class="col-lg-12">
										<select name="event-employees[]" id="employee" style="width:100%" multiple="on">
										  <option value="1" class="assigned">John Mark Martinez</option>
										  <option value="2" class="assigned">Vany Deloso</option>
										  <option value="3" class="assigned">John Frades</option>
										  <option value="4" class="assigned">Kaye Pada</option>
										  <?php  //echo $taskApp->getEmployee();  ?>
										</select>
									</div>
								</div>
								<!--end employee select-->
								<div class="row">
									<div class="col-lg-5">
										<h6 style="text-align:left">Priority:</h6>
										<select name="event-priority" id="priority" style="width:100%">
											<option value="low">Low</option>
											<option value="mid">Mid</option>
											<option value="high">High</option>
										</select>
									</div>
									<div class="col-lg-2">
									</div>
									<div class="col-lg-5">
									</div>
								</div>	
								<div class="modal-footer">
									<button type="submit" name ="button" value="done" class="btn btn-success" id="done-event" data-dismiss="modal" onclick="return doneTask()">Done</button>
									<button type="submit" name ="button" value="update" class="btn btn-success" id="update-event" data-dismiss="modal" data-target="#data" onclick="return updateTask()">Update</button>
									<button type="submit" name ="button" value="add" class="btn btn-success" id="save-event" data-dismiss="modal" data-target="#data" onclick="return addTask()">Save</button>  
									<button type="button" name ="button" value="done" class="btn btn-default" data-dismiss="modal">Close</button>	
									
									
								</div>
							</form><!--end form--> 
							<p id="msg"></p>
							<!-- <p id="msg"></p> -->
						</div><!--end modal-body-->
					 </div><!--end modal-content-->
                 <!--end modal content-->
                </div><!--end modal-dialog-->
            </div><!--end modal fade-->
    </div><!--end continer main-panel--> 
</div>
<!-- main end -->
</div>
</body>
</html>