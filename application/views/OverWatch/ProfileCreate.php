<div class="container">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 box-outer">
			<h2>Opret Profil</h2>
			<p>Sørg for at kopiere battletag fra battle.net da det er vigtigt at store og små bokstaver.</p>

			
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
					<label for="BattleTag" class="col-sm-3 control-label">BattleTag:</label>
					<div class="col-sm-9">
						<input type="text" id="BattleTag" name="BattleTag" placeholder="Indtast BattleTag" value="<?php echo $post['BattleTag']; ?>" class="form-control" autofocus>
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