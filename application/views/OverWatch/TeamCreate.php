<div class="container">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 box-outer">
			<h2>Opret hold</h2>
			<p>Indtast navnet på holdet neden for</p>



			<?php
				if( function_exists("validation_errors" ) ) {

					$errors = validation_errors('|','|');
			
					$errors = explode("|",$errors);
	
					if( isset( $errors[1] ) ) {
						echo '<div class="alert alert-danger" role="alert">Advarsel: ';
						echo $errors[1];
						echo '</div>';
					}

				}
			?>

			<form method="post">
				
			
				<div class="form-group row">
					<label for="TeamName" class="col-sm-3 control-label">Holnavn:</label>
					<div class="col-sm-9">
						<input type="text" id="TeamName" name="TeamName" placeholder="Indtast Holdnavn" value="<?php echo $post['TeamName']; ?>" class="form-control" autofocus>
					</div>
				</div>
				<div class="form-group">
						<div class="col-sm-9 col-sm-offset-3">
							<button type="submit" class="btn btn-primary btn-block">Opret</button>
						</div>
				</div>
			</form>
	
	
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>