<?php
	
	include('dbcon_pdo.php');

	$stmt = $dbcon_pdo-> prepare("SELECT t.idTask, t.task, t.details, DATE_FORMAT(t.dateStart,'%Y') As startYear,
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
		
	echo '[';
	foreach($stmt as $row)		
	{
		$posts['id'][] = $row["idTask"];
		$posts['idEmp'][] = $row["assgndTo"];
		$posts['name'][] = $row["task"];
		$posts['location'][] = $row["details"];
		$posts['startYear'][] = $row["startYear"];
		$posts['startMonth'][] = $row["startMonth"];
		$posts['startDay'][] = $row["startDay"];
		$posts['endYear'][] = $row["endYear"];
		$posts['endMonth'][] = $row["endMonth"];
		$posts['endDay'][] = $row["endDay"];
		
		
		echo '{';
		echo "<br>";
		echo '"id":'.$row["idTask"].',';
		echo "<br>";
		echo '"idEmp":'.$row["assgndTo"].',';
		echo "<br>";
		echo '"name":"'.$row["task"].'",';
		echo "<br>";
		echo '"location":"'.$row["details"].'",';
		echo "<br>";
		echo '"startYear":'.$row["startYear"].',';
		echo "<br>";
		echo '"startMonth":'.$row["startMonth"].',';
		echo "<br>";
		echo '"startDay":'.$row["startDay"].',';
		echo "<br>";
		echo '"endYear":'.$row["endYear"].',';
		echo "<br>";
		echo '"endMonth":'.$row["endMonth"].',';
		echo "<br>";
		echo '"endDay":'.$row["endDay"];
		echo "<br>";
		echo '}';
		echo "<br>";

		if(($count-1) >= 1)
		{
			echo ", <br>";
		}

		$count--;
	}
	echo ']';
?>