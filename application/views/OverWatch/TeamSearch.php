<div class="container box-outer">
<h2><?php echo $sitetitle; ?></h2>

<div class="row">
	<div class="container">
		
		<form action="/OverWatch/TeamSearch/" method="post">
				
				
				
				<div class="form-group row">
					<label for="TeamID" class="col-sm-3 control-label">Hold:</label>
					<div class="col-sm-9">
						<input type="text" name="search" value="<?php echo $Search; ?>">
						<input type="submit" value="Søg">
					</div>
				</div>

		</form>
	</div>
</div>

<div class="row">
	<div class="container">

		<table class="table table-striped table-bordered table-plusplanner">
			<thead class="thead-plusplanner">
				<tr>
					<th scope="col">#</th>
					<th scope="col">TeamName</th>
					<th scope="col">Players</th>
				
				</tr>
			</thead>
			<tbody>

				<?php
				foreach( $Teams as $Team ) {
					echo "<tr>";

						echo "<td><a href='/OverWatch/TeamView/".$Team["TeamID"]."'>vis</a></td>";
						echo "<td>".$Team["Name"]."</td>";
						echo "<td>&nbsp;</td>";
							
					echo "</tr>";
				}


				?>
			</tbody>
		</table>



	</div>
</div>


</div>