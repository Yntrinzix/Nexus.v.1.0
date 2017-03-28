<?php

	require_once('dbcon_pdo.php');  



	$stmt = $dbcon_pdo-> prepare("SELECT t.task, t.details, t.dateAssgnd, t.dateStart, t.dateDue, t.priority, t.status, t.dateFinish, CONCAT(e.fName, ' ', e.lName) As Employee FROM task t LEFT JOIN assigned a On a.idTask=t.idTask LEFT JOIN employee e On e.idEmp=a.assgndTo LEFT JOIN progress p ON p.idAssgnd=a.assgndTo");

	$stmt->execute();



	foreach($stmt as $row)

	{	

		echo '<table>

			  <tr>

				<th>Task: '.$row["task"].'</th>

				<th>Details: '.$row["details"].'</th>

			  </tr>

			   <tr>

				<th>Date Assigned: '.$row["dateAssgnd"].'</th>

				<th>Time Frame: '.$row["dateStart"].'-'.$row["dateDue"].'</th>

			  </tr>

			 

			  <tr>

				<td>Jill</td>

				<td>Smith</td> 

				<td>50</td>

			  </tr>

			  <tr>

				<td>Eve</td>

				<td>Jackson</td> 

				<td>94</td>

			  </tr>

			</table>';

	}	

	

?>