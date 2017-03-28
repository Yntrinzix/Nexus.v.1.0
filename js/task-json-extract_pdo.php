<?php
	/*
	Reference:
	1. PHP File Create/Write
	   https://www.w3schools.com/php/php_file_create.asp
	*/
	
	$fp = fopen('../js/task-view-mng.json', 'w');

	include('dbcon_pdo.php');

	$stmt = $dbcon_pdo-> prepare("SELECT t.idTask, t.task, DATE_FORMAT(t.dateStart,'%Y') As startYear,
								 DATE_FORMAT(t.dateStart,'%c') As startMonth,
								 DATE_FORMAT(t.dateStart,'%e') As startDay, 
								 DATE_FORMAT(t.dateDue,'%Y') As endYear,
								 DATE_FORMAT(t.dateDue,'	%c') As endMonth,
								 DATE_FORMAT(t.dateDue,'%e') As endDay,
								 a.assgndTo 
								 FROM task t 
								 LEFT JOIN assigned a  ON a.idTask=t.idTask");
	$stmt->execute();
	$count = $stmt->rowCount();
		
	fwrite($fp,  "[ ");
	foreach($stmt as $row)		
	{
		

		fwrite($fp, '{"id":"'.$row["idTask"].'", "idEmp":"'.$row["assgndTo"].'", "name":"'.$row['task'].'", "location":"'.$row['task'].'",  "startYear":'.$row["startYear"].', "startMonth":'.$row["startMonth"].', "startDay":'.$row["startDay"].', "endYear":'.$row["endYear"].', "endMonth":'.$row["endMonth"].', "endDay":'.$row["endDay"].'}');  

		if(($count-1) >= 1)
		{
			fwrite($fp, ",");
			//echo " <br>";
		}

		$count--;
	}
		fwrite($fp, "]");
			  	
		fclose($fp);

		
?>