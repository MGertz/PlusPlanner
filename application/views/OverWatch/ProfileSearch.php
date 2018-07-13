<div class="container box-outer">
<h2><?php echo $sitetitle; ?></h2>

<div class="row">
	<div class="container">
		
		<form action="/Overwatch/ProfileSearch/" method="post">
				
				
				
				<div class="form-group row">
					<div class="col-sm-9">
						<input type="text" name="search" value="<?php echo $Search; ?>" placeholder="Indtast dele af/hele BattleTag">
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
					<th scope="col">SR</th>
					
				
				</tr>
			</thead>
			<tbody>

				<?php
				foreach( $Profiles as $Profile ) {
					echo "<tr>";

						echo "<td><a href='/Overwatch/ProfileView/".$Profile["ProfileID"]."'>vis</a></td>";
						echo "<td>".$Profile["BattleTag"]."</td>";
						echo "<td>".$Profile["SR"]."</td>";

							
					echo "</tr>";
				}


				?>
			</tbody>
		</table>



	</div>
</div>


</div>