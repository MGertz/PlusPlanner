<div class="container box-outer">
<h2><?php echo $sitetitle; ?></h2>

<div class="row">
	<div class="container">
		<form method="get">


		</form>
	</div>
</div>

<div class="row">
	<div class="container">

		<table class="table table-striped table-bordered table-plusplanner">
			<thead class="thead-plusplanner">
				<tr>
					<th scope="col">Status</th>
					<th scope="col">First Team</th>
					<th scope="col">Second Team</th>
					<th scope="col">Start Time</th>
					<th scope="col">End Time</th>
					
				</tr>
			</thead>
			<tbody>

				<?php

				foreach( $Scrims as $row ) {
					echo "<tr>";

						echo "<td>".$row["Status"]."</td>";
						echo "<td>".$row["TeamName"]."</td>";
						echo "<td>&nbsp;</td>";
						echo "<td>".$row["Time_Start"]."</td>";
						echo "<td>".$row["Time_End"]."</td>";
							
					echo "</tr>";
				}



				?>
			</tbody>
		</table>



	</div>
</div>


</div>