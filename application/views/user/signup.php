<div class="container">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 box-outer">
			<h2>Bruger registrering</h2>
			<p>*udfyld alle felter</p>

			
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
					<label for="Username" class="col-sm-3 control-label">Brugernavn:</label>
					<div class="col-sm-9">
						<input type="text" id="Username" name="Username" placeholder="Indtast brugernavn" value="<?php echo $post['Username']; ?>" class="form-control" autofocus>
					</div>
				</div>
				
				<div class="form-group row">
					<label for="Firstname" class="col-sm-3 control-label">Fornavn:</label>
					<div class="col-sm-9">
						<input type="text" id="Firstname" name="Firstname" placeholder="Indtast fornavn" value="<?php echo $post['Firstname']; ?>" class="form-control">
						
					</div>
				</div>
				<div class="form-group row">
					<label for="Lastname" class="col-sm-3 control-label">Efternavn:</label>
					<div class="col-sm-9">
						<input type="text" id="Lastname" name="Lastname" placeholder="Indtast Efternavn" value="<?php echo $post['Lastname']; ?>" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label for="Password" class="col-sm-3 control-label">Kodeord</label>
					<div class="col-sm-9">
						<input type="Password" id="Password" name="Password" placeholder="Indtast kodeord" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label for="Passconf" class="col-sm-3 control-label">Gentag kodeord</label>
					<div class="col-sm-9">
						<input type="password" id="Passconf" name="Passconf" placeholder="Indtast kodeord igen" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label for="Email" class="col-sm-3 control-label">Email</label>
					<div class="col-sm-9">
						<input type="email" id="Email" name="Email" placeholder="Indtast Email" value="<?php echo $post['Email']; ?>" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label for="Zipcode" class="col-sm-3 control-label">Postnummer:</label>
					<div class="col-sm-9">
						<input type="text" id="Zipcode" name="Zipcode" placeholder="Indtast postnummer, bruges kun til statistik" value="<?php echo $post['Zipcode']; ?>" class="form-control">
					</div>
				</div>

				<!-- line to make sure Gender is posted if not selected -->
					<input type="hidden" name="Gender" value="">
				<!-- line to make sure Gender is posted if not selected -->


				<div class="form-group row">
					<label for="" class="control-label col-sm-3">Køn</label>
					<div class="col-sm-9">
						<div class="checkbox">
							<label>
								<input type="radio" id="Male" value="M" name="Gender" <?php if( $post['Gender'] == 'M' ) echo 'checked="checked"'; ?>> Dreng
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="radio" id="Female" value="F" name="Gender" <?php if( $post['Gender'] == 'F' ) echo 'checked="checked"'; ?>> Pige
							</label>
						</div>
					</div>
				</div>


				<div class="form-group row">
					<label for="Birthday" class="col-sm-3 control-label">Fødselsdag</label>
					<div class="col-sm-9">
						<input type="date" id="Birthday" name="Birthday" placeholder="" value="<?php echo $post['Birthday']; ?>" class="form-control">
					</div>
				</div>
				
				
				<div class="form-group row">
					<label for="Newsletter" class="col-sm-3 control-label">Nyhedsbrev</label>
					<div class="col-sm-9">
						<input type="checkbox" id="Newsletter" name="Newsletter" value="true" class="form-check-input form-control" checked>
						
					</div>
				</div>



				<div class="form-group row">
					<label for="EULA" class="col-sm-3 control-label">Betingelser</label>
					<div class="col-sm-9">
					<input type="checkbox" id="EULA" name="EULA" value="true" class="form-check-input form-control">
					<label class="form-check-label" for="EULA"><a href="#">Betingelser</a></label>

					</div>
				</div>





				<div class="form-group">
						<div class="col-sm-9 col-sm-offset-3">
							<button type="submit" class="btn btn-primary btn-block">Registrer</button>
						</div>
				</div>
			</form>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>